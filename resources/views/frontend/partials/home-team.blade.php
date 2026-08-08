@if($team->count())
<section class="team-section fix section-padding">
    <div class="container">
        <div class="section-title title-area mx-auto text-center mb-50">
            <h6>Our Team</h6>
            <h2>Meet Our Experts</h2>
        </div>
        <div class="row g-4">
            @foreach($team as $member)
                <div class="col-xl-3 col-md-6">
                    <div class="team-card text-center" style="background:var(--bg);padding:20px;border-radius:12px;">
                        <img src="{{ $member->imageUrl() }}" alt="{{ $member->name }}" style="width:100%;border-radius:10px;margin-bottom:16px;">
                        <h4><a href="{{ route('team.show', $member) }}">{{ $member->name }}</a></h4>
                        <p style="color:var(--theme);">{{ $member->designation }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
