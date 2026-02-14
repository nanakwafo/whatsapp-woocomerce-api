<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your License Key</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f8; font-family: Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8; padding:40px 0;">
<tr>
<td align="center">

<table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 8px 20px rgba(0,0,0,0.05);">

<!-- Header -->
<tr>
<td align="center" style="background: linear-gradient(90deg, #7f54b3, #96588a); padding:30px;">
    <h1 style="color:#ffffff; margin:0; font-size:24px;">
        🎉 Payment Successful!
    </h1>
</td>
</tr>

<!-- Body -->
<tr>
<td style="padding:40px; color:#333333;">

    <h2 style="margin-top:0; font-size:20px;">
        Thank you for your purchase
    </h2>

    <p style="font-size:15px; line-height:1.6; color:#555;">
        Your license has been generated successfully.  
        Please keep it safe — you will need it to activate your plugin.
    </p>

    <!-- License Box -->
    <div style="margin:30px 0; padding:20px; background:#f8f5fc; border:2px dashed #7f54b3; border-radius:8px; text-align:center;">
        <p style="margin:0; font-size:13px; color:#777;">Your License Key</p>
        <h2 style="margin:10px 0 0; font-size:22px; letter-spacing:2px; color:#7f54b3;">
            {{ $licenseKey }}
        </h2>
    </div>

    <p style="font-size:14px; color:#555;">
        🗓 This license is valid for <strong>1 year</strong> from the date of activation.
    </p>

    <p style="font-size:14px; color:#555;">
        If you need help activating your license, feel free to contact support.
    </p>

</td>
</tr>

<!-- Footer -->
<tr>
<td align="center" style="background:#f4f6f8; padding:20px; font-size:12px; color:#888;">
    © {{ date('Y') }} Your Company Name. All rights reserved.
</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>
