{{-- Envolvemos todo el contenido de la tarjeta original en una etiqueta <a> --}}
    <a href="{{ route('cocineros.show', $cocinero) }}" class="card"> 
        {{-- Mantenemos la clase 'card' si define la apariencia que deseas,
             o podrías añadir/cambiar clases según el estilo de la segunda vista si prefieres --}}
    
        {{-- Contenido interno original de la primera tarjeta --}}
        <div class="temporary_text">
            <img src="{{ asset('storage/' . $cocinero->profile_photo_url) }}" 
                 class="w-full h-48 object-cover rounded-lg"
                 alt="{{ $cocinero->name }}">
        </div>
    
        <div class="card_content">
            <span class="card_title">{{ $cocinero->name }}</span>
            {{-- Asegúrate que la forma de calcular el rating es la que quieres usar --}}
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
        {{-- Fin del contenido interno original --}}
    
    </a> {{-- Cerramos la etiqueta <a> --}}
    
    {{-- El segundo ejemplo con texto de relleno no necesita cambios según tu petición --}}
    {{-- <article class="card"> ... </article> --}} 
    
    {{-- El tercer ejemplo (el que ya era un enlace) se mantiene como referencia --}}
    {{-- <a href="{{ route('cocineros.show', $cocinero) }}" class="..."> ... </a> --}}