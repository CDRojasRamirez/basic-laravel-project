# GOAPPY E-commerce - Prueba Técnica Full Stack

![GOAPPY Logo](https://via.placeholder.com/150x50?text=GOAPPY)

## 📋 Descripción

Aplicación e-commerce completa desarrollada con Laravel, implementando un CRUD de productos con API REST (usando queries SQL directas) y una interfaz moderna con Blade + TailwindCSS.

## ✨ Características

### Backend (API REST)
- ✅ CRUD completo de productos usando **solo queries SQL** (sin Models)
- ✅ Endpoints RESTful con respuestas JSON estandarizadas (status 200/100)
- ✅ Validación de datos en todas las operaciones
- ✅ Base de datos MySQL con tabla `products`

### Frontend (Blade + TailwindCSS)
- ✅ Tienda online (e-commerce) con grid de productos
- ✅ Panel de administración completo
- ✅ Formulario para crear/editar productos
- ✅ Tabla de productos con acciones (editar/eliminar)
- ✅ Actualización automática sin recargar página
- ✅ Diseño moderno y responsive
- ✅ Feedback visual (loading, success, error)

## 🚀 Instalación

### Requisitos Previos
- PHP 8.3+
- MySQL
- Composer
- Node.js y NPM
- Laragon (recomendado)

### Pasos de Instalación

1. **Clonar el repositorio**
```bash
git clone <repository-url>
cd PRUEBA-TECNICA-GOAPPY
```

2. **Instalar dependencias de PHP**
```bash
composer install
```

3. **Instalar dependencias de Node**
```bash
npm install
```

4. **Configurar variables de entorno**

Copia el archivo `.env.example` a `.env` y configura la base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=laravel_products_data
DB_USERNAME=root
DB_PASSWORD=
```

5. **Generar key de aplicación**
```bash
C:\laragon\bin\php\php-8.3.26-Win32-vs16-x64\php.exe artisan key:generate
```

6. **Crear base de datos**

Opción A - Automático (Laragon):
La base de datos se creará automáticamente al ejecutar las migraciones.

Opción B - Manual:
- Abre phpMyAdmin (http://localhost/phpmyadmin)
- Crea una base de datos llamada: `laravel_products_data`

7. **Ejecutar migraciones**
```bash
C:\laragon\bin\php\php-8.3.26-Win32-vs16-x64\php.exe artisan migrate
```

8. **Compilar assets (opcional para desarrollo)**
```bash
npm run dev
```

O para producción:
```bash
npm run build
```

9. **Iniciar servidor**
```bash
C:\laragon\bin\php\php-8.3.26-Win32-vs16-x64\php.exe artisan serve
```

La aplicación estará disponible en: **http://localhost:8000**

## 📡 API Endpoints

Todos los endpoints están bajo el prefijo `/api`

### Listar todos los productos
```http
GET /api/products
```

**Respuesta exitosa:**
```json
{
  "status": 200,
  "message": "Products retrieved successfully",
  "data": [...]
}
```

### Obtener un producto por ID
```http
GET /api/products/{id}
```

### Crear un producto
```http
POST /api/products
Content-Type: application/json

{
  "name": "Producto Ejemplo",
  "price": 99.99,
  "description": "Descripción del producto",
  "url": "https://ejemplo.com/imagen.jpg"
}
```

### Actualizar un producto
```http
PUT /api/products/{id}
Content-Type: application/json

{
  "name": "Producto Actualizado",
  "price": 149.99,
  "description": "Nueva descripción",
  "url": "https://ejemplo.com/nueva-imagen.jpg"
}
```

### Eliminar un producto
```http
DELETE /api/products/{id}
```

### Formato de Respuestas

**Éxito:**
```json
{
  "status": 200,
  "message": "Success message",
  "data": { ... }
}
```

**Error:**
```json
{
  "status": 100,
  "message": "Error message",
  "data": null
}
```

## 🎨 Rutas Web

- **`/`** - Tienda online (e-commerce)
- **`/admin/products`** - Panel de administración

## 🗂️ Estructura del Proyecto

```
app/
├── Http/
│   └── Controllers/
│       └── Api/
│           └── ProductController.php    # CRUD con queries SQL
database/
├── migrations/
│   └── 2025_11_20_040327_create_products_table.php
resources/
├── css/
│   └── app.css                         # TailwindCSS
├── js/
│   └── app.js
└── views/
    ├── layouts/
    │   └── app.blade.php               # Layout principal
    └── products/
        ├── index.blade.php             # E-commerce (tienda)
        └── admin.blade.php             # Panel admin
routes/
├── api.php                             # Rutas API
└── web.php                             # Rutas web
```

## 💾 Esquema de Base de Datos

### Tabla: `products`

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | BIGINT UNSIGNED | Primary key, auto increment |
| name | VARCHAR(255) | Nombre del producto |
| price | DECIMAL(10,2) | Precio del producto |
| description | TEXT | Descripción del producto |
| url | VARCHAR(500) | URL de la imagen (nullable) |
| created_at | TIMESTAMP | Fecha de creación |
| updated_at | TIMESTAMP | Fecha de actualización |

## 🎯 Características Técnicas

### Backend
- **Sin Models**: Todas las operaciones usan queries SQL directas
  - `DB::select()` para consultas SELECT
  - `DB::insert()` para INSERT
  - `DB::update()` para UPDATE
  - `DB::delete()` para DELETE
- **Validación**: Validación de datos con Laravel Validator
- **Respuestas estandarizadas**: Status 200 (éxito) y 100 (error)

### Frontend
- **TailwindCSS**: Framework CSS utility-first
- **JavaScript Vanilla**: Sin frameworks adicionales
- **Fetch API**: Consumo de endpoints
- **Actualización dinámica**: Sin recargar página
- **Diseño responsive**: Mobile-first

## 🧪 Pruebas

### Probar API con cURL

**Crear producto:**
```bash
curl -X POST http://localhost:8000/api/products \
  -H "Content-Type: application/json" \
  -d '{"name":"Test Product","price":99.99,"description":"Test description","url":"https://via.placeholder.com/400"}'
```

**Listar productos:**
```bash
curl http://localhost:8000/api/products
```

## 📝 Notas Importantes

1. **Queries SQL Directas**: El proyecto NO usa Models de Laravel, todas las operaciones se realizan con queries SQL directas como se solicitó en la prueba técnica.

2. **Respuestas JSON**: Todas las respuestas de la API siguen el formato especificado con `status: 200` para éxito y `status: 100` para errores.

3. **Actualización Automática**: El frontend se actualiza automáticamente después de crear, editar o eliminar productos sin necesidad de recargar la página.

## 👨‍💻 Desarrollo

### Comandos útiles

```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Ver rutas
php artisan route:list

# Rollback migraciones
php artisan migrate:rollback

# Compilar assets en modo watch
npm run dev
```

## 📄 Licencia

Este proyecto fue desarrollado como prueba técnica para GOAPPY.

---

**Desarrollado con ❤️ usando Laravel {{ app()->version() }}**
