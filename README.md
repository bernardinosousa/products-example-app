# Products Example App

## Subjects that app contains:

- Feature Tests
- Unit Tests
- Task Scheduling / Console Commands
- Form Validation
- Integration with Email
- Database Migrations
- Laravel Sail (Integration with Docker for local environment)
- Laravel Pint (Code Styling Fixer)
- Job Queues

## Setup local environment

```
alias sail='bash vendor/bin/sail'
cp .env.example .env
sail up -d
sail php artisan key:generate
sail php artisan migrate --seed
sail npm install
sail npm run dev
```