<!DOCTYPE html>
<html lang="es">

<head>
    <title>Laravel-Inertia-Svelte</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @inertiaHead
</head>

<body class="antialiased
    dark:bg-neon-950 dark:text-neon-150
    bg-neutral-50 text-neutral-600 text-normal
    ">
    @inertia
</body>

</html>
