<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
    <style>
        :root {
            color-scheme: light dark;
        }

        body {
            background-color: #f7f9fc;
            font-family: 'Inter', Arial, sans-serif;
            color: #1a1a1a;
            margin: 0;
            padding: 40px 0;
        }

        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 0 auto;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(90deg, #4f46e5, #3b82f6);
            color: #ffffff;
            text-align: center;
            padding: 32px 24px 24px 24px;
        }

        .header img {
            max-width: 140px;
            margin-bottom: 16px;
            filter: brightness(0) invert(1);
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
            letter-spacing: 0.5px;
        }

        .content {
            padding: 32px;
        }

        .content h3 {
            font-size: 20px;
            margin-bottom: 16px;
            color: #111827;
        }

        .info {
            margin-bottom: 24px;
        }

        .info p {
            margin: 6px 0;
            line-height: 1.5;
        }

        .info strong {
            color: #111827;
            display: inline-block;
            width: 90px;
        }

        .message-box {
            background-color: #f3f4f6;
            padding: 16px;
            border-radius: 12px;
            line-height: 1.6;
            color: #374151;
        }

        .footer {
            padding: 20px 32px;
            background-color: #f9fafb;
            text-align: center;
            font-size: 13px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }

        @media (prefers-color-scheme: dark) {
            body {
                background-color: #111827;
                color: #f9fafb;
            }

            .email-container {
                background-color: #1f2937;
                box-shadow: 0 4px 20px rgba(255, 255, 255, 0.05);
            }

            .content h3, .info strong {
                color: #f9fafb;
            }

            .message-box {
                background-color: #374151;
                color: #e5e7eb;
            }

            .footer {
                background-color: #111827;
                border-top-color: #374151;
                color: #9ca3af;
            }

            .header img {
                filter: brightness(1) invert(0); /* logo normal in dark mode */
            }
        }

        @media (max-width: 600px) {
            .content, .header, .footer {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="{{ $data['logo_url'] }}" alt="ImmaOnStudio Logo">
            <h2>📩 New Contact Message</h2>
        </div>

        <div class="content">
            <h3>Contact Details</h3>

            <div class="info">
                <p><strong>Name:</strong> {{ $data['name'] }}</p>
                <p><strong>Email:</strong> {{ $data['email'] }}</p>
                <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
                <p><strong>Class:</strong> {{ $data['class'] }}</p>
            </div>

            <h3>Message</h3>
            <div class="message-box">
                {{ $data['message'] }}
            </div>
        </div>

        <div class="footer">
            <p>Sent from <strong>ImmaOnStudio</strong> Contact Form</p>
            <p style="margin-top: 6px;">Jl. Letnan Jendral Sutoyo, Parit Tokaya, Kec. Pontianak Sel., Kota Pontianak, Kalimantan Barat 78121</p>
        </div>
    </div>
</body>
</html>