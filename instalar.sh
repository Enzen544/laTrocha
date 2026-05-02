#!/bin/bash

# Script de instalación inicial del proyecto La Trocha
# Ejecutar UNA SOLA VEZ cuando se clona el proyecto por primera vez

echo "=========================================="
echo "  🚗 La Trocha - Instalación inicial"
echo "=========================================="

# 1. Copiar .env si no existe
if [ ! -f .env ]; then
    echo "📋 Creando archivo .env..."
    cp .env.example .env
else
    echo "✅ .env ya existe, omitiendo..."
fi

# 2. Levantar contenedores
echo "🐳 Levantando contenedores Docker..."
docker-compose up -d --build

# 3. Esperar a que MySQL esté listo
echo "⏳ Esperando que la base de datos esté lista (30 seg)..."
sleep 30

# 4. Instalar dependencias
echo "📦 Instalando dependencias de Laravel..."
docker-compose exec app composer install

# 5. Generar key
echo "🔑 Generando clave de la aplicación..."
docker-compose exec app php artisan key:generate

# 6. Ejecutar migraciones
echo "🗄️ Creando tablas en la base de datos..."
docker-compose exec app php artisan migrate

# 7. Permisos de storage
echo "🔒 Configurando permisos..."
docker-compose exec app chmod -R 775 storage bootstrap/cache

echo ""
echo "=========================================="
echo "✅ ¡Instalación completa!"
echo ""
echo "  🌐 App:        http://localhost:8080"
echo "  🗄️  phpMyAdmin: http://localhost:8081"
echo "=========================================="
