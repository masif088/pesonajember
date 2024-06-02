<div class="card">
    <div class="card-body">
        <div class="grid grid-cols-12 gap-6">
            <div class="lg:col-span-4 md:col-span-12 sm:col-span-12 col-span-12">
                <div class="flex flex-col h-full items-start ">
                    <div class="text-start">
                        <h5 class="card-title">
                            REPORT HASIL USAHA
                        </h5>
                        <span class="card-subtitle">
                            Mei
                            1, 2024 -
                            Juni 1,
                            2024
                        </span>
                    </div>
                    <div class="lg:mt-auto mt-5 w-full">
                        <span>
                            Total Omzet
                            <span class="text-success">+9.78%</span>
                        </span>
                        <h2 class="text-[28px] font-medium py-4">
                            Rp. 8.240.000</h2>
                        <span>Peningkatan 15% dari bulan lalu</span>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-8 md:col-span-12 sm:col-span-12 col-span-12">
                <div class="w-full">
                    <div class="md:flex items-start gap-3">

                        <div class="ms-auto">
                            <select>
                                <option selected="">Maret
                                    2024
                                </option>
                                <option>April
                                    2024
                                </option>
                                <option>Mei
                                    2024
                                </option>
                                <option>Juni
                                    2024
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 -me-4">
                        <div id="financial" style="min-height: 215px;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var chart = {
                series: [
                    {
                        name: "Pengeluaran",
                        data: [28, 120, 36, 90, 38, 85,],
                    },
                    {
                        name: "Penjualan",
                        data: [50, 100, 65, 140, 32, 60],
                    },
                    {
                        name: "Pendapatan",
                        data: [100, 50, 130, 70, 135, 80],
                    },
                ],
                chart: {
                    toolbar: {
                        show: false,
                    },
                    type: "line",
                    fontFamily: "inherit",
                    foreColor: "#adb0bb",
                    height: 200,
                    offsetX: -10
                },
                colors: ["var(--color-error)", "#615dff", "var(--color-success)"],
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    show: false,
                },
                stroke: {
                    curve: "smooth",
                    width: 3,
                },
                grid: {
                    borderColor: "rgba(0,0,0,0.1)",
                    strokeDashArray: 3,
                    xaxis: {
                        lines: {
                            show: false,
                        },
                    },
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0,
                    },
                },
                xaxis: {
                    categories: [
                        "1-5 Mei",
                        "6-10 Mei",
                        "11-15 Mei",
                        "16-20 Mei",
                        "21-25 Mei",
                        "26-30 Mei",
                    ],
                },
                yaxis: {
                    tickAmount: 4,
                },
                tooltip: {
                    theme: "dark",
                },
            };

            var chart = new ApexCharts(document.querySelector("#financial"), chart);
            chart.render();

            var chart2 = {
                series: [
                    {
                        name: "Hours",
                        data: [22.5, 34.3, 24.7, 28.5, 11.4, 30.6, 44.5],
                    },
                ],
                chart: {
                    height: 350,
                    type: "area",
                    fontFamily: "inherit",
                    foreColor: "#adb0bb",
                    toolbar: {
                        show: false,
                    },
                    sparkline: {
                        enabled: true
                    },
                    dropShadow: {
                        enabled: true,
                        top: 3,
                        left: 0,
                        blur: 5,
                        color: "#000",
                        opacity: 0.2,
                    },
                },
                colors: ["#615dff"],
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                    colors: ["#615dff"],
                    width: 2,
                },
                fill: {
                    type: "gradient",
                },
                markers: {
                    show: false,
                },
                grid: {
                    show: false,
                },
                yaxis: {
                    show: false,
                },
                xaxis: {
                    type: "category",
                    categories: ["Su", "Mo", "Tu", "Wed", "Th", "Fr", "Sa"],

                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                legend: {
                    show: false,
                },
                tooltip: {
                    theme: "dark",
                },
            };

            var chart2 = new ApexCharts(
                document.querySelector("#activity-status"),
                chart2
            );
            chart2.render();

            var chart3 = {
                chart: {
                    type: "radialBar",
                    fontFamily: "inherit",
                    foreColor: "#adb0bb",
                    height: 305,
                },
                series: [45, 50, 60, 70],
                colors: ['#615dff', '#fa896b', '#ffae1f', '#3dd9eb'],
                plotOptions: {
                    radialBar: {
                        hollow: {
                            margin: 15,
                            size: "50%"
                        },
                        dataLabels: {
                            total: {
                                show: true,
                                label: 'Team'
                            }
                        }
                    }
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "dark",
                        type: "vertical",
                        gradientToColors: ["#615dff"],
                        stops: [0, 100]
                    }
                },
                stroke: {
                    lineCap: "round",
                },
                labels: ['Team A', 'Team B', 'Team C', 'Team D'],
                tooltip: {
                    enabled: true,
                    theme: "dark",
                    fillSeriesColor: false,
                },
            };

            new ApexCharts(
                document.querySelector("#team-performance"),
                chart3
            ).render();


            // Toaster Js
            setTimeout(() => {
                if (document.getElementById('dismiss-toast')) {
                    document.getElementById('dismiss-toast').classList.add('hs-removing');
                    document.getElementById('dismiss-toast').classList.remove('show-toast');
                    setTimeout(() => {
                        document.getElementById('dismiss-toast').remove();
                    }, 300);
                }
                else { }
            }, 5000)

            setTimeout(() => {
                document.getElementById('dismiss-toast').classList.add('show-toast');
            }, 1000)



        });

    </script>
    <div class="sm:border-t border-border dark:border-darkborder">
        <div class="grid grid-cols-12">
            <div
                class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-12 border-e border-border dark:border-darkborder">
                <div class="p-6">
                    <div class="flex items-center">
                        <i class="ti ti-point-filled text-error text-xl -ms-1"></i>
                        <span class="text-error text-base">Pengeluaran</span>
                    </div>
                    <h5 class="text-2xl font-medium mt-1">Rp. 3.350.000</h5>
                </div>
            </div>
            <div
                class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-12 border-e border-border dark:border-darkborder">
                <div class="p-6">
                    <div class="flex items-center">
                        <i class="ti ti-point-filled text-primary text-xl -ms-1"></i>
                        <span class="text-primary text-base">Penjualan</span>
                    </div>
                    <h5 class="text-2xl font-medium mt-1">1.500</h5>
                </div>
            </div>
            <div class="lg:col-span-4 md:col-span-4 sm:col-span-4 col-span-12">
                <div class="p-6">
                    <div class="flex items-center">
                        <i class="ti ti-point-filled text-success text-xl -ms-1"></i>
                        <span class="text-success text-base">Pendapatan</span>
                    </div>
                    <h5 class="text-2xl font-medium mt-1">Rp. 8.2430.000</h5>
                </div>
            </div>
        </div>
    </div>
</div>
