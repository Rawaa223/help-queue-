# Help Queue

A Laravel application for managing a help queue, topics, and ticket statuses.

## Setup

```bash
git clone https://github.com/Rawaa223/help-queue-.git
cd help-queue-
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

Open the URL printed by `php artisan serve` to use the application. The seed command
creates example topics and tickets.

On Windows PowerShell, use `Copy-Item .env.example .env` instead of `cp`, and create
the SQLite file with:

```powershell
New-Item database\database.sqlite -ItemType File
```
