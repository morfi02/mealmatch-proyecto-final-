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
                            @php
                                $avgRating = $cocinero->ratingsReceived()->avg('rating') ?? 0;
                                $ratingCount = $cocinero->ratingsReceived()->count();
                            @endphp
                            <div class="star-display flex">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($avgRating))
                                        <i class="fas fa-star text-yellow-400"></i>
                                    @elseif($i == ceil($avgRating) && ($avgRating - floor($avgRating) > 0))
                                        <i class="fas fa-star-half-alt text-yellow-400"></i>
                                    @else
                                        <i class="far fa-star text-yellow-400"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="ml-1">({{ number_format($avgRating, 1) }}) {{ $ratingCount }} reseñas</span>
                        </div>
                    </div>
                    <p class="mt-4 text-gray-600">{{ $cocinero->bio }}</p>
                </div>
            </div>
        </div>

        <!-- Sección de Valoración -->
        @auth
        @if(auth()->user()->rol === 'cliente' && !auth()->user()->hasRated($cocinero->id))
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-[#2D3748] mb-4">Deja tu valoración</h2>
            <form action="{{ route('rate.chef') }}" method="POST">
                @csrf
                <input type="hidden" name="seller_id" value="{{ $cocinero->id }}">
                
                <div class="star-rating mb-4">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="far fa-star cursor-pointer text-2xl" data-rating="{{ $i }}"></i>
                    @endfor
                    <input type="hidden" name="rating" id="selected-rating" value="0" required>
                </div>
                
                <div class="mb-4">
                    <textarea name="comment" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FF6F61]" placeholder="Comentario (opcional)"></textarea>
                </div>
                
                <button type="submit" class="bg-[#6B5B95] text-black px-4 py-2 rounded-lg hover:bg-[#7F6DA7] transition">
                    Enviar Valoración
                </button>
            </form>
        </div>
        @endif
        @endauth
       

        {{-- seccion de pedidos antiguos --}}
        @if($order)
        <div class="bg-white p-6 rounded-xl shadow-sm mt-6">
            <h3 class="text-xl font-bold text-[#2D3748] mb-4">Último pedido</h3>
            <div class="bg-gray-50 p-4 rounded-lg shadow hover:shadow-md transition">
                <h4 class="text-lg font-bold text-[#2D3748] mb-4">Detalles del Pedido</h4>
                @if(is_array($order->items) && count($order->items) > 0)
                <ul class="space-y-2">
                    @foreach($order->items as $item)
                    <li class="flex justify-between text-sm text-gray-600">
                        <span>{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                        <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                    </li>
                    @endforeach
                </ul>
                <p class="text-lg font-bold text-[#FF6F61] mt-4">
                    Total: ${{ number_format(collect($order->items)->sum(fn($item) => $item['price'] * $item['quantity']), 2) }}
                </p>
                @else
                <p class="text-gray-500">No hay detalles del pedido disponibles.</p>
                @endif
            </div>
            <div class="mt-6 flex justify-end">
                <button class="bg-[#FF6F61] text-white px-4 py-2 rounded-lg hover:bg-[#FF8C7F] transition" onclick="repeatOrder()">
                    Repetir Pedido
                </button>
            </div>
        </div>
        @endif
        {{-- estilo de pedidos antiguos --}}
        <style>
            .grid {
                display: grid;
                gap: 1.5rem;
            }
            .grid-cols-1 {
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }
            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
            .lg\:grid-cols-3 {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
            .rounded-lg {
                border-radius: 0.5rem;
            }
            .shadow {
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            }
            .hover\:shadow-md:hover {
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            .transition {
                transition: all 0.2s ease-in-out;
            }
            .text-[#FF6F61] {
                color: #FF6F61;
            }
            .bg-gray-50 {
                background-color: #F9FAFB;
            }
        </style>

        

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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Sidebar de Información -->
            <div class="relative">
                <div class="lg:grid-cols-3 gap-8">
                    <!-- Carrito de Compras -->
                    <div class="receipt bg-white p-6 rounded-xl shadow-sm sticky top-8 animate__animated animate__zoomIn">
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

                    <!-- Información del Chef -->
                    <div class="bg-white p-6 rounded-xl shadow-sm mt-6">
                        <h3 class="text-xl font-bold text-[#2D3748] mb-4">Detalles del Chef</h3>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3">
                                🕒 Tiempo de entrega: <span class="font-medium">45-60 min</span>
                            </li>
                            <li class="flex items-center gap-3">
                                ⭐ Valoración promedio: <span class="font-medium">{{ number_format($avgRating, 1) }}/5</span>
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
</div>

<!-- Sección de Valoración -->
@auth
@if(auth()->user()->rol === 'cliente' && !auth()->user()->hasRated($cocinero->id))
<div class="bg-white rounded-xl shadow-lg p-8 mb-8">
    <h2 class="text-2xl font-bold text-[#2D3748] mb-4">Deja tu valoración</h2>
    <form action="{{ route('rate.chef') }}" method="POST">
        @csrf
        <input type="hidden" name="seller_id" value="{{ $cocinero->id }}">
        
        <div class="star-rating mb-4">
            @for($i = 1; $i <= 5; $i++)
                <i class="far fa-star cursor-pointer text-2xl" data-rating="{{ $i }}"></i>
            @endfor
            <input type="hidden" name="rating" id="selected-rating" value="0" required>
        </div>
        
        <div class="mb-4">
            <textarea name="comment" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FF6F61]" placeholder="Comentario (opcional)"></textarea>
        </div>
        
        <button type="submit" class="bg-[#6B5B95] text-black px-4 py-2 rounded-lg hover:bg-[#7F6DA7] transition">
            Enviar Valoración
        </button>
    </form>
</div>
@endif
@endauth

<!-- Listado de Valoraciones -->
@if($cocinero->ratingsReceived->count() > 0)
<div class="bg-white rounded-xl shadow-lg p-8 mb-8">
    <h2 class="text-2xl font-bold text-[#2D3748] mb-6">Reseñas de clientes</h2>
    <div class="space-y-6">
        @foreach($cocinero->ratingsReceived()->with('user')->latest()->take(5)->get() as $rating)
        <div class="border-b pb-6 last:border-b-0 last:pb-0">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center">
                    <div class="font-medium">{{ $rating->user->name }}</div>
                    <div class="flex ml-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $rating->rating))
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
@endif

<!-- Script para el sistema de valoración -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sistema de selección de estrellas
        const stars = document.querySelectorAll('.star-rating i');
        const ratingInput = document.getElementById('selected-rating');
        
        if (stars.length > 0) {
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.getAttribute('data-rating');
                    ratingInput.value = rating;
                    
                    // Actualizar visualización
                    stars.forEach((s, index) => {
                        if (index < rating) {
                            s.classList.add('fas');
                            s.classList.remove('far');
                        } else {
                            s.classList.add('far');
                            s.classList.remove('fas');
                        }
                    });
                });
                
                // Efecto hover
                star.addEventListener('mouseover', function() {
                    const hoverRating = this.getAttribute('data-rating');
                    stars.forEach((s, index) => {
                        if (index < hoverRating) {
                            s.classList.add('text-yellow-300');
                        } else {
                            s.classList.remove('text-yellow-300');
                        }
                    });
                });
                
                star.addEventListener('mouseout', function() {
                    const currentRating = ratingInput.value;
                    stars.forEach((s, index) => {
                        s.classList.remove('text-yellow-300');
                        if (index < currentRating) {
                            s.classList.add('fas');
                            s.classList.remove('far');
                        } else {
                            s.classList.add('far');
                            s.classList.remove('fas');
                        }
                    });
                });
            });
        }
    });

    // Script del carrito 
    let cart = [];
    let total = 0;

    function addToCart(dish) {
        const existingItem = cart.find(item => item.id === dish.id);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                ...dish,
                quantity: 1,
                key: Date.now() + Math.random()
            });
        }

        total += parseFloat(dish.price);
        updateCartUI();
    }

    function removeFromCart(itemKey) {
        const itemIndex = cart.findIndex(item => item.key === itemKey);
        if (itemIndex === -1) return;

        const item = cart[itemIndex];
        total -= item.price * item.quantity;

        cart.splice(itemIndex, 1);
        updateCartUI();
    }

    function updateCartUI() {
        const cartBody = document.getElementById('cart-items').getElementsByTagName('tbody')[0];
        cartBody.innerHTML = '';

        cart.forEach(item => {
            const row = document.createElement('tr');
            row.className = 'cart-item';
            row.innerHTML = `
                    <td class="font-medium">${item.name}</td>
                    <td>${item.quantity}</td>
                    <td>$${(item.price * item.quantity).toFixed(2)}</td>
                    <td class="text-right">
                        <button 
                            class="delete-btn text-red-500 hover:text-red-700 transition"
                            onclick="removeFromCart(${item.key})"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </td>
                `;
            cartBody.appendChild(row);
        });

        document.getElementById('cart-total').textContent = `$${total.toFixed(2)}`;
    }

    function confirmOrder() {
    if (cart.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: '¡Carrito vacío!',
            text: 'Añade platos a tu pedido antes de confirmar.',
        });
        return;
    }

    // Mostrar formulario de dirección y pago con la animación
    Swal.fire({
        title: 'Detalles de envío y pago',
        html: `
            <div class="transaction-container">
                <div class="left-side">
                    <div class="card">
                        <div class="card-line"></div>
                        <div class="buttons"></div>
                    </div>
                    <div class="post">
                        <div class="post-line"></div>
                        <div class="screen">
                            <div class="dollar">$</div>
                        </div>
                        <div class="numbers"></div>
                        <div class="numbers-line2"></div>
                    </div>
                </div>
                <div class="right-side">
                    <div class="new">Nuevo Pago</div>
                    <svg viewBox="0 0 451.846 451.847" height="512" width="512" xmlns="http://www.w3.org/2000/svg" class="arrow">
                        <path fill="#cfcfcf" d="M345.441 248.292L151.154 442.573c-12.359 12.365-32.397 12.365-44.75 0-12.354-12.354-12.354-32.391 0-44.744L278.318 225.92 106.409 54.017c-12.354-12.359-12.354-32.394 0-44.748 12.354-12.359 32.391-12.359 44.75 0l194.287 194.284c6.177 6.18 9.262 14.271 9.262 22.366 0 8.099-3.091 16.196-9.267 22.373z"></path>
                    </svg>
                </div>
            </div>
            <form id="checkout-form" class="text-left mt-6">
                <h3 class="font-bold text-lg mb-3">Dirección de entrega</h3>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Calle y número</label>
                    <input type="text" id="street" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Piso/Puerta</label>
                        <input type="text" id="floor" class="w-full px-3 py-2 border rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Código Postal</label>
                        <input type="text" id="postal_code" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Instrucciones adicionales</label>
                    <textarea id="instructions" class="w-full px-3 py-2 border rounded-md" rows="2"></textarea>
                </div>
                
                <h3 class="font-bold text-lg mb-3">Información de pago</h3>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Número de tarjeta</label>
                    <input type="text" id="card_number" class="w-full px-3 py-2 border rounded-md" 
                           placeholder="0000 0000 0000 0000" required>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de expiración</label>
                        <input type="text" id="expiry" class="w-full px-3 py-2 border rounded-md" 
                               placeholder="MM/AA" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                        <input type="text" id="cvv" class="w-full px-3 py-2 border rounded-md" 
                               placeholder="123" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre en la tarjeta</label>
                    <input type="text" id="card_name" class="w-full px-3 py-2 border rounded-md" required>
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: 'Completar pedido',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#FF6F61',
        focusConfirm: false,
        didOpen: () => {
            
            const container = document.querySelector('.transaction-container');
            if (container) {
                
                container.classList.add('animate');
                
                
                setTimeout(() => {
                    container.dispatchEvent(new MouseEvent('mouseenter'));
                    
                    
                    setTimeout(() => {
                        container.dispatchEvent(new MouseEvent('mouseleave'));
                    }, 2000);
                }, 500);
            }
        },
        preConfirm: () => {
            // Validate form
            const form = document.getElementById('checkout-form');
            const requiredInputs = form.querySelectorAll('[required]');
            let isValid = true;

            requiredInputs.forEach(input => {
                if (!input.value) {
                    isValid = false;
                    input.classList.add('border-red-500');
                    input.classList.remove('border-green-500'); 
                } else {
                    input.classList.remove('border-red-500');
                    input.classList.add('border-green-500'); 
                }
            });

            if (!isValid) {
                Swal.showValidationMessage('Por favor, complete todos los campos requeridos');
                return false;
            }
                            
                // Recopilar datos del formulario
                return {
                    address: {
                        street: document.getElementById('street').value,
                        floor: document.getElementById('floor').value,
                        postal_code: document.getElementById('postal_code').value,
                        instructions: document.getElementById('instructions').value
                    },
                    payment: {
                        card_number: document.getElementById('card_number').value,
                        expiry: document.getElementById('expiry').value,
                        cvv: document.getElementById('cvv').value,
                        name: document.getElementById('card_name').value
                    }
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar el pedido con los datos de dirección y pago
                const orderData = {
                    cocinero_id: {{ $cocinero->id }},
                    items: cart,
                    address: result.value.address,
                    payment_info: result.value.payment
                };
                
                // Mostrar pantalla de carga
                Swal.fire({
                    title: 'Procesando pedido...',
                    text: 'Por favor espere mientras procesamos su pedido',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Enviar pedido al servidor
                fetch('{{ route("order.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify(orderData),
                })
                .then(response => response.json())
                .then(data => {
                    // Mostrar confirmación
                    Swal.fire({
                        icon: 'success',
                        title: '¡Pedido realizado con éxito!',
                        text: 'Recibirás un correo electrónico con los detalles de tu pedido.',
                        confirmButtonColor: '#FF6F61'
                    });
                    
                    // Vaciar carrito
                    cart = [];
                    total = 0;
                    updateCartUI();
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al procesar el pedido',
                        text: 'Por favor, intente nuevamente más tarde.',
                        confirmButtonColor: '#FF6F61'
                    });
                });
            }
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
        // Formateo automático del número de tarjeta (separación cada 4 dígitos)
        document.body.addEventListener('input', function(e) {
            if (e.target && e.target.id === 'card_number') {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 16) value = value.slice(0, 16);
                
                // Formatear con espacios cada 4 dígitos
                const formatted = [];
                for (let i = 0; i < value.length; i += 4) {
                    formatted.push(value.slice(i, i + 4));
                }
                e.target.value = formatted.join(' ');
            }
            
            // Formateo de fecha de expiración (MM/AA)
            if (e.target && e.target.id === 'expiry') {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 4) value = value.slice(0, 4);
                
                if (value.length > 2) {
                    e.target.value = value.slice(0, 2) + '/' + value.slice(2);
                } else {
                    e.target.value = value;
                }
            }
            
            // Limitar CVV a 3-4 dígitos
            if (e.target && e.target.id === 'cvv') {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 4) value = value.slice(0, 4);
                e.target.value = value;
            }
        });
    });
</script>

<!-- Estilos adicionales -->
<style>
    .star-rating {
        color: #e2e8f0; /
    }
    .star-rating i {
        transition: all 0.2s;
        margin-right: 4px;
    }
    .star-rating i:hover {
        transform: scale(1.2);
    }
    .star-display i {
        margin-right: 2px;
    }
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
    .receipt {
        position: sticky;
        top: 20px; /* Distancia desde la parte superior de la ventana */
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

    .swal2-popup {
        width: 40em !important;
        max-width: 95% !important;
    }
    
    /* Estilos para campos con validación fallida */
    .border-red-500 {
        border-color: #ef4444 !important;
    }
    
    /* Mejoras para campos de formulario */
    input.border, textarea.border {
        transition: all 0.3s ease;
    }
    
    input.border:focus, textarea.border:focus {
        border-color: #FF6F61;
        outline: none;
        box-shadow: 0 0 0 3px rgba(255, 111, 97, 0.2);
    }
    
    /* Mejoras de accesibilidad */
    label {
        cursor: pointer;
    }
    
    /* Estilos para mensajes de validación */
    .swal2-validation-message {
        background-color: #fef2f2 !important;
        color: #ef4444 !important;
        border-radius: 6px !important;
        padding: 10px 15px !important;
    }
</style>


@endsection