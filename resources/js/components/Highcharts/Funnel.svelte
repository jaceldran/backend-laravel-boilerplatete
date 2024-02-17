<script>
    import { onMount } from "svelte";
    import { colorScheme } from "@/stores/colorScheme.js";
    import { numberFormat } from "@/utils.js";
    import Highcharts from "highcharts";
    import Funnel from "highcharts/modules/funnel";

    import darkTheme from "@/components/Highcharts/darkTheme.js";
    import lightTheme from "@/components/Highcharts/lightTheme.js";

    export let title;

    const id = `id_${Math.random().toString(36).substring(2)}`;

    Funnel(Highcharts);

    let chart;

    const options = {
        chart: {
            type: "funnel",
        },
        title: false,
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    outline: "0",
                    inside: true,
                    format: "<b>{point.name}</b> ({point.y:,.0f})",
                    softConnector: true,
                    // color: "white",
                    // style: {
                    //     textOutline: "none",
                    // },
                },
                // center: ["40%", "50%"],
                center: ["50%", "50%"],
                neckWidth: "30%",
                neckHeight: "25%",
                width: "90%",
            },
        },
        legend: {
            enabled: false,
        },
        series: [
            {
                name: "Unique users",
                data: [
                    ["Website visits", 15654],
                    ["Downloads", 4064],
                    ["Requested price list", 1987],
                    ["Invoice sent", 976],
                    ["Finalized", 846],
                ],
            },
        ],

        // responsive: {
        //     rules: [
        //         {
        //             condition: {
        //                 maxWidth: 500,
        //             },
        //             chartOptions: {
        //                 plotOptions: {
        //                     series: {
        //                         dataLabels: {
        //                             inside: true,
        //                         },
        //                         center: ["50%", "50%"],
        //                         width: "100%",
        //                     },
        //                 },
        //             },
        //         },
        //     ],
        // },
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

    // Highcharts.chart("funnel-container", {
    //     chart: {
    //         type: "funnel",
    //     },
    //     title: {
    //         text: "Sales funnel",
    //     },
    //     plotOptions: {
    //         series: {
    //             dataLabels: {
    //                 enabled: true,
    //                 format: "<b>{point.name}</b> ({point.y:,.0f})",
    //                 softConnector: true,
    //             },
    //             center: ["40%", "50%"],
    //             neckWidth: "30%",
    //             neckHeight: "25%",
    //             width: "80%",
    //         },
    //     },
    //     legend: {
    //         enabled: false,
    //     },
    //     series: [
    //         {
    //             name: "Unique users",
    //             data: [
    //                 ["Website visits", 15654],
    //                 ["Downloads", 4064],
    //                 ["Requested price list", 1987],
    //                 ["Invoice sent", 976],
    //                 ["Finalized", 846],
    //             ],
    //         },
    //     ],

    //     responsive: {
    //         rules: [
    //             {
    //                 condition: {
    //                     maxWidth: 500,
    //                 },
    //                 chartOptions: {
    //                     plotOptions: {
    //                         series: {
    //                             dataLabels: {
    //                                 inside: true,
    //                             },
    //                             center: ["50%", "50%"],
    //                             width: "100%",
    //                         },
    //                     },
    //                 },
    //             },
    //         ],
    //     },
    // });
</script>

<div class={$$props.class}>
    <div {id} class="w-full h-full"></div>
</div>
