# Structured Architectural Comparison Before Orders

This document is architecture-only and references concrete implementation files.
It does not propose changes.

---

## Module A: Tickets (reference = lifecycle/status/response/NX.UX/cardModal usage)

## 1) Controller structure
- Main controller: `app/Http/Controllers/Tickets.php`.
- Constructor wiring is repository-driven and action-specific middleware-gated (`ticketsMiddlewareFiltering`, `ticketsMiddlewareIndex`, `ticketsMiddlewareCreate`, `ticketsMiddlewareEdit`, `ticketsMiddlewareBulkEdit`, etc.).
- Core execution methods are concentrated around list/detail/update/close and related actions:
  - `index`, `show`, `update`, `closeTicket`
  - plus `create/store`, `changeStatus/changeStatusUpdate`, `archive/restore`, reply/tag/pin endpoints.
- Supporting controller helpers for section setup and counters are local (`pageSettings`, `statsWidget`).

Reference files:
- `app/Http/Controllers/Tickets.php`

## 2) Response class pattern
- Response classes are in `app/Http/Responses/Tickets/*` and consistently use `Responsable` with payload unpacking.
- Pattern:
  1. unpack `$payload`
  2. optionally fire response event
  3. optionally apply `module_injections`
  4. return either full HTML (wrapper/view) or NX.UX JSON command payload.
- Examples:
  - `IndexResponse`: full wrapper for non-AJAX, JSON for `load/sort/search/ext` with `dom_html`, `dom_visibility`, `dom_attributes`, `dom_classes`, etc.
  - `UpdateResponse`: context-based (list vs page) row patch or redirect.
  - `ChangeStatusResponse`: renders modal body for action `show`, patches rows for action `update`.
  - `ReplyResponse`/`EditResponse`: modal-body replacement and postrun hooks (`NXTicketReplay`, `NXTicketEdit`).

Reference files:
- `app/Http/Responses/Tickets/IndexResponse.php`
- `app/Http/Responses/Tickets/ShowResponse.php`
- `app/Http/Responses/Tickets/UpdateResponse.php`
- `app/Http/Responses/Tickets/ChangeStatusResponse.php`
- `app/Http/Responses/Tickets/ReplyResponse.php`
- `app/Http/Responses/Tickets/EditResponse.php`

## 3) Routes
- Tickets uses hybrid routing in `routes/web.php`:
  - action routes under `Route::group(['prefix' => 'tickets'], ...)`
    (`/search`, `/{ticket}/reply`, `/{ticket}/postreply`, `/change-status`, `/archive`, `/restore`, `/{ticket}/close`, etc.)
  - plus `Route::resource('tickets', 'Tickets')` for CRUD resource endpoints.

Reference file:
- `routes/web.php`

## 4) Modal entry flow
- Tickets actions are generally entered via `#commonModal` and `#actionsModal`.
- List/table and ticket-page buttons carry AJAX metadata (`js-ajax-ux-request`, `data-url`, `data-action-url`, `data-action-method`, `data-loading-target`).
- Bulk status uses `#actionsModal` + `#actionsModalBody`.
- Edit/reply/tags actions target `#commonModal` + `#commonModalBody`.

Reference files:
- `resources/views/pages/tickets/components/misc/list-page-actions.blade.php`
- `resources/views/pages/tickets/components/table/ajax-inc.blade.php`
- `resources/views/pages/tickets/components/actions/checkbox-actions.blade.php`
- `resources/views/pages/ticket/components/body.blade.php`
- `resources/views/pages/ticket/components/misc/actions.blade.php`

## 5) Lifecycle flow (index → show → update → close)
- **index**: `Tickets@index` loads tickets, categories, statuses, stats, custom fields; response decides full page vs JSON update.
- **show**: `Tickets@show` loads ticket + replies + canned data + fields and marks event tracking as read.
- **update**: `Tickets@update` persists modifications, re-queries the ticket, and returns list-row replacement or redirect depending on `edit_source`.
- **close**: `Tickets@closeTicket` enforces `ticket_status = 2`; close transition side-effects are triggered when old status was not closed.

