@extends('layouts.cocinero_app')

@section('title', 'Dashboard del Cocinero - TuApp')

@section('content')
<!-- Sección Hero  -->
<section class="bg-cover bg-center h-96 text-white flex items-center" style="background-image: url('{{ asset('images/cocina.png') }}');">
    <div class="container mx-auto text-center">
        <h1 class="text-5xl font-bold animate__animated animate__bounceInLeft">Bienvenido, {{ Auth::user()->name }}</h1>
        <p class="text-xl mt-4 animate__animated animate__bounceInLeft">Cada plato que creas es una obra de arte. ¡Sigue cocinando con pasión!</p>
        <button id="toggleFormButton" class="mt-6 inline-block bg-blue-500 text-white text-lg font-semibold py-3 px-6 rounded-lg hover:bg-[#FF8C7F] transition duration-300 animate__animated animate__bounce">
            Publicar Nuevo Plato
        </button>
    </div>
</section>

<!-- Contenido  -->
<div class="container mx-auto grid grid-cols-12 gap-6 mt-10">

    <!-- Columna Izquierda: Estadísticas -->
    <aside class="col-span-4 bg-white p-6 rounded-lg shadow border border-gray-200">
        <h2 class="text-2xl font-bold text-[#6B5B95] mb-4">Tus Estadísticas</h2>
        <ul class="space-y-4 text-gray-700">
            <li><strong>Platos publicados:</strong> {{ $dishes->count() }}</li>
            <li><strong>Plato más caro:</strong> ${{ number_format($dishes->max('price'), 2) }}</li>
            <li><strong>Plato más barato:</strong> ${{ number_format($dishes->min('price'), 2) }}</li>
            <li><strong>Precio medio:</strong> ${{ number_format($dishes->avg('price'), 2) }}</li>
            <li><strong>Rating promedio:</strong> {{ number_format($averageRating, 1) }} / 5</li>
            <li><strong>Comentarios recibidos:</strong> {{ $totalComments }}</li>
        </ul>
    </aside>

    <!-- Columna Derecha: Formulario y lista de platos -->
    <main class="col-span-8">

        
            <div id="formContainer" class="hidden bg-white p-6 rounded-lg shadow border border-gray-200 mb-6">
                <h2 class="text-3xl font-bold text-center text-[#6B5B95] mb-6">Publicar Nuevo Plato</h2>
                <form action="{{ route('dishes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="block text-gray-700 text-lg font-medium mb-1">Nombre del Plato</label>
                            <input type="text" name="name" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#FF6F61]" placeholder="Ej: Paella Valenciana" required>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-gray-700 text-lg font-medium mb-1">Descripción</label>
                            <textarea name="description" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#FF6F61]" rows="3" placeholder="Describe tu plato..." required></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-lg font-medium mb-1">Precio</label>
                            <input type="number" step="0.01" name="price" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#FF6F61]" placeholder="Ej: 12.50" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-lg font-medium mb-1">Imagen</label>
                            <input type="file" name="image" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#FF6F61]" required>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-gray-700 text-lg font-medium mb-2">Categorías del Plato</label>
                            
                            <!-- Clasificaciones basadas en la experiencia -->
                            <div class="mb-4">
                                <p class="font-semibold text-[#6B5B95] mb-2">🍽️ Clasificaciones basadas en la experiencia</p>
                                @foreach(['Cena Romántica', 'Comida Familiar Casera', 'Comida para Compartir con Amigos', 'Ideal para una Primera Cita', 'Para Sorprender a Alguien'] as $cat)
                                    <label class="block text-sm text-gray-600 mb-1">
                                        <input type="checkbox" name="tags[]" value="{{ $cat }}" class="mr-2">
                                        {{ $cat }}
                                    </label>
                                @endforeach
                            </div>
                        
                            <!-- Según el estado de ánimo -->
                            <div class="mb-4">
                                <p class="font-semibold text-[#6B5B95] mb-2">😌 Según el estado de ánimo</p>
                                @foreach(['Confort Food / Comida Reconfortante', 'Para un Día Lluvioso', 'Ligera y Refrescante', 'Para Recargar Energías', 'Para Consentirte'] as $cat)
                                    <label class="block text-sm text-gray-600 mb-1">
                                        <input type="checkbox" name="tags[]" value="{{ $cat }}" class="mr-2">
                                        {{ $cat }}
                                    </label>
                                @endforeach
                            </div>
                        
                            <!-- Según la ocasión -->
                            <div class="mb-4">
                                <p class="font-semibold text-[#6B5B95] mb-2">💼 Según la ocasión</p>
                                @foreach(['Comida para Llevar al Trabajo', 'Ideal para Picnics', 'Menú para Eventos Pequeños', 'Desayuno de Domingo', 'Cena Exprés entre Semana'] as $cat)
                                    <label class="block text-sm text-gray-600 mb-1">
                                        <input type="checkbox" name="tags[]" value="{{ $cat }}" class="mr-2">
                                        {{ $cat }}
                                    </label>
                                @endforeach
                            </div>
                        
                            <!-- Estilo de cocina o intención -->
                            <div class="mb-4">
                                <p class="font-semibold text-[#6B5B95] mb-2">💡 Estilo de cocina o intención</p>
                                @foreach(['Hecho con Amor', '100% Casero', 'De la Abuela', 'De Temporada', 'Cocina de Autor', 'Comida Tradicional Renovada'] as $cat)
                                    <label class="block text-sm text-gray-600 mb-1">
                                        <input type="checkbox" name="tags[]" value="{{ $cat }}" class="mr-2">
                                        {{ $cat }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="col-span-2">
                            <button type="submit" class="w-full bg-black text-white text-lg font-semibold py-2 rounded hover:bg-[#FF8C7F] transition duration-300">
                                Publicar Plato
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Lista de platos -->
            <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
                    <h2 class="text-2xl font-bold text-[#6B5B95] mb-4">Tus Platos</h2>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($dishes as $dish)
                            <div class="bg-[#F0F8FF] rounded-lg shadow hover:shadow-md transition duration-200 overflow-hidden">
                                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}"
                                    class="w-full h-40 object-cover">

                                <div class="p-4">
                                    <h3 class="text-lg font-bold text-[#6B5B95]">{{ $dish->name }}</h3>
                                    <p class="text-sm text-gray-600 line-clamp-2 mb-2">{{ $dish->description }}</p>
                                    <p class="text-[#FF6F61] font-bold text-lg">${{ number_format($dish->price, 2) }}</p>
                                    <div class="mt-4 flex justify-end items-center space-x-4">
                                        <a href="{{ route('dishes.edit', $dish->id) }}"
                                            class="group flex items-center space-x-1 text-gray-600 hover:text-blue-500 transition-all duration-200">
                                            <span
                                                class="text-sm font-medium opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 transition-all duration-200">Editar</span>
                                            <i class="fas fa-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('dishes.destroy', $dish->id) }}" method="POST" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="group flex items-center space-x-1 text-gray-600 hover:text-red-500 transition-all duration-200 delete-button">
                                                <span
                                                    class="text-sm font-medium opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 transition-all duration-200">Eliminar</span>
                                                <i class="fas fa-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
            </div>

            @if($ratings->count() > 0)
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-[#2D3748] mb-6">Reseñas de clientes</h2>
                <div class="space-y-6">
                    @foreach($ratings as $rating)
                    <div class="border-b pb-6 last:border-b-0 last:pb-0">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <div class="font-medium">{{ $rating->user->name }}</div>
                                <div class="flex ml-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $rating->rating)
                                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        @else
                                            <i class="far fa-star text-yellow-400 text-sm"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <span class="text-sm text-gray-500">{{ $rating->created_at->diffForHumans() }}</span>
                        </div>
                        @if($rating->comment)
                        <p class="text-gray-600 mt-2">{{ $rating->comment }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <p class="text-gray-600">Aún no hay reseñas para mostrar.</p>
            @endif

        </div>
        
    </main>

</div>


<script>
    document.getElementById('toggleFormButton').addEventListener('click', function() {
        var formContainer = document.getElementById('formContainer');
        formContainer.classList.toggle('hidden');
        if (!formContainer.classList.contains('hidden')) {
            formContainer.scrollIntoView({ behavior: 'smooth' });
        }
    });


    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const form = this.closest('.delete-form');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
