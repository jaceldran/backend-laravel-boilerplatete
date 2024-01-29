
import tailwind from "tailwindcss/colors";

export default {
    // colors: ['#FF0000', '#00FF00', '#0000FF'],
    credits: {
        enabled: false,
    },
    chart: {
        backgroundColor: tailwind.stone[700],
    },
    title: {
        style: {
            color: tailwind.stone[300],
            fontSize: '1.25rem',
            fontWeight: '400',
        }
    },
    xAxis: {
        labels: {
            style: {
                color: '#FF0000'
            }
        }
    },
    yAxis: {
        labels: {
            style: {
                color: '#00FF00'
            }
        }
    },
    plotOptions: {
        series: {
            animation: true,
            dataLabels: {
                color: tailwind.stone[300],
                style: {
                    textOutline: "none",
                }
            }
        }
    }
};
