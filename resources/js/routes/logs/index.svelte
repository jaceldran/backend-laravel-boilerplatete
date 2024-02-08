<script>
    import MainContent from "@/layouts/App.svelte";

    const logLinks = [
        {
            href: "https://service.enae.es/dynamics/commands/logs/sync-to-dynamics.log",
            text: "sync-to-dynamics",
            description:
                "Sincronización de todas las preinscripciones marcadas como finalizadas por el solicitante.",
        },
        {
            href: "https://service.enae.es/dynamics/commands/logs/link-lead.log",
            text: "link-lead",
            description:
                "Asignación o creación de <u>lead</u> a todas las preinscripciones que aún no lo tienen asignado, independientemente de si el solicitante la ha dado por finalizada.",
        },
        {
            href: "https://service.enae.es/dynamics/commands/logs/link-contact.log",
            text: "link-contact",
            description:
                "Asignación o creación de <u>contact</u> para las preinscripciones marcadas como finalizadas por el solicitante.",
        },
        {
            href: "https://service.enae.es/dynamics/commands/logs/link-opportunity.log",
            text: "link-opportunity",
            description:
                "Asignación o creación de <u>opportunity</u> para las preinscripciones marcadas como finalizadas por el solicitante que ya tienen asignado <u>lead</u> y <u>contact</u>.",
        },
    ];

    const links = [{ text: "Logs", href: "#" }];
</script>

<MainContent class="flex flex-col ">
    <h1 class="text-hero">Logs</h1>

    <p class="text-lg my-4">
        Logs de las tareas programadas para sincronizar los datos de los
        procesos de preinscripciones a Dynamics.
    </p>

    <nav
        class="flex flex-col rounded bg-neon-light-lightest dark:bg-neon-dark-medium"
    >
        <dl>
            {#each logLinks as { text, href, description }}
                <a
                    target="__blank"
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
