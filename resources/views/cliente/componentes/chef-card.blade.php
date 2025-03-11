<a 
    href="{{ route('cocineros.show', $cocinero) }}" 
    class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden"
>
    <!-- Imagen de perfil -->
    <div class="relative h-48">
        <img 
            src="{{ asset('storage/' . $cocinero->profile_photo_url) }}" 
            class="w-full h-full object-cover"
            alt="{{ $cocinero->name }}"
        >
        <span class="absolute top-4 right-4 bg-[#FF6F61] text-white px-3 py-1 rounded-full text-sm">
            ⭐ {{ $cocinero->rating ?? 4.9 }}
        </span>
    </div>

    <!-- Información del cocinero -->
    <div class="p-6">
        <h3 class="text-xl font-bold text-[#2D3748] mb-2">{{ $cocinero->name }}</h3>
        <p class="text-[#6B5B95] font-medium mb-3">{{ $cocinero->category }}</p>
        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $cocinero->bio }}</p>
        
        
        <div class="grid grid-cols-2 gap-2">
            @foreach($cocinero->dishes->take(2) as $dish)
                <img 
                    src="{{ asset('storage/' . $dish->image) }}" 
                    class="w-full h-20 object-cover rounded"
                    alt="{{ $dish->name }}"
                >
            @endforeach
        </div>
    </div>
</a>