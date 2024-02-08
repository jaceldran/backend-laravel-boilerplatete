<script>
    import MainContent from "@/layouts/App.svelte";
    import { inertia } from "@inertiajs/svelte";

    const logLinks = [
        {
            href: "/dashboards/marketing",
            text: "Marketing",
            description:
                "Estado de objetivos de captación de leads, contacts, efectividad de estrategias, tasas de conversión, etc.",
        },
        {
            href: "/dashboards/marketing",
            text: "Financiero",
            description:
                "Estado de objetivos de ingresos y ventas, indicadores de rentabilidad, de productividad, costes por estudiante/programa, etc.",
        },
        {
            href: "/dashboards/marketing",
            text: "Académico",
            description:
                "Tiempo promedio para completar máster o curso, coste por estudiante/programa, distribución por tipo de asistencia presencial, online, blended, etc.",
        },
    ];
</script>

<MainContent class="flex flex-col ">
    <h1 class="text-hero">Dashboards</h1>

    <p class="my-4 text-lg">Visualizaciones varias según datos disponibles.</p>
    <nav
        class="flex flex-col rounded bg-neon-light-lightest dark:bg-neon-dark-medium"
    >
        <dl>
            {#each logLinks as { text, href, description }}
                <a
                    use:inertia
                    {href}
                    class="hover:bg-neon-light-lighter dark:hover:bg-neon-dark-dark dark:text-white"
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
        @apply block p-4;
    }
    dt {
        @apply text-lg font-medium;
    }
    dd {
        @apply px-4;
    }
</style>
