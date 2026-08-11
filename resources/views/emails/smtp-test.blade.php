<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SMTP Test</title>
</head>
<body style="font-family: Arial, sans-serif; color: #222; line-height: 1.6;">
    <h2 style="color: #3C72FC;">SMTP Test Successful</h2>

    <p>This is a test email from <strong>{{ $settings->site_name ?: 'Extech CMS' }}</strong>.</p>

    <p>If you received this message, your SMTP settings are working correctly.</p>

    <ul>
        <li><strong>Mailer:</strong> {{ $mail->mailer }}</li>
        <li><strong>Host:</strong> {{ $mail->host ?: '—' }}</li>
        <li><strong>Port:</strong> {{ $mail->port ?: '—' }}</li>
        <li><strong>Encryption:</strong> {{ $mail->encryption ?: 'none' }}</li>
        <li><strong>From:</strong> {{ $mail->from_name }} &lt;{{ $mail->from_address }}&gt;</li>
        <li><strong>Sent at:</strong> {{ $sentAt }}</li>
    </ul>

    @if($note)
        <p><strong>Note:</strong> {{ $note }}</p>
    @endif
</body>
</html>
