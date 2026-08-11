<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quote Request</title>
</head>
<body style="font-family: Arial, sans-serif; color: #222; line-height: 1.6;">
    <h2 style="color: #3C72FC;">New Get A Quote Request</h2>

    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    @if(!empty($data['phone']))
        <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
    @endif

    @if($service)
        <p><strong>Service:</strong> {{ $service->title }}</p>
        @if($service->short_description)
            <p><strong>Service Summary:</strong> {{ $service->short_description }}</p>
        @endif
    @else
        <p><strong>Service:</strong> Not selected</p>
    @endif

    @if($plan)
        <p><strong>Pricing Plan:</strong> {{ $plan->name }}
            @if($plan->displayPrice())
                ({{ $plan->displayPrice() }} · {{ $plan->displaySuffix() }})
            @endif
        </p>
    @endif

    <p><strong>Message:</strong></p>
    <p style="white-space: pre-wrap;">{{ $data['message'] }}</p>

    <hr>
    <p style="font-size: 12px; color: #777;">Sent from {{ $settings->site_name }} website Get A Quote form.</p>
</body>
</html>
