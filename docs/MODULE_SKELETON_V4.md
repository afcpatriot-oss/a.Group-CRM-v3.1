---

# MODULE SKELETON v4 — Orders / Hybrid Architecture

**Project:** a.Group CRM
**Platform:** Grow CRM (lead-centric core, frozen)
**Environment:** FTP-only (NO SSH / NO CLI / NO MIGRATIONS)
**Status:** CANONICAL / ETERNAL

---

# PURPOSE (UPDATED)

This document defines the **ONLY valid skeleton** for building new business modules inside a.Group CRM.

We are:

- NOT building Leads
- NOT rewriting core
- NOT fighting the platform

We are building **Orders** as a domain module using a **conscious hybrid architecture**.

> Grow CRM = infrastructure & UX engine
> a.Group CRM = business logic & domain modules

---

# FINAL ARCHITECTURAL DECISION (FIXED)

Orders are built as a **hybrid**, not a clone.

## Canonical Hybrid Table (MANDATORY REFERENCE)

| Layer                             | Source          |
| --------------------------------- | --------------- |
| Permissions                       | Platform        |
| Roles                             | Platform        |
| AJAX lifecycle                    | Platform        |
| Modal opening                     | Leads pattern   |
| Lifecycle (create → open → close) | Tickets pattern |
| UI table                          | Leads pattern   |
| Status system                     | Tickets pattern |
| Clients                           | Platform        |
| Custom fields                     | Platform        |
| Events / hooks                    | Platform        |

> This is a designed hybrid, not a workaround.

---

# WHAT IS NO LONGER VALID (REMOVED FROM v3)

The following assumptions are invalid and forbidden:

- Orders as a clone of Leads
- Orders with independent modal system
- Orders owning their own JS lifecycle
- Kanban-first logic for Orders
- Inventing new UX contracts

All of the above caused architectural conflicts and are explicitly removed.

---

# CORRECT MENTAL MODEL (v4)

- Leads = core card entity of the platform
- Tickets / Contracts = service / execution entities
- Orders = business execution entity, closer to Tickets than Leads

Orders:

- DO NOT replace Leads
- DO NOT break lead-centric JS
- DO reuse:
  - NX.UX lifecycle
  - cardModal container
  - permissions / ACL

Orders integrate into the platform, they do not dominate it.

---

# REAL FILE STRUCTURE (UPDATED)

Orders module is **distributed**, not isolated.

```
app/Http/Controllers/
    Orders.php

app/Http/Responses/Orders/
    IndexListResponse.php
    ShowResponse.php
    CreateResponse.php

resources/views/pages/orders/
    wrapper.blade.php
    tabswrapper.blade.php
    components/
        table/
            wrapper.blade.php
            ajax.blade.php
        modals/
            show.blade.php
            create.blade.php

routes/custom/web.php
```

There is:

- NO standalone modal
- NO standalone JS
- NO independent lifecycle

---

# ROUTES (STRICT)

**File:** `routes/custom/web.php`

```php
Route::group(['prefix' => 'orders'], function () {

    Route::get('/', [Orders::class, 'index'])->name('orders.index');

    Route::get('/create', [Orders::class, 'create']);

    Route::post('/', [Orders::class, 'store']);

    Route::get('/{order}', [Orders::class, 'show'])
        ->where('order', '[0-9]+|[A-Z][0-9]{4}')
        ->name('orders.show');

});
```

Orders use the same modal entry rules as Leads.

---

# CONTROLLER RULES

Controllers:

- contain NO HTML
- contain NO JS assumptions
- orchestrate only business flow

UI is controlled exclusively via Response classes.

---

# RESPONSE PATTERN (NON-NEGOTIABLE)

Grow CRM renders UI via AJAX JSON contracts.

Returning `view()` directly for modals is forbidden.

Canonical response structure:

```php
return response()->json([
    'dom_html' => [...],
    'dom_visibility' => [...],
    'postrun_functions' => [...]
]);
```

Orders must follow the same NX.UX rules as Leads.

---

# INDEX LIST (Orders table)

UI pattern: **Leads table**

Behaviour:

- click → AJAX → cardModal

No Kanban logic (allowed only as stub if required by platform)

---

# SHOW (Order card)

Modal container: **platform cardModal**

Entry:

- AJAX
- or direct URL

Content:

- Tabs (Order / Delivery / Script / Cart)

Status logic:

- Tickets-style
- NOT Leads

Orders card is a mode inside platform modal, not an independent entity.

---

# DATABASE POLICY (IMPORTANT)

- NO migrations
- NO schema guessing
- NO duplicate entities

Database is reviewed **after skeleton stabilisation**.

Existing Orders tables are treated as **source of truth**.

---

# HARD PROHIBITIONS

- Editing core Grow CRM files
- Editing Leads controllers or logic
- Creating new modal containers
- Introducing new JS lifecycles
- Point-patching files (FULL FILES ONLY)

---

# ALLOWED & ENCOURAGED

- Using Tickets / Contracts as UX & lifecycle reference
- Building Orders as domain logic layer
- Using platform custom fields
- Using platform events & hooks
- Gradual extension after skeleton is stable

---

# ROLE OF AI ASSISTANT

Assistant must:

- Think in platform constraints
- Never invent UX contracts
- Always return FULL FILES
- Preserve hybrid table decisions
- Treat Leads/Tickets as immutable references

---

# FINAL STATEMENT

Orders are not a rebellion against Grow CRM.
Orders are a controlled extension inside it.

Any future decision is validated against this document first.

> MODULE SKELETON v4 IS NOW THE LAW OF THE PROJECT.
