<script>
    import { inertia, page } from "@inertiajs/svelte";
    import Main from "@/layouts/App.svelte";

    const breadcrumbLinks = [{ text: "System", href: "/system" }];

    const logLinks = [
        {
            href: "/system/models",
            text: "Modelos",
            description:
                "Información de la configuración de los modelos del sistema como, por ejemplo, los atributos de las entidades de Dynamics relacionadas con los enrolments.",
        },
        {
            href: "/request-docs",
            text: "Rutas",
            description: "Configuración de rutas disponibles de web y api.",
        },
        {
            href: "/system/commands",
            text: "Comandos",
            description:
                "Panel para ejecutar comandos del sistema y revisar los logs de última ejecución",
        },
    ];

    const routes = [
        { text: "Modelos", href: "/system/models", active: false },
        {
            text: "Rutas",
            target: "_blank",
            href: "/request-docs",
            active: false,
        },
        {
            text: "Comandos",
            target: "_self",
            href: "/system/commands",
            active: false,
        },
    ];
</script>

<Main {breadcrumbLinks} class="flex flex-col ">
    <h1 class="text-hero">System</h1>

    <p class="text-lg my-4">
        En esta sección se gestionan cuestiones relativas al funcionamiento
        interno del sistema.
    </p>

    <nav class="flex flex-col rounded bg-neon-50 dark:bg-neon-800">
        <dl>
            {#each logLinks as { text, href, description }}
                <a
                    use:inertia
                    {href}
                    class="hover:bg-neon-100 dark:hover:bg-neon-700 dark:text-white"
                >
                    <dt>{text}</dt>
                    <dd>{@html description}</dd>
                </a>
            {/each}
        </dl>
    </nav>
</Main>

<style>
    a {
        @apply block py-2 px-4;
    }
    dt {
        @apply text-lg font-medium;
    }
    dd {
        @apply px-4;
    }
</style>