Reference files:
- `app/Http/Controllers/Tickets.php`
- `app/Http/Responses/Tickets/IndexResponse.php`
- `app/Http/Responses/Tickets/ShowResponse.php`
- `app/Http/Responses/Tickets/UpdateResponse.php`
- `app/Http/Responses/Tickets/CloseTicketResponse.php`

## 6) Status logic
- Status data source is dynamic table model `TicketStatus` (`tickets_status`).
- Status list is used in index/edit and stats calculation.
- Bulk status update flow:
  - `changeStatus()` returns status-selection modal content.
  - `changeStatusUpdate()` writes posted status to selected tickets and returns row-level DOM updates.
- Close semantics are explicit in controller logic via status ID `2` guards.

Reference files:
- `app/Models/TicketStatus.php`
- `app/Http/Controllers/Tickets.php`
- `app/Http/Responses/Tickets/ChangeStatusResponse.php`
- `app/Repositories/TicketRepository.php`

## 7) NX.UX integration
- Trigger side: `js-ajax-ux-request` + data-attribute contract in ticket views.
- Response side: JSON commands with `dom_html`, `dom_visibility`, `dom_classes`, `dom_attributes`, `redirect_url`, `notification`, `postrun_functions`.
- Supports embedded mode (`source=ext`) and list operations (`load/sort/search`) with server-selected partial templates.

Reference files:
- `resources/views/pages/tickets/components/*`
- `resources/views/pages/ticket/components/*`
- `app/Http/Responses/Tickets/IndexResponse.php`
- `app/Http/Responses/Tickets/UpdateResponse.php`
- `app/Http/Responses/Tickets/ReplyResponse.php`
- `app/Http/Responses/Tickets/EditResponse.php`

## Tickets and cardModal usage reference
- Tickets module does not expose a `#cardModal` detail shell in its own views/responses.
- Ticket detail is rendered as full page (`pages/ticket/wrapper`) and modal interactions use `#commonModal` / `#actionsModal`.

Reference files:
- `app/Http/Responses/Tickets/ShowResponse.php`
- `resources/views/pages/tickets/components/*`
- `resources/views/pages/ticket/components/*`

---

## Module B: Leads (reference = UI table/card/tabs/modal-entry/dom_html)

## 1) Controller structure
- Main controller: `app/Http/Controllers/Leads.php`.
- `index()` selects layout mode:
  - `indexList()` for table view
  - `indexKanban()` for kanban boards
- `show()` assembles card payload blocks (left panel, right panel, comments, attachments, checklists, tags, reminders, statuses, sources).
- Many specialized update endpoints (`updateStatus`, `updateName`, `updateValue`, `updateAssigned`, etc.) support granular card interactions.

Reference file:
- `app/Http/Controllers/Leads.php`

## 2) Response class pattern
- Responses in `app/Http/Responses/Leads/*` are `Responsable` classes with payload unpacking and JSON DOM command emission.
- `IndexListResponse` mirrors list NX.UX operations (load/sort/search/ext template switching + DOM operations).
- `ShowResponse` is card-oriented and patches many card regions (`#cardModalContent`, tab menu, left/right panel, comments/attachments/checklists).
- `UpdateResponse` performs incremental row/card patches (`#lead_{id}`, card field selectors) and closes action modal when needed.

Reference files:
- `app/Http/Responses/Leads/IndexListResponse.php`
- `app/Http/Responses/Leads/ShowResponse.php`
- `app/Http/Responses/Leads/UpdateResponse.php`
- `app/Http/Responses/Leads/CreateResponse.php`
- `app/Http/Responses/Leads/EditResponse.php`

## 3) Routes
- Leads uses rich action routing under `Route::group(['prefix' => 'leads'], ...)`:
  - search, details, many single-field updates, bulk actions, assignment/status changes, archive/activate, pinning.
  - card-tab content routes under `/leads/content/{lead}/...` (main, organisation, customfields, mynotes, logs).
