# Strict GAP Analysis: Orders vs Tickets/Leads/Skeleton v4

Scope: architecture-only GAP analysis.
No refactoring. No fixes. No proposals.

Comparison baseline:
1. Current Orders implementation
2. Tickets architecture (execution model)
3. Leads architecture (UI model)
4. `docs/MODULE_SKELETON_V4.md`

---

## CRITICAL deviations

### 1) Response payload/controller contract breaks (runtime-fatal level)
- `Orders@store` returns payload with only `order_id`, but `StoreResponse` renders with `$order` object (`collect([$order])`), which is not provided by controller payload.
- `Orders@update` returns payload with `orders` collection and `order_id`, but `UpdateResponse` uses `$order` object (`$order->id` and row render from `$order`).

References:
- `app/Http/Controllers/Orders.php` (store/update payload keys).  
- `app/Http/Responses/Orders/StoreResponse.php` (expects `$order`).  
- `app/Http/Responses/Orders/UpdateResponse.php` (expects `$order`).

### 2) Edit response expects template context not supplied by controller
- `EditResponse` renders `pages/orders/components/modals/$template` and expects `page/categories/projects/fields/statuses`, but `Orders@edit` sends only `order`, `statuses`, `fields`.
- This is a direct response-context mismatch.

References:
- `app/Http/Controllers/Orders.php` (`edit` payload).  
- `app/Http/Responses/Orders/EditResponse.php` (`$template` + compact vars).

### 3) Blade file contains embedded PHP controller class (file-structure violation)
- `resources/views/pages/orders/components/modals/show.blade.php` contains full controller PHP code (`namespace App\Http\Controllers; class Orders extends Controller ...`) after modal markup.
- This violates module file boundaries and the skeleton’s distributed structure expectations.

References:
- `resources/views/pages/orders/components/modals/show.blade.php`.
- `docs/MODULE_SKELETON_V4.md` (real file structure + controller rules).

### 4) Route/controller lifecycle mismatch (core lifecycle endpoints absent from routing)
- `Orders` controller includes edit/update/destroy/changeStatus/archive/restore actions.
- `routes/custom/web.php` exposes only: index/create/store/show/update.
- Therefore significant lifecycle actions are unreachable via current routing despite existing response classes and views.

References:
- `app/Http/Controllers/Orders.php` (public action list).
- `routes/custom/web.php` (registered orders routes).
- `docs/MODULE_SKELETON_V4.md` (strict route section and lifecycle expectations).

### 5) Tickets-style close lifecycle missing from current Orders implementation
- Requested execution reference (Tickets) includes explicit close lifecycle (`closeTicket`, closed transition behavior).
- Current Orders controller has no close action/method, while a `CloseOrderResponse` file exists.

References:
- `app/Http/Controllers/Tickets.php` (close lifecycle action).
- `app/Http/Controllers/Orders.php` (no close action).
- `app/Http/Responses/Orders/CloseOrderResponse.php` (orphan response class).
- `docs/MODULE_SKELETON_V4.md` (lifecycle from Tickets pattern).

### 6) Database policy conflict vs Skeleton v4
- Skeleton v4 states: NO migrations in this workflow.
- Orders implementation includes dedicated migration files for orders table creation and schema updates.

References:
- `docs/MODULE_SKELETON_V4.md` (database policy: NO migrations).
- `database/migrations/2026_02_08_025759_create_orders_table.php`.
- `database/migrations/2026_01_28_000001_add_client_snapshot_to_orders_table.php`.

---

## MAJOR deviations

### 1) Modal integration diverges from Leads card-modal pattern
- Leads UI model opens records via `#cardModal` from table/kanban entry points and uses card shell regions (`#cardModalContent`, `#cardModalTabMenu`, left/right panels).
- Orders table rows link to direct URLs (`href="/orders/{id}"`) and do not use `data-target="#cardModal"` entry flow.
- Orders `ShowResponse` writes only to `#cardModalBody` and toggles `#cardModal` visibility, without card shell/tab menu contract used by Leads.

References:
- `resources/views/pages/leads/components/table/ajax.blade.php` (cardModal entry).
- `resources/views/pages/leads/components/kanban/card.blade.php` (cardModal entry).
- `resources/views/pages/lead/modal.blade.php` (cardModal structure).
- `resources/views/pages/orders/components/table/ajax.blade.php` and `ajax-inc.blade.php` (direct links).
- `app/Http/Responses/Orders/ShowResponse.php`.

### 2) Lifecycle model deviation from Tickets execution flow
- Tickets uses explicit index → show(full page ticket wrapper) → update(with edit_source behavior) → close semantics.
- Orders currently mixes:
  - index list pattern,
  - show as modal-body JSON only,
  - update row replace without source context branching,
  - no explicit close lifecycle.

References:
- `app/Http/Controllers/Tickets.php` + `app/Http/Responses/Tickets/UpdateResponse.php` + `CloseTicketResponse.php`.
- `app/Http/Controllers/Orders.php` + `app/Http/Responses/Orders/ShowResponse.php` + `UpdateResponse.php`.

