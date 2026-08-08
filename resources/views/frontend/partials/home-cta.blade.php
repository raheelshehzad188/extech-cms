<section class="cta-section fix section-padding" style="background:var(--theme2);color:#fff;">
    <div class="container text-center">
        <h2 style="color:#fff;margin-bottom:16px;">{{ $home['cta_title'] ?? 'Ready to Get Started?' }}</h2>
        <p style="opacity:.9;max-width:640px;margin:0 auto 24px;">{{ $home['cta_text'] ?? 'Talk to our team and discover how we can help your business grow.' }}</p>
        <a href="{{ $home['cta_button_url'] ?? route('contact') }}" class="gt-btn style4">
            {{ $home['cta_button_text'] ?? ($settings->header_cta_text ?: 'Contact Us') }}
            <i class="fa-solid fa-arrow-right-long"></i>
        </a>
    </div>
</section>
