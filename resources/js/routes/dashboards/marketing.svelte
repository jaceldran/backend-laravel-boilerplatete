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

    <div id="dashboard" class="flex-1 outline bg-green-100 flex">
        <div class="bg-red-100 text-red-900 w-1/4 flex flex-col">
            <div class="widget bg-red-200">
                <b>column 1 - widget 1</b>
                <p>La altura de este se adapta al contenido</p>
            </div>
            <div class="widget gb-red-300 flex-1">
                <b>column 1 - widget 2</b>
                <p>la altura de este ocupa el resto disponible</p>
            </div>
        </div>
        <div class="bg-blue-100 w-2/4">column 2</div>
        <div class="bg-fuchsia-100 w-1/4">column 3</div>
    </div>
</Main>
