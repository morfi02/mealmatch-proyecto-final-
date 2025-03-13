<a 
    href="{{ route('cocineros.show', $cocinero) }}" 
    class="menu-card bg-white hover:shadow-2xl transition-all duration-500"
>
    <div class="menu-cover">
        <div class="relative h-full w-full">
            <div class="menu-texture absolute inset-0 bg-[#3a2a22]"></div>
            <img 
                src="{{ asset('storage/' . $cocinero->profile_photo_url) }}" 
                class="menu-chef-image"
                alt="{{ $cocinero->name }}"
            >
            <div class="menu-title">
                <h3 class="text-[#f5e6d3] font-vintage">{{ $cocinero->name }}</h3>
                <div class="menu-divider"></div>
                <span class="rating-badge">
                    ⭐ {{ $cocinero->rating ?? 4.9 }}
                </span>
            </div>
        </div>
    </div>

    <div class="menu-content">
        <div class="menu-paper-texture">
            <h4 class="menu-section-title">Especialidades del Chef</h4>
            <div class="menu-items">
                @forelse($cocinero->dishes->take(5) as $dish)
                    <div class="menu-item">
                        <span class="item-name">{{ $dish->name }}</span>
                        <div class="item-dots"></div>
                        @if($dish->price)
                            <span class="item-price">{{ number_format($dish->price, 2) }}€</span>
                        @endif
                    </div>
                @empty
                    <p class="no-dishes">Creaciones secretas en camino...</p>
                @endforelse
            </div>
            <div class="menu-corner-logo">★ Chef ★</div>
        </div>
    </div>
</a>