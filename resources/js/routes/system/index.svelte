<script>
    import { inertia, page } from "@inertiajs/svelte";
    import Main from "@/layouts/App.svelte";
    import Icon from "@/components/ui/Icon.svelte";
    import { faArrowRight } from "@fortawesome/free-solid-svg-icons";

    const breadcrumbLinks = [{ text: "Sistema", href: "/system" }];

    const logLinks = [
        {
            href: "/system/models",
            text: "Modelos",
            description:
                "Información de la configuración de los modelos del sistema como, por ejemplo, los atributos de las entidades de Dynamics relacionadas con los enrolments.",
        },
        {
            href: "/system/commands",
            text: "Comandos",
            description:
                "Panel para ejecutar comandos del sistema y revisar los logs de última ejecución",
        },
        {
            href: "/request-docs",
            text: "Rutas",
            description: "Configuración de rutas disponibles de web y api.",
        },
    ];

    const routes = [
        { text: "Modelos", href: "/system/models", active: false },
        {
            text: "Comandos",
            target: "_self",
            href: "/system/commands",
            active: false,
        },
        {
            text: "Rutas",
            target: "_blank",
            href: "/request-docs",
            active: false,
        },
    ];
</script>

<Main {breadcrumbLinks}>
    <h1 class="text-hero">Sistema</h1>

    <p class="text-xl my-4">Características del sistema.</p>

    <nav class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        {#each logLinks as { text, href, description }}
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
