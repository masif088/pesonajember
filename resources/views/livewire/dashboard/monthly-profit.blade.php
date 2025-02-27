<div class="card p-5">
    <div class="card-header card-no-border">

        <h5 class=" text-xl">Monthly Profits</h5>
        <h5 class=" text-md text-gray-500">Total Peningkatan
            <font class="{{ increase_check($increase) }} text-sm">
                {!! $icon !!} {{ $increase }}%
            </font>
        </h5>

    </div>

        <div class="card-body pt-0">
            <div class="monthly-profit">
                <div id="profitmonthly"></div>
            </div>
        </div>


        <script>
            document.addEventListener('livewire:init', function () {
                var optionsprofit = {
                    labels: ["By Order", "E-Catalog", "Pinjam Bendera"],
                    series: [
                        @foreach($profits  as $to)

                            {{ $to }},

                        @endforeach
                    ],
                    chart: {
                        type: "donut",
                        height: 275,
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    legend: {
                        position: "bottom",
                        fontSize: "14px",
                        fontFamily: "Rubik, sans-serif",
                        fontWeight: 500,
                        labels: {
                            colors: "var(--chart-text-color)",
                        },
                        markers: {
                            width: 6,
                            height: 6,
                        },
                        itemMargin: {
                            horizontal: 7,
                            vertical: 0,
                        },
                    },
                    stroke: {
                        width: 10,
                        colors: ["var(--light2)"],
                    },
                    plotOptions: {
                        pie: {
                            expandOnClick: false,
                            donut: {
                                size: "83%",
                                labels: {
                                    show: true,
                                    name: {
                                        offsetY: 4,
                                    },
                                    total: {
                                        show: true,
                                        fontSize: "20px",
                                        fontFamily: "Rubik, sans-serif",
                                        fontWeight: 500,
                                        label: "Rp. {{ thousand_format($totalProfit/1000000) }}Jt",
                                        formatter: () => "Total Profit",
                                    },
                                    value: {
                                        formatter: function (value) {

                                            return "Rp. " + (Math.round(value)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                        }
                                    }
                                },
                            },
                        },
                    },
                    states: {
                        normal: {
                            filter: {
                                type: "none",
                            },
                        },
                        hover: {
                            filter: {
                                type: "none",
                            },
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: "none",
                            },
                        },
                    },
                    colors: ["#54BA4A", "#7a6eff", "#FFA941"],
                    responsive: [
                        {
                            breakpoint: 1425,
                            options: {
                                chart: {
                                    height: 270,
                                },
                            },
                        },
                        {
                            breakpoint: 1400,
                            options: {
                                chart: {
                                    height: 320,
                                },
                            },
                        },
                        {
                            breakpoint: 480,
                            options: {
                                chart: {
                                    height: 250,
                                },
                            },
                        },
                    ],
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return "Rp. " + (Math.round(value)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }
                        },
                    },
                    xaxis: {
                        labels: {
                            formatter: function (value) {
                                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }
                        }
                    }
                };

                var chartprofit = new ApexCharts(document.querySelector("#profitmonthly"), optionsprofit);
                chartprofit.render();
            });
        </script>
    </div>
