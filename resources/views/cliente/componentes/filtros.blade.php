<form action="{{ route('buscar.cocineros') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center">
    <div class="flex-1 w-full">
        <input 
            type="text" 
            name="search"
            value="{{ request('search') }}"
            placeholder="Buscar por nombre o especialidad..."
            class="w-full px-4 py-3 border-2 border-[#A2DDF0] rounded-lg focus:ring-2 focus:ring-[#FF6F61]"
        >
    </div>

    <select name="categoria" class="w-full md:w-64 px-4 py-3 border-2 border-[#A2DDF0] rounded-lg">
        <option value="">Todas las categorías</option>
        <option value="Mexicana" {{ request('categoria') == 'Mexicana' ? 'selected' : '' }}>Mexicana</option>
        <option value="Italiana" {{ request('categoria') == 'Italiana' ? 'selected' : '' }}>Italiana</option>
        <option value="Vegana" {{ request('categoria') == 'Vegana' ? 'selected' : '' }}>Vegana</option>
    </select>

    <button type="submit" class="w-full md:w-auto px-6 py-3 bg-[#FF6F61] text-white rounded-lg hover:bg-[#FF8C7F] transition">
        🔍 Buscar
    </button>
</form>
