<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
        <h1 style="color: white; margin: 0;">New Contact Form Submission</h1>
    </div>
    
    <div style="background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; border: 1px solid #e0e0e0;">
        <p style="font-size: 16px; margin-bottom: 20px;">You have received a new contact form submission from your website:</p>
        
        <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #667eea;">
            <p style="margin: 10px 0;"><strong>Full Name:</strong> {{ $contactMessage->full_name }}</p>
            <p style="margin: 10px 0;"><strong>Email:</strong> <a href="mailto:{{ $contactMessage->email }}" style="color: #667eea;">{{ $contactMessage->email }}</a></p>
            <p style="margin: 10px 0;"><strong>WhatsApp Number:</strong> {{ $contactMessage->whatsapp_number }}</p>
        </div>
        
        <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #764ba2;">
            <p style="margin: 0 0 10px 0;"><strong>Message:</strong></p>
            <p style="margin: 0; white-space: pre-wrap;">{{ $contactMessage->message }}</p>
        </div>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="{{ url('/admin/contact-messages') }}" 
               style="display: inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                View in Admin Dashboard
            </a>
        </div>
        
        <p style="margin-top: 30px; font-size: 12px; color: #999; text-align: center;">
            This email was sent from your Itapp Digital website contact form.
        </p>
    </div>
</body>
</html>

