<script lang="ts">
    import { base } from "@/lib/scripts/userStore";
//   import ApexCharts from "apexcharts";
  import { onMount } from "svelte";

    let leadsWidget: HTMLDivElement

	onMount(async () =>{
        const data = await fetch(base+'/api/chart.php?total')
        .then(async (res)=>{
            if (res.status === 200) {
                const lastweek = await res.json()
                return lastweek
            }

            if (res.status === 400) {
                return new Array(5).fill(0);
            }
        })

        var options = {
            series: data,
            chart: {
                foreColor: '#898989',
                height: 300,
                type: 'radialBar',
            },
            // colors: ['#007eff', '#ea9715', '#fb3d4e'],
            plotOptions: {
                radialBar: {
                    track: {
                        show: false,
                    },
                    dataLabels: {
                        name: {
                            fontSize: '22px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            // color: '#fce',
                            formatter: function (w: { config: { series: number[]; }; }) {
                                // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                                let t = 0
                                w.config.series.forEach((element: number) => {
                                    t+= element
                                });
                                return t
                            }
                        }
                    }
                }
            },
            labels: ['Inprogress', 'Completed', 'On-held','Not-Started','Cancelled'],
        };

        const ApexCharts = (await import("apexcharts")).default;
        var chart = new ApexCharts(leadsWidget, options);
	    chart.render();
    })
</script>

<div class="card">
    <div class="card-body">
        <div class="d-flex m-b-30 no-block">
            <h5 class="card-title m-b-0 align-self-center">Project Summary</h5>
            <div class="ml-auto">This Year</div>
        </div>
        <div bind:this={leadsWidget} class="c3" />
        <ul class="list-inline m-t-30 text-center font-12">
            <li class="p-b-10">
            <span class="label label-default label-rounded"
                ><i class="fa fa-circle text-default" /> New</span
            >
            </li>
            <li class="p-b-10">
            <span class="label label-danger label-rounded"
                ><i class="fa fa-circle text-danger" />Cancelled</span
            >
            </li>
            <li class="p-b-10">
            <span class="label label-info label-rounded"
                ><i class="fa fa-circle text-info" />Not Started</span
            >
            </li>
            <li class="p-b-10">
            <span class="label label-warning label-rounded"
                ><i class="fa fa-circle text-warning" />In Progress</span
            >
            </li>
            <li class="p-b-10">
            <span class="label label-lime label-rounded"
                ><i class="fa fa-circle text-lime" />On Hold</span
            >
            </li>
            <li class="p-b-10">
            <span class="label label-success label-rounded"
                ><i class="fa fa-circle text-success" /> Completed</span
            >
            </li>
        </ul>
    </div>
</div>