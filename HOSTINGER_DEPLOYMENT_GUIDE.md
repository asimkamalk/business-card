# Hostinger Deployment Guide - Step by Step

## 📁 Folder Structure Overview

```
/home/username/
├── business_card/          (Main Laravel application - outside public_html)
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/             (This will be linked to public_html)
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   ├── .env
│   ├── .htaccess
│   ├── artisan
│   ├── composer.json
│   └── ... (all Laravel files)
│
└── public_html/            (Web root - only Laravel's public folder contents)
    ├── index.php           (Modified to point to ../business_card)
    ├── .htaccess
    ├── assets/             (CSS, JS, images)
    └── ... (only public files)
```

## 🚀 Step-by-Step Deployment Guide

### Step 1: Prepare Your Local Project

1. **Create a ZIP file of your project** (excluding unnecessary files):
   - Exclude: `node_modules/`, `.git/`, `.env` (we'll create a new one)
   - Include: All Laravel files, `vendor/` (if you have it), `storage/`, etc.

2. **Files to exclude from ZIP:**
   - `.git/`
   - `node_modules/`
   - `.env` (we'll create a new one on server)
   - `storage/logs/*.log`
   - `.DS_Store`
   - `Thumbs.db`

### Step 2: Upload Files to Hostinger

#### Option A: Using File Manager (Recommended for beginners)

1. **Login to Hostinger hPanel**
2. **Go to File Manager**
3. **Navigate to your domain's root** (usually `/home/username/`)
4. **Create folder `business_card`** (if it doesn't exist)
5. **Upload your ZIP file** to the `business_card` folder
6. **Extract the ZIP file** in the `business_card` folder
7. **Move contents** from `business_card/your-zip-name/` to `business_card/`

#### Option B: Using FTP/SFTP

1. **Connect via FTP** (FileZilla, WinSCP, etc.)
2. **Navigate to `/home/username/`**
3. **Upload all files** to `business_card/` folder
4. **Ensure folder structure** matches the structure above

### Step 3: Set Up public_html Folder

**Important**: Only Laravel's `public/` folder contents should be in `public_html/`

1. **Copy contents** from `business_card/public/` to `public_html/`
2. **Or create a symbolic link** (if supported):
   ```bash
   ln -s /home/username/business_card/public /home/username/public_html
   ```

### Step 4: Modify public_html/index.php

The `index.php` in `public_html` needs to point to the correct paths:

```php
<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
*/

if (file_exists($maintenance = __DIR__.'/../business_card/storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/

require __DIR__.'/../business_card/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
*/

$app = require_once __DIR__.'/../business_card/bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
```

### Step 5: Create .env File for Production

1. **Copy `.env.example` to `.env`** in `business_card/` folder:
   ```bash
   cp .env.example .env
   ```

2. **Edit `.env` file** with production settings:

```env
APP_NAME="Itapp Digital"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_URL=https://itappdigital.com

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=info@itappdigital.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@itappdigital.com
MAIL_FROM_NAME="Itapp Digital"
```

3. **Generate APP_KEY** (if needed):
   ```bash
   php artisan key:generate
   ```

### Step 6: Set File Permissions

Set proper permissions for Laravel to work:

```bash
# Navigate to business_card folder
cd /home/username/business_card

# Set permissions
chmod -R 755 storage bootstrap/cache
chmod -R 755 public
chown -R username:username storage bootstrap/cache
```

**Via File Manager:**
- Right-click `storage/` → Permissions → Set to `755`
- Right-click `bootstrap/cache/` → Permissions → Set to `755`
- Right-click `public/` → Permissions → Set to `755`

### Step 7: Install Dependencies

1. **SSH into your server** (if available) or use **Terminal in hPanel**
2. **Navigate to business_card folder**:
   ```bash
   cd /home/username/business_card
   ```
3. **Install Composer dependencies**:
   ```bash
   composer install --no-dev --optimize-autoloader
   ```
   (If composer is not available, upload `vendor/` folder from local)

### Step 8: Run Migrations

```bash
cd /home/username/business_card
php artisan migrate --force
```

### Step 9: Create Storage Link

```bash
php artisan storage:link
```

### Step 10: Clear and Cache Configuration

```bash
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### Step 11: Set Up Database

1. **Create database** in Hostinger hPanel:
   - Go to **Databases** → **MySQL Databases**
   - Create new database
   - Create database user
   - Grant all privileges
   - Note down: Database name, Username, Password

2. **Import database** (if you have a backup):
   - Go to **phpMyAdmin**
   - Select your database
   - Click **Import**
   - Upload your `.sql` file

3. **Or run migrations** (Step 8 above)

### Step 12: Configure .htaccess in public_html

Create/update `.htaccess` in `public_html/`:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

### Step 13: Test Your Application

1. **Visit your domain**: `https://itappdigital.com`
2. **Check if it loads** correctly
3. **Test registration** to verify emails work
4. **Check admin login** with: `info@itappdigital.com`

## 📋 Checklist

- [ ] All files uploaded to `business_card/` folder
- [ ] `public_html/` contains only public files
- [ ] `public_html/index.php` modified with correct paths
- [ ] `.env` file created with production settings
- [ ] Database created and configured
- [ ] File permissions set (755 for storage, bootstrap/cache)
- [ ] Composer dependencies installed
- [ ] Migrations run
- [ ] Storage link created
- [ ] Configuration cached
- [ ] `.htaccess` configured
- [ ] Application tested

## 🔧 Troubleshooting

### Issue: 500 Internal Server Error
- Check file permissions (storage, bootstrap/cache should be 755)
- Check `.env` file exists and has correct settings
- Check error logs: `business_card/storage/logs/laravel.log`

### Issue: White Screen
- Enable debug temporarily: `APP_DEBUG=true` in `.env`
- Check PHP version (Laravel 11 requires PHP 8.2+)
- Check error logs

### Issue: Assets Not Loading
- Ensure `storage:link` is created
- Check `public_html/` has all assets
- Verify paths in `index.php`

### Issue: Database Connection Error
- Verify database credentials in `.env`
- Check database exists in phpMyAdmin
- Verify database user has proper permissions

### Issue: Email Not Sending
- Check SMTP settings in `.env`
- Verify email credentials
- Test with tinker: `php artisan tinker`

## 📁 Final Folder Structure

```
/home/username/
│
├── business_card/                    (Main Laravel App - Protected)
│   ├── app/
│   ├── bootstrap/
│   │   └── cache/                    (755 permissions)
│   ├── config/
│   ├── database/
│   ├── public/                       (Contents copied to public_html)
│   ├── resources/
│   ├── routes/
│   ├── storage/                      (755 permissions)
│   │   ├── app/
│   │   ├── framework/
│   │   └── logs/
│   ├── vendor/
│   ├── .env                          (Production settings)
│   ├── .htaccess
│   ├── artisan
│   ├── composer.json
│   └── ...
│
└── public_html/                      (Web Root - Public Access)
    ├── index.php                     (Modified to point to ../business_card)
    ├── .htaccess
    ├── css/
    ├── js/
    ├── images/
    └── ... (all public assets)
```

## 🎯 Quick Commands Reference

```bash
# Navigate to project
cd /home/username/business_card

# Install dependencies
composer install --no-dev --optimize-autoloader

# Run migrations
php artisan migrate --force

# Create storage link
php artisan storage:link

# Clear and cache
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Set permissions
chmod -R 755 storage bootstrap/cache
```

## ✅ Success!

Your Laravel application should now be live at `https://itappdigital.com`!

---

**Need Help?** Check the error logs in `business_card/storage/logs/laravel.log`

