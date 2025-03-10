<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-[#FF6F61]">Inicia sesión</h2>
        <p class="mt-2 text-[#6B5B95]">Accede a tu cuenta para continuar</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-6">
            <label class="block text-[#6B5B95] text-sm font-medium mb-2">Correo electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full px-4 py-2 border border-[#A2DDF0] rounded-lg focus:ring-2 focus:ring-[#FF6F61] focus:border-transparent"
                   required autofocus>
        </div>

        <div class="mb-6">
            <label class="block text-[#6B5B95] text-sm font-medium mb-2">Contraseña</label>
            <input type="password" name="password"
                   class="w-full px-4 py-2 border border-[#A2DDF0] rounded-lg focus:ring-2 focus:ring-[#FF6F61] focus:border-transparent"
                   required>
        </div>

        <button type="submit"
                class="w-full bg-[#FF6F61] text-white py-2 px-4 rounded-lg hover:bg-[#FF8C7F] transition duration-300">
            Ingresar
        </button>

        <div class="mt-6 text-center">
            <a href="{{ route('register') }}" class="text-[#6B5B95] hover:underline">¿No tienes cuenta? Regístrate</a>
        </div>
    </form>
</x-guest-layout>
