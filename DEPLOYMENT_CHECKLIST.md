# Deployment Checklist for Hostinger

## 📦 Pre-Deployment (Local)

- [ ] Remove `.git/` folder (if not needed)
- [ ] Remove `node_modules/` (if not needed)
- [ ] Remove `.env` file (will create new one on server)
- [ ] Remove `storage/logs/*.log` files
- [ ] Create ZIP file of project
- [ ] Test application locally one last time

## 📤 Upload to Server

- [ ] Login to Hostinger hPanel
- [ ] Navigate to File Manager
- [ ] Create `business_card/` folder in root (`/home/username/`)
- [ ] Upload ZIP file to `business_card/`
- [ ] Extract ZIP file
- [ ] Verify all files are in `business_card/` folder

## 🔧 Server Configuration

### Folder Structure
- [ ] `business_card/` contains all Laravel files
- [ ] `public_html/` contains only public files (from `business_card/public/`)
- [ ] `public_html/index.php` modified with correct paths

### File Permissions
- [ ] `storage/` folder: 755
- [ ] `bootstrap/cache/` folder: 755
- [ ] `public/` folder: 755

### Environment Setup
- [ ] `.env` file created in `business_card/`
- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_URL=https://itappdigital.com`
- [ ] Database credentials configured
- [ ] Email credentials configured
- [ ] `APP_KEY` generated

## 🗄️ Database Setup

- [ ] Database created in Hostinger
- [ ] Database user created
- [ ] User granted all privileges
- [ ] Database credentials added to `.env`
- [ ] Migrations run: `php artisan migrate --force`
- [ ] Admin user seeded (if needed): `php artisan db:seed --class=AdminUserSeeder`

## 📦 Dependencies

- [ ] Composer dependencies installed: `composer install --no-dev`
- [ ] Or `vendor/` folder uploaded from local

## 🔗 Laravel Setup

- [ ] Storage link created: `php artisan storage:link`
- [ ] Configuration cached: `php artisan config:cache`
- [ ] Routes cached: `php artisan route:cache`
- [ ] Views cached: `php artisan view:cache`
- [ ] Optimized: `php artisan optimize`

## 🌐 Web Server Configuration

- [ ] `.htaccess` file in `public_html/`
- [ ] `index.php` in `public_html/` points to `../business_card/`
- [ ] PHP version is 8.2 or higher
- [ ] Required PHP extensions enabled

## ✉️ Email Configuration

- [ ] SMTP settings in `.env`
- [ ] `MAIL_FROM_ADDRESS=info@itappdigital.com`
- [ ] Email credentials correct
- [ ] Test email sent successfully

## 🧪 Testing

- [ ] Homepage loads: `https://itappdigital.com`
- [ ] Registration works
- [ ] Login works
- [ ] Admin login works: `info@itappdigital.com`
- [ ] Email notifications work
- [ ] Password reset works
- [ ] All pages load correctly
- [ ] Images/assets load correctly

## 🔒 Security

- [ ] `.env` file not accessible via web
- [ ] `storage/` folder not accessible via web
- [ ] `bootstrap/` folder not accessible via web
- [ ] `vendor/` folder not accessible via web
- [ ] SSL certificate installed (HTTPS working)

## 📊 Monitoring

- [ ] Error logging working
- [ ] Check logs: `business_card/storage/logs/laravel.log`
- [ ] Queue worker running (if using queues)

## ✅ Final Verification

- [ ] All functionality tested
- [ ] No errors in logs
- [ ] Performance is acceptable
- [ ] Backup strategy in place
- [ ] Documentation reviewed

---

**Status**: ⬜ Not Started | 🟡 In Progress | ✅ Complete

