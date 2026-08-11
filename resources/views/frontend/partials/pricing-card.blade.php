<div class="col-xl-4 col-md-6">
    <div class="pricing-card {{ $plan->cardClass() }}">
        <div class="pricing-card_header">
            <div class="item">
                <h4>{{ $plan->name }}</h4>
                <div class="price">
                    <h2>{{ $price }}</h2>
                    <span>{{ $suffix }}</span>
                </div>
            </div>
            <div class="item">
                <img src="{{ $plan->iconUrl() }}" alt="icon">
            </div>
        </div>
        <div class="pricing-card_body">
            <div class="checklist-wrapper">
                @foreach($plan->featureList() as $feature)
                    <ul class="checklist style1">
                        <li>
                            <img src="{{ asset('assets/img/icon/'.($feature['included'] ? 'checkmarkIcon' : 'crossIcon').'.svg') }}" alt="icon">
                            {{ $feature['text'] }}
                        </li>
                        <li>
                            <img src="{{ asset('assets/img/icon/questionIcon.svg') }}" alt="icon">
                        </li>
                    </ul>
                @endforeach
            </div>
            <div class="btn-wrapper">
                <a href="{{ $plan->button_url ? url($plan->button_url) : route('plan.subscribe', $plan) }}" class="{{ $plan->buttonClass() }}">
                    {{ $plan->button_text ?: 'Buy Now' }}
                    <i class="fa-sharp fa-light fa-arrow-right-long"></i>
                </a>
            </div>
        </div>
    </div>
</div>
