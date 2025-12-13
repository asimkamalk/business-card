# Quick Deployment Guide - Hostinger

## 🚀 Fast Track Deployment (5 Minutes)

### Step 1: Create ZIP (Local)
1. Zip your project (exclude `.git`, `node_modules`, `.env`)
2. Name it: `business-card.zip`

### Step 2: Upload to Hostinger
1. Login to **hPanel** → **File Manager**
2. Go to `/home/username/` (root)
3. Create folder: `business_card`
4. Upload `business-card.zip` to `business_card/`
5. Extract ZIP file
6. Move all contents from extracted folder to `business_card/`

### Step 3: Set Up public_html
1. Copy ALL files from `business_card/public/` to `public_html/`
2. Replace `public_html/index.php` with the modified version (see `public_html_index.php`)
3. Ensure `.htaccess` exists in `public_html/` (see `public_html_htaccess`)

### Step 4: Configure Environment
1. In `business_card/`, copy `.env.example` to `.env`
2. Edit `.env` with these settings:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://itappdigital.com

DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=info@itappdigital.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@itappdigital.com
```

### Step 5: Set Permissions
Via File Manager:
- Right-click `business_card/storage/` → Permissions → **755**
- Right-click `business_card/bootstrap/cache/` → Permissions → **755**

### Step 6: Run Commands (Terminal/SSH)
```bash
cd /home/username/business_card

# Install dependencies (if composer available)
composer install --no-dev

# Generate key (if needed)
php artisan key:generate

# Run migrations
php artisan migrate --force

# Create storage link
php artisan storage:link

# Cache everything
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### Step 7: Test
Visit: `https://itappdigital.com`

---

## 📁 What Goes Where?

### business_card/ folder (Main Application)
```
✅ ALL Laravel files
✅ app/
✅ bootstrap/
✅ config/
✅ database/
✅ resources/
✅ routes/
✅ storage/
✅ vendor/
✅ .env
✅ artisan
✅ composer.json
```

### public_html/ folder (Web Root)
```
✅ Contents of business_card/public/
✅ index.php (modified version)
✅ .htaccess
✅ All CSS, JS, images
✅ Favicon
```

### ❌ DO NOT PUT IN public_html:
```
❌ app/
❌ bootstrap/
❌ config/
❌ database/
❌ resources/
❌ routes/
❌ storage/
❌ vendor/
❌ .env
❌ artisan
```

---

## 🔧 Common Issues & Fixes

**500 Error?**
- Check permissions: `storage/` and `bootstrap/cache/` = 755
- Check `.env` file exists
- Check error log: `business_card/storage/logs/laravel.log`

**White Screen?**
- Set `APP_DEBUG=true` temporarily
- Check PHP version (need 8.2+)
- Check error logs

**Assets Not Loading?**
- Run: `php artisan storage:link`
- Check `public_html/` has all files
- Clear browser cache

---

## ✅ Done!

Your site should be live at: **https://itappdigital.com**

