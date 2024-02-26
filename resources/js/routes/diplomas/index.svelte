<script>
    import { inertia } from "@inertiajs/svelte";
    import MainContent from "@/layouts/App.svelte";

    const logLinks = [
        {
            href: "#",
            text: "Años académicos",
            description: "Años académicos sincronizados con Dynamics.",
        },
        {
            href: "#",
            text: "Programas y ediciones",
            description: "Programas y ediciones sincronizadas con Dynamics.",
        },
        {
            href: "#",
            text: "Matrículas",
            description: "Matrículas de Dynamics",
        },
        {
            href: "#",
            text: "Estudiantes",
            description: "Estudiantes registrados de Dynamics.",
        },
        {
            href: "#",
            text: "Diplomas",
            description: `<ul>
                <li>Diplomas notarizados.</li>
                <li>Visualización de diplomas.</li>
                <li>API de notarización.</li>
             </ul>`,
        },
    ];

    const breadcrumbLinks = [{ text: "Diplomas", href: "/diplomas" }];
</script>

<MainContent {breadcrumbLinks} class="flex flex-col ">
    <h1 class="text-hero">Diplomas</h1>

    <p class="text-lg my-4">
        En esta sección se incluye todo lo relativo a la gestión y emisión de
        diplomas digitales para lo que se necesita disponer de la lista de los
        años académicos, programas, ediciones, matrículas y estudiantes.
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
</MainContent>

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
