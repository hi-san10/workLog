# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview

workLog is a construction work management tool (業務管理ツール) for tracking daily work reports from contractors. It records what work was done (task, maker, quantity) at which site, by which contractor, and tracks payments.

## Architecture

The app runs as a **Docker Compose stack** with 4 services:
- **nginx** (port 80) — reverse proxy serving Laravel's `public/` directory
- **php** — PHP-FPM container running Laravel 13 (PHP 8.3)
- **mysql** (MySQL 8.0) — primary database (`workLog_db`)
- **phpmyadmin** (port 8080) — DB admin UI

All application code lives in `backend/src/` (a standard Laravel project). The `frontend/` directory is currently empty.

**Database schema** (key tables):
- `contractors` — 外注先 (name, date_of_birth, address)
- `work_sites` — 現場 (name)
- `makers` — メーカー (name)
- `tasks` — 作業内容 (name, unit)
- `work_reports` — 日次記録 (date, contractors_id, work_sites_id)
- `work_details` — 明細 (work_reports_id, makers_id, tasks_id, quantity)
- `payments` — 支払い記録 (contractors_id, target_month, amount, payment_method)

**Request flow**: Each form POST hits a dedicated controller that either creates a single model or wraps multiple model creates in a `DB::transaction`. Controllers return `back()->withInput()` on success. No API layer — all server-rendered Blade views.

## Development

### Start the stack
```bash
docker compose up -d
```
App is at http://localhost, phpMyAdmin at http://localhost:8080.

### Run inside the PHP container
```bash
docker compose exec php bash
# then inside:
php artisan migrate
php artisan db:seed
composer test        # runs php artisan test
```

### Run tests
Tests use SQLite in-memory (configured in `phpunit.xml`). Run from `backend/src/`:
```bash
# inside the PHP container:
php artisan test
# or run a single test file:
php artisan test tests/Feature/ExampleTest.php
```

### Lint (Laravel Pint)
```bash
# inside the PHP container:
./vendor/bin/pint
```

### Database backup / restore
```bash
# from repo root:
make backup
make restore file=backup_2026-05-15.sql
```

## Key conventions

- Views extend `layouts/app` and use `@section('content')`.
- Foreign key column names follow `{table_singular}_id` pluralised as the table name, e.g. `contractors_id` (not `contractor_id`).
- `WorkReportController::store` wraps `WorkReport` + `WorkDetail` creation in a single transaction — keep that pattern for any multi-model writes.
- Payment methods are hardcoded in `PaymentController::index` as `['現金', '銀行振込']`.
- The `.env` in `backend/src/` is committed (local dev credentials only); `backup_*.sql` files are git-ignored via root `.gitignore`.
