@extends('layouts.cocinero_app')

@section('content')
<div class="relative min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('images/fondo.jpg') }}');">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg bg-opacity-90 backdrop-blur-md">
        <h2 class="text-3xl font-bold text-center text-[#6B5B95] mb-6">Editar Plato</h2>
        
        <form action="{{ route('dishes.update', $dish->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 text-lg font-medium mb-1">Nombre del Plato</label>
                    <input type="text" name="name" value="{{ $dish->name }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#FF6F61]" required>
                </div>
                
                <div>
                    <label class="block text-gray-700 text-lg font-medium mb-1">Descripción</label>
                    <textarea name="description" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#FF6F61]" rows="3" required>{{ $dish->description }}</textarea>
                </div>
                
                <div>
                    <label class="block text-gray-700 text-lg font-medium mb-1">Precio</label>
                    <input type="number" step="0.01" name="price" value="{{ $dish->price }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#FF6F61]" required>
                </div>
                
                <div>
                    <label class="block text-gray-700 text-lg font-medium mb-1">Nueva Imagen (opcional)</label>
                    <input type="file" name="image" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#FF6F61]">
                </div>
                
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('cocinero.dashboard') }}" class="px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancelar</a>
                    <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Guardar Cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
