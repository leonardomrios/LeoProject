# Leo - Panel de Control Personal para Desarrollo Profesional

**Leo** es una aplicación web personal desarrollada con Laravel que te permite gestionar y visualizar de manera integral tu desarrollo profesional. El sistema está diseñado específicamente para profesionales que buscan estructurar su crecimiento mediante la planificación estratégica, el análisis personal y el seguimiento de objetivos profesionales.

## 📋 Descripción del Proyecto

Leo es un panel de control completo que integra múltiples herramientas de gestión personal en una sola plataforma:

### 🎯 Funcionalidades Principales

1. **Objetivos Profesionales SMART**
   - Gestión completa de objetivos categorizados en Corto Plazo (1-2 años), Mediano Plazo (3-5 años) y Largo Plazo (10+ años)
   - Sistema de priorización (1-5 estrellas)
   - Fechas límite con alertas visuales
   - Seguimiento de progreso y estado de completado
   - Visualización moderna con métricas y estadísticas

2. **Matriz DOFA (Análisis Estratégico)**
   - Gestión de Fortalezas, Debilidades, Oportunidades y Amenazas
   - Priorización de elementos
   - Visualización en cuadrantes organizados
   - Edición y gestión completa de elementos

3. **Autoanálisis Estratégico**
   - Reflexión profunda sobre 4 estrategias clave:
     - **FO**: Fortalezas + Oportunidades
     - **DO**: Oportunidades - Debilidades
     - **FA**: Fortalezas - Amenazas
     - **DA**: Debilidades - Amenazas
   - Panel de resumen visual con gráficos y métricas
   - Visualización de temas clave y acciones prioritarias

4. **Cronograma de Roadmap**
   - Sistema completo de gestión de actividades y subactividades
   - Roadmap pre-configurado de Machine Learning Engineer (450+ horas)
   - Visualización en Gantt y Calendario
   - Cálculo automático de fechas considerando días hábiles y festivos de Colombia
   - Seguimiento de progreso por actividad y subactividad
   - 8 categorías principales con múltiples actividades

5. **Calendario Interactivo**
   - Vista mensual de todas las actividades
   - Visualización de fechas de inicio y fin
   - Navegación entre meses

### 🎨 Características de Diseño

- **Interfaz Moderna**: Diseño limpio y profesional con sidebar de navegación
- **Responsive**: Adaptable a diferentes tamaños de pantalla
- **UI/UX Optimizada**: Experiencia de usuario intuitiva con feedback visual
- **Gráficos y Visualizaciones**: Resúmenes visuales con gráficos circulares, barras de progreso y nubes de tags
- **Sistema de Colores**: Paleta consistente con indicadores visuales para estados y prioridades

## 🛠️ Tecnologías Utilizadas

- **Backend**: Laravel 12 (PHP 8.2+)
- **Base de Datos**: PostgreSQL 12+ (también compatible con SQLite para desarrollo)
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Build Tool**: Vite 7
- **CSS Framework**: Tailwind CSS 4
- **Estilos**: CSS personalizado con variables CSS y diseño moderno

## 📦 Requisitos del Sistema

Antes de instalar, asegúrate de tener instalado:

- **PHP** >= 8.2 con extensiones:
  - BCMath
  - Ctype
  - cURL
  - DOM
  - Fileinfo
  - JSON
  - Mbstring
  - OpenSSL
  - PCRE
  - PDO
  - Tokenizer
  - XML
- **Composer** >= 2.0
- **Node.js** >= 18.x y **npm** >= 9.x
- **PostgreSQL** >= 12 (recomendado) o **SQLite** (para desarrollo)
- **Servidor web** (Apache/Nginx) o PHP Built-in Server

## 🚀 Instalación Paso a Paso

### Paso 1: Clonar o Descargar el Repositorio

Si tienes el repositorio en Git:
```bash
git clone <url-del-repositorio>
cd LeonardoProject
```

Si descargaste un ZIP, extrae el archivo y navega a la carpeta:
```bash
cd LeonardoProject
```

### Paso 2: Instalar Dependencias de PHP

Abre una terminal en la carpeta del proyecto y ejecuta:

```bash
composer install
```

Esto instalará todas las dependencias de Laravel y paquetes PHP necesarios.

