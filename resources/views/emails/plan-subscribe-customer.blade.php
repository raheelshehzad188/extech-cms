<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Package Request Received</title>
</head>
<body style="font-family: Arial, sans-serif; color: #222; line-height: 1.6;">
    <h2 style="color: #3C72FC;">Thanks for your package request</h2>

    <p>Hi {{ $subscription->name }},</p>
    <p>
        We received your one-time purchase request for
        <strong>{{ $subscription->plan_name }}</strong>
        @if($subscription->plan_price)
            ({{ $subscription->plan_price }})
        @endif.
    </p>
    <p>Our team will contact you shortly with payment and next steps.</p>

    <p style="font-size: 12px; color: #777; margin-top: 32px;">
        {{ $settings->site_name }}
        @if($settings->email)
            · {{ $settings->email }}
        @endif
    </p>
</body>
</html>
