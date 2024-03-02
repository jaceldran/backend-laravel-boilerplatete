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
            text: "Comandos",
            target: "_self",
            href: "/system/commands",
            active: true,
        },
        {
            text: "Rutas",
            target: "_blank",
            href: "/request-docs",
            active: false,
        },
    ];

    const runCommand = (commandName, commandId) => {
        if (confirm(`Ejecutar el comando "${commandName}"`)) {
            router.get(`/system/commands/${commandId}/run`);
        }
    };
    const breadcrumbLinks = [
        { text: "Sistema", href: "/system" },
        { text: "Commands", href: "/system/commands" },
        // { text: `${model.name}`, href: "#" },
    ];
</script>

<Main {breadcrumbLinks}>
    <ToolBar class="justify-between">
        <Navigation class="horizontal subnav" {routes} />
        <SearchInput url="/system/commands" {q} />
    </ToolBar>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        {#each Object.entries(commands) as [key, value]}
            <div
                class="bg-normal rounded-md shadow-md dark:bg-dark dark:border-dark"
            >
                <div class="command-name dark:bg-dark underlined-4">
                    {key}
                </div>
                {#each value as { id, subcommand, description }}
                    <section class="flex justify-between items-center">
                        <div class="subcommand">
                            <span class="signature"> {subcommand}</span>
                            <div class="description">
                                {@html description}
                            </div>
                        </div>
                        <button
                            class="bg-dark text-light dark:bg-darker"
                            on:click={runCommand(subcommand, id)}
                            data-command={id}
                        >
                            <Icon
                                icon={faCirclePlay}
                                size="lg"
                                color="red"
                                class="text-light dark:text-light"
                                text="Run"
                            />
                        </button>
                    </section>
                {/each}
            </div>
        {/each}
    </div>
</Main>

<style>
    .command-name {
        @apply font-semibold  text-lg py-2 px-2 rounded-t-md;
    }
    .subcommand {
        @apply px-4 py-2;
    }
    .subcommand .signature {
        @apply font-semibold;
    }
    .subcommand .description {
        @apply text-sm;
    }
    button {
        @apply cursor-pointer flex items-center rounded-full py-1.5 px-4 uppercase text-[75%] font-semibold mr-4;
    }
</style>
