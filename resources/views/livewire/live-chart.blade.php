<div class="container mx-auto">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-chart">
                <div id="chart" class="chart" wire:poll="dadadada"></div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    </script>
    <script>
       
        document.addEventListener('livewire:load', function() {

            // Livewire hooks for handling updates
            Livewire.hook('message.sent', (message, component) => {
                // // Reload the chart data when Livewire sends a message
                // if (message.updateChart) {
                //     updateChart(message);
                // }
            });
     
        });

        // function updateChart(datas) {
        //     var options = {
        //         chart: {
        //             type: 'bar',
        //             height: 350
        //         },
        //         plotOptions: {
        //             bar: {
        //                 borderRadius: 4,
        //                 horizontal: true,
        //             }
        //         },
        //         series: [{
        //             name: 'Jumlah Suara',
        //             data: datas.map(item => item.data)
        //         }],
        //         xaxis: {
        //             categories: datas.map(item => item.label)
        //         }
        //     };

        //     var chart = new ApexCharts(document.querySelector("#chart"), options);
        //     chart.render();
        // }

        // // Initial rendering of the chart
        // updateChart(datas);
    </script>
</div>
