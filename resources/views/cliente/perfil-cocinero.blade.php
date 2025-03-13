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
                <!-- Estilos para el botón de eliminar  -->
                <style>
                    .delete-btn {
                        padding: 2px;
                        border-radius: 50%;
                        transition: all 0.2s;
                    }

                    .delete-btn:hover {
                        background-color: #fee2e2;
                    }

                    .cart-item td {
                        padding: 12px 8px;
                        vertical-align: middle;
                    }

                    .cart-item:hover {
                        background-color: #f8fafc;
                    }
                </style>
                
                <!-- Sidebar de Información -->
                <div class="relative">
                    <div class=" lg:grid-cols-3 gap-8 ">

                        <div class="receipt bg-white p-6 rounded-xl shadow-sm sticky top-8">
                            <p class="shop-name">{{ $cocinero->name }}</p>
                            <p class="info">
                                {{ $cocinero->location }}<br />
                                Fecha: {{ now()->format('d/m/Y') }}<br />
                                Hora: {{ now()->format('H:i') }}
                            </p>

                            <table id="cart-items">
                                <thead>
                                    <tr>
                                        <th>Plato</th>
                                        <th>Cant.</th>
                                        <th>Precio</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                            <div class="total">
                                <p>Total:</p>
                                <p id="cart-total">$0.00</p>
                            </div>

                            <button
                                class="w-full bg-[#FF6F61] text-black px-6 py-2 rounded-lg hover:bg-[#FF7F71] transition mt-4"
                                onclick="confirmOrder()">
                                Confirmar Pedido
                            </button>
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
                <style>
                    /* estilo ticket */
                .receipt {
                width: 250px;
                background: white;
                border: 2px dashed #ccc;
                padding: 15px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                font-family: 'Courier New', Courier, monospace;
                }

                .shop-name {
                font-size: 1.2rem;
                font-weight: bold;
                text-align: center;
                margin-bottom: 10px;
                color: #2D3748;
                text-transform: uppercase;
                }

                .info {
                text-align: center;
                font-size: 0.85rem;
                margin-bottom: 15px;
                color: #4A5568;
                line-height: 1.5;
                }

                .receipt table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 15px;
                font-size: 0.85rem;
                }

                .receipt table th,
                .receipt table td {
                padding: 4px;
                text-align: left;
                border-bottom: 1px solid #eee;
                }

                .receipt table th {
                background-color: #f7fafc;
                font-weight: 600;
                }

                .total {
                display: flex;
                justify-content: space-between;
                font-size: 1rem;
                font-weight: bold;
                margin-bottom: 15px;
                padding-top: 10px;
                border-top: 2px dashed #ccc;
                }

                .barcode {
                display: flex;
                justify-content: center;
                margin-top: 15px;
                }

                .thanks {
                font-size: 0.85rem;
                text-align: center;
                margin-top: 10px;
                color: #718096;
                font-style: italic;
                }

                </style>
            </div>
    </div>
</div>

@endsection