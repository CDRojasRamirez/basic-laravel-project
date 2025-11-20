@extends('layouts.app')

@section('title', 'GOAPPY - Administración de Productos')

@section('content')
<div class="max-w-[95%] mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Administración de Productos</h1>
        <p class="text-gray-600">Gestiona tu catálogo de productos</p>
    </div>

    <!-- Success/Error Messages -->
    <div id="alert-container" class="mb-6"></div>

    <!-- Add Product Button -->
    <div class="mb-6">
        <button onclick="openModal()" class="bg-gradient-to-r from-goappy-primary to-goappy-secondary text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Agregar Producto
        </button>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Creado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actualizado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody id="products-table-body" class="bg-white divide-y divide-gray-200">
                    <tr id="loading-row">
                        <td colspan="8" class="px-6 py-12 text-center">
                            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-goappy-primary"></div>
                            <p class="mt-2 text-gray-600">Cargando productos...</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Add/Edit Product -->
<div id="product-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 id="modal-title" class="text-2xl font-bold text-gray-900">Agregar Producto</h2>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="product-form" onsubmit="saveProduct(event)">
                <input type="hidden" id="product-id">
                
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Producto *</label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-goappy-primary focus:border-transparent">
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Precio *</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-goappy-primary focus:border-transparent">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripción *</label>
                        <textarea id="description" name="description" rows="4" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-goappy-primary focus:border-transparent"></textarea>
                    </div>

                    <div>
                        <label for="url" class="block text-sm font-medium text-gray-700 mb-1">URL de Imagen</label>
                        <input type="url" id="url" name="url"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-goappy-primary focus:border-transparent"
                            placeholder="https://ejemplo.com/imagen.jpg">
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Cancelar
                    </button>
                    <button type="submit" class="px-6 py-2 bg-gradient-to-r from-goappy-primary to-goappy-secondary text-white rounded-lg font-semibold hover:shadow-lg transition">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Confirmation Modal for Delete -->
