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

<Main>
    <ToolBar class="justify-between">
        <Navigation class="horizontal" {routes} />
        <button on:click={expand}>
            <Icon size="lg" icon={faExpand} />
        </button>
    </ToolBar>

    <div class="">
        <Funnel title="Funel de ventas" />
    </div>

    <div class="flex flex-col gap-4">
        <div class="">
            <Bullet title="Objetivos de Leads" height="h-[120px]" />
        </div>
        <div class="">
            <Bullet title="Objetivos de ventas" height="h-[120px]" />
        </div>
    </div>

    <!-- <div class="">
        <div class="outline block lg:float-left">
            <Pie title="Ventas por producto" data={salesByProduct} />
        </div>
        <div class="outline block lg:float-right">
            <Pie title="Ventas por categoría" data={salesByCategory} />
        </div>
    </div> -->

    <div class="flex text-center">
        <div class="inline-block w-1/2">
            <Pie title="Ventas por producto" data={salesByProduct} />
        </div>
        <div class="inline-block w-1/2">
            <Pie title="Ventas por categoría" data={salesByCategory} />
        </div>
    </div>

    <!-- <div class="flex w-full flex-justify-between">
        <div class="flex flex-col w-1/2">
            <div class="flex gap-4">
            </div>

            <div class="flex justify-center">
                <div class="flex-1">
                </div>
                <div class="flex-1">
                </div>
            </div>
        </div>

        <div class="flex w-1/2">
        </div>
    </div> -->

    <!-- <div class="flex justify-between gap-4">
        <Bullet title="Objetivos de Leads" height="h-[120px]" />

        <Bullet title="Objetivos de ventas" height="h-[120px]" />
    </div>

    <div class="flex justify-between">
        <div class="">
            <Pie title="Ventas por producto" data={salesByProduct} />
        </div>

        <div class="">
            <Funnel title="Funel de ventas" class="" />
        </div>
    </div> -->

    <!-- <Pie title="Ventas por categoría" data={salesByCategory} />

    <Funnel title="Funel de ventas" class="" /> -->

    <!-- <div class="flex items-center justify-center gap-4 w-full-200 py-4">
    </div> -->
</Main>