**Nota**: Si es la primera vez que usas Composer, puedes instalarlo desde [getcomposer.org](https://getcomposer.org/)

### Paso 3: Instalar Dependencias de Node.js

En la misma terminal o en una nueva, ejecuta:

```bash
npm install
```

Esto instalará Vite, Tailwind CSS y otras dependencias de frontend.

**Nota**: Si no tienes Node.js instalado, descárgalo desde [nodejs.org](https://nodejs.org/)

### Paso 4: Configurar el Archivo de Entorno

Copia el archivo de ejemplo de configuración:

```bash
cp .env.example .env
```

Si no existe `.env.example`, crea un archivo `.env` nuevo. Abre el archivo `.env` con tu editor de texto favorito y configura lo siguiente:

#### Configuración de Base de Datos (PostgreSQL)

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=leo_database
DB_USERNAME=tu_usuario_postgres
DB_PASSWORD=tu_contraseña_postgres
```

**Alternativa con SQLite** (más fácil para desarrollo):

```env
DB_CONNECTION=sqlite
DB_DATABASE=/ruta/completa/a/database/database.sqlite
```

Si usas SQLite, asegúrate de que el archivo `database/database.sqlite` exista:
```bash
touch database/database.sqlite
```

#### Otras Configuraciones Importantes

```env
APP_NAME="Leo"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_LEVEL=debug
```

### Paso 5: Generar la Clave de Aplicación

Laravel requiere una clave de aplicación única. Genera una con:

```bash
php artisan key:generate
```

Esto actualizará automáticamente el `APP_KEY` en tu archivo `.env`.

### Paso 6: Crear la Base de Datos

#### Si usas PostgreSQL:

1. Abre tu cliente de PostgreSQL (pgAdmin, DBeaver, o línea de comandos)
2. Conéctate a tu servidor PostgreSQL
3. Crea una nueva base de datos:

```sql
CREATE DATABASE leo_database;
```

O desde la línea de comandos:
```bash
createdb -U tu_usuario_postgres leo_database
```

#### Si usas SQLite:

El archivo se creará automáticamente cuando ejecutes las migraciones.

### Paso 7: Ejecutar las Migraciones

Las migraciones crean las tablas necesarias en la base de datos:

```bash
php artisan migrate
```

Esto creará las siguientes tablas:
- `users` - Usuarios del sistema
- `objetivos` - Objetivos profesionales
- `dofa_elements` - Elementos de la matriz DOFA
- `autoanalisis_respuestas` - Respuestas de autoanálisis
- `actividads` - Actividades del cronograma
- `subactividads` - Subactividades del cronograma
- `cache`, `jobs` - Tablas del sistema Laravel

### Paso 8: Poblar la Base de Datos con Datos Iniciales

Ejecuta los seeders para cargar datos de ejemplo:

```bash
php artisan db:seed
```

Esto ejecutará los siguientes seeders:
- **ActividadSeeder**: Crea el roadmap completo de Machine Learning Engineer (450+ horas, 8 categorías)
- **ObjetivosProfesionalesSeeder**: Crea 17 objetivos profesionales SMART (6 corto plazo, 6 mediano plazo, 5 largo plazo)
- **DofaElementSeeder**: Crea la matriz DOFA completa (6 fortalezas, 5 debilidades, 6 oportunidades, 6 amenazas)
- **AutoanalisisRespuestaSeeder**: Crea las 4 reflexiones estratégicas de autoanálisis

**Nota**: Si quieres ejecutar seeders individuales:
```bash
php artisan db:seed --class=ActividadSeeder
php artisan db:seed --class=ObjetivosProfesionalesSeeder
php artisan db:seed --class=DofaElementSeeder
php artisan db:seed --class=AutoanalisisRespuestaSeeder
```

### Paso 9: Compilar los Assets Frontend

Para desarrollo (con hot-reload):
```bash
npm run dev
```

Para producción:
```bash
npm run build
```

### Paso 10: Iniciar el Servidor

Abre una nueva terminal y ejecuta:

```bash
php artisan serve
```

El servidor estará disponible en: `http://localhost:8000`

**Importante**: Si estás en modo desarrollo (`npm run dev`), mantén ambas terminales abiertas:
- Terminal 1: `npm run dev` (Vite para assets)
- Terminal 2: `php artisan serve` (Servidor Laravel)

### Paso 11: Acceder a la Aplicación

Abre tu navegador y navega a:
```
http://localhost:8000
```

La aplicación redirigirá automáticamente a la página de Objetivos Profesionales.

## 📁 Estructura del Proyecto

```
LeonardoProject/
├── app/
│   ├── Http/Controllers/
│   │   ├── ObjetivoController.php          # CRUD de objetivos
│   │   ├── DofaController.php              # CRUD de matriz DOFA
│   │   ├── AutoanalisisController.php      # CRUD de autoanálisis
│   │   ├── CronogramaController.php         # Gestión de cronograma
│   │   └── SubactividadController.php       # Gestión de subactividades
│   └── Models/
│       ├── Objetivo.php                     # Modelo de objetivos
│       ├── DofaElement.php                 # Modelo de elementos DOFA
│       ├── AutoanalisisRespuesta.php        # Modelo de autoanálisis
│       ├── Actividad.php                    # Modelo de actividades
│       └── Subactividad.php                 # Modelo de subactividades
├── database/
│   ├── migrations/                          # Migraciones de base de datos
│   │   ├── *_create_objetivos_table.php
│   │   ├── *_create_dofa_elements_table.php
│   │   ├── *_create_autoanalisis_respuestas_table.php
│   │   ├── *_create_actividads_table.php
│   │   └── *_create_subactividads_table.php
│   └── seeders/                             # Seeders de datos iniciales
│       ├── DatabaseSeeder.php               # Seeder principal
│       ├── ActividadSeeder.php              # Roadmap ML Engineer
│       ├── ObjetivosProfesionalesSeeder.php # Objetivos SMART
│       ├── DofaElementSeeder.php            # Matriz DOFA
│       └── AutoanalisisRespuestaSeeder.php  # Autoanálisis
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php                # Layout principal
│   │   ├── objetivos/                       # Vistas de objetivos
│   │   ├── dofa/                            # Vistas de DOFA
│   │   ├── autoanalisis/                    # Vistas de autoanálisis
│   │   └── cronograma/                      # Vistas de cronograma
│   ├── css/
│   │   └── app.css                          # Estilos principales
│   └── js/
│       └── app.js                           # JavaScript principal
├── routes/
│   └── web.php                              # Rutas de la aplicación
├── public/                                  # Archivos públicos
├── .env                                     # Configuración (crear desde .env.example)
├── composer.json                            # Dependencias PHP
├── package.json                             # Dependencias Node.js
└── vite.config.js                           # Configuración de Vite
```

## 🎯 Funcionalidades Detalladas

### Objetivos Profesionales

- ✅ Crear, editar y eliminar objetivos
- ✅ Categorización automática (Corto/Mediano/Largo plazo)
- ✅ Sistema de priorización con estrellas (1-5)
- ✅ Fechas límite con cálculo de días restantes
- ✅ Estados visuales: Completado, Vencido, Por Vencer, En Progreso
- ✅ Estadísticas por categoría (total, completados, progreso)
- ✅ Visualización moderna con cards y métricas

### Matriz DOFA

- ✅ Gestión completa de 4 cuadrantes:
  - **Fortalezas**: Puntos fuertes actuales
  - **Debilidades**: Aspectos a mejorar
  - **Oportunidades**: Posibilidades de crecimiento
  - **Amenazas**: Riesgos a considerar
- ✅ Priorización de elementos (1-5)
- ✅ Edición y eliminación de elementos
- ✅ Visualización en grid responsive

### Autoanálisis Estratégico

- ✅ 4 reflexiones estratégicas basadas en matriz DOFA
- ✅ Panel de resumen visual con:
  - Gráfico circular de progreso
  - Lista de estrategias completadas
  - Nube de temas clave
  - Acciones prioritarias
- ✅ Edición y actualización de reflexiones
- ✅ Respuestas humanizadas y naturales

### Cronograma y Roadmap

- ✅ Roadmap pre-configurado de Machine Learning Engineer:
  - 8 categorías principales
  - 15+ actividades principales
  - 80+ subactividades detalladas
  - 450+ horas de contenido estructurado
- ✅ Cálculo automático de fechas considerando:
  - Días hábiles (lunes a viernes)
  - Festivos de Colombia (2026-2028)
  - 3 horas por día hábil
- ✅ Visualización en Gantt y Calendario
- ✅ Gestión de progreso por actividad
- ✅ Creación y edición de actividades y subactividades

## 🔧 Comandos Útiles

### Desarrollo

```bash
# Iniciar servidor de desarrollo
php artisan serve

# Compilar assets en modo desarrollo (hot-reload)
npm run dev

# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Base de Datos

```bash
# Ejecutar migraciones
php artisan migrate

# Revertir última migración
php artisan migrate:rollback

# Ejecutar seeders
php artisan db:seed

# Refrescar base de datos (elimina todo y recrea)
php artisan migrate:fresh --seed
```

### Producción

```bash
# Compilar assets para producción
npm run build

# Optimizar aplicación
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🐛 Solución de Problemas Comunes

### Error: "Class not found" o problemas de autoload

```bash
composer dump-autoload
```

### Error: "APP_KEY is not set"

```bash
php artisan key:generate
```

### Error de conexión a base de datos

1. Verifica que PostgreSQL esté corriendo
2. Verifica las credenciales en `.env`
3. Asegúrate de que la base de datos existe
4. Verifica permisos del usuario de PostgreSQL

### Error: "Vite manifest not found"

```bash
npm run build
# o en desarrollo:
npm run dev
```

### Los cambios en CSS/JS no se reflejan

1. Detén `npm run dev` (Ctrl+C)
2. Elimina la carpeta `public/build`
3. Ejecuta nuevamente `npm run dev`

### Problemas con permisos (Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## 📝 Notas Adicionales

- El roadmap de ML Engineer está configurado para comenzar el **20 de enero de 2026**
- Los días festivos de Colombia están incluidos para 2026, 2027 y 2028
- El sistema calcula automáticamente solo días hábiles (lunes a viernes, excluyendo festivos)
- Los seeders pueden ejecutarse múltiples veces de forma segura (usan `truncate` o `firstOrCreate`)

## 🔐 Seguridad

- Nunca subas el archivo `.env` al repositorio
- Cambia `APP_DEBUG=false` en producción
- Usa contraseñas seguras para la base de datos
- Mantén Laravel y las dependencias actualizadas

## 📄 Licencia

Este proyecto es de uso personal.

## 👤 Autor

Desarrollado para gestión personal de desarrollo profesional y planificación estratégica.

---

**¿Necesitas ayuda?** Revisa la sección de [Solución de Problemas](#-solución-de-problemas-comunes) o consulta la documentación oficial de [Laravel](https://laravel.com/docs).
