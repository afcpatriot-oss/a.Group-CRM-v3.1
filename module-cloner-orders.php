<?php
/**
 * Grow CRM Module Cloner (Tickets -> Orders baseline)
 *
 * Цель:
 *  - Создать модуль/сущность Orders как 1:1 копию Tickets по структуре (канон платформы)
 *  - Сформировать views-структуру Orders как у Tickets (wrapper/compose/…)
 *  - Подготовить миграцию orders (минимальную)
 *  - НЕ ломать core: не патчить автоматически routes/web.php и configs — только выдавать готовые вставки
 *
 * Запуск:
 *  php module-cloner-orders.php Tickets Orders
 *
 * Опции:
 *  --force              перезаписать целевую папку (ОПАСНО, лучше не надо)
 *  --with-leads-ui      дополнительно скопировать Lead-style views (как reference, НЕ включать в ранний baseline)
 *  --dry-run            показать, что будет сделано, но ничего не записывать
 *  --project-root=/path явно указать корень проекта (если скрипт лежит не в корне)
 *
 * Важно:
 *  - Скрипт не меняет БД, не запускает миграции, не трогает core роуты.
 *  - Он создает/клонирует файлы и выводит инструкции по ручным вставкам.
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');

// -----------------------------
// CLI args
// -----------------------------
function hasFlag(string $flag): bool {
    global $argv;
    return in_array($flag, $argv, true);
}

function getOption(string $name, ?string $default = null): ?string {
    global $argv;
    foreach ($argv as $arg) {
        if (str_starts_with($arg, $name . '=')) {
            return substr($arg, strlen($name) + 1);
        }
    }
    return $default;
}

if ($argc < 3) {
    echo "Использование: php module-cloner-orders.php <SourceModule> <TargetModule> [--dry-run] [--force] [--with-leads-ui] [--project-root=/path]\n";
    exit(1);
}

$sourceModule = $argv[1]; // e.g. Tickets
$targetModule = $argv[2]; // e.g. Orders

$dryRun = hasFlag('--dry-run');
$force  = hasFlag('--force');
$withLeadsUI = hasFlag('--with-leads-ui');

$projectRoot = getOption('--project-root', __DIR__);
$projectRoot = rtrim($projectRoot, '/\\');

// -----------------------------
// Grow CRM typical structure assumptions
// (works for your project style: app/Http/... + resources/views/pages/...)
// -----------------------------
$paths = [
    // Controllers
    'controllers' => $projectRoot . '/app/Http/Controllers',

    // Requests (optional)
    'requests' => $projectRoot . '/app/Http/Requests',

    // Repositories
    'repositories' => $projectRoot . '/app/Repositories',

    // Responses
    'responses' => $projectRoot . '/app/Http/Responses',

    // Events (optional)
    'events' => $projectRoot . '/app/Events',

    // Models
    'models' => $projectRoot . '/app/Models',

    // Views
    'views_pages' => $projectRoot . '/resources/views/pages',

    // Migrations
    'migrations' => $projectRoot . '/database/migrations',

    // Routes
    'routes_web' => $projectRoot . '/routes/web.php',
];

// -----------------------------
// Safety checks
// -----------------------------
function mustExistDir(string $path, string $label) {
    if (!is_dir($path)) {
        echo "❌ Не найдена папка ($label): $path\n";
        exit(1);
    }
}

mustExistDir($projectRoot, 'project-root');
mustExistDir($paths['controllers'], 'controllers');
mustExistDir($paths['views_pages'], 'views/pages');
mustExistDir($paths['migrations'], 'migrations');

// -----------------------------
// Helpers
// -----------------------------
function println(string $s = '') { echo $s . PHP_EOL; }

function ensureDir(string $dir, bool $dryRun): void {
    if (is_dir($dir)) return;
    if ($dryRun) return;
    mkdir($dir, 0755, true);
}

function rrmdir(string $dir, bool $dryRun): void {
    if (!is_dir($dir)) return;
    if ($dryRun) return;
    $items = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );
    foreach ($items as $item) {
        $path = $item->getPathname();
        if ($item->isDir()) rmdir($path);
        else unlink($path);
    }
    rmdir($dir);
}

/**
 * Replace strategy:
 *  - Replace class/module names in multiple forms:
 *    Tickets -> Orders
 *    tickets -> orders
 *    Ticket  -> Order
 *    ticket  -> order
 *
 * NOTE:
 *  - We intentionally keep this conservative.
 *  - It’s okay if some replacements remain and you adjust manually later.
 */
