<script>
    import { onMount } from "svelte";
    import { colorScheme } from "@/stores/colorScheme.js";
    import { numberFormat } from "@/utils.js";
    import Highcharts from "highcharts";
    import darkTheme from "@/components/Highcharts/darkTheme.js";
    import lightTheme from "@/components/Highcharts/lightTheme.js";

    export let title;
    export let height;
    export let width;
    export let data;

    const id = `id_${Math.random().toString(36).substring(2)}`;

    let chart;

    const options = {
        chart: {
            type: "pie",
        },
        // title: {
        //     text: title,
        //     align: "center",
        // },
        // tooltip: {
        //     valueSuffix: "%",
        // },
        series: [data],
    };

    const renderChart = () => {
        if (chart) {
            chart.destroy();
        }

        if ($colorScheme === "dark") {
            Highcharts.setOptions(darkTheme);
        } else {
            Highcharts.setOptions(lightTheme);
        }

        chart = new Highcharts.Chart(id, options);
    };

    onMount(() => {
        colorScheme.subscribe((val) => {
            renderChart();
        });
    });
</script>

<!-- <div class="text-center">{title || ""}</div> -->

<div {id} class="w-full h-auto"></div>

<!-- <section class="grid grid-cols-3 shadow-md mt-4 mx-auto w-2/3 text-sm">
    {#each data.data as item}
        <div class="rowitem">{item.name}</div>
        <div class="rowitem text-right">
            {numberFormat(item.y)}
        </div>
        <div class="rowitem text-right">
            {numberFormat(item.y, { compact: true })}
        </div>
    {/each}
</section>

<style>
    .rowitem {
        @apply border-b p-1;
    }
</style> -->
