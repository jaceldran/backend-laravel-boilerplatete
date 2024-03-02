<script>
    import Main from "@/layouts/App.svelte";
    import { inertia } from "@inertiajs/svelte";

    const links = [
        {
            href: "/enrolments",
            text: "Preinscripciones",
            description: "Registro de preinscripciones basadas en Dynamics.",
        },
        {
            href: "/payments",
            text: "Pagos",
            description: "Registro de procesos de pago gestionados.",
        },
        {
            href: "/system",
            text: "Sistema",
            description: "Características del sistema.",
        },
    ];

    const breadcrumbLinks = [{ text: "Inicio", href: "/" }];
</script>

<Main {breadcrumbLinks}>
    <h1 class="text-hero">Inicio</h1>

    <p class="text-xl my-4">Módulos disponibles:</p>

    <nav class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        {#each links as { text, href, description }}
            <a
                use:inertia
                {href}
                class="block rounded-lg shadow-lg p-4 bg-light dark:bg-dark"
            >
                <div class="underlined-4 font-medium">{text}</div>
                <div class="mt-4">{description}</div>
            </a>
        {/each}
    </nav>
</Main>
