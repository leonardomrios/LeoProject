# Panel de Control Personal - Laravel

Aplicación web personal de gestión de vida desarrollada con Laravel y PostgreSQL. Este panel de control centralizado te permite visualizar y gestionar información estratégica sobre tu desarrollo profesional y personal.

## Características

- **Objetivos Profesionales**: Gestión completa de objetivos categorizados en Corto, Mediano y Largo plazo con funcionalidad CRUD completa
- **Matriz DOFA**: Visualización y gestión de Debilidades, Oportunidades, Fortalezas y Amenazas
- **Interfaz Moderna**: Diseño profesional y cohesivo con sidebar de navegación lateral
- **Base de Datos PostgreSQL**: Configurado para usar PostgreSQL como sistema de gestión de base de datos

## Requisitos

- PHP >= 8.2
- Composer
- Node.js y npm
- PostgreSQL >= 12
- Servidor web (Apache/Nginx) o PHP Built-in Server

## Instalación

1. **Clonar el repositorio** (si aplica) o asegurarse de estar en el directorio del proyecto

2. **Instalar dependencias de PHP**:
```bash
composer install
```

3. **Instalar dependencias de Node.js**:
```bash
npm install
```

4. **Configurar el archivo .env**:
```bash
cp .env.example .env
```

Editar el archivo `.env` y configurar la conexión a PostgreSQL:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

5. **Generar la clave de aplicación**:
```bash
php artisan key:generate
```

6. **Crear la base de datos en PostgreSQL**:
```sql
CREATE DATABASE nombre_de_tu_base_de_datos;
```

7. **Ejecutar las migraciones**:
```bash
php artisan migrate
```

8. **Compilar los assets** (para desarrollo):
```bash
npm run dev
```

O para producción:
```bash
npm run build
```

## Uso

### Desarrollo

1. **Iniciar el servidor de desarrollo de Laravel**:
```bash
php artisan serve
```

2. **En otra terminal, iniciar Vite** (si estás en modo desarrollo):
```bash
npm run dev
```

3. **Acceder a la aplicación**:
Abre tu navegador en `http://localhost:8000`

### Producción

1. **Compilar los assets**:
```bash
npm run build
```

2. **Optimizar la aplicación**:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Estructura del Proyecto

```
├── app/
│   ├── Http/Controllers/
│   │   ├── ObjetivoController.php    # Controlador para objetivos
│   │   └── DofaController.php        # Controlador para matriz DOFA
│   └── Models/
│       ├── Objetivo.php              # Modelo de objetivos
│       └── DofaElement.php           # Modelo de elementos DOFA
├── database/migrations/
│   ├── *_create_objetivos_table.php
│   └── *_create_dofa_elements_table.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php         # Layout principal con sidebar
│   │   ├── objetivos/                # Vistas de objetivos
│   │   └── dofa/                     # Vistas de matriz DOFA
│   ├── css/
│   │   └── app.css                   # Estilos principales
│   └── js/
│       └── app.js                    # JavaScript principal
└── routes/
    └── web.php                       # Rutas de la aplicación
```

## Funcionalidades

### Objetivos Profesionales

- Crear, leer, actualizar y eliminar objetivos
- Categorización por plazo (Corto, Mediano, Largo)
- Priorización (1-5)
- Fechas límite
- Estado de completado
- Visualización organizada por categorías

### Matriz DOFA

- Gestión de elementos en las 4 categorías:
  - **Debilidades**: Aspectos a mejorar
  - **Oportunidades**: Posibilidades de crecimiento
  - **Fortalezas**: Puntos fuertes actuales
  - **Amenazas**: Riesgos a considerar
- Priorización de elementos
- Panel de edición accesible desde el botón "Editar Matriz"

## Tecnologías Utilizadas

- **Backend**: Laravel 12
- **Base de Datos**: PostgreSQL
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Build Tool**: Vite
- **Estilos**: CSS personalizado con diseño moderno

## Licencia

Este proyecto es de uso personal.

## Autor

Desarrollado para gestión personal de desarrollo profesional y personal.
