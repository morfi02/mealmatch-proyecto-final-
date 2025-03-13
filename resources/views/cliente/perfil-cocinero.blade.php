@extends('layouts.cliente_app')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Cabecera del Perfil -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <img 
                    src="{{ asset('storage/' . $cocinero->profile_photo_url) }}" 
                    class="w-32 h-32 rounded-full object-cover border-4 border-[#FF6F61]"
                    alt="{{ $cocinero->name }}"
                >
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-[#2D3748]">{{ $cocinero->name }}</h1>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="bg-[#6B5B95] text-white px-3 py-1 rounded-full text-sm">
                            {{ $cocinero->category }}
                        </span>
                        <div class="flex items-center">
                            ⭐ {{ $cocinero->rating }} ({{ $cocinero->reviews_count }} reseñas)
                        </div>
                    </div>
                    <p class="mt-4 text-gray-600">{{ $cocinero->bio }}</p>
                </div>
            </div>
        </div>

        <!-- Menú del Cocinero -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Listado de Platos -->
                <div class="lg:col-span-2">
                    <h2 class="text-2xl font-bold text-[#2D3748] mb-6">Menú Disponible</h2>
                    <div class="grid gap-6">
                        @foreach($cocinero->dishes as $dish)
                            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition">
                                <div class="flex gap-6">
                                    <img src="{{ asset('storage/' . $dish->image) }}" class="w-32 h-32 object-cover rounded-xl"
                                        alt="{{ $dish->name }}">
                                    <div class="flex-1">
                                        <h3 class="text-xl font-semibold text-[#2D3748]">{{ $dish->name }}</h3>
                                        <p class="text-gray-600 mt-2">{{ $dish->description }}</p>
                                        <div class="mt-4 flex justify-between items-center">
                                            <span class="text-2xl font-bold text-[#FF6F61]">${{ $dish->price }}</span>
                                            <button class="button" onclick="addToCart({{ json_encode($dish) }})">
                                                <span class="button__text">Añadir</span>
                                                <span class="button__icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke-linejoin="round" stroke-linecap="round"
                                                        stroke="currentColor" height="24" fill="none" class="svg">
                                                        <line y2="19" y1="5" x2="12" x1="12"></line>
                                                        <line y2="12" y1="12" x2="19" x1="5"></line>
                                                    </svg>
                                                </span>
                                            </button>
                                            <!-- estilo boton añadir -->
                                            <style>
                                                .button {
                                                    position: relative;
                                                    width: 150px;
                                                    height: 40px;
                                                    cursor: pointer;
                                                    display: flex;
                                                    align-items: center;
                                                    border: 1px solid #6B5B95;
                                                    background-color: #7F6DA7;
                                                    border-radius: 8px;
                                                    overflow: hidden;
                                                }

                                                .button,
                                                .button__icon,
                                                .button__text {
                                                    transition: all 0.3s;
                                                }

                                                .button .button__text {
                                                    transform: translateX(20px);
                                                    color: #fff;
                                                    font-weight: 600;
                                                }

                                                .button .button__icon {
                                                    position: absolute;
                                                    transform: translateX(109px);
                                                    height: 100%;
                                                    width: 39px;
                                                    background-color: #6B5B95;
                                                    display: flex;
                                                    align-items: center;
                                                    justify-content: center;
                                                    border-radius: 0 8px 8px 0;
                                                }

                                                .button .svg {
                                                    width: 24px;
                                                    stroke: #fff;
                                                }

                                                .button:hover {
                                                    background: #6B5B95;
                                                }

                                                .button:hover .button__text {
                                                    color: transparent;
                                                }

                                                .button:hover .button__icon {
                                                    width: 148px;
                                                    transform: translateX(0);
                                                }

                                                .button:active .button__icon {
                                                    background-color: #5A4A7F;
                                                }

                                                .button:active {
                                                    border: 1px solid #5A4A7F;
                                                }
                                            </style>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                    <div class="bg-white p-6 rounded-xl shadow-sm">
                        <h3 class="text-xl font-bold text-[#2D3748] mb-4">Detalles del Chef</h3>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3">
                                📍 Ubicación: <span class="font-medium">{{ $cocinero->location }}</span>
                            </li>
                            <li class="flex items-center gap-3">
                                🕒 Tiempo de entrega: <span class="font-medium">45-60 min</span>
                            </li>
                            <li class="flex items-center gap-3">
                                💬 Idiomas: <span class="font-medium">Español, Inglés</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection