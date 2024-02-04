<!DOCTYPE html>
<html lang="es">

<head>
    <title>Laravel-Inertia-Svelte</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @inertiaHead
</head>

{{-- dark:bg-[#241b2f] --}}

<body
    class="antialiased
    dark:text-neutral-400
    bg-neutral-50 text-neutral-600 text-normal
    dark:bg-gradient-to-bl  dark:from-neon-dark-darkest dark:to-neon-dark-darker">
    @inertia
</body>

</html>
