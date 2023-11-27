# Products Example App

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