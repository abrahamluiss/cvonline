<h1 align="center"><a href="https://github.com/abrahamluiss/cvonline/"</a>Cv Online</h1>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://img.shields.io/badge/Laravel-%5E8.0-red" alt="Laravel"></a>
<a href="https://vuejs.org"><img src="https://img.shields.io/badge/Vue.js-%5E2.6.12-green" alt="Vue.js"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Sobre el proyecto
Creador de CV Online, utilizando Laravel^8.0 y Vue.js^2.6.12 <br>
Librerias: <br>
    - Images <br>
        composer require intervention/image <br>
     - API Tokens <br>
        composer require laravel/sanctum <br>

### Instalar
 1. Ejecutar `https://github.com/abrahamluiss/cvonline/.git` para clonar el repositorio
 2. Ejecutar `composer update` o `composer install` de la carpeta raíz de los proyectos
 3. De la raiz del proyecto  `cp .env.example .env`
 4. Ejecutar `php artisan key:generate`
 5. Configure el archivo `.env`, así como los archivos en la carpeta de configuración para suitar sus necesidades
 6. Ejecute `php artisan migrate` para configurar las tablas de base de datos MySQL después de que se haya creado la base de datos para la aplicación y configurada en el archivo `..env`.
 7. En el archivo .env agregar `JSON_RESUME_API="http://localhost:8081"`
 8. Ejecutar `npm i && npm start`
 9. Ejecutar `php artisan serve`
 
 
 ### Testing
 1. Ejecutar `npm i --save-dev jest @vue/test-utils babel-jest babel-core@^7.0.0-0 @babel/preset-env vue-jest`
 2. Ejecutar `npm test`
 3. Ejecutar `php artisan test` usando mysql, si no quieres perder tus datos en la bd original usar sqlite
