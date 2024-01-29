<!DOCTYPE html>
<html lang="es" class="antialiased font-light text-slate-700">

<head>
    <title>Laravel-Inertia-Svelte</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @inertiaHead
</head>

<body class="dark:bg-stone-700 dark:text-stone-50">
    @inertia
</body>

</html>
