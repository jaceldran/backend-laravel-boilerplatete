<script>
    import { router, inertia } from "@inertiajs/svelte";
    import { formatDistanceToNow } from "date-fns";
    import { es } from "date-fns/locale";
    import ObjectRender from "@/components/ui/ObjectRender.svelte";
    import ToolBar from "@/components/ui/ToolBar.svelte";
    import Navigation from "@/components/ui/Navigation.svelte";
    import Main from "@/layouts/App.svelte";
    import Icon from "@/components/ui/Icon.svelte";
    import {
        faArrowRight,
        faCircleRight,
        faEye,
        faRefresh,
    } from "@fortawesome/free-solid-svg-icons";
    import { dateFormat, isDate, jsonRender } from "@/utils.js";

    export let commands;
    export let q;

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
            active: true,
        },
    ];

    const runCommand = (command) => {
        confirm(`Ejecutar el comando "${command}"`);
    };
    const breadcrumbLinks = [
        { text: "System", href: "/system" },
        { text: "Commands", href: "/system/commands" },
        // { text: `${model.name}`, href: "#" },
    ];
</script>

<Main {breadcrumbLinks}>
    <ToolBar class="justify-between">
        <Navigation class="horizontal subnav" {routes} />
        <section class="flex gap-2">
            <!-- <button class="rounded-full bg-neon-100 px-4">
                <Icon icon={faRefresh} class="" />
            </button>
            <SearchInput url="/system-models" {q} /> -->
        </section>
    </ToolBar>
    <!-- <h1 class="text-hero">Commands</h1> -->

    <div class="grid grid-cols-2 gap-4">
        {#each Object.entries(commands) as [key, value]}
            <div class="shadow-md rounded-md">
                <div class="command-name">{key}</div>
                <ul class="">
                    {#each Object.entries(value.list) as [k, v]}
                        <li class="command">
                            <section
                                class="flex justify-between items-center bg-neon-50"
                            >
                                <div class="signature">
                                    {k}
                                </div>
                                <p class="buttons">
                                    <button
                                        on:click={runCommand(k)}
                                        data-command={k}
                                    >
                                        <Icon
                                            icon={faCircleRight}
                                            size="lg"
                                            text="Ejecutar"
                                        />
                                    </button>
                                    <a
                                        class="button"
                                        use:inertia
                                        href="/system/commands/{k}"
                                        target="_blank"
                                    >
                                        <Icon
                                            icon={faEye}
                                            size="lg"
                                            text="Ver log"
                                        />
                                    </a>
                                </p>
                            </section>

                            <div class="description">{@html v.description}</div>
                        </li>
                    {/each}
                </ul>
            </div>
        {/each}
    </div>

    <div style="display:none">
        <kbd></kbd>
    </div>
    <!-- <ObjectRender data={commands} /> -->

    <!-- <pre>{jsonRender(commands)}</pre> -->
</Main>

<style>
    .command-name {
        @apply font-semibold  text-lg py-2 px-4 bg-neon-100 rounded-t-md;
    }
    .signature {
        @apply font-medium px-4 py-2;
    }
    .description {
        @apply px-4 py-2;
    }
    .buttons {
        @apply flex justify-center gap-2 px-4;
    }
    .buttons button,
    .buttons .button {
        @apply flex gap-4 items-center shadow rounded-full py-1 px-3 bg-white uppercase text-xs font-semibold;
    }
    button:hover,
    .button:hover {
        @apply bg-neon-100;
    }
</style>