function buildReplacements(string $sourceModule, string $targetModule): array {
    $sourceSingular = rtrim($sourceModule, 's'); // Tickets -> Ticket (best effort)
    $targetSingular = rtrim($targetModule, 's'); // Orders -> Order

    return [
        // Module names
        $sourceModule => $targetModule,
        strtolower($sourceModule) => strtolower($targetModule),

        // Singular
        $sourceSingular => $targetSingular,
        strtolower($sourceSingular) => strtolower($targetSingular),

        // Common variable names
        '$ticket' => '$order',
        '$tickets' => '$orders',

        // In case someone used lead variables in ticket clones earlier
        '$lead' => '$order',
        '$leads' => '$orders',
    ];
}

function replaceContent(string $content, array $map): string {
    // Simple str_replace chain (predictable)
    $search = array_keys($map);
    $replace = array_values($map);
    return str_replace($search, $replace, $content);
}

function copyTreeWithReplace(string $src, string $dst, array $replaceMap, array $excludePatterns, bool $dryRun): void {
    $src = rtrim($src, '/\\');
    $dst = rtrim($dst, '/\\');

    $it = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($src, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($it as $item) {
        $from = $item->getPathname();
        $rel  = substr($from, strlen($src) + 1);
        $to   = $dst . DIRECTORY_SEPARATOR . $rel;

        // Excludes
        foreach ($excludePatterns as $pattern) {
            if (preg_match($pattern, $rel)) {
                continue 2;
            }
        }

        if ($item->isDir()) {
            ensureDir($to, $dryRun);
            continue;
        }

        // Rename file if it contains sourceModule / sourceSingular tokens in filename
        $toRenamed = $to;
        foreach ($replaceMap as $k => $v) {
            $toRenamed = str_replace($k, $v, $toRenamed);
        }

        if ($dryRun) {
            println("DRY: copy $rel -> " . substr($toRenamed, strlen($dst) + 1));
            continue;
        }

        ensureDir(dirname($toRenamed), false);

        $content = file_get_contents($from);
        $content = replaceContent($content, $replaceMap);

        file_put_contents($toRenamed, $content);
    }
}

function writeFile(string $path, string $content, bool $dryRun): void {
    if ($dryRun) {
        println("DRY: write " . $path);
        return;
    }
    ensureDir(dirname($path), false);
    file_put_contents($path, $content);
}

function timestamp(): string {
    return date('Y_m_d_His');
}

// -----------------------------
// Define source/target locations (baseline = tickets structure)
// -----------------------------
$src = [
    'controller'   => $paths['controllers'] . '/' . $sourceModule . '.php',
    'responses'    => $paths['responses'] . '/' . $sourceModule,
    'requests'     => $paths['requests'] . '/' . $sourceModule,
    'repositories' => $paths['repositories'],
    'views'        => $paths['views_pages'] . '/' . strtolower($sourceModule),
];

$dst = [
    'controller'   => $paths['controllers'] . '/' . $targetModule . '.php',
    'responses'    => $paths['responses'] . '/' . $targetModule,
    'requests'     => $paths['requests'] . '/' . $targetModule,
    'views'        => $paths['views_pages'] . '/' . strtolower($targetModule),
];

// Baseline checks
if (!file_exists($src['controller'])) {
    println("❌ Не найден контроллер источника: {$src['controller']}");
    println("   Ожидается файл вида app/Http/Controllers/{$sourceModule}.php");
    exit(1);
}
if (!is_dir($src['views'])) {
    println("❌ Не найдены views источника: {$src['views']}");
    println("   Ожидается папка вида resources/views/pages/" . strtolower($sourceModule));
    exit(1);
}
if (!is_dir($src['responses'])) {
    println("⚠️ Не найдены Responses источника: {$src['responses']}");
    println("   Это возможно, если проект устроен иначе. Скрипт продолжит, но часть будет пропущена.");
}

// Target existence
if ((file_exists($dst['controller']) || is_dir($dst['responses']) || is_dir($dst['views'])) && !$force) {
    println("❌ Цель уже существует. Чтобы перезаписать, используй --force (ОПАСНО).");
    println("   controller: {$dst['controller']}");
    println("   responses:  {$dst['responses']}");
    println("   views:      {$dst['views']}");
    exit(1);
}

// If force - remove target dirs/files
if ($force) {
    println("⚠️ --force включен: целевые файлы будут удалены и созданы заново.");
    if (file_exists($dst['controller'])) {
        if (!$dryRun) unlink($dst['controller']);
    }
    rrmdir($dst['responses'], $dryRun);
    rrmdir($dst['views'], $dryRun);
}

// Replacement map
$replaceMap = buildReplacements($sourceModule, $targetModule);

// Exclude patterns (keep minimal; you can add more later)
$excludePatterns = [
    '/^\.git\//',
    '/^node_modules\//',
    '/^vendor\//',
    '/\.log$/',
    '/\.tmp$/',
];

// -----------------------------
// 1) Clone Controller
// -----------------------------
println("== 1) Клонируем Controller ==");
$controllerContent = file_get_contents($src['controller']);
$controllerContent = replaceContent($controllerContent, $replaceMap);
writeFile($dst['controller'], $controllerContent, $dryRun);
println("✅ Controller: {$dst['controller']}");

// -----------------------------
// 2) Clone Responses (if exists)
// -----------------------------
println("\n== 2) Клонируем Responses (если есть) ==");
if (is_dir($src['responses'])) {
    copyTreeWithReplace($src['responses'], $dst['responses'], $replaceMap, $excludePatterns, $dryRun);
    println("✅ Responses: {$dst['responses']}");
} else {
    println("↪ Пропущено: responses источника не найдены.");
}

// -----------------------------
// 3) Clone Views (tickets -> orders baseline)
// -----------------------------
println("\n== 3) Клонируем Views (pages/{$sourceModule} -> pages/{$targetModule}) ==");
copyTreeWithReplace($src['views'], $dst['views'], $replaceMap, $excludePatterns, $dryRun);
println("✅ Views: {$dst['views']}");

// -----------------------------
// 4) Optional: copy Lead-style UI as a reference pack (NOT baseline)
// -----------------------------
if ($withLeadsUI) {
    println("\n== 4) Дополнительно: копируем Lead-style UI (как reference) ==");
    $leadViews = $paths['views_pages'] . '/leads';
    if (!is_dir($leadViews)) {
        println("⚠️ Не найдено: $leadViews (пропущено)");
    } else {
        $refDir = $dst['views'] . '/_reference_from_leads';
        copyTreeWithReplace($leadViews, $refDir, ['$lead' => '$order', '$leads' => '$orders'], $excludePatterns, $dryRun);
        println("✅ Lead-style reference: $refDir");
    }
}

// -----------------------------
// 5) Create minimal Orders migration (safe baseline)
// -----------------------------
println("\n== 5) Создаём минимальную миграцию orders (baseline) ==");
$migrationName = timestamp() . "_create_orders_table.php";
$migrationPath = $paths['migrations'] . '/' . $migrationName;

$migrationTemplate = <<<PHP
<?php

use Illuminate\\Database\\Migrations\\Migration;
use Illuminate\\Database\\Schema\\Blueprint;
use Illuminate\\Support\\Facades\\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Baseline table. Business fields (statuses, sales models, antifraud, etc)
        // будут добавлены позже осознанно, после выравнивания с платформой.
        Schema::create('orders', function (Blueprint \$table) {
            // Grow CRM-style PK (explicit)
            \$table->bigIncrements('order_id');

            // Minimal client identity layer (you already use these fields)
            \$table->string('first_name')->nullable();
            \$table->string('last_name')->nullable();
            \$table->string('middle_name')->nullable();
            \$table->string('phone')->nullable();

            // Optional future-proof placeholders (safe)
            \$table->string('source_type')->nullable(); // manual / preland / land / api etc (you will finalize later)
            \$table->unsignedBigInteger('user_id')->nullable(); // creator/operator

            // Platform timestamps
            \$table->timestamps();

            // Indexes (minimal)
            \$table->index('phone');
            \$table->index('user_id');
            \$table->index('source_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
PHP;

writeFile($migrationPath, $migrationTemplate, $dryRun);
println("✅ Migration: $migrationPath");

// -----------------------------
// 6) Output safe route snippet (manual insertion)
// -----------------------------
println("\n== 6) Роуты: выдаём безопасную вставку (НЕ патчим автоматически) ==");
$routeSnippet = <<<PHP
// --- Orders (generated snippet) ---
use App\\Http\\Controllers\\{$targetModule};

Route::prefix('orders')->group(function () {
    Route::get('/', [{$targetModule}::class, 'index'])->name('orders.index');
    Route::get('/create', [{$targetModule}::class, 'create'])->name('orders.create');
    Route::post('/', [{$targetModule}::class, 'store'])->name('orders.store');
    Route::get('/{order}', [{$targetModule}::class, 'show'])->name('orders.show');
});
PHP;

println($routeSnippet);

// -----------------------------
// 7) Final notes and next steps
// -----------------------------
println("\n✅ ГОТОВО: baseline Orders создан на базе {$sourceModule}.");
println("Важно: это БАЗА (структура). Бизнес-логику ты выравниваешь позже, сравнивая со старым дампом.");

if ($dryRun) {
    println("\nDRY-RUN режим: файлы не записаны. Убери --dry-run для реального запуска.");
}
