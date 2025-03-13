<nav class="bg-white text-black">
    <div class="container mx-auto flex justify-between items-center py-3">
        <a  href="{{ route('cliente.dashboard') }}" class="text-xl font-bold">MealMatch</a>

        <div class="space-x-4 flex items-center">
            <a href="{{ route('cliente.dashboard') }}" class="hover:underline flex items-center text-sm bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Inicio</a>
            @auth
                

                <!-- Dropdown de Perfil -->
                <div x-data="{ open: false }" class="relative inline-block text-left">
                    <button @click="open = !open" class="bg-pink-100 hover:bg-pink-200 text-black font-semibold py-2 px-4 rounded inline-flex items-center">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="fill-current h-4 w-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M5.516 7.548l4.484 4.484 4.484-4.484L16 8.548l-6 6-6-6z"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-blue-50 ring-1 ring-black ring-opacity-5 z-50">
                        <div class="py-2">
                            <p class="px-4 text-sm text-gray-700">Nombre: {{ Auth::user()->name }}</p>
                            <p class="px-4 text-sm text-gray-700">Email: {{ Auth::user()->email }}</p>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100">Editar perfil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-100">Cerrar sesión</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="hover:underline">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="hover:underline">Registrarse</a>
            @endauth
        </div>
    </div>
</nav>
