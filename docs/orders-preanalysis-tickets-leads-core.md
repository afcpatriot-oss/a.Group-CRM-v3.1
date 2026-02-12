# Orders Pre-Analysis: Tickets vs Leads vs Core (No-change architecture brief)

Scope: pre-analysis only. This document compares existing module patterns before any Orders work.

---

## A. Priority of “teaching” Codex (explicit role split)

1. **Tickets = behavioral/execution reference**
   - lifecycle semantics for execution entities
   - status transitions and close semantics
   - response contract and NX.UX backend instructions
2. **Leads = UI/layout reference**
   - list table pattern
   - card structure and tab organization
   - card modal entry + DOM contract
3. **Core (Grow CRM) = constraints/infrastructure reference**
   - ACL/roles/permissions middleware gates
   - event/hook lifecycle and extension points
   - existing modal containers and NX.UX lifecycle boundaries

This ordering follows project context: architecture from Tickets, UI pattern from Leads, constraints from Core.

---

## B. Tickets analysis (execution/lifecycle template)

## 1) Controller structure
- `Tickets` controller is repository-centric and action-gated by dedicated middleware per capability (index/filter/create/edit/bulk/reply/show/destroy/etc.).
- It exposes a compact execution flow with `index`, `create`, `store`, `show`, `edit`, `update`, `closeTicket`, plus bulk status/archive/restore and reply/tag/pin operations.
- `pageSettings()` keeps list/detail/create metadata centralized and NX.UX-friendly.

## 2) Response pattern
- Ticket responses implement `Responsable`, unpack payload, optionally fire response events, process `module_injections`, then return full HTML or JSON DOM instructions.
- JSON responses use common UX keys: `dom_html`, `dom_visibility`, `dom_classes`, `dom_attributes`, `redirect_url`, `notification`, `postrun_functions`.
- Edit/reply flows initialize frontend hooks via postrun functions like `NXTicketEdit` and `NXTicketReplay`.

## 3) Route model
- Hybrid route model: resource routes + action routes (`/search`, `/reply`, `/postreply`, `/change-status`, `/archive`, `/restore`, `/close`, etc.).
- This preserves REST endpoints for CRUD while allowing lifecycle-specific commands.

## 4) Lifecycle signal (create → open → update → close)
- **create/store**: ticket is persisted, attachments/tags/events/notifications are attached.
- **open/show**: ticket + replies + canned data resolved; tracking marked read.
- **update**: row/page update behavior depends on `edit_source` and returns UX instructions accordingly.
- **close**: explicit closed status (`ticket_status = 2`) with guarded close-side effects (event + notification + mail).

## 5) Status logic
- Statuses are dynamic records from `tickets_status` (`TicketStatus`), used for filtering, edit forms, and stats.
- Bulk status update flow exists (`changeStatus` + `changeStatusUpdate`) and returns updated rows.
- Closed state is hard-checked by ID `2` in close-transition logic.

## 6) NX.UX integration
- Triggered via `js-ajax-ux-request` and modal metadata (`data-url`, `data-action-url`, `data-action-method`, `data-loading-target`).
- Backend returns instruction payloads to mutate UI state without full page reload.

---

## C. Leads analysis (UI/table/card template)

## 1) Controller/UI composition
- `Leads` supports two index modes (`indexList()` and `indexKanban()`), with a shared `index()` switch by user preference.
- `show()` builds a rich card payload: right panel, left panel blocks, comments, attachments, checklist, reminders, tags, statuses, sources.
- `pageSettings()` defines list UX defaults including add-modal metadata, search URL, side panel id.

## 2) Card modal + tabs pattern
- Leads table/kanban entries open `#cardModal` using AJAX URL to `/leads/{id}`.
- Lead routes include dedicated `content/{lead}/...` tab endpoints (show main, custom fields, notes, logs, etc.), i.e., card tabs are first-class.
- `ShowResponse` populates card modal containers (`#cardModalContent`, `#cardModalTabMenu`) and card subregions.

## 3) Response and DOM contract
- List view response (`IndexListResponse`) mirrors NX.UX list behavior (load/sort/search templates, load-more attr updates, tab state classes, etc.).
- `UpdateResponse` focuses on incremental card + row patching (`#lead_{id}` row, `#card-lead-*` nodes) and kanban card replacement.
- Create/edit still use `#commonModal` forms; card reading context is `#cardModal`.

## 4) Status handling (UI-heavy)
- Lead statuses are dynamic (`LeadStatus`) and used in list/kanban filtering, card edits, bulk status change, drag-drop position/status updates.
- Status update endpoints are fine-grained (`/{lead}/update-status`) and tied to card-level DOM patches.

---

## D. Core constraints (infrastructure, not template)

- Core philosophy in project context: do not break Grow CRM lifecycle; use existing NX.UX, modal containers, events/hooks, ACL/roles/permissions.
- Controllers demonstrate this through auth + resource middleware gates and event dispatching around store/update/status transitions.
- Therefore Core is the boundary system: permissions, event pipeline, and UX lifecycle engine are constraints to comply with, not business-logic reference.

---

## E. Tickets vs Leads — clear differences (for Orders pre-analysis)

1. **Primary role**
   - Tickets: execution workflow module with explicit lifecycle commands.
   - Leads: UI-rich card module (table + kanban + tabbed card experience).

2. **Lifecycle shape**
   - Tickets: direct create/open/update/close semantics, including explicit close action.
   - Leads: many granular field update endpoints + card/tab interactions.

3. **Status behavior**
   - Tickets: status system + bulk modal update; closed transition guarded by status ID 2 side effects.
   - Leads: status integrated into card updates and kanban positioning workflow.

4. **Modal model**
   - Tickets: `#commonModal` for forms/actions; detail generally rendered as full page.
   - Leads: `#cardModal` as the main detail shell, with `#commonModal` for edit helpers.

5. **Response emphasis**
   - Tickets: list row replacement, modal actions, redirects for page/list contexts.
   - Leads: dense DOM patching of card fragments and tab-aware content areas.

6. **What each should teach Orders (analysis outcome)**
   - From Tickets: lifecycle execution + status/close semantics + response orchestration.
   - From Leads: list/card/tab UX structure + modal entry and DOM patch idioms.
   - From Core: limits and integration rules (ACL/events/hooks/NX.UX lifecycle).

---

## F. Explicit non-goal

This document does **not** propose implementation changes. It only maps existing architecture and differences for pre-analysis.
