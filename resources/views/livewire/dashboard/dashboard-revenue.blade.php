<div >
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Omzet</h5>
            <p class="card-subtitle">Tahun {{ \Carbon\Carbon::now()->year-1 }} - {{ \Carbon\Carbon::now()->year }}</p>
            <div class="">
                <div id="salary" ></div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        // =====================================
        // Salary
        // =====================================
        var salary = {
            series: [
                {
                    name: "Omzet {{ \Carbon\Carbon::now()->year }}",
                    data: [
                        @foreach($data[\Carbon\Carbon::now()->year] as $d)

                            {{ $d }},

                        @endforeach
                    ],
                },
                {
                    name: "Omzet {{ \Carbon\Carbon::now()->year-1 }}",
                    data: [
                        @foreach($data[\Carbon\Carbon::now()->year-1] as $d)

                            {{ $d }},

                        @endforeach
                    ],
                },
            ],

            chart: {
                toolbar: {
                    show: false,
                },
                height: 260,
                type: "bar",
                fontFamily: "inherit",
                foreColor: "#adb0bb",

            },

            plotOptions: {
                bar: {
                    borderRadius: 4,
                    columnWidth: "55%",
                    distributed: false,
                    endingShape: "rounded",

                },

            },

            dataLabels: {
                enabled: false,
            },
            legend: {
                show: false,
            },
            grid: {
                yaxis: {
                    lines: {
                        show: false,
                    },
                },
                xaxis: {
                    lines: {
                        show: false,
                    },
                },
            },
            xaxis: {
                categories: [["Januari"], ["Februari"], ["Maret"], ["April"], ["Mei"], ["Juni"],["Juli"],["Agustus"],["September"],["November"],["Desember"]],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                labels: {
                    show: false,
                },
            },
            tooltip: {
                theme: "dark",
            },
        };

        var chart = new ApexCharts(document.querySelector("#salary"), salary);
        chart.render();
        });
    </script>
</div>
