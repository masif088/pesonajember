@php
    use App\Models\Customer;use App\Models\Order;use App\Models\OrderProofOfCash;use App\Models\OrderSharingDetail;use Carbon\Carbon;

@endphp
<x-admin-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>
    <x-slot name="breadcrumb">
        <a href="#">Dashboard</a>
    </x-slot>
    <div class="grid grid-cols-12 gap-3">

        <div class="lg:col-span-4 col-span-12">
            <div class="card">
                <div class="card-body bg-gray-50 rounded flex gap-3 align-middle p-3">
                    <div class="bg-green-200 rounded-full my-auto"
                         style="width: 64px !important;height: 64px !important;; padding: 20px 0">
                        <span class="iconify text-green-900 text-2xl mx-auto"
                              data-icon="icon-park-solid:wallet"></span>
                    </div>

                    <div class="w-8/12">

                        <table style="height: 100%; width: 100%">
                            <tr>
                                <td class="align-middle">
                                    <h6 class="font-medium mb-2">Pendapatan Bulan ini</h6>
                                    <h4 class="text-green-900 flex justify-between text-lg">
                                        @php
                                            $now = Carbon::now();
                                            $totalIncome = OrderProofOfCash::whereMonth('created_at',$now->month)->whereYear('created_at',$now->year)->sum('nominal');
                                            $prevMonth = $now->subMonth();
                                            $totalIncomePrev = OrderProofOfCash::whereMonth('created_at',$prevMonth->month)->whereYear('created_at',$prevMonth->year)->sum('nominal');
                                            $increase = 0;
                                            $icon = '-';
                                            if ($totalIncome==0 || $totalIncomePrev==0 || $totalIncome==$totalIncomePrev){
                                                $increase = 0;
                                            }else{
                                                $increase = number_format(($totalIncome-$totalIncomePrev)/$totalIncomePrev*100,2,',','.');
                                            }
                                             if ($increase < 0) {
                                                 $icon = "<span class='iconify text-red-900' data-icon='mingcute:arrow-down-fill'></span>";
                                             } elseif ($increase > 0) {
                                                 $icon = "<span class='iconify text-green-900' data-icon='mingcute:arrow-up-fill'></span>";
                                             } else {
                                                 $icon = "<i class='text-green-500 '> </i> -";
                                             }


                                        @endphp
                                        Rp. {{ thousand_format($totalIncome) }}
                                        <font class="{{ increase_check($increase) }} text-xs flex text-nowrap">
                                            {!! $icon !!}
                                            <span>{{ $increase }}%</span>
                                        </font>

                                    </h4>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 col-span-12">
            <div class="card">
                <div class="card-body bg-gray-50 rounded flex gap-3 align-middle p-3">
                    <div class="bg-green-200 rounded-full my-auto"
                         style="width: 64px !important;height: 64px !important;; padding: 20px 0">
                                <span class="iconify text-green-900 text-2xl mx-auto"
                                      data-icon="icon-park-solid:wallet"></span>
                    </div>

                    <div class="w-8/12">

                        <table style="height: 100%; width: 100%">
                            <tr>
                                <td class="align-middle">
                                    <h6 class="font-medium mb-2">Transaksi Bulan ini</h6>
                                    <h4 class="text-green-900 flex justify-between text-lg">
                                        @php
                                            $now = Carbon::now();
                                                $totalTransaction = Order::whereMonth('created_at',$now->month)->whereYear('created_at',$now->year)->count();
                                                $prevMonth = $now->subMonth();
                                                $totalTransactionPrev = Order::whereMonth('created_at',$prevMonth->month)->whereYear('created_at',$prevMonth->year)->count();
                                                $increase = 0;
                                                $icon = '-';
                                                if ($totalTransaction==0 || $totalTransactionPrev==0 || $totalTransaction==$totalTransactionPrev){
                                                    $increase = 0;
                                                }else{
                                                    $increase = number_format(($totalTransaction-$totalTransactionPrev)/$totalTransactionPrev*100,2,',','.');
                                                }
                                     if ($increase < 0) {
                                                 $icon = "<span class='iconify text-red-900' data-icon='mingcute:arrow-down-fill'></span>";
                                             } elseif ($increase > 0) {
                                                 $icon = "<span class='iconify text-green-900' data-icon='mingcute:arrow-up-fill'></span>";
                                             } else {
                                                 $icon = "<i class='text-green-500 '> </i> -";
                                             }


                                        @endphp
                                        {{ thousand_format($totalTransaction) }} Transaksi
                                        <font class="{{ increase_check($increase) }} text-xs flex text-nowrap">
                                            {!! $icon !!}
                                            <span>{{ $increase }}%</span>
                                        </font>

                                    </h4>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 col-span-12">
            <div class="card">
                <div class="card-body bg-gray-50 rounded flex gap-3 align-middle p-3">
                    <div class="bg-green-200 rounded-full my-auto"
                         style="width: 64px !important;height: 64px !important;; padding: 20px 0">
                                <span class="iconify text-green-900 text-2xl mx-auto"
                                      data-icon="icon-park-solid:wallet"></span>
                    </div>

                    <div class="w-8/12">

                        <table style="height: 100%; width: 100%">
                            <tr>
                                <td class="align-middle">
                                    <h6 class="font-medium mb-2">Order Selesai Bulan ini</h6>
                                    <h4 class="text-green-900 flex justify-between text-lg">
                                        @php
                                            $total = Order::whereMonth('updated_at',$now->month)->whereYear('updated_at',$now->year)->where('status',3)->count();
                                            $prevMonth = $now->subMonth();
                                            $totalPrev = Order::whereMonth('updated_at',$prevMonth->month)->whereYear('updated_at',$prevMonth->year)->where('status',3)->count();
                                            $increase = 0;
                                            $icon = '-';
                                            if ($total==0 || $totalPrev==0){
                                                $increase = 0;
                                            }else{
                                                $increase = number_format(($total-$totalPrev)/$totalPrev*100,2,',','.');
                                            }
                                            if ($increase < 0) {
                                                 $icon = "<span class='iconify text-red-900' data-icon='mingcute:arrow-down-fill'></span>";
                                            } elseif ($increase > 0) {
                                                 $icon = "<span class='iconify text-green-900' data-icon='mingcute:arrow-up-fill'></span>";
                                            } else {
                                                 $icon = "<i class='text-green-500 '> </i> -";
                                            }
                                        @endphp
                                        {{ thousand_format($total) }} Transaksi
                                        <font class="{{ increase_check($increase) }} text-xs flex text-nowrap">
                                            {!! $icon !!}
                                            <span>{{ $increase }}%</span>
                                        </font>


                                    </h4>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="lg:col-span-12 col-span-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <h5>Order Overview</h5>
                        <div class="card-header-right-icon">
                            {{--                            <div class="dropdown icon-dropdown">--}}
                            {{--                                <button class="btn dropdown-toggle" id="orderOverview" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>--}}
                            {{--                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orderOverview"><a class="dropdown-item" href="#!">This Month</a><a class="dropdown-item" href="#!">Previous Month</a><a class="dropdown-item" href="#!">Last 3 Months</a><a class="dropdown-item" href="#!">Last 6 Months</a></div>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row m-0 overall-card overview-card grid grid-cols-12">
                        <div class="col-span-9 md:col-span-8 p-0 box-col-8 w-md-100">
                            <div class="chart-right">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card-body p-0">
                                            <ul class="balance-data">
                                                <li><span class="circle bg-primary"> </span><span class="f-light ms-1">Order Masuk</span>
                                                </li>
                                                <li><span class="circle bg-success"> </span><span class="f-light ms-1">Total Pembayaran</span>
                                                </li>
                                            </ul>
                                            <div class="current-sale-container order-container">
                                                <div class="overview-wrapper" id="orderoverview"></div>
                                                <div class="back-bar-container">
                                                    <div id="order-bar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-3 md:col-span-4  p-0 box-col-4e ds-md-none gap-3">
                            <div class="row g-sm-3 g-2 gap-3 grid grid-cols-12">
                                <div class="col-span-12 mb-4">
                                    <h2>Progress Bulan kemarin</h2>
                                </div>
                                <div class="col-span-12">
                                    <div class="light-card balance-card widget-hover">
                                        <div class="svg-box">
                                            <svg class="svg-fill">
                                                <use href="../assets/svg/icon-sprite.svg#orders"></use>
                                            </svg>
                                        </div>
                                        <div><span class="f-light">Order Masuk</span>
                                            <h6 class="mt-1 mb-0 counter">
                                                {{ thousand_format($totalTransactionPrev) }} Transaksi
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12">
                                    <div class="light-card balance-card widget-hover">
                                        <div class="svg-box">
                                            <svg class="svg-fill">
                                                <use href="{{ asset('assets/svg/icon-sprite.svg#expense')}}"></use>
                                            </svg>
                                        </div>
                                        <div><span class="f-light">Uang Masuk</span>
                                            <h6 class="mt-1 mb-0">Rp. <span class="counter"
                                                                            data-target="12678">{{ thousand_format($totalIncomePrev) }}</span>
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('livewire:init', function () {
                    var optionsoverview = {
                        series: [
                            {
                                name: "Order",
                                type: "area",
                                data: [44, 55, 35, 50, 67, 50, 55, 45, 32, 38, 45],
                            },
                            {
                                name: "Total Pembayaran",
                                type: "area",
                                data: [35, 30, 23, 40, 50, 35, 40, 52, 67, 50, 55],
                            },
                            // {
                            //     name: "Refunds",
                            //     type: "area",
                            //     data: [25, 20, 15, 25, 32, 20, 30, 35, 23, 30, 20],
                            // },
                        ],
                        chart: {
                            height: 340,
                            type: "line",
                            stacked: false,
                            toolbar: {
                                show: false,
                            },
                            dropShadow: {
                                enabled: true,
                                top: 2,
                                left: 0,
                                blur: 4,
                                color: "#000",
                                opacity: 0.08,
                            },
                        },
                        stroke: {
                            width: [2, 2, 2],
                            curve: "smooth",
                        },
                        grid: {
                            show: true,
                            borderColor: "var(--chart-border)",
                            strokeDashArray: 0,
                            position: "back",
                            xaxis: {
                                lines: {
                                    show: true,
                                },
                            },
                            padding: {
                                top: 0,
                                right: 0,
                                bottom: 0,
                                left: 0,
                            },
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: "50%",
                            },
                        },
                        colors: ["#7064F5", "#54BA4A", "#FF3364"],
                        fill: {
                            type: "gradient",
                            gradient: {
                                shade: "light",
                                type: "vertical",
                                opacityFrom: 0.4,
                                opacityTo: 0,
                                stops: [0, 100],
                            },
                        },
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov"],
                        markers: {
                            discrete: [
                                {
                                    seriesIndex: 0,
                                    dataPointIndex: 2,
                                    fillColor: "#7064F5",
                                    strokeColor: "var(--white)",
                                    size: 5,
                                    sizeOffset: 3,
                                },
                                {
                                    seriesIndex: 1,
                                    dataPointIndex: 2,
                                    fillColor: "#54BA4A",
                                    strokeColor: "var(--white)",
                                    size: 5,
                                },
                                {
                                    seriesIndex: 2,
                                    dataPointIndex: 2,
                                    fillColor: "#FF3364",
                                    strokeColor: "var(--white)",
                                    size: 5,
                                },
                                {
                                    seriesIndex: 0,
                                    dataPointIndex: 5,
                                    fillColor: "#7064F5",
                                    strokeColor: "var(--white)",
                                    size: 5,
                                    sizeOffset: 3,
                                },
                                {
                                    seriesIndex: 1,
                                    dataPointIndex: 5,
                                    fillColor: "#54BA4A",
                                    strokeColor: "var(--white)",
                                    size: 5,
                                },
                                {
                                    seriesIndex: 2,
                                    dataPointIndex: 5,
                                    fillColor: "#FF3364",
                                    strokeColor: "var(--white)",
                                    size: 5,
                                },
                                {
                                    seriesIndex: 0,
                                    dataPointIndex: 9,
                                    fillColor: "#7064F5",
                                    strokeColor: "var(--white)",
                                    size: 5,
                                    sizeOffset: 3,
                                },
                                {
                                    seriesIndex: 1,
                                    dataPointIndex: 9,
                                    fillColor: "#54BA4A",
                                    strokeColor: "var(--white)",
                                    size: 5,
                                },
                                {
                                    seriesIndex: 2,
                                    dataPointIndex: 9,
                                    fillColor: "#FF3364",
                                    strokeColor: "var(--white)",
                                    size: 5,
                                },
                            ],
                            hover: {
                                size: 5,
                                sizeOffset: 0,
                            },
                        },
                        xaxis: {
                            type: "category",
                            tickAmount: 11,
                            tickPlacement: "on",
                            tooltip: {
                                enabled: false,
                            },
                            axisBorder: {
                                color: "var(--chart-border)",
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        legend: {
                            show: false,
                        },
                        yaxis: {
                            min: 0,
                            max: 67,
                            tickAmount: 6,
                            tickPlacement: "between",
                        },
                        tooltip: {
                            shared: false,
                            intersect: false,
                        },
                        responsive: [
                            {
                                breakpoint: 1400,
                                options: {
                                    chart: {
                                        height: 325,
                                    },
                                },
                            },
                            {
                                breakpoint: 1317,
                                options: {
                                    chart: {
                                        height: 295,
                                    },
                                },
                            },
                            {
                                breakpoint: 1200,
                                options: {
                                    chart: {
                                        height: 280,
                                    },
                                },
                            },
                            {
                                breakpoint: 1142,
                                options: {
                                    chart: {
                                        height: 260,
                                    },
                                },
                            },
                            {
                                breakpoint: 992,
                                options: {
                                    chart: {
                                        height: 292,
                                    },
                                    xaxis: {
                                        type: "category",
                                        tickAmount: 5,
                                        tickPlacement: "on",
                                    },
                                },
                            },
                            {
                                breakpoint: 851,
                                options: {
                                    chart: {
                                        height: 260,
                                    },
                                },
                            },
                            {
                                breakpoint: 343,
                                options: {
                                    xaxis: {
                                        type: "category",
                                        tickAmount: 3,
                                        tickPlacement: "on",
                                    },
                                },
                            },
                        ],
                    };

                    var chartoverview = new ApexCharts(document.querySelector("#orderoverview"), optionsoverview);
                    chartoverview.render();
                });
            </script>
        </div>

        <div class="lg:col-span-4 col-span-12">


            <livewire:dashboard.monthly-profit/>


        </div>
        <div class="lg:col-span-4 col-span-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <h5>Top Customers</h5>
                    </div>
                </div>
                <div class="card-body  px-0 pt-0">
                    <div class="table-responsive custom-scrollbar">
                        <table class="table" id="top-customer" style="width: 100%">
                            <thead>
                            <tr>
                                <td style="width: 10px!important;">#</td>
                                <td>Nama Konsumen</td>
                                <td>Total Pembelian</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(Customer::get() as $index=>$customer)
                                <tr>
                                    <td style="width: 10px!important;">{{ $index+1 }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>
                                        Rp. {{ thousand_format(OrderProofOfCash::whereHas('order',function ($q) use ($customer){$q->where('customer_id',$customer->id);})->sum('nominal')) }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</x-admin-layout>


