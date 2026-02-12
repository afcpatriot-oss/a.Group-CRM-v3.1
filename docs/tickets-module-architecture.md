# Tickets Module Architecture (as implemented)

This document is a code-level analysis of the current Tickets module in this repository.
No changes are proposed here.

## 1) Controller structure

Primary controller: `app/Http/Controllers/Tickets.php`.

### Constructor wiring
- Uses repository-driven DI: `TicketRepository`, `UserRepository`, `EventRepository`, `EventTrackingRepository`, `EmailerRepository`, `AttachmentRepository`, `CustomFieldsRepository`, `TagRepository`.
- Applies tickets-specific middleware per action:
  - filtering/index access (`ticketsMiddlewareFiltering`, `ticketsMiddlewareIndex`)
  - create/edit/bulk-edit/reply/show/download/destroy/edit-reply guards
- This creates an explicit permission + context gate per lifecycle step.

### Public method map (functional groups)
- List/Create: `index`, `create`, `store`
- Detail/Edit: `show`, `edit`, `update`
- Reply thread: `reply`, `storeReply`, `editReply`, `updateReply`, `deleteReply`
- Bulk ops: `changeStatus`, `changeStatusUpdate`, `archive`, `restore`
- Single quick ops: `closeTicket`, `togglePinning`, `editTags`, `updateTags`, `destroy`, `downloadAttachment`

### Internal helpers
- `pageSettings()` centralizes page metadata and dynamic URLs for list/detail/create contexts.
- `statsWidget()` builds list widget counters based on dynamic statuses.
- `ticketClientSync()` backfills ticket client ownership when IMAP-created tickets are missing client linkage.

---

## 2) Response classes pattern

Located in `app/Http/Responses/Tickets/*Response.php`.

### Shared pattern
Most Tickets responses follow this contract:
1. Implement `Illuminate\Contracts\Support\Responsable`.
2. Accept a `$payload` in constructor.
3. In `toResponse($request)`, unpack payload keys into local variables.
4. Optionally fire a response event (`App\Events\Tickets\Responses\...`).
5. Optionally process `module_injections` (pushes extension HTML into Blade stacks).
6. Return either:
   - server-rendered HTML view (full page responses), or
   - JSON NX.UX instruction object (`dom_html`, `dom_visibility`, `dom_classes`, `dom_attributes`, `redirect_url`, `notification`, `postrun_functions`, etc.).

### Response type split
- **Full HTML views**:
  - `IndexResponse` (non-AJAX branch)
  - `CreateResponse`
  - `ShowResponse`
- **AJAX/NX.UX responses**:
  - `EditResponse`, `ReplyResponse`, `UpdateResponse`, `ChangeStatusResponse`, `ArchiveRestoreResponse`, `StoreReplyResponse`, etc.
  - Typically return frontend instruction arrays consumed by the shared UX engine.

### Notable variation
- `StoreResponse` and `CloseTicketResponse` are lightweight JSON redirect responses (flash success + `redirect_url`) and do not run response events/module injections.

---

## 3) Route definitions

Primary routes are in `routes/web.php` under the Tickets block.

### Tickets-prefixed custom routes
- Search/list refresh: `Route::any('/tickets/search', 'Tickets@index')`
- Reply flow: `GET /{ticket}/reply`, `POST /{ticket}/postreply`
- Reply editing: `GET|POST /{ticket}/edit-reply`, `DELETE /{ticket}/delete-reply`
- Bulk/archive/status actions:
  - `ANY /tickets/archive`
  - `ANY /tickets/restore`
  - `GET /tickets/change-status`
  - `POST /tickets/change-status`
- Other action routes:
  - `GET /tickets/{ticket}/pinning`
  - `GET|POST /tickets/{ticket}/edit-tags`
  - `POST /tickets/{ticket}/close`
  - `POST /tickets/delete` (bulk delete)
  - `GET /tickets/attachments/download/{uniqueid}`

### Resource routes
- `Route::resource('tickets', 'Tickets')` adds RESTful endpoints for `index/create/store/show/edit/update/destroy`.
- Therefore Tickets runs a hybrid route model: REST resource + action endpoints.

---

## 4) Modal entry logic

