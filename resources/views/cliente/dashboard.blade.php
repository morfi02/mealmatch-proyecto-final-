@extends('layouts.cliente_app')

@section('content')


<div class="min-h-screen bg-gray-50 p-8">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li>
                    <a href="{{ route('cliente.dashboard') }}" class="text-white/90 hover:text-white transition-colors">
                        Inicio
                    </a>
                </li>
                <li>
                    <span class="text-white/70">/</span>
                </li>
                <li class="text-[#FF6F61]" aria-current="page">
                    Explorar Cocineros
                </li>
            </ol>
        </nav>
        <div class="relative py-16 mb-8">
            <div class="absolute inset-0 overflow-hidden">
                <img src="{{ asset('images/header-bg.jpg') }}" class="w-full h-full object-cover" alt="Background">
                <div class="absolute inset-0 bg-black/80"></div>
            </div>

            <div class="relative py-16 mb-8">
                <div class="absolute inset-0 overflow-hidden">
                    <img src="{{ asset('images/header-bg.jpg') }}" class="w-full h-full object-cover" alt="Background">
                    <div class="absolute inset-0 bg-black/60"></div>
                </div>

                <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
                    <h1 class="text-5xl font-extrabold text-white mb-3 text-shadow-2xl drop-shadow-lg animate__animated animate__tada">
                        Descubre Chefs Talentosos
                    </h1>
                    <p class="text-xl text-white text-shadow-lg drop-shadow-md max-w-2xl mx-auto animate__animated animate__tada">
                        Encuentra tu experiencia culinaria perfecta
                    </p>
                </div>
            </div>


        </div>


        <style>
            .text-shadow {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            }

            .text-shadow-sm {
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            }
        </style>

        @include('cliente.componentes.filtros')

        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($cocineros as $cocinero)
                @include('cliente.componentes.chef-card', ['cocinero' => $cocinero])
            @endforeach
    </div>
@endsection