- Plus `Route::resource('leads', 'Leads')` for resource CRUD.

Reference file:
- `routes/web.php`

## 4) Modal entry flow
- Table rows and kanban cards open lead detail using `#cardModal` via AJAX request URL `/leads/{id}`.
- Create/edit auxiliary forms use `#commonModal`.
- Wrapper contains dynamic trigger anchor for loading a lead directly into `#cardModal`.

Reference files:
- `resources/views/pages/leads/components/table/ajax.blade.php`
- `resources/views/pages/leads/components/kanban/card.blade.php`
- `resources/views/pages/leads/wrapper.blade.php`
- `resources/views/pages/lead/modal.blade.php`

## 5) Lifecycle flow
- **index**: mode switch (table or kanban) and corresponding response rendering.
- **show**: card payload assembly then card-region rendering through `ShowResponse`.
- **update**: broad update endpoint plus many field-level update endpoints returning targeted DOM mutations.
- **close**: no `close` lifecycle equivalent like Tickets’ explicit close endpoint; lifecycle is status/field driven.

Reference files:
- `app/Http/Controllers/Leads.php`
- `app/Http/Responses/Leads/IndexListResponse.php`
- `app/Http/Responses/Leads/ShowResponse.php`
- `app/Http/Responses/Leads/UpdateResponse.php`

## 6) Status logic
- Status model is dynamic (`LeadStatus`), consumed by list/kanban and card editing.
- `updateStatus($id)` validates status existence, updates lead status, logs event, and returns card/list refresh commands.
- Additional status movement exists through kanban drag-drop (`updatePosition`) and bulk status routes.

Reference files:
- `app/Http/Controllers/Leads.php`
- `routes/web.php`
- `app/Http/Responses/Leads/UpdateResponse.php`

## 7) NX.UX integration
- UI triggers rely on `js-ajax-ux-request` and modal/action data attributes.
- DOM instruction contract is heavily used with many fine-grained selectors for card/table updates.
- Card modal shell is explicit (`#cardModal`, `#cardModalContent`, `#cardModalTabMenu`, `#card-leads-left-panel`, `#card--leads-right-panel`).

Reference files:
- `resources/views/pages/leads/components/*`
- `resources/views/pages/lead/modal.blade.php`
- `app/Http/Responses/Leads/ShowResponse.php`
- `app/Http/Responses/Leads/UpdateResponse.php`

## Leads references requested specifically

### UI table structure reference
- Table wrapper/headers/checklists/actions/sorting pattern are in leads table components.
- Reference: `resources/views/pages/leads/components/table/table.blade.php`, `resources/views/pages/leads/components/table/ajax.blade.php`.

### Card modal structure reference
- Card shell + modal regions + cover image + convert section + tab menu container are in lead modal template.
- Reference: `resources/views/pages/lead/modal.blade.php`.

### Tab organisation reference
- Card tab content routes are under `/leads/content/{lead}/...` and tab menu placeholder is `#cardModalTabMenu` in modal template.
- Reference: `routes/web.php`, `resources/views/pages/lead/modal.blade.php`, `app/Http/Responses/Leads/ShowResponse.php`.

### Modal entry logic reference
- Entry from list/kanban uses `data-target="#cardModal"` and lead URL.
- Reference: `resources/views/pages/leads/components/table/ajax.blade.php`, `resources/views/pages/leads/components/kanban/card.blade.php`, `resources/views/pages/leads/wrapper.blade.php`.

### dom_html contract reference
- `ShowResponse` and `UpdateResponse` demonstrate selector-targeted `dom_html` updates across row/card regions.
- Reference: `app/Http/Responses/Leads/ShowResponse.php`, `app/Http/Responses/Leads/UpdateResponse.php`.

---

## Scope statement
This is architectural documentation only (no proposals, no improvements, no implementation changes).
