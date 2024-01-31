<!DOCTYPE html>
<html lang="es" class="antialiased font-light">

<head>
    <title>Laravel-Inertia-Svelte</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @inertiaHead
</head>

<body class="dark:bg-neutral-900 dark:text-neutral-500 bg-neutral-50 text-neutral-500">
    @inertia
</body>

</html>
