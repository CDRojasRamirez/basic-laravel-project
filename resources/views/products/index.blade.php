@extends('layouts.app')

@section('title', 'GOAPPY - Tienda Online')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Hero Section -->
    <div class="text-center mb-12">
        <h1 class="text-5xl font-bold bg-gradient-to-r from-goappy-primary to-goappy-secondary bg-clip-text text-transparent mb-4">
            Bienvenido a GOAPPY
        </h1>
        <p class="text-xl text-gray-600">Descubre nuestros productos increíbles</p>
    </div>

    <!-- Loading State -->
    <div id="loading" class="text-center py-20">
        <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-goappy-primary"></div>
        <p class="mt-4 text-gray-600">Cargando productos...</p>
    </div>

    <!-- Products Grid -->
    <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 hidden">
        <!-- Products will be loaded here -->
    </div>

    <!-- Empty State -->
    <div id="empty-state" class="text-center py-20 hidden">
        <div class="text-6xl mb-4">🛍️</div>
        <h3 class="text-2xl font-semibold text-gray-700 mb-2">No hay productos disponibles</h3>
        <p class="text-gray-500 mb-6">Aún no hay productos en la tienda</p>
        <a href="/admin/products" class="inline-block bg-gradient-to-r from-goappy-primary to-goappy-secondary text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
            Agregar Productos
        </a>
    </div>
</div>

@push('scripts')
<script>
    const API_URL = '/api/products';

    // Load products on page load
    document.addEventListener('DOMContentLoaded', loadProducts);

    async function loadProducts() {
        try {
            const response = await fetch(API_URL);
            const result = await response.json();

            document.getElementById('loading').classList.add('hidden');

            if (result.status === 200 && result.data && result.data.length > 0) {
                displayProducts(result.data);
            } else {
                document.getElementById('empty-state').classList.remove('hidden');
            }
        } catch (error) {
            console.error('Error loading products:', error);
            document.getElementById('loading').classList.add('hidden');
            document.getElementById('empty-state').classList.remove('hidden');
        }
    }

    function displayProducts(products) {
        const grid = document.getElementById('products-grid');
        grid.innerHTML = '';
        grid.classList.remove('hidden');

        products.forEach(product => {
            const card = createProductCard(product);
            grid.appendChild(card);
        });
    }

    function createProductCard(product) {
        const div = document.createElement('div');
        div.className = 'bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2';
        
        const imageUrl = product.url || 'https://via.placeholder.com/400x300?text=No+Image';
        const price = parseFloat(product.price).toFixed(2);
        
        div.innerHTML = `
            <div class="aspect-w-16 aspect-h-12 bg-gray-200">
                <img src="${imageUrl}" alt="${product.name}" class="w-full h-48 object-cover" onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
            </div>
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2 line-clamp-1">${product.name}</h3>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">${product.description}</p>
                <div class="flex items-center justify-between">
                    <span class="text-2xl font-bold text-goappy-primary">$${price}</span>
                    <button class="bg-gradient-to-r from-goappy-primary to-goappy-secondary text-white px-4 py-2 rounded-lg font-semibold hover:shadow-lg transition">
                        Comprar
                    </button>
                </div>
            </div>
        `;
        
        return div;
    }
</script>
@endpush
@endsection
