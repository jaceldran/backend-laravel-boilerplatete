# Laravel backend

*Boilerpate* para un proyecto de *backend* con Laravel.


## Caraterísticas básicas

- `app/Traits/Newable` para instanciar cualquier clase usando `MyClass::new()` con o sin argumentos;

- `app/Traits/GenerateUuid` para asignar claves primarias basadas en UUID en lugar de autoincrementales.

- Ajuste de **CORS** en el archivo de configuración `config/cors.php` mediante el registro de los orígenes permitidos.

    - http://localhost:5173 (URL por defecto para `npm run dev`)
    - http://localhost:4173 (URL por defecto para `npm run preview`)

- - Rutas de login/logout vía API en el archivo `routes/api.php` invocando a los controladores correspondients:

    - `api/login` LoginController
    - `api/logout` LogoutController



## Instalación en subdirectorio

Si la aplicación laravel se instala en un subdirectorio del raiz entonces añadir un `.htaccess` con el contenido:

```
RewriteEngine On
RewriteRule ^$ public/ [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ public/$1 [L]
```
Y, en `app/Providers/RouteServiceProvider.php`, modificar el método boot añadiendo prefijos a los middleware de rutas api y web:

```php
public function boot(): void
    {
        $subdirectory = 'backend';

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix($subdirectory . '/api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->prefix($subdirectory)
                ->group(base_path('routes/web.php'));
        });
    }
```
