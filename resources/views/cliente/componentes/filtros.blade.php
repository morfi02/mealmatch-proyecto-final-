<!-- pruebas -->
<div class="max-w-7xl mx-auto mb-12 bg-white rounded-xl shadow-sm p-6">
    <div class="flex flex-col md:flex-row gap-4 items-center">
        <div class="flex-1 w-full">
            <input 
                type="text" 
                placeholder="Buscar por nombre o especialidad..."
                class="w-full px-4 py-3 border-2 border-[#A2DDF0] rounded-lg focus:ring-2 focus:ring-[#FF6F61]"
            >
        </div>

        <select class="w-full md:w-64 px-4 py-3 border-2 border-[#A2DDF0] rounded-lg">
            <option value="">Todas las categorías</option>
            <option>Mexicana</option>
            <option>Italiana</option>
            <option>Vegana</option>
        </select>

        <button class="w-full md:w-auto px-6 py-3 bg-[#FF6F61] text-white rounded-lg hover:bg-[#FF8C7F] transition">
            🔍 Buscar
        </button>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($cocineros as $cocinero)
                @include('cliente.componentes.chef-card', ['cocinero' => $cocinero])
            @endforeach
    </div>
</div>