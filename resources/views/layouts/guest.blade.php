<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MealMatch') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-image: url('/images/background.jpg'); /* Ajusta esta ruta */
            background-size: cover;
            background-position: center;
            z-index: -1;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 360px;
        }
    </style>
</head>

<body class="font-sans bg-[#FFF3E0] flex items-center justify-center min-h-screen">
    <div class="background-image"></div>

    <div class="form-container">
        <div class="text-center mb-6">
            <a href="{{ route('home') }}" class="text-3xl font-bold text-[#FF6F61] hover:underline">
                MEALMATCH
            </a>
            <p class="text-[#6B5B95]">Tu plataforma de comidas caseras</p>
        </div>

        {{ $slot }}
    </div>
</body>

</html>
