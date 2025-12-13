# Folder Structure for Hostinger Deployment

## 📂 Complete Folder Structure

```
/home/username/                          (Your Hostinger root)
│
├── 📁 business_card/                   ⚠️ MAIN APPLICATION (Protected)
│   │
│   ├── 📁 app/                         ✅ Keep here
│   ├── 📁 bootstrap/                   ✅ Keep here
│   │   └── cache/                      ✅ Keep here (755 permissions)
│   ├── 📁 config/                      ✅ Keep here
│   ├── 📁 database/                    ✅ Keep here
│   ├── 📁 public/                      ⚠️ Copy contents to public_html
│   │   ├── index.php                   ⚠️ Copy & modify
│   │   ├── .htaccess                   ⚠️ Copy
│   │   ├── css/                        ⚠️ Copy
│   │   ├── js/                         ⚠️ Copy
│   │   └── ...                         ⚠️ Copy all
│   ├── 📁 resources/                   ✅ Keep here
│   ├── 📁 routes/                      ✅ Keep here
│   ├── 📁 storage/                     ✅ Keep here (755 permissions)
│   │   ├── app/
│   │   ├── framework/
│   │   └── logs/
│   ├── 📁 vendor/                      ✅ Keep here
│   ├── 📄 .env                         ✅ Keep here (create new)
│   ├── 📄 .htaccess                     ✅ Keep here
│   ├── 📄 artisan                      ✅ Keep here
│   ├── 📄 composer.json                 ✅ Keep here
│   └── ... (all other Laravel files)   ✅ Keep here
│
└── 📁 public_html/                      🌐 WEB ROOT (Public Access)
    │
    ├── 📄 index.php                     ⚠️ Modified version (see public_html_index.php)
    ├── 📄 .htaccess                     ⚠️ Copy from public_html_htaccess
    ├── 📁 css/                          ✅ From business_card/public/css/
    ├── 📁 js/                           ✅ From business_card/public/js/
    ├── 📁 images/                       ✅ From business_card/public/images/
    ├── 📄 favicon.ico                   ✅ From business_card/public/
    └── ... (all public assets)           ✅ From business_card/public/
```

## 🎯 What Goes Where?

### ✅ business_card/ Folder Contains:

**ALL Laravel Application Files:**
- ✅ `app/` - Application code
- ✅ `bootstrap/` - Bootstrap files
- ✅ `config/` - Configuration files
- ✅ `database/` - Migrations, seeders
- ✅ `resources/` - Views, assets source
- ✅ `routes/` - Route definitions
- ✅ `storage/` - Logs, cache, uploads
- ✅ `vendor/` - Composer dependencies
- ✅ `.env` - Environment configuration
- ✅ `artisan` - Artisan CLI
- ✅ `composer.json` - Dependencies

**⚠️ DO NOT put these in public_html:**
- ❌ `.env` file (security risk!)
- ❌ `storage/` folder (security risk!)
- ❌ `vendor/` folder (not needed)
- ❌ `config/` folder (not needed)
- ❌ Any application code

### 🌐 public_html/ Folder Contains:

**ONLY Public-Facing Files:**
- ✅ `index.php` - Entry point (modified)
- ✅ `.htaccess` - Apache configuration
- ✅ All CSS files
- ✅ All JavaScript files
- ✅ All images
- ✅ Favicon
- ✅ Any other public assets

**⚠️ These are the ONLY files that should be in public_html:**
- ✅ Files from `business_card/public/`
- ✅ Modified `index.php` pointing to `../business_card/`

## 📋 Step-by-Step File Placement

### Step 1: Upload to business_card/

Upload ALL these folders/files to `/home/username/business_card/`:

```
business_card/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/              ← We'll copy contents from here
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env                 ← Create new one
├── .htaccess
├── artisan
├── composer.json
└── ... (all files)
```

### Step 2: Copy to public_html/

Copy ONLY the contents of `business_card/public/` to `/home/username/public_html/`:

```
public_html/
├── index.php            ← Replace with modified version
├── .htaccess            ← Copy as-is
├── css/
├── js/
├── images/
├── favicon.ico
└── ... (all public assets)
```

### Step 3: Modify public_html/index.php

Replace `public_html/index.php` with the modified version that points to `../business_card/`

See file: `public_html_index.php` in your project root.

## 🔒 Security Notes

### ✅ Protected (Not Web Accessible):
- `business_card/.env` - Contains sensitive data
- `business_card/storage/` - Contains logs and uploads
- `business_card/config/` - Contains configuration
- `business_card/vendor/` - Contains dependencies
- `business_card/app/` - Contains application code

### 🌐 Public (Web Accessible):
- `public_html/` - Only this folder is web-accessible
- All files in `public_html/` can be accessed via browser

## 📝 Quick Reference

| Item | Location | Notes |
|------|----------|-------|
| Laravel App | `business_card/` | All application files |
| Public Files | `public_html/` | Only public assets |
| `.env` | `business_card/.env` | Never in public_html |
| `index.php` | `public_html/index.php` | Modified version |
| Storage | `business_card/storage/` | 755 permissions |
| Cache | `business_card/bootstrap/cache/` | 755 permissions |

## ✅ Verification Checklist

After deployment, verify:

- [ ] `business_card/` has all Laravel files
- [ ] `public_html/` has only public files
- [ ] `public_html/index.php` points to `../business_card/`
- [ ] `.env` is in `business_card/` (NOT in public_html)
- [ ] Permissions set: `storage/` and `bootstrap/cache/` = 755
- [ ] No sensitive files in `public_html/`

---

**Remember**: The main application stays in `business_card/` (protected), and only public files go in `public_html/` (web-accessible).

