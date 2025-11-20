<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController
{
    /**
     * Display a listing of all products.
     * GET /api/products
     */
    public function index()
    {
        try {
            $products = DB::select('SELECT * FROM products ORDER BY created_at DESC');
            
            return response()->json([
                'status' => 200,
                'message' => 'Products retrieved successfully',
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => 'Error retrieving products: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    /**
     * Display the specified product.
     * GET /api/products/{id}
     */
    public function show($id)
    {
        try {
            $product = DB::select('SELECT * FROM products WHERE id = ? LIMIT 1', [$id]);
            
            if (empty($product)) {
                return response()->json([
                    'status' => 100,
                    'message' => 'Product not found',
                    'data' => null
                ], 404);
            }
            
            return response()->json([
                'status' => 200,
                'message' => 'Product retrieved successfully',
                'data' => $product[0]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => 'Error retrieving product: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    /**
     * Store a newly created product.
     * POST /api/products
     */
    public function store(Request $request)
    {
        try {
            // Validation
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'description' => 'required|string',
                'url' => 'nullable|string|max:500'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 100,
                    'message' => 'Validation error',
                    'data' => $validator->errors()
                ], 422);
            }

            $name = $request->input('name');
            $price = $request->input('price');
            $description = $request->input('description');
            $url = $request->input('url');
            $now = now();

            DB::insert(
                'INSERT INTO products (name, price, description, url, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)',
                [$name, $price, $description, $url, $now, $now]
            );

            // Get the last inserted product
            $product = DB::select('SELECT * FROM products WHERE id = LAST_INSERT_ID() LIMIT 1');

            return response()->json([
                'status' => 200,
                'message' => 'Producto creado con éxito',
                'data' => $product[0] ?? null
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => 'Error creando producto: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    /**
     * Update the specified product.
     * PUT /api/products/{id}
     */
    public function update(Request $request, $id)
    {
        try {
            // Check if product exists
            $existingProduct = DB::select('SELECT * FROM products WHERE id = ? LIMIT 1', [$id]);
            
            if (empty($existingProduct)) {
                return response()->json([
                    'status' => 100,
                    'message' => 'Product not found',
                    'data' => null
                ], 404);
            }

            // Validation
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'description' => 'required|string',
                'url' => 'nullable|string|max:500'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 100,
                    'message' => 'Validation error',
                    'data' => $validator->errors()
                ], 422);
            }

            $name = $request->input('name');
            $price = $request->input('price');
            $description = $request->input('description');
            $url = $request->input('url');
            $now = now();

            DB::update(
                'UPDATE products SET name = ?, price = ?, description = ?, url = ?, updated_at = ? WHERE id = ?',
                [$name, $price, $description, $url, $now, $id]
            );

            // Get updated product
            $product = DB::select('SELECT * FROM products WHERE id = ? LIMIT 1', [$id]);

            return response()->json([
                'status' => 200,
                'message' => 'Producto actualizado exitosamente',
                'data' => $product[0]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => 'Error actualizando el producto: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    /**
     * Remove the specified product.
     * DELETE /api/products/{id}
     */
    public function destroy($id)
    {
        try {
            // Check if product exists
            $product = DB::select('SELECT * FROM products WHERE id = ? LIMIT 1', [$id]);
            
            if (empty($product)) {
                return response()->json([
                    'status' => 100,
                    'message' => 'Product not found',
                    'data' => null
                ], 404);
            }

            DB::delete('DELETE FROM products WHERE id = ?', [$id]);

            return response()->json([
                'status' => 200,
                'message' => 'Producto eliminado exitosamente',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 100,
                'message' => 'Error eliminando producto: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
}
