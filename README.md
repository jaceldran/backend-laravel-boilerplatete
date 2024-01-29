# Monolito Laravel Inertia Svelte

Instalar dependencias php (inertiajs/inertia)

````
composer install / update
````

Para poder modificar la carpeta por defecto de inertia.

php artisan vendor:publish --provider="Inertia\ServiceProvider"


Instalar dependencias js


````
npm install
````

Si la página de inicio sigue mostrando el welcome por defecto de Laravel

````
php artisah route:clear
````

## Características

- Carpeta utils para agregar utilidades diversas y centralizarlas en la librería `utils.js`.

- Componente de botón para alternar modo dark/light.

- Instalación de Highcharts con temas personalizables de muestra: darkTheme y lightTheme.
