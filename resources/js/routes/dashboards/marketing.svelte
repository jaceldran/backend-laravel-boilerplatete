<script>
    import Pie from "@/components/Highcharts/Pie.svelte";
    import Bullet from "@/components/Highcharts/Bullet.svelte";
    import Funnel from "@/components/Highcharts/Funnel.svelte";
    import ToolBar from "@/components/ui/ToolBar.svelte";
    import Navigation from "@/components/ui/Navigation.svelte";
    import Main from "@/layouts/App.svelte";
    import Icon from "@/components/ui/Icon.svelte";
    import { faExpand } from "@fortawesome/free-solid-svg-icons";

    export let salesByProduct;
    export let salesByCategory;

    const routes = [
        { text: "Marketing", href: "/dashboards/marketing", active: true },
        { text: "Académico", href: "/dashboards/marketing", active: false },
        { text: "Financiero", href: "/dashboards/marketing", active: false },
    ];

    const expand = () => {
        alert("cambiar a modo fullscreen");
    };
</script>

<Main class="flex flex-col h-svh">
    <ToolBar class="justify-between">
        <Navigation class="horizontal" {routes} />
        <button on:click={expand}>
            <Icon size="lg" icon={faExpand} />
        </button>
    </ToolBar>

    <div id="dashboard" class="flex-1 outline bg-green-100 flex max-h-full">
        <div class="panel bg-red-100 text-red-900 w-1/4 flex flex-col">
            <div class=" widget bg-neon-50">
                <Pie data={salesByCategory} />
            </div>
            <div class=" widget bg-neon-50">
                <Pie data={salesByCategory} />
            </div>
        </div>

        <div class="panel bg-blue-100 flex-1">
            <Funnel />
        </div>

        <div class="panel bg-fuchsia-100 flex-col w-1/4">
            <div class="widget bg-neon-100">
                <Pie data={salesByProduct} />
            </div>
            <div class="widget bg-neon-100">
                <Pie data={salesByProduct} />
            </div>
        </div>
    </div>
</Main>

<style>
    .panel {
        @apply flex justify-center;
    }
    .widget {
        @apply flex-1 border border-dotted border-red-600;
    }
</style>
