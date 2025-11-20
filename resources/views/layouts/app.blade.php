<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GOAPPY - E-commerce')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'goappy-primary': '#6366f1',
                        'goappy-secondary': '#8b5cf6',
                        'goappy-accent': '#ec4899',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-goappy-primary to-goappy-secondary rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-xl">G</span>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-goappy-primary to-goappy-secondary bg-clip-text text-transparent">
                            GOAPPY
                        </span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/" class="{{ request()->routeIs('store') ? 'text-goappy-primary font-bold bg-indigo-50' : 'text-gray-700 hover:text-goappy-primary' }} px-3 py-2 rounded-md text-sm font-medium transition">
                        Tienda
                    </a>
                    <a href="/admin/products" class="{{ request()->routeIs('admin.products') ? 'text-goappy-primary font-bold bg-indigo-50' : 'text-gray-700 hover:text-goappy-primary' }} px-3 py-2 rounded-md text-sm font-medium transition">
                        Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-goappy-primary to-goappy-secondary rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-xl">G</span>
                        </div>
                        <span class="text-2xl font-bold">GOAPPY</span>
                    </div>
                    <p class="text-gray-400">Tu tienda online de confianza</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Enlaces</h3>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-400 hover:text-white transition">Inicio</a></li>
                        <li><a href="/admin/products" class="text-gray-400 hover:text-white transition">Administración</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contacto</h3>
                    <p class="text-gray-400">Email: info@goappy.com</p>
                    <p class="text-gray-400">Tel: +1 234 567 890</p>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} GOAPPY. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
