<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Plan Request</title>
</head>
<body style="font-family: Arial, sans-serif; color: #222; line-height: 1.6;">
    <h2 style="color: #3C72FC;">New Plan Request</h2>
    <p>Someone submitted a Get Started request for a pricing plan.</p>

    <p><strong>Plan:</strong> {{ $subscription->plan_name }}</p>
    <p><strong>Plan Price:</strong> {{ $subscription->plan_price ?: '—' }}</p>
    <p><strong>Status:</strong> {{ ucfirst($subscription->status) }}</p>

    <hr>
    <p><strong>Name:</strong> {{ $subscription->name }}</p>
    <p><strong>Email:</strong> {{ $subscription->email }}</p>
    <p><strong>Contact:</strong> {{ $subscription->phone ?: '—' }}</p>
    <p><strong>WhatsApp:</strong> {{ $subscription->whatsapp ?: '—' }}</p>
    <p><strong>Business Name:</strong> {{ $subscription->business_name ?: ($subscription->company ?: '—') }}</p>
    <p><strong>Website:</strong> {{ $subscription->website ?: '—' }}</p>
    <p><strong>Country:</strong> {{ $subscription->country ?: '—' }}</p>
    <p><strong>Address:</strong></p>
    <p style="white-space: pre-wrap;">{{ $subscription->address ?: '—' }}</p>
    @if($subscription->message)
        <p><strong>Notes:</strong></p>
        <p style="white-space: pre-wrap;">{{ $subscription->message }}</p>
    @endif

    <hr>
    <p style="font-size: 12px; color: #777;">
        Manage in admin → Requests. Sent from {{ $settings->site_name }}.
    </p>
</body>
</html>
