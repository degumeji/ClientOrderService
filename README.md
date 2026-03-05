Aquí tienes un **README.md** propuesto para tu proyecto basado en el código analizado:

---

# 📦 API de Gestión de Clientes y Órdenes

## 📌 Descripción

Esta aplicación es una **API REST desarrollada en Laravel 9** que permite gestionar:

* 👤 Clientes
* 🛒 Órdenes
* 📊 Estadísticas de órdenes (dashboard)
* 🔐 Autenticación mediante JWT (JSON Web Token)

La API protege sus endpoints utilizando un middleware personalizado `jwt.auth`, lo que significa que todas las rutas requieren un token válido enviado en el header:

```
Authorization: Bearer {token}
```

---

## 🏗️ Tecnologías Utilizadas

* PHP 8.0+
* Laravel 9
* JWT (`firebase/php-jwt`)
* Sanctum (instalado)
* Guzzle HTTP
* PHPUnit (pruebas)
* Vite (frontend assets si aplica)

---

## 📁 Estructura Principal

```
app/
 └── Http/Controllers/
      ├── ClientController.php
      └── OrderController.php

routes/
 └── api.php
```

---

## 🔐 Autenticación

Todas las rutas están protegidas por:

```php
Route::middleware(['jwt.auth'])->group(function () {
```

Esto significa que debes enviar un token JWT válido en cada petición.

---

## 🚀 Endpoints Disponibles

### 📌 Clientes

| Método | Endpoint            | Descripción        |
| ------ | ------------------- | ------------------ |
| GET    | `/api/clients`      | Listar clientes    |
| POST   | `/api/clients`      | Crear cliente      |
| PUT    | `/api/clients/{id}` | Actualizar cliente |
| DELETE | `/api/clients/{id}` | Eliminar cliente   |

### 📌 Órdenes

| Método | Endpoint           | Descripción      |
| ------ | ------------------ | ---------------- |
| GET    | `/api/orders`      | Listar órdenes   |
| POST   | `/api/orders`      | Crear orden      |
| PUT    | `/api/orders/{id}` | Actualizar orden |
| DELETE | `/api/orders/{id}` | Eliminar orden   |

### 📊 Dashboard

```
GET /api/dashboard/stats
```

Devuelve estadísticas relacionadas con órdenes.

### 🔎 Validar Token

```
GET /api/check-token
```

Devuelve información básica del header del JWT enviado.

---

# ⚙️ Instalación

## 1️⃣ Clonar el repositorio

```bash
git clone <url-del-repositorio>
cd nombre-del-proyecto
```

---

## 2️⃣ Instalar dependencias PHP

```bash
composer install
```

Si tienes problemas con composer en Windows, asegúrate de que esté agregado al PATH.

---

## 3️⃣ Configurar variables de entorno

Copia el archivo `.env.example`:

```bash
cp .env.example .env
```

Configura la base de datos en el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_db
DB_USERNAME=root
DB_PASSWORD=
```

(O ajusta según uses SQL Server, PostgreSQL, etc.)

---

## 4️⃣ Generar clave de la aplicación

```bash
php artisan key:generate
```

---

## 5️⃣ Ejecutar migraciones

```bash
php artisan migrate
```

Si necesitas datos de prueba:

```bash
php artisan db:seed
```

---

## 6️⃣ Levantar el servidor

```bash
php artisan serve
```

La API estará disponible en:

```
http://localhost:8000
```

---

# 🐳 Ejecutar con Docker (Opcional)

Si deseas usar Laravel Sail:

```bash
./vendor/bin/sail up
```

O si usas Docker manualmente, asegúrate de tener:

* PHP
* Base de datos
* Composer

---

# 🧪 Ejecutar Pruebas

```bash
php artisan test
```

o

```bash
./vendor/bin/phpunit
```

---

# 📬 Ejemplo de Petición con Postman

### Crear Cliente

**POST**

```
http://localhost:8000/api/clients
```

Headers:

```
Authorization: Bearer TU_TOKEN
Content-Type: application/json
```

Body:

```json
{
  "firstName": "Juan",
  "lastName": "Perez",
  "email": "juan@email.com",
  "phone": "0999999999"
}
```

---

# 🛡️ Seguridad

* Todas las rutas están protegidas por JWT.
* Validación de datos en creación de clientes.
* Emails únicos en la base de datos.

---

# 📈 Posibles Mejoras Futuras

* Implementar Swagger para documentación
* Agregar pruebas de integración
* Dockerizar completamente el entorno
* Implementar refresh tokens
* Agregar roles y permisos

---

# 👨‍💻 Autor

Proyecto desarrollado como API REST para gestión de clientes y órdenes con autenticación JWT en Laravel.

---