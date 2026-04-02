# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

A **NativePHP Mobile** income/expense tracker app built with Laravel 13, Livewire 4, and Tailwind CSS. The app is compiled as an Android APK and tested on a real device via the NativePHP Jump app. Uses SQLite for persistent storage.

## Commands

```bash
# Setup (install deps, generate key, migrate, build assets)
composer setup

# Run dev server (Laravel server + queue + pail logs + Vite, all concurrently)
composer dev

# Run tests
composer test                    # full suite
php artisan test --filter=Name   # single test

# Lint/format PHP
./vendor/bin/pint

# NativePHP mobile
php artisan native:jump          # test on real device via Jump app
php artisan native:run android   # run Android build

# Database
php artisan migrate              # run migrations
php artisan db:seed              # seed sample data
```

## Architecture

- **Laravel 13 + PHP 8.4** — standard Laravel skeleton
- **NativePHP Mobile v3** (`nativephp/mobile`) — wraps the Laravel app as a native Android app. Config in `nativephp.json` (PHP version, ICU toggle). Build artifacts in `nativephp/android/`
- **Livewire 4** — all UI interactions are Livewire components. No Alpine.js or Vue
- **Tailwind CSS via CDN** — loaded in `resources/views/layouts/app.blade.php`
- **SQLite** — persistent storage for transactions and Laravel internals (sessions, cache, jobs)
- **Chart.js via CDN** — dashboard charts for income/expense visualization

### Screen Flow

```
Dashboard (GET /)
  ├── shows daily summary cards, chart, transaction list
  └── FAB button → Add Transaction (GET /add)
                      ├── Income → AddIncome (GET /add/income) → saves & redirects to /
                      └── Expense → AddExpense (GET /add/expense) → saves & redirects to /
```

### Key Models

- `Transaction` — columns: `type` (income/expense), `amount` (decimal), `description` (string)

## Task Tracking Rules

All tasks are tracked in `task.md`. Follow these rules strictly:

1. **Always read `task.md` before starting work** to know current status
2. **Update task status immediately** when starting a task (change `pending` → `in-progress` and `- [ ]` → `- [ ]`)
3. **Mark task completed** when done (change status to `completed` and `- [ ]` → `- [x]`)
4. **Never skip a task's status update** — every task must reflect its real state at all times
5. **Follow the implementation order** defined in `task.md` unless a dependency requires otherwise
6. **Do not remove or reorder tasks** — only update their status

## Code Rules

- **Livewire only** for interactivity — no Alpine.js, no Vue, no raw JavaScript (except Chart.js for charts)
- **One Livewire component per screen** — keep components simple, use Laravel routing for navigation
- **Use `wire:navigate`** for SPA-like page transitions between screens
- **Mobile-first UI** — dark theme (`bg-zinc-950`), large touch targets (min 56px), safe-area padding
- **Color convention** — green for income, red for expense, white/gray for neutral
- **Validation** — validate all user input in Livewire components with inline error messages
- **No auth, no API** — this is a single-user local app
- **Run `./vendor/bin/pint`** after writing PHP code to maintain consistent formatting
