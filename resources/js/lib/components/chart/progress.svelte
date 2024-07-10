<script lang="ts">
  import { onMount } from "svelte";
    export let data;

    const options = {
        series: [data],
        chart: {
            height: 180,
            width: 200,
            type: "radialBar"
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 225,
                hollow: {
                    margin: 0,
                    size: "50%",
                    background: "#fff",
                    image: undefined,
                    imageOffsetX: 0,
                    imageOffsetY: 0,
                    position: "front",
                    dropShadow: {
                        enabled: true,
                        top: 0,
                        left: 0,
                        blur: 4,
                        opacity: 0.24,
                    },
                },
                track: {
                    background: "#fff",
                    strokeWidth: "70%",
                    margin: 0, // margin is in pixels
                    dropShadow: {
                        enabled: true,
                        top: -3,
                        left: 0,
                        blur: 4,
                        opacity: 0.35,
                    },
                },

                dataLabels: {
                    show: true,
                    name: {
                        show: false,
                    },
                    value: {
                        formatter: function (val: string) {
                            return val+'%';
                        },
                        color: "#111",
                        fontSize: "16px",
                        show: true,
                        center:true
                    },
                },
            },
        },
        fill: {
            type: "gradient",
            gradient: {
            shade: "dark",
            type: "horizontal",
            shadeIntensity: 0.5,
            gradientToColors: ["#ABE5A1"],
            inverseColors: true,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100],
            },
        },
        stroke: {
            lineCap: "round",
        },
    };

    onMount(async () => {
        const ApexCharts = (await import("apexcharts")).default

        const chart = new ApexCharts(document.querySelector("#project_progress_chart"), options);
        chart.render();
    })
</script>

<div id="project_progress_chart" class="c3" />
