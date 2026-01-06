<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification Code</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f5;">
    <table role="presentation" style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="padding: 40px 0;">
                <table role="presentation" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); padding: 40px 30px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 700;">🛒 Toko Keren</h1>
                            <p style="margin: 10px 0 0; color: rgba(255, 255, 255, 0.9); font-size: 16px;">Email Verification</p>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <p style="margin: 0 0 20px; color: #374151; font-size: 16px; line-height: 1.6;">
                                Hi <strong>{{ $userName }}</strong>,
                            </p>
                            <p style="margin: 0 0 30px; color: #374151; font-size: 16px; line-height: 1.6;">
                                Thank you for registering with Toko Keren! Please use the verification code below to complete your registration:
                            </p>
                            
                            <!-- Verification Code Box -->
                            <div style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); border: 2px dashed #6366f1; border-radius: 12px; padding: 30px; text-align: center; margin: 0 0 30px;">
                                <p style="margin: 0 0 10px; color: #6b7280; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">Your Verification Code</p>
                                <p style="margin: 0; font-size: 42px; font-weight: 700; color: #6366f1; letter-spacing: 8px; font-family: 'Courier New', monospace;">{{ $code }}</p>
                            </div>
                            
                            <p style="margin: 0 0 15px; color: #6b7280; font-size: 14px; line-height: 1.6;">
                                ⏰ This code will expire in <strong>15 minutes</strong>.
                            </p>
                            <p style="margin: 0; color: #6b7280; font-size: 14px; line-height: 1.6;">
                                If you didn't request this code, you can safely ignore this email.
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 30px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0 0 10px; color: #6b7280; font-size: 12px;">
                                &copy; {{ date('Y') }} Toko Keren. All rights reserved.
                            </p>
                            <p style="margin: 0; color: #9ca3af; font-size: 11px;">
                                This is an automated message. Please do not reply to this email.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
