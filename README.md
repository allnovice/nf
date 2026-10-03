# NFC Business Card

Laravel-based digital business card system for employees.

Each employee has a public profile accessible through a unique code.

Example:
https://your-domain.com/1111

## Stack

- Laravel 13
- PHP 8.4
- MariaDB 11
- Nginx
- Node.js 22
- Vite
- Tailwind CSS
- Docker Compose
- Tailscale Funnel (optional)

## Requirements

Install:

- Git
- Docker
- Docker Compose
- Tailscale (optional)

The application runs PHP, MariaDB and Node inside Docker.

## First-Time Setup

Clone the repository:

git clone https://github.com/allnovice/nf.git
cd nf

Create the environment file:

cp .env.example .env

Edit the environment:

nano .env

Development example:

APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8080

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=nfc
DB_USERNAME=nfc
DB_PASSWORD=your-password

For development, set the machine address used by the browser to reach Vite:

VITE_HMR_HOST=192.168.x.x

If accessing the machine through Tailscale:

VITE_HMR_HOST=100.x.x.x

Never commit .env.

## Start the Application

Build and start the containers:

docker compose up -d --build

Install PHP dependencies:

docker compose exec app composer install

Generate the Laravel key:

docker compose exec app php artisan key:generate

Run migrations:

docker compose exec app php artisan migrate

Create the storage link:

docker compose exec app php artisan storage:link

Fix Laravel permissions:

docker compose exec app chown -R www-data:www-data storage bootstrap/cache

Install frontend dependencies:

docker compose run --rm node npm ci

## Development

Start Vite:

docker compose up -d node

The application is available at:

http://localhost:8080

Or from another device:

http://MACHINE-IP:8080

Vite runs on:

http://MACHINE-IP:5173

VITE_HMR_HOST must contain the IP address that the browser can use to reach the development machine.

## Laravel-Only Development

If only PHP, Blade, routes, controllers or database code is being changed, Node does not need to run.

Stop Node:

docker compose stop node

Laravel will use the existing production assets in:

public/build

## Frontend Development

When changing CSS or JavaScript:

docker compose up -d node

Vite provides live reload/HMR.

When finished:

docker compose stop node

Rebuild the production assets:

docker compose run --rm node npm run build

## Production Setup

Clone the repository:

git clone https://github.com/allnovice/nf.git
cd nf

Create the environment:

cp .env.example .env

Edit:

nano .env

Production example:

APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-public-domain.com
ASSET_URL=https://your-public-domain.com

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=nfc
DB_USERNAME=nfc
DB_PASSWORD=your-production-password

Do not configure VITE_HMR_HOST for production.

Build and start:

docker compose up -d --build

Install production PHP dependencies:

docker compose exec app composer install --no-dev --optimize-autoloader

Generate the application key:

docker compose exec app php artisan key:generate

Run migrations:

docker compose exec app php artisan migrate --force

Create the storage link:

docker compose exec app php artisan storage:link

Fix permissions:

docker compose exec app chown -R www-data:www-data storage bootstrap/cache

Install frontend dependencies:

docker compose run --rm node npm ci

Build frontend assets:

docker compose run --rm node npm run build

Stop Node:

docker compose stop node

Production uses the built assets in public/build.

## Production Updates

Pull the latest code:

git pull

For PHP, Blade or Laravel changes:

docker compose exec app php artisan optimize:clear

For CSS or JavaScript changes:

docker compose run --rm node npm ci
docker compose run --rm node npm run build
docker compose exec app php artisan optimize:clear

For database migrations:

docker compose exec app php artisan migrate --force
docker compose exec app php artisan optimize:clear

If the Dockerfile changed:

docker compose up -d --build

## Tailscale Funnel

Tailscale Funnel can expose the application publicly.

The local application runs on:

http://127.0.0.1:8080

Start Funnel:

sudo tailscale funnel --bg http://127.0.0.1:8080

Funnel exposes the Nginx application publicly.

Do not expose Vite port 5173 through Funnel.

In production, Node/Vite should normally be stopped.

## Environment Files

.env contains machine-specific settings and secrets.

Never commit .env.

.env.example is the template used when creating a new installation.

Development normally uses:

APP_ENV=local
APP_DEBUG=true
APP_URL=http://MACHINE-IP:8080
VITE_HMR_HOST=MACHINE-IP

Production normally uses:

APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-public-domain.com
ASSET_URL=https://your-public-domain.com

VITE_HMR_HOST should not be configured for production.

Never put real passwords, API keys or APP_KEY values in .env.example.

## Git Workflow

Pull the latest code:

git pull

Make and test changes.

Then:

git add .
git commit -m "Describe the change"
git push

Production can then pull the changes:

git pull

Run the required production update commands.

Do not commit:

.env
vendor/
node_modules/
public/build/
public/storage/

## Useful Commands

Check containers:

docker compose ps

Application logs:

docker compose logs app

Nginx logs:

docker compose logs nginx

Vite logs:

docker compose logs node

Enter the Laravel container:

docker compose exec app bash

Laravel Tinker:

docker compose exec app php artisan tinker

Clear Laravel caches:

docker compose exec app php artisan optimize:clear

Test the application:

curl -I http://127.0.0.1:8080/1111

## Project Structure

app/
database/
resources/
public/
docker/
routes/
compose.yaml
Dockerfile
vite.config.js
.env.example

## Public Employee Cards

Employee cards are accessed using the employee code:

/{code}

Example:

/1111

Employee cards can contain:

- Name
- Position
- Department
- Phone
- Email
- Biography
- Photo
- Social media links
- Office information

Office information is centrally managed and can be shared by all employee cards.

## Production Notes

Before exposing the application publicly, make sure:

APP_ENV=production
APP_DEBUG=false

Keep .env private.

Back up the production database before major migrations or destructive changes.
