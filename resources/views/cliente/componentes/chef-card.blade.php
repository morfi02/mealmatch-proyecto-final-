<article class="card">
    <div class="temporary_text">
        <img src="{{ asset('storage/' . $cocinero->profile_photo_url) }}" 
             class="w-full h-48 object-cover rounded-lg"
             alt="{{ $cocinero->name }}">
    </div>

    <div class="card_content">
        <span class="card_title">{{ $cocinero->name }}</span>
        <span class="card_subtitle">⭐ {{ number_format($cocinero->ratingsReceived()->avg('rating') ?? 5.0, 1) }}</span>
        
        <div class="card_description">
            <h4 class="font-semibold text-lg">Especialidades</h4>
            @forelse($cocinero->dishes->take(3) as $dish)
                <div class="dish flex justify-between mb-2">
                    <span>{{ $dish->name }}</span>
                    @if($dish->price)
                        <span>{{ number_format($dish->price, 2) }}€</span>
                    @endif
                </div>
            @empty
                <p class="text-sm">Creaciones secretas...</p>
            @endforelse
        </div>
    </div>
</article>
<article class="card">
    <div class="temporary_text">
        <img src="{{ asset('storage/' . $cocinero->profile_photo_url) }}" 
             class="w-full h-48 object-cover rounded-lg"
             alt="{{ $cocinero->name }}">
    </div>
<div class="card_content">
    <span class="card_title">This is a Title</span>
        <span class="card_subtitle">Thsi is a subtitle of this page. Let us see how it looks on the Web.</span>
        <p class="card_description">Lorem ipsum dolor, sit amet  expedita exercitationem recusandae aut dolor tempora aperiam itaque possimus at, cupiditate earum, quae repudiandae aspernatur? Labore minus soluta consequatur placeat.</p>
    
</div>
</article>