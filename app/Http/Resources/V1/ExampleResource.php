<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * ExampleResource
 * 
 * API Resource para transformar los datos de forma consistente.
 * Esto permite controlar exactamente qué datos se exponen en la API.
 */
class ExampleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource['id'],
            'title' => $this->resource['title'],
            'description' => $this->resource['description'],
            'status' => $this->resource['status'],
            'is_active' => $this->resource['status'] === 'active',
            'created_at' => $this->resource['created_at'],
            'links' => [
                'self' => route('api.v1.examples.show', ['id' => $this->resource['id']]),
            ],
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        return [
            'meta' => [
                'version' => 'v1',
                'timestamp' => now()->toIso8601String(),
            ],
        ];
    }
}
