<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Newsletter Subscriber</title>
</head>
<body style="font-family: Arial, sans-serif; color: #222; line-height: 1.6;">
    <h2 style="color: #3C72FC;">New Newsletter Subscriber</h2>

    <p><strong>Email:</strong> {{ $subscriber->email }}</p>
    @if($subscriber->name)
        <p><strong>Name:</strong> {{ $subscriber->name }}</p>
    @endif
    <p><strong>Source:</strong> {{ $subscriber->source }}</p>
    <p><strong>IP:</strong> {{ $subscriber->ip_address ?: '—' }}</p>
    <p><strong>Subscribed at:</strong> {{ optional($subscriber->subscribed_at)->format('d M Y, h:i A') }}</p>

    <hr>
    <p style="font-size: 12px; color: #777;">
        Manage subscribers in admin → Newsletter.
    </p>
</body>
</html>
