# 🚗 La Trocha - App Web Estación de Servicio

Aplicación web para la gestión operativa de la estación de gasolina **"La Trocha"** (Biomax S.A.), Campohermoso, Boyacá.

**Grupo 2 - Ingeniería de Sistemas UNAD**

---

## 🛠️ Tecnologías

- **Backend:** PHP 8.2 + Laravel 11
- **Frontend:** Blade + Bootstrap
- **Base de datos:** MySQL 8.0
- **Servidor web:** Nginx
- **Contenedores:** Docker + Docker Compose

---

## 📋 Requisitos (instalar antes de empezar)

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) ✅
- [Git](https://git-scm.com/)
- Cuenta en [GitHub](https://github.com/)

---

## 🚀 Instrucciones para correr el proyecto (TODOS los compañeros)

### Paso 1 — Clonar el repositorio

```bash
git clone https://github.com/TU_USUARIO/la-trocha.git
cd la-trocha
```

### Paso 2 — Crear el archivo .env

```bash
cp .env.example .env
```

### Paso 3 — Levantar los contenedores Docker

ir a la carpeta raiz del proyecto

```bash
docker compose build
docker compose up
```

Esto descarga las imágenes y construye el proyecto. La **primera vez** puede demorar 5-10 minutos.

### Paso 4 — Instalar dependencias de Laravel

```bash
docker compose exec app composer install
```

### Paso 5 — Generar clave de la aplicación

```bash
docker compose exec app php artisan key:generate
```

### Paso 6 — Crear las tablas en la base de datos

```bash
docker compose exec app php artisan migrate
```

### Paso 7 — Abrir el proyecto

| Servicio | URL |
|---|---|
| 🌐 Aplicación web | http://localhost:8080 |
| 🗄️ phpMyAdmin (BD) | http://localhost:8081 |

---

## 🔄 Comandos útiles del día a día

```bash
# Encender los contenedores
docker-compose up -d

# Apagar los contenedores
docker-compose down

# Ver los logs si algo falla
docker-compose logs -f

# Entrar al contenedor de PHP
docker-compose exec app bash

# Correr migraciones nuevas
docker-compose exec app php artisan migrate

# Crear un nuevo controlador
docker-compose exec app php artisan make:controller NombreController

# Crear un nuevo modelo con migración
docker-compose exec app php artisan make:model NombreModelo -m
```

---

## 📁 Módulos del proyecto

```
la-trocha/
├── app/
│   ├── Http/Controllers/
│   │   ├── CombustibleController.php   ← Control de gasolina y ACPM
│   │   ├── FiadoController.php         ← Control de fiados/créditos
│   │   └── BodegaController.php        ← Gestión de inventario
│   └── Models/
│       ├── Combustible.php
│       ├── Fiado.php
│       └── Producto.php
├── database/
│   └── migrations/                     ← Tablas de la BD
├── resources/views/                    ← Pantallas HTML (Blade)
├── routes/web.php                      ← Rutas de la app
├── docker/nginx/nginx.conf
├── docker-compose.yml
├── Dockerfile
└── .env.example
```

---

## ⚠️ Solución de problemas comunes

**"Permission denied" en Linux/Mac:**
```bash
sudo chmod -R 777 storage bootstrap/cache
```

**La base de datos no conecta:**
```bash
# Esperar 30 segundos y volver a intentar migrate
docker-compose exec app php artisan migrate
```

**El puerto 8080 está ocupado:**
Cambiar `"8080:80"` por `"8090:80"` en el `docker-compose.yml`

---

## 👥 Integrantes

- Ana Graciela Rodríguez Rada
- Cristian Yesid Correa Aullon
- Edison Jair Estupiñan Amaya

**Tutor:** Ruben Dario Ordoñez Mantilla
