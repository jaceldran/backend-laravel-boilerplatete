<script>
    import { router, inertia } from "@inertiajs/svelte";
    import { formatDistanceToNow } from "date-fns";
    import { es } from "date-fns/locale";
    import ObjectRender from "@/components/ui/ObjectRender.svelte";
    import SearchInput from "@/components/ui/SearchInput.svelte";
    import ToolBar from "@/components/ui/ToolBar.svelte";
    import Navigation from "@/components/ui/Navigation.svelte";
    import Main from "@/layouts/App.svelte";
    import Icon from "@/components/ui/Icon.svelte";
    import {
        faArrowRight,
        faCirclePlay,
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
        <!-- <section class="flex gap-2"> -->
        <!-- <button class="rounded-full bg-neon-100 px-4">
                <Icon icon={faRefresh} class="" />
            </button> -->
        <SearchInput url="/system/commands" {q} />
        <!-- </section> -->
    </ToolBar>
    <!-- <h1 class="text-hero">Commands</h1> -->

    <div class="grid grid-cols-1 gap-4">
        {#each Object.entries(commands) as [key, value]}
            <div class="shadow-md rounded-md">
                <div class="command-name brand-normal dark:brand-darker">
                    {key}
                </div>
                <ul class="">
                    {#each value as { id, subcommand, description }}
                        <li class="command">
                            <section class="flex justify-between items-center">
                                <div class="subcommand dark:text-green-200">
                                    {subcommand}
                                </div>
                                <p class="buttons">
                                    <button
                                        on:click={runCommand(id)}
                                        data-command={id}
                                    >
                                        <Icon
                                            icon={faCirclePlay}
                                            size="lg"
                                            text="Run"
                                        />
                                    </button>
                                    <a
                                        class="button"
                                        use:inertia
                                        href="/system/commands/{subcommand}"
                                        target="_blank"
                                    >
                                        <Icon
                                            icon={faEye}
                                            size="lg"
                                            text="Log"
                                        />
                                    </a>
                                </p>
                            </section>

                            <div class="description">
                                {@html description}
                            </div>
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
        @apply font-semibold  text-lg py-2 px-4 rounded-t-md;
    }
    .subcommand {
        @apply font-medium h-10 px-4 py-2;
    }
    .description {
        @apply px-4 py-2;
    }
    .buttons {
        @apply flex justify-center gap-2 px-4;
    }
    .buttons button,
    .buttons .button {
        @apply cursor-pointer flex items-center shadow rounded-full py-1 px-2 bg-white uppercase text-[75%] font-semibold;
        /* font-variant: small-caps; */
    }
    /* button:hover,
    .button:hover {
        @apply bg-neon-100 text-red-500;
    } */
</style>
