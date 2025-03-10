<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MealMatch - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
   
</head>

<body style="background-color: #FFF3E0;">


    <!-- Navegación -->
    @include('layouts.cocinero_navigation')

    <!-- Contenido Principal -->
    <main class="mt-0">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow py-4 text-center mt-0">
        <p class="text-gray-600">&copy; 2025 MealMatch. Todos los derechos reservados.</p>
    </footer>
</body>

</html>