<script>
    import { onMount } from "svelte";
    import { colorScheme } from "@/stores/colorScheme.js";
    import { numberFormat } from "@/utils.js";
    import Highcharts from "highcharts";
    import Bullet from "highcharts/modules/bullet";

    import darkTheme from "@/components/Highcharts/darkTheme.js";
    import lightTheme from "@/components/Highcharts/lightTheme.js";

    const id = `bullet_${Math.random().toString(36).substring(2)}`;

    export let title;
    export let height;

    Bullet(Highcharts);

    let chart;
    let options;

    // global
    Highcharts.setOptions({
        chart: {
            inverted: true,
            marginLeft: 0,
            marginRight: 0,
            type: "bullet",
        },
        title: false,
        legend: false,
        xAxis: {
            categories: ["cat 1"],
        },
        yAxis: {
            gridLineWidth: 0,
        },
        plotOptions: {
            series: {
                pointPadding: 0.25,
                borderWidth: 0,
                color: "#000",
                targetOptions: {
                    width: "200%",
                },
            },
            tooltip: {
                pointFormat: "<b>{point.y}</b> (with target at {point.target})",
            },
        },
    });

    // custom
    options = {
        yAxis: {
            labels: {
                style: {
                    color: "#999",
                },
            },
            plotBands: [
                {
                    from: 0,
                    to: 150,
                    color: "#666",
                },
                {
                    from: 150,
                    to: 225,
                    color: "#999",
                },
                {
                    from: 225,
                    to: 9e9,
                    color: "#bbb",
                },
            ],
        },
        series: [
            {
                data: [
                    {
                        y: 275,
                        target: 300,
                    },
                ],
            },
        ],
        tooltip: {
            pointFormat: "<b>***{point.y}</b> (with target at {point.target})",
        },
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

<div {id} class="w-full {height} {$$props.class}"></div>
