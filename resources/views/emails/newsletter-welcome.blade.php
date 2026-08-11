<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Newsletter Subscription</title>
</head>
<body style="font-family: Arial, sans-serif; color: #222; line-height: 1.6;">
    <h2 style="color: #3C72FC;">Thanks for subscribing!</h2>

    <p>Hi{{ $subscriber->name ? ' '.$subscriber->name : '' }},</p>

    <p>
        You are now subscribed to updates from
        <strong>{{ $settings->site_name ?: 'our website' }}</strong>.
    </p>

    <p>We will share news, tips, and offers related to our services.</p>

    <p style="font-size: 12px; color: #777; margin-top: 32px;">
        If you did not subscribe, you can
        <a href="{{ $subscriber->unsubscribeUrl() }}">unsubscribe here</a>.
    </p>
</body>
</html>
