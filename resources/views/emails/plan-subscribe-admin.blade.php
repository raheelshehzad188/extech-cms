<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Plan Subscribe</title>
</head>
<body style="font-family: Arial, sans-serif; color: #222; line-height: 1.6;">
    <h2 style="color: #3C72FC;">New Plan Subscribe Request</h2>
    <p>Someone wants to buy a package (one-time charge).</p>

    <p><strong>Plan:</strong> {{ $subscription->plan_name }}</p>
    <p><strong>One-Time Price:</strong> {{ $subscription->plan_price ?: '—' }}</p>
    <p><strong>Payment Type:</strong> One Time Charge</p>
    <p><strong>Status:</strong> {{ ucfirst($subscription->status) }}</p>

    <hr>
    <p><strong>Name:</strong> {{ $subscription->name }}</p>
    <p><strong>Email:</strong> {{ $subscription->email }}</p>
    @if($subscription->phone)
        <p><strong>Phone:</strong> {{ $subscription->phone }}</p>
    @endif
    @if($subscription->company)
        <p><strong>Company:</strong> {{ $subscription->company }}</p>
    @endif
    @if($subscription->message)
        <p><strong>Message:</strong></p>
        <p style="white-space: pre-wrap;">{{ $subscription->message }}</p>
    @endif

    <hr>
    <p style="font-size: 12px; color: #777;">
        Manage in admin → Plan Subscribe. Sent from {{ $settings->site_name }}.
    </p>
</body>
</html>
