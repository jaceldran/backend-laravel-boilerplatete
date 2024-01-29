
import tailwind from "tailwindcss/colors";

// console.log('darkTheme', tailwind.slate[500]);

export default {
    // colors: ['#FF0000', '#00FF00', '#0000FF'],
    credits: {
        enabled: false,
    },
    chart: {
        backgroundColor: 'transparent',
        style: {
            fontFamily: "Overpass",
        }
    },
    title: {
        style: {
            color: tailwind.stone[700],
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
                color: tailwind.stone[500],
            },
            style: {
                textOutline: "none",
            }
        }
    }
};
