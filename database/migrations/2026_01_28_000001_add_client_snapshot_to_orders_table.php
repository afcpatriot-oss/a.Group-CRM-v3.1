<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {

            // ФИО покупателя одной строкой (снимок на момент заказа)
            $table->string('client_name')->nullable()->after('client_id');

            // Телефон покупателя (для списков и быстрого поиска)
            $table->string('phone', 30)->nullable()->after('client_name');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['client_name', 'phone']);
        });
    }
};
