# NF - Digital Business Card

Laravel-based digital business card system for employees.

Each employee gets a unique public code that can be used to access their digital business card.

Example:

    https://your-domain.com/1111

---

## Features

### Public Employee Cards

Each employee has a public digital business card containing:

- Name
- Position
- Department
- Phone
- Email
- Biography
- Photo
- Social media links
- Office information

Example:

    /{employee-code}

---

### Admin

Protected admin area for managing employees.

Admin functions include:

- Login/logout
- Add employee
- Edit employee
- Delete employee
- Upload/replace employee photo
- Manage employee social links
- View public employee card
- Manage office information

---

### Excel Import

Employees can be added in bulk using an Excel file.

The admin can:

- Download an Excel template
- Fill employee information
- Upload the Excel file
- Import multiple employees at once
- Skip employees whose code already exists

Employee fields:

- Code
- Name
- Position
- Department
- Email
- Phone
- Bio

Social link fields:

- Facebook
- Instagram
- LinkedIn
- X
- GitHub
- Viber
- Telegram
- Messenger
- WhatsApp
- YouTube
- TikTok
- Threads

---

## Office Information

Office information is centrally managed and can appear on employee cards.

Current office settings include:

- Office name
- Address
- Phone
- Email
- Website
- Logo

---

## Technology

- Laravel 13
- PHP 8.4
- MariaDB 11
- Nginx
- Tailwind CSS
- Vite
- Docker Compose
- Tailscale Funnel (optional)

---

## Quick Setup

### Requirements

- Git
- Docker
- Docker Compose

### Clone the project

    git clone https://github.com/allnovice/nf.git
    cd nf

### Create the environment file

    cp .env.example .env

Edit the environment file:

    nano .env

Configure the database and application settings as required.

### Start the application

    docker compose up -d --build

### Install PHP dependencies

    docker compose exec app composer install

### Install frontend dependencies

    docker compose run --rm node npm ci

### Initialize Laravel

    docker compose exec app php artisan key:generate
    docker compose exec app php artisan migrate
    docker compose exec app php artisan storage:link

### Build frontend assets

    docker compose run --rm node npm run build

The application is now ready.

---

## Development

For PHP, Blade, routes, controllers and database changes, the Node/Vite container does not need to be running.

For CSS or JavaScript development:

    docker compose up -d node

Build frontend assets when needed:

    docker compose run --rm node npm run build

---

## Admin

The admin login page is:

    /admin/login

After login:

    /admin/employees

The root URL `/` behaves as follows:

- Not logged in → `/admin/login`
- Logged in → `/admin/employees`

---

## Public Employee Cards

Employee cards are publicly accessible without authentication.

Format:

    /{code}

Example:

    /1111

The public card contains the employee's configured information and social links.

The admin area remains protected by authentication.

---

## Production

For production, use:

    APP_ENV=production
    APP_DEBUG=false
    APP_URL=https://your-public-domain.com
    SESSION_SECURE_COOKIE=true

Do not commit `.env`.

Do not expose the Vite development port publicly.

### Production update

After pulling new code:

    git pull
    docker compose up -d --build
    docker compose exec app php artisan migrate --force
    docker compose exec app php artisan optimize:clear

If only PHP, Blade or Laravel configuration changed, a rebuild may not always be necessary.

---

## Tailscale Funnel

Tailscale Funnel can be used to expose the application publicly.

Example:

    sudo tailscale funnel --bg http://127.0.0.1:8080

Do not expose the Vite development port `5173` through Funnel.

---

## Useful Commands

### Check containers

    docker compose ps

### Laravel logs

    docker compose logs app

### Nginx logs

    docker compose logs nginx

### Vite logs

    docker compose logs node

### Enter the Laravel container

    docker compose exec app bash

### Laravel Tinker

    docker compose exec app php artisan tinker

### Clear Laravel caches

    docker compose exec app php artisan optimize:clear

---

## Git Workflow

Pull updates:

    git pull

Check changes:

    git status

Commit changes:

    git add .
    git commit -m "Describe the change"

Push changes:

    git push

---

## Project Structure

    app/                    Laravel application
    database/               Database migrations
    resources/              Blade views and frontend
    public/                 Public assets
    routes/                 Application routes
    docker/                 Docker configuration
    compose.yaml            Docker Compose configuration
    Dockerfile              PHP application image
    vite.config.js          Vite configuration
    .env.example            Environment template

---

## Security

The public employee cards are intentionally accessible without authentication.

The admin area requires authentication.

Never commit:

    .env

Keep production passwords, database credentials and `APP_KEY` private.

Back up the production database before major migrations or destructive changes.

---

## TODO

- Company/organization logo
- Import social links from Excel
- Improve Excel import validation and error reporting
- Additional security audit
- Production backup/restore procedure
- Further UI improvements