<div id="confirm-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-95" id="confirm-modal-content">
        <!-- Icon Header -->
        <div class="flex flex-col items-center pt-8 pb-4">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4 animate-pulse">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">¿Eliminar Producto?</h3>
            <p class="text-gray-600 text-center px-6">Esta acción no se puede deshacer. El producto será eliminado permanentemente.</p>
        </div>
        
        <!-- Product Info -->
        <div id="delete-product-info" class="mx-6 mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
            <p class="text-sm text-gray-700 font-medium" id="delete-product-name"></p>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex gap-3 px-6 pb-6">
            <button onclick="window.cancelDelete()" class="flex-1 px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                Cancelar
            </button>
            <button onclick="window.confirmDelete()" class="flex-1 px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg font-semibold hover:from-red-700 hover:to-red-800 hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                Sí, Eliminar
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const API_URL = '/api/products';
    let editingProductId = null;

    // Make functions globally accessible
    window.editProduct = editProduct;
    window.deleteProductConfirmed = deleteProductConfirmed;
    window.openModal = openModal;
    window.closeModal = closeModal;
    window.saveProduct = saveProduct;

    // Load products on page load
    document.addEventListener('DOMContentLoaded', loadProducts);

    async function loadProducts() {
        try {
            const response = await fetch(API_URL);
            const result = await response.json();

            const tbody = document.getElementById('products-table-body');
            tbody.innerHTML = '';

            if (result.status === 200 && result.data && result.data.length > 0) {
                result.data.forEach(product => {
                    tbody.appendChild(createProductRow(product));
                });
            } else {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                            No hay productos registrados. ¡Agrega tu primer producto!
                        </td>
                    </tr>
                `;
            }
        } catch (error) {
            console.error('Error loading products:', error);
            showAlert('Error al cargar productos', 'error');
        }
    }

    function createProductRow(product) {
        const tr = document.createElement('tr');
        tr.className = 'hover:bg-gray-50 transition';
        
        const imageUrl = product.url || 'https://via.placeholder.com/100';
        const price = parseFloat(product.price).toFixed(2);
        const escapedName = product.name.replace(/'/g, "\\'");
        
        // Format dates
        const createdDate = new Date(product.created_at).toLocaleString('es-ES', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit'
        });
        const updatedDate = new Date(product.updated_at).toLocaleString('es-ES', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit'
        });
        
        tr.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${product.id}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <img src="${imageUrl}" alt="${escapedName}" class="h-12 w-12 object-cover rounded" onerror="this.src='https://via.placeholder.com/100'">
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${product.name}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$${price}</td>
            <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">${product.description}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${createdDate}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${updatedDate}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                <button onclick="window.editProduct(${product.id})" class="text-goappy-primary hover:text-goappy-secondary transition" title="Editar">
                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </button>
                <button onclick="window.showDeleteConfirm(${product.id}, '${escapedName}')" class="text-red-600 hover:text-red-800 transition" title="Eliminar">
                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </td>
        `;
        
        return tr;
    }

    // Delete confirmation modal functions
    let productToDelete = null;

    function showDeleteConfirm(id, name) {
        productToDelete = id;
        document.getElementById('delete-product-name').textContent = `Producto: ${name}`;
        const modal = document.getElementById('confirm-modal');
        const content = document.getElementById('confirm-modal-content');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-95');
            content.classList.add('scale-100');
        }, 10);
    }

    function cancelDelete() {
        const modal = document.getElementById('confirm-modal');
        const content = document.getElementById('confirm-modal-content');
        content.classList.remove('scale-100');
        content.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            productToDelete = null;
        }, 200);
    }

    function confirmDelete() {
        if (productToDelete) {
            cancelDelete();
            deleteProductConfirmed(productToDelete);
        }
    }

    window.showDeleteConfirm = showDeleteConfirm;
    window.cancelDelete = cancelDelete;
    window.confirmDelete = confirmDelete;

    function openModal(product = null) {
        const modal = document.getElementById('product-modal');
        const form = document.getElementById('product-form');
        const title = document.getElementById('modal-title');

        if (product) {
            title.textContent = 'Editar Producto';
            document.getElementById('product-id').value = product.id;
            document.getElementById('name').value = product.name;
            document.getElementById('price').value = product.price;
            document.getElementById('description').value = product.description;
            document.getElementById('url').value = product.url || '';
            editingProductId = product.id;
        } else {
            title.textContent = 'Agregar Producto';
            form.reset();
            document.getElementById('product-id').value = '';
            editingProductId = null;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('product-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.getElementById('product-form').reset();
        editingProductId = null;
    }

    async function saveProduct(event) {
        event.preventDefault();

        const formData = {
            name: document.getElementById('name').value,
            price: parseFloat(document.getElementById('price').value),
            description: document.getElementById('description').value,
            url: document.getElementById('url').value || null
        };

        try {
            const url = editingProductId ? `${API_URL}/${editingProductId}` : API_URL;
            const method = editingProductId ? 'PUT' : 'POST';

            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            });

            const result = await response.json();

            if (result.status === 200) {
                showAlert(result.message, 'success');
                closeModal();
                loadProducts();
            } else {
                showAlert(result.message, 'error');
            }
        } catch (error) {
            console.error('Error saving product:', error);
            showAlert('Error al guardar el producto', 'error');
        }
    }

    async function editProduct(id) {
        try {
            const response = await fetch(`${API_URL}/${id}`);
            const result = await response.json();

            if (result.status === 200) {
                openModal(result.data);
            } else {
                showAlert('Error al cargar el producto', 'error');
            }
        } catch (error) {
            console.error('Error loading product:', error);
            showAlert('Error al cargar el producto', 'error');
        }
    }

    async function deleteProductConfirmed(id) {
        try {
            const response = await fetch(`${API_URL}/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const result = await response.json();

            if (result.status === 200) {
                showAlert(result.message, 'success');
                loadProducts();
            } else {
                showAlert(result.message, 'error');
            }
        } catch (error) {
            console.error('Error deleting product:', error);
            showAlert('Error al eliminar el producto', 'error');
        }
    }

    function showAlert(message, type = 'success') {
        const container = document.getElementById('alert-container');
        const bgColor = type === 'success' ? 'bg-green-100 border-green-500 text-green-700' : 'bg-red-100 border-red-500 text-red-700';
        
        container.innerHTML = `
            <div class="${bgColor} border-l-4 p-4 rounded">
                <p class="font-medium">${message}</p>
            </div>
        `;

        setTimeout(() => {
            container.innerHTML = '';
        }, 5000);
    }
</script>
@endpush
@endsection
