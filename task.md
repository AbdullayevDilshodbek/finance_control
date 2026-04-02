# Income & Expense Tracker — Technical Task Breakdown

> **App**: Daily income/expense tracker built with Laravel + NativePHP Mobile + Livewire
> **Platform**: Android (APK via NativePHP)
> **Database**: SQLite

---

## Epic 1: Data Layer (P0 — Critical)

- [x] **1.1** Create `Transaction` model + migration
  - Table: `transactions`
  - Columns: `id`, `type` (enum: income/expense), `amount` (decimal 10,2), `description` (string 255), `created_at`, `updated_at`
  - Status: `completed`

- [x] **1.2** Create `TransactionSeeder` with sample data
  - Seed ~10 sample transactions (mix of income/expense) for dev/testing
  - Status: `completed`

---

## Epic 2: Dashboard Screen (P0 — Critical)

- [x] **2.1** Create `Dashboard` Livewire component + route
  - Route: `GET /` (replaces current Counter)
  - Query today's transactions, calculate total income, total expense, net balance
  - Status: `completed`

- [x] **2.2** Build dashboard summary cards
  - Three cards: Total Income (green), Total Expense (red), Net Balance (white)
  - Status: `completed`

- [x] **2.3** Add income/expense chart
  - Daily income vs expense chart using Chart.js via CDN (doughnut chart)
  - Pass data from Livewire to JS chart
  - Status: `completed`

- [x] **2.4** Add "Add Transaction" floating button
  - Prominent FAB button, navigates to `/add`
  - Status: `completed`

- [x] **2.5** Add transaction history list
  - Scrollable list of today's transactions below chart
  - Each item shows: type icon, description, amount (green/red), time
  - Status: `completed`

- [x] **2.6** Empty state for dashboard
  - Friendly message when no transactions exist for today
  - Status: `completed`

---

## Epic 3: Add Transaction Flow (P0 — Critical)

- [x] **3.1** Create `AddTransaction` Livewire component
  - Route: `GET /add`
  - Screen with two large buttons: "Income" (green) and "Expense" (red)
  - Status: `completed`

- [x] **3.2** Create `AddIncome` Livewire component
  - Route: `GET /add/income`
  - Form: amount (numeric), description (text)
  - On submit: save to DB with `type=income`, redirect to `/`
  - Status: `completed`

- [x] **3.3** Create `AddExpense` Livewire component
  - Route: `GET /add/expense`
  - Form: amount (numeric), description (text)
  - On submit: save to DB with `type=expense`, redirect to `/`
  - Status: `completed`

- [x] **3.4** Add Livewire form validation
  - Rules: amount required & > 0, description required & max 255
  - Inline error messages below each field
  - Status: `completed` (built into 3.2 and 3.3)

---

## Epic 4: UI/UX Polish (P1 — High)

- [x] **4.1** Mobile-optimized layout
  - Dark theme (`bg-zinc-950`), safe-area padding, no horizontal scroll
  - Large touch targets (min 56px), finger-friendly spacing
  - Status: `completed` (built into all components)

- [x] **4.2** Screen navigation
  - Back buttons on add screens
  - Use `wire:navigate` for SPA-like page transitions
  - Status: `completed` (built into all components)

- [x] **4.3** Color-coded transactions
  - Green for income, red for expense — in chart, list, and forms
  - Status: `completed` (built into all components)

---

## Epic 5: Enhancements (P2 — Medium)

- [x] **5.1** Date filtering on dashboard
  - View income/expense for previous days (date picker or day navigation)
  - Status: `completed`

- [x] **5.2** Delete transaction
  - Delete button on each transaction in the history list with confirmation
  - Status: `completed`

- [x] **5.3** Monthly summary view
  - Aggregated monthly totals view (toggle or separate tab)
  - Status: `completed`

---

## Epic 6: Multi-Language Support (P2 — Medium)

- [x] **6.1** Set up Laravel localization structure
  - Create `lang/en` and `lang/uz` directories with translation files
  - Add language strings for all UI text (labels, buttons, messages, headings)
  - Status: `completed`

- [x] **6.2** Add language switcher component
  - Toggle between English and Uzbek (persisted in session/localStorage)
  - Accessible from dashboard header
  - Status: `completed`

- [x] **6.3** Translate Dashboard screen
  - Replace all hardcoded strings with `__()` translation helpers
  - Strings: "Daily Tracker", "Income", "Expense", "Balance", "Today's Transactions", "No transactions today", "Monthly", etc.
  - Status: `completed`

- [x] **6.4** Translate Add Transaction flow
  - Translate AddTransaction, AddIncome, AddExpense screens
  - Strings: "Add Transaction", "Income", "Expense", "Amount", "Description", "Save", validation messages, etc.
  - Status: `completed`

- [x] **6.5** Translate Monthly Summary screen
  - Replace all hardcoded strings with translation helpers
  - Strings: "Monthly Summary", "Daily Breakdown", "No transactions this month", date formats, etc.
  - Status: `completed`

---

## Implementation Order

```
1.1 → 1.2 → 3.2 → 3.3 → 3.1 → 3.4 → 2.1 → 2.5 → 2.2 → 2.3 → 2.4 → 2.6 → 4.1 → 4.2 → 4.3 → 5.1 → 5.2 → 5.3 → 6.1 → 6.2 → 6.3 → 6.4 → 6.5
```

## Status Legend

| Status | Meaning |
|--------|---------|
| `pending` | Not started |
| `in-progress` | Currently being worked on |
| `completed` | Done and verified |
| `blocked` | Waiting on dependency or decision |
