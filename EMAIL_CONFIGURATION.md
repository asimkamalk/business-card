# Email Configuration Guide for Itapp Digital

## Quick Setup

### Step 1: Update .env File

Add these settings to your `.env` file:

```env
# Email Settings
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=info@itappdigital.com
MAIL_PASSWORD=your_email_password_here
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@itappdigital.com
MAIL_FROM_NAME="Itapp Digital"

# Application URL (for production)
APP_URL=https://itappdigital.com
APP_ENV=production
APP_DEBUG=false
```

### Step 2: Clear Configuration Cache

After updating `.env`, run:
```bash
php artisan config:clear
php artisan config:cache
```

### Step 3: Test Email Configuration

Test your email setup:
```bash
php artisan tinker
```

Then in tinker:
```php
Mail::raw('Test email from Itapp Digital', function ($message) {
    $message->to('your-test@email.com')
            ->subject('Test Email - Itapp Digital');
});
```

## Email Notifications Active

The following email notifications are now configured:

### 1. Account Created Email
- **Trigger**: When a new user registers
- **Recipient**: New user
- **Content**: Welcome message with account details

### 2. Password Reset Email
- **Trigger**: When user requests password reset
- **Recipient**: User requesting reset
- **Content**: Password reset link with expiration time

### 3. Account Status Changed Email
- **Trigger**: When admin changes user status
- **Recipient**: Affected user
- **Content**: Status change notification (Active/Suspended/Deleted)

## SMTP Configuration Options

### Hostinger (Recommended for itappdigital.com)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=info@itappdigital.com
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
```

### Alternative: Gmail (if using Google Workspace)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=info@itappdigital.com
MAIL_PASSWORD=app_specific_password
MAIL_ENCRYPTION=tls
```

**Note**: For Gmail, you need to:
1. Enable 2-Step Verification
2. Generate an App Password
3. Use the App Password (not your regular password)

### Alternative: Mailgun

```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=itappdigital.com
MAILGUN_SECRET=your_mailgun_secret
MAILGUN_ENDPOINT=api.mailgun.net
```

## Queue Configuration (Recommended for Production)

For better performance, emails are sent via queue:

1. **Ensure jobs table exists**:
```bash
php artisan migrate
```

2. **Start queue worker**:
```bash
php artisan queue:work
```

For production, use Supervisor or similar process manager to keep the queue worker running.

## Troubleshooting

### Emails not sending?

1. Check `.env` file has correct settings
2. Clear config cache: `php artisan config:clear`
3. Check mail logs: `storage/logs/laravel.log`
4. Test with tinker (see Step 3 above)
5. Verify SMTP credentials are correct
6. Check firewall/port restrictions

### Queue not processing?

1. Ensure jobs table exists: `php artisan migrate`
2. Check queue connection in `.env`: `QUEUE_CONNECTION=database`
3. Start queue worker: `php artisan queue:work`
4. Check failed jobs: `php artisan queue:failed`

### Common Issues

**Issue**: "Connection timeout"
- **Solution**: Check MAIL_HOST and MAIL_PORT are correct
- **Solution**: Verify firewall allows outbound SMTP connections

**Issue**: "Authentication failed"
- **Solution**: Verify MAIL_USERNAME and MAIL_PASSWORD
- **Solution**: For Gmail, use App Password, not regular password

**Issue**: "Emails going to spam"
- **Solution**: Set up SPF, DKIM, and DMARC records for your domain
- **Solution**: Use a reputable email service (Mailgun, SendGrid)

## Production Checklist

- [ ] Email credentials configured in `.env`
- [ ] `APP_URL` set to `https://itappdigital.com`
- [ ] `APP_ENV` set to `production`
- [ ] `APP_DEBUG` set to `false`
- [ ] Queue worker running (if using queue)
- [ ] Email test successful
- [ ] SPF/DKIM records configured (optional but recommended)

