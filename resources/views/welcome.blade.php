@extends('layouts.app')

@section('title', 'MealMatch - Comida Casera')

@section('content')
    <!-- Sección Hero -->
    <section class="bg-cover bg-center h-screen text-white flex items-center"
        style="background-image: url('/images/hero-bg.jpg');">
        <div class="container mx-auto text-center">
            <h1 class="text-5xl font-bold animate__animated animate__bounce"">Comida casera al alcance de un clic</h1>
            <p class="text-xl mt-4">Encuentra cocineros locales que preparan deliciosos platillos para ti.</p>
            <a href="{{ route('login') }}"
                class="mt-6 inline-block bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600">Ver Cocineros</a>
        </div>
    </section>


    <section class="text-center my-12">
        <h3 class="text-2xl font-semibold text-gray-800">Únete a nuestra comunidad culinaria</h3>
        <p class="text-gray-600">
            Ya sea que quieras disfrutar de deliciosas comidas o compartir tus creaciones, tenemos algo para ti.
        </p>
    </section>



    <!-- Opciones -->
    <div class="flex justify-center space-x-8 my-12">
        <div class="bg-green-700 text-white p-8 rounded-lg w-1/3 text-center shadow-md">
            <h4 class="text-2xl font-bold">Para Amantes de la Cocina</h4>
            <p class="mt-2">Descubre sabores únicos y apoya a cocineros locales.</p>
            <a href="{{ route('register') }}"
                class="inline-block mt-4 bg-white text-green-700 px-4 py-2 rounded-md hover:bg-gray-100">
                Explorar Menús
            </a>
        </div>

        <div class="bg-pink-700 text-white p-8 rounded-lg w-1/3 text-center shadow-md">
            <h4 class="text-2xl font-bold">Para Cocineros Apasionados</h4>
            <p class="mt-2">Comparte tu talento y gana cocinando lo que amas y aprecias.</p>
            <a href="mailto:morfijorge489@gmail.com?subject=Interés en tener un perfil&body=Hola, quiero tener un perfil en tu sitio."
                class="inline-block mt-4 bg-white text-pink-700 px-4 py-2 rounded-md hover:bg-gray-100">
                Empezar a Cocinar
            </a>
        </div>

    </div>

@endsection