<script>
    import Main from "@/layouts/App.svelte";
    import ToolBar from "@/components/ui/ToolBar.svelte";
    import Navigation from "@/components/ui/Navigation.svelte";
    import ObjectRender from "@/components/ui/ObjectRender.svelte";
    import { jsonRender } from "@/utils";
    import { keys } from "highcharts";

    export let model;

    const routes = [
        { text: "Modelos", href: "/system/models", active: true },
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

    const breadcrumbLinks = [
        { text: "System", href: "/system" },
        { text: "Models", href: "/system/models" },
        { text: `${model.type}`, href: "#" },
        { text: `${model.name}`, href: "#" },
    ];
</script>

<Main {breadcrumbLinks}>
    <ToolBar class="justify-between">
        <Navigation class="horizontal subnav" {routes} />
        <!-- <section class="flex gap-2">
            <button class="rounded-full bg-neon-100 px-4">
                <Icon icon={faRefresh} class="" />
            </button>
            <SearchInput url="/system-models" {q} />
        </section> -->
    </ToolBar>
    <h1 class="text-hero">{model.type} {model.name}</h1>
    <ObjectRender data={model.data} />
    <!-- <pre>{jsonRender(model.data)}</pre> -->
</Main>
