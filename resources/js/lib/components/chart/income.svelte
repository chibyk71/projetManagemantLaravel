<script lang="ts">
import { onMount } from "svelte";
onMount(async () => {
    const data = await fetch('/api/home/',{method:'post', body:JSON.stringify({type:'lastweek'})})
    .then(async (res)=>{
        if (res.status === 200) {
            const lastweek = await res.json()
            return lastweek
        }

        if (res.status === 400) {
            return new Array(7).fill(0);
        }
    })

    var options = {
        series: [{
            name: "Projects",
            data: data
        }, ],
        chart: {
            foreColor: "#ffceff",
            height: 350,
            type: "area",
            zoom: {
                enabled: false,
            },
        },
        colors: ["#f00"],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            curve: "smooth",
            lineCap: "butt",
            colors: undefined,
            width: 2,
            dashArray: 0,
        },
        markers: {
            size: 2,
            colors: "#ea9715",
            strokeColors: "#ffffff",
            strokeWidth: 2,
            strokeOpacity: 0.9,
            strokeDashArray: 0,
            fillOpacity: 1,
            discrete: [],
            shape: "circle",
            radius: 5,
            offsetX: 0,
            offsetY: 0,
            onClick: undefined,
            onDblClick: undefined,
            hover: {
                size: undefined,
                sizeOffset: 3,
            },
        },
        grid: {
            borderColor: "#f7f7f7",
            row: {
                colors: ["transparent"], // takes an array which will be repeated on columns
                opacity: 0,
            },
            yaxis: {
                lines: {
                    show: true,
                },
            },
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.01,
                opacityTo: 1,
                stops: [0, 90, 100],
            },
        },
        xaxis: {
            categories: [
                "Mon",
                "Tue",
                "wed",
                "thu",
                "fri",
                "sat",
                "sun",
            ],
            labels: {
                show: true,
            },
            axisBorder: {
                show: true,
            },
            axisTicks: {
                show: true,
            },
            tooltip: {
                enabled: true,
            },
        },
        yaxis: {
            labels: {
                show: true,
            },
        },
    };

    const ApexCharts = (await import('apexcharts')).default
    var chart = new ApexCharts( document.querySelector("#admin-dhasboard-income-vs-expenses"), options);
    chart.render();
});
</script>

<div class="card">
    <div class="card-body">
        <div class="d-flex m-b-30">
            <h5 class="card-title m-b-0 align-self-center">Uploaded Project</h5>
            <div class="ml-auto align-self-center">
                <ul class="list-inline font-12">
                    <li>
                        <span class="label label-success label-rounded"><i class="fa fa-circle" /> Projects</span>
                    </li>
                    <li>
                        <span class="label label-info label-rounded"><i class="fa fa-circle text-info" /> Days</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="incomeexpenses ct-charts" id="admin-dhasboard-income-vs-expenses">
            <div class="chartist-tooltip">---</div>
        </div>
    </div>
</div>