### 3) Status handling schema inconsistencies
- In Orders domain, status field in repository/model flow is `status_id`.
- `OrderStatus` relation points to `order_status` field (`hasMany(..., 'order_status', 'id')`) creating field-name inconsistency.
- Orders table row status display uses static `runtimeLang('order_status')` rather than current record status mapping.

References:
- `app/Repositories/OrderRepository.php` (`status_id` usage).
- `app/Models/Order.php` (`status_id` fillable).
- `app/Models/OrderStatus.php` (relationship on `order_status`).
- `resources/views/pages/orders/components/table/ajax.blade.php` and `ajax-inc.blade.php` (status render).

### 4) NX.UX command mismatch vs established contract wording
- Tickets/Leads responses consistently use `close-modal` in `dom_visibility` actions.
- Orders `StoreResponse` and `UpdateResponse` use action `close` for `#commonModal` instead of `close-modal`.

References:
- `app/Http/Responses/Tickets/UpdateResponse.php` (`close-modal`).
- `app/Http/Responses/Leads/UpdateResponse.php` (modal close pattern).
- `app/Http/Responses/Orders/StoreResponse.php` and `UpdateResponse.php` (`close`).

### 5) Controller rule drift vs skeleton “UI in responses only” principle (indirect)
- Skeleton mandates controller orchestration with UI in response classes.
- Orders controller imports many response classes for features not route-bound and not lifecycle-consistent (`DestroyResponse`, `ChangeStatusResponse`, `ArchiveRestoreResponse`) while route map remains minimal; this creates orchestration/contract drift.

References:
- `docs/MODULE_SKELETON_V4.md` (controller rules + lifecycle).
- `app/Http/Controllers/Orders.php`.
- `routes/custom/web.php`.

### 6) File structure inconsistency against skeleton’s canonical response set
- Skeleton’s listed minimal response structure for Orders highlights `IndexListResponse`, `ShowResponse`, `CreateResponse`.
- Current Orders response directory contains large ticket-cloned set (reply, tags, archive, pinning, close, etc.), partially disconnected from routes/controller lifecycle.

References:
- `docs/MODULE_SKELETON_V4.md` (real file structure).
- `app/Http/Responses/Orders/` (response inventory).
- `routes/custom/web.php`.

---

## MINOR deviations

### 1) Mixed identifier conventions (`id` vs `order_id`) across views/responses
- Orders views and responses alternate row keys/selectors using `id` and `order_id`.
- Archive/status responses target `#order_{$order->order_id}` while table rows are keyed as `#order_{$order->id}`.

References:
- `resources/views/pages/orders/components/table/ajax.blade.php` and `ajax-inc.blade.php` (row ids use `id`).
- `app/Http/Responses/Orders/ArchiveRestoreResponse.php` and `ChangeStatusResponse.php` (selectors use `order_id`).

### 2) Inconsistent naming/UX parity in page settings and view wiring
- Orders `pageSettings()` is minimal compared with Tickets/Leads page metadata patterns (dynamic search URL, sidepanel id, modal action defaults).
- This creates partial parity with NX.UX list scaffolding but does not fully mirror reference metadata contracts.

References:
- `app/Http/Controllers/Orders.php` (`pageSettings`).
- `app/Http/Controllers/Tickets.php` (`pageSettings`).
- `app/Http/Controllers/Leads.php` (`pageSettings`).

### 3) Non-uniform response style inside Orders module
- Some responses follow event/module injection contract (ticket-style clones), while others are minimal direct JSON without event hooks.
- This is an internal consistency gap across the same Orders module response layer.

References:
- `app/Http/Responses/Orders/EditResponse.php`, `ChangeStatusResponse.php` (event + injections).
- `app/Http/Responses/Orders/CreateResponse.php`, `ShowResponse.php`, `StoreResponse.php`, `UpdateResponse.php` (minimal JSON only).

---

## Controller rule violations (explicit checklist)

### CRITICAL
- Controller code embedded inside Blade template file (`resources/views/pages/orders/components/modals/show.blade.php`).

### MAJOR
- Controller-response payload contract mismatches causing response-layer dependence on missing controller-supplied vars (`store`, `update`, `edit` chains).
- Route exposure does not align with declared controller actions and response classes (orchestrator contract inconsistency).

References:
- `app/Http/Controllers/Orders.php`
- `app/Http/Responses/Orders/StoreResponse.php`
- `app/Http/Responses/Orders/UpdateResponse.php`
- `app/Http/Responses/Orders/EditResponse.php`
- `routes/custom/web.php`
- `resources/views/pages/orders/components/modals/show.blade.php`

---

## Final classification summary

- **CRITICAL:** 6 deviations
- **MAJOR:** 6 deviations
- **MINOR:** 3 deviations

This is a strict deviation inventory only.
