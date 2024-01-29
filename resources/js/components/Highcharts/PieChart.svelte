<script>
    import { onMount } from "svelte";
    import { colorScheme } from "@/stores/colorScheme.js";
    import tailwind from "tailwindcss/colors";
    import { jsonRender } from "@/utils.js";
    import Highcharts from "highcharts";
    import darkTheme from "@/components/Highcharts/darkTheme.js";
    import lightTheme from "@/components/Highcharts/lightTheme.js";

    export let title;
    export let apply;
    export let data;

    const id = `id_${Math.random().toString(36).substring(2)}`;

    let chart;

    const options = {
        chart: {
            type: "pie",
        },
        title: { text: title },
        tooltip: {
            valueSuffix: "%",
        },
        // plotOptions: {
        //     series: {
        //         allowPointSelect: true,
        //         cursor: "pointer",
        //         dataLabels: [
        //             {
        //                 enabled: true,
        //                 distance: 20,
        //             },
        //             {
        //                 enabled: true,
        //                 distance: -40,
        //                 format: "{point.percentage:.1f}%",
        //                 style: {
        //                     fontSize: ".8em",
        //                     textOutline: "none",
        //                     opacity: 0.7,
        //                 },
        //                 filter: {
        //                     operator: ">",
        //                     property: "percentage",
        //                     value: 10,
        //                 },
        //             },
        //         ],
        //     },
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

<div {id} class={apply}></div>