Modal entry is attribute-driven in Blade, using the common UX hooks.

### Entry points
- List page add button opens `#commonModal` and loads create/edit URLs through `js-ajax-ux-request` metadata.
- Table row edit button opens `#commonModal` with edit URL + action URL/method (`PUT`).
- Bulk “change status” opens `#actionsModal` and loads form into `#actionsModalBody`.
- Ticket detail page actions open:
  - edit modal (`/tickets/{id}/edit?...`)
  - edit-tags modal (`/tickets/{id}/edit-tags`)
  - reply modal (`/tickets/{id}/reply`) when popup reply mode is enabled.

### Response-side modal behavior
- Response classes inject HTML into `#commonModalBody` or `#actionsModalBody`.
- They control footer visibility and close actions via JSON instructions.
- Post-run initializers are declared (e.g. `NXTicketEdit`, `NXTicketReplay`) to bootstrap modal-specific behaviors.

---

## 5) Lifecycle (index → show → update → close)

### Index
- Route: `/tickets` or `/tickets/search`.
- Controller `index()` pulls:
  - paginated tickets via repository search
  - categories, statuses, stats, custom fields
- `IndexResponse`:
  - full wrapper view for standard request
  - JSON DOM operations for embedded/search/sort/load flows

### Show
- Route: `/tickets/{id}`.
- Controller `show()`:
  - loads ticket + replies + canned response data + custom fields
  - backfills client mapping for IMAP tickets if missing
  - marks ticket events as read for current user
- `ShowResponse` returns full ticket page wrapper.

### Update
- Route: `PUT /tickets/{id}`.
- Controller `update()`:
  - stores old status
  - calls repository update
  - re-queries updated ticket
  - if transition to closed (`status == 2` and previous != 2), records activity event + notifications + closes email notifications
- `UpdateResponse` branches by `edit_source`:
  - `list`: replace row + close modal + success notice
  - `leftpanel`/`page`: redirect to ticket show

### Close
- Route: `POST /tickets/{id}/close`.
- Controller `closeTicket()`:
  - hard-sets `ticket_status = 2`
  - repeats close transition side effects (event, notification, email) when changing from non-closed
- `CloseTicketResponse` flashes success and redirects to tickets list.

---

## 6) Status handling logic

Status in this module is ID-driven and dynamic.

### Data model
- `TicketStatus` model maps to `tickets_status` table.
- Tickets table stores foreign key-like `ticket_status` values referencing `ticketstatus_id`.
- Status records are ordered by `ticketstatus_position` and carry UI color/title metadata.

### Where statuses are used
- List/index and edit forms load status list ordered by position.
- `statsWidget()` iterates all statuses and counts tickets per status dynamically.
- Repository supports status filtering with `filter_ticket_status[]`.
- Bulk status change:
  - `changeStatus()` serves modal form
  - `changeStatusUpdate()` updates selected ticket rows to posted status ID and returns updated rows.

### “Closed” semantics
- Closed is treated as status ID `2` in controller logic (`update()` and `closeTicket()`).
- Transition guard `old_status != 2 && new_status == 2` controls close side effects (timeline event, notifications, mail).

---

## 7) NX.UX integration pattern

The Tickets module follows the project-wide NX.UX response contract:

### Frontend trigger layer
- Blade actions use shared classes/attributes:
  - `js-ajax-ux-request`
  - `edit-add-modal-button`
  - `actions-modal-button`
  - rich `data-*` contract (`data-url`, `data-action-url`, `data-action-method`, `data-loading-target`, `data-form-id`, etc.)

### Backend instruction layer
- Response classes return JSON commands, not raw fragments only.
- Common instruction keys used by Tickets:
  - `dom_html` (replace/append HTML)
  - `dom_visibility` (show/hide/close modal)
  - `dom_classes`, `dom_attributes`, `dom_move_element`
  - `redirect_url`, `notification`, `skip_dom_reset`
  - `postrun_functions` (e.g. `NXTicketEdit`, `NXTicketReplay`)

### Practical effect
- Tickets supports both full-page and embedded/AJAX operation using the same controller endpoints.
- UX state transitions (modal open/close, table row swap, stats refresh, tab activation, redirects) are driven from backend JSON instruction payloads.
