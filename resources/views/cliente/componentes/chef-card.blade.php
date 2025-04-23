<a href="{{ route('cocineros.show', $cocinero) }}" class="chef-card">

    <div class="chef-card__image-container">
        {{-- La imagen original --}}
        <img src="{{ asset('storage/' . $cocinero->profile_photo_url) }}"
             class="chef-card__image"
             alt="{{ $cocinero->name }}">

        {{-- NUEVA CAPA DE OVERLAY (inicialmente oculta) --}}
        <div class="chef-card__dishes-overlay">
            <h5 class="chef-card__overlay-title">Top Platos</h5>
            <ul class="chef-card__overlay-list">
                {{-- Bucle para mostrar HASTA 10 platos en el overlay --}}
                @forelse($cocinero->dishes->take(10) as $dish)
                    <li class="chef-card__overlay-dish">
                        <span>{{ $dish->name }}</span>
                        @if($dish->price)
                            <span>{{ number_format($dish->price, 2) }}€</span>
                        @endif
                    </li>
                @empty
                    <li class="chef-card__overlay-no-dishes">Aún no hay platos destacados.</li>
                @endforelse
            </ul>
        </div>
        {{-- FIN DE LA CAPA DE OVERLAY --}}

    </div>

    {{-- Contenido inferior (se mantiene como antes, mostrando 3 platos) --}}
    <div class="chef-card__content">
        <div class="chef-card__header">
             <span class="chef-card__title">{{ $cocinero->name }}</span>
             <span class="chef-card__rating">
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="chef-card__rating-icon">
                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354l-4.597 2.927c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.007z" clip-rule="evenodd" />
                 </svg>
                 {{ number_format($cocinero->ratingsReceived()->avg('rating') ?? 5.0, 1) }}
             </span>
        </div>

        
    </div> 

</a>