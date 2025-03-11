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
    @include('layouts.navigation')

    <!-- Contenido Principal -->
    <main class="mt-0">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer style="background-color: #222; color: white; padding: 40px 20px; font-size: 14px;">
        <div style="max-width: 1200px; margin: auto; display: flex; flex-wrap: wrap; justify-content: space-between;">
            <!-- Sección Sobre Nosotros -->
            <div style="flex: 1; min-width: 250px; margin-bottom: 20px;">
                <h3>Sobre Nosotros</h3>
                <p>Somos una empresa dedicada a ofrecer productos y servicios de alta calidad, comprometidos con la satisfacción de nuestros clientes.</p>
                <p>Dirección: Calle Ejemplo 123, Ciudad, País</p>
                <p>Teléfono: +123 456 789</p>
                <p>Email: contacto@empresa.com</p>
            </div>
            
            <!-- Sección Enlaces Rápidos -->
            <div style="flex: 1; min-width: 200px; margin-bottom: 20px;">
                <h3>Enlaces Rápidos</h3>
                <ul style="list-style: none; padding: 0;">
                    <li><a href="#" style="color: white; text-decoration: none;">Inicio</a></li>
                    <li><a href="#" style="color: white; text-decoration: none;">Productos</a></li>
                    <li><a href="#" style="color: white; text-decoration: none;">Servicios</a></li>
                    <li><a href="#" style="color: white; text-decoration: none;">Blog</a></li>
                    <li><a href="#" style="color: white; text-decoration: none;">Contacto</a></li>
                </ul>
            </div>
            
            <!-- Sección Redes Sociales -->
            <div style="flex: 1; min-width: 200px; margin-bottom: 20px;">
                <h3>Síguenos</h3>
                <p>Conéctate con nosotros en redes sociales:</p>
                <p>
                    <a href="#" style="color: white; text-decoration: none; margin-right: 10px;">Facebook</a>
                    <a href="#" style="color: white; text-decoration: none; margin-right: 10px;">Twitter</a>
                    <a href="#" style="color: white; text-decoration: none; margin-right: 10px;">Instagram</a>
                    <a href="#" style="color: white; text-decoration: none;">LinkedIn</a>
                </p>
            </div>
            
            <!-- Sección Newsletter -->
            <div style="flex: 1; min-width: 250px; margin-bottom: 20px;">
                <h3>Suscríbete</h3>
                <p>Recibe las últimas novedades y ofertas especiales directamente en tu correo electrónico.</p>
                <input type="email" placeholder="Tu correo electrónico" style="padding: 8px; width: 80%; margin-bottom: 10px;">
                <button style="padding: 8px 12px; background-color: #f04; color: white; border: none; cursor: pointer;">Suscribirse</button>
            </div>
        </div>
        <hr style="margin: 20px 0; border-color: #555;">
        <p style="text-align: center;">&copy; 2025 Empresa. Todos los derechos reservados.</p>
    </footer>

</body>

</html>