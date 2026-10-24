# AGENTS.md

## Project overview

This repository is primarily a Laravel application for a store/point-of-sale system with role-based access for admin and cashier users. A separate Flutter client also exists under [sensor_mobile/README.md](sensor_mobile/README.md) and should be treated as a sibling project rather than the main backend.

For the main app, start with [README.md](README.md), [routes/web.php](routes/web.php), and [routes/api.php](routes/api.php).

## Architecture and key conventions

- Backend code lives in the Laravel root project: `app/`, `routes/`, `resources/`, `database/`, and `config/`.
- Web routes and permission checks are defined in [routes/web.php](routes/web.php). Authentication and role middleware are already used extensively for admin and cashier flows.
- API routes and Sanctum-based authentication are defined in [routes/api.php](routes/api.php). Most JSON endpoints return a resource or token-based response and should remain consistent with that pattern.
- Models are in `app/Models`, controllers in `app/Http/Controllers`, and database schema changes belong in `database/migrations`.
- Frontend styling and asset build are Vite/Tailwind-based via `resources/css`, `resources/js`, and the scripts in [package.json](package.json).
- The Flutter project is intentionally separate and should not be conflated with the Laravel backend unless a task explicitly targets the mobile app.

## Useful commands

- Install PHP dependencies: `composer install`
- Start the Laravel app: `php artisan serve`
- Run backend tests: `php artisan test` or `./vendor/bin/pest`
- Build frontend assets: `npm install && npm run build`
- Run the Flutter app: `cd sensor_mobile && flutter pub get && flutter run`

## Working guidance for agents

- Prefer the existing Laravel conventions over introducing new patterns or frameworks.
- Keep authorization logic consistent with existing route middleware and role checks.
- When editing the web app, respect the current controller/model split and the route names already defined in [routes/web.php](routes/web.php).
- When editing the API, keep Sanctum authentication and JSON response conventions aligned with [routes/api.php](routes/api.php).
- Preserve existing naming conventions in models, migration files, and route groups.
- If a change affects both the Laravel app and the Flutter client, treat them as separate workstreams and document the scope clearly.

## Recommended entry points

- App auth/session flows: [routes/web.php](routes/web.php)
- API auth and CRUD endpoints: [routes/api.php](routes/api.php)
- Laravel app overview: [README.md](README.md)
- Flutter app details: [sensor_mobile/README.md](sensor_mobile/README.md)
