# Production Setup Guide for Itapp Digital

## Email Configuration

### Required .env Settings for Production

Add the following to your `.env` file for production:

```env
# Application Settings
APP_NAME="Itapp Digital"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://itappdigital.com

# Email Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=info@itappdigital.com
MAIL_PASSWORD=your_email_password_here
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@itappdigital.com
MAIL_FROM_NAME="${APP_NAME}"

# Queue Configuration (for async email sending)
QUEUE_CONNECTION=database
```

### Email Service Provider Options

#### Option 1: Hostinger SMTP (Recommended)
If you're using Hostinger hosting, use their SMTP:
- **Host**: `smtp.hostinger.com`
- **Port**: `587` (TLS) or `465` (SSL)
- **Encryption**: `tls` or `ssl`
- **Username**: `info@itappdigital.com`
- **Password**: Your email account password

#### Option 2: Gmail SMTP
If using Gmail:
- **Host**: `smtp.gmail.com`
- **Port**: `587`
- **Encryption**: `tls`
- **Username**: `info@itappdigital.com` (if using Google Workspace)
- **Password**: App-specific password (not regular password)

#### Option 3: Mailgun
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=itappdigital.com
MAILGUN_SECRET=your_mailgun_secret
MAILGUN_ENDPOINT=api.mailgun.net
```

#### Option 4: SendGrid
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your_sendgrid_api_key
```

### Setting Up Queue for Email Processing

1. **Create the jobs table** (if not exists):
```bash
php artisan queue:table
php artisan migrate
```

2. **Start the queue worker** (for production):
```bash
php artisan queue:work --tries=3
```

Or use a process manager like Supervisor:
```ini
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/path/to/worker.log
```

### Email Notifications Configured

The following email notifications are now active:

1. **Account Created** - Sent when a user registers
2. **Password Reset** - Sent when user requests password reset
3. **Account Status Changed** - Sent when account is:
   - Activated
   - Suspended
   - Deleted
   - Restored

### Testing Email Configuration

Test your email setup:
```bash
php artisan tinker
Mail::raw('Test email', function ($message) {
    $message->to('your-test@email.com')
            ->subject('Test Email');
});
```

## Production Checklist

- [ ] Update `.env` with production settings
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Set `APP_URL=https://itappdigital.com`
- [ ] Configure email settings
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Set up queue worker
- [ ] Configure SSL certificate
- [ ] Set proper file permissions
- [ ] Configure database backups
- [ ] Set up error logging (Sentry, etc.)

## File Permissions

```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## Security Recommendations

1. Keep `.env` file secure and never commit it
2. Use strong database passwords
3. Enable HTTPS/SSL
4. Regularly update dependencies
5. Set up regular backups
6. Monitor error logs

