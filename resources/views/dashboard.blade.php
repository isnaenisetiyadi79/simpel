@extends('layouts.master')

@section('title', 'Dashboard')

@section('css')
    <!-- Apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.css">
    <style type="text/css">
        .apexcharts-tooltip.apexcharts-theme-light {
            background-color: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }
    </style>
@endsection

@section('content')
    <!-- Content -->
    <div class="w-full lg:ps-64">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">

            @livewire('components.orderdetail.widget')
            <div class="grid gap-4 sm:gap-6">

                <!-- Card -->
                <div
                    class="p-4 md:p-5 min-h-102.5 flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                    <!-- Header -->
                    <div class="flex flex-wrap justify-between items-center gap-2">
                        <div>
                            <h2 class="text-sm text-gray-500 dark:text-neutral-500">
                                Total Penjualan Seminggu
                            </h2>
                            <p class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                                Rp. {{ number_format($orderdetails->sum('subtotal'), 0,',','.') }}
                            </p>
                        </div>

                        {{-- <div>
                            <span
                                class="py-[5px] px-1.5 inline-flex items-center gap-x-1 text-xs font-medium rounded-md bg-red-100 text-red-800 dark:bg-red-500/10 dark:text-red-500">
                                <svg class="inline-block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 5v14" />
                                    <path d="m19 12-7 7-7-7" />
                                </svg>
                                2%
                            </span>
                        </div> --}}
                    </div>
                    <!-- End Header -->

                    <div id="hs-single-area-chart"></div>
                </div>
                <!-- End Card -->
            </div>


        </div>
    </div>
    <!-- End Content -->
@endsection
@push('scripts')
    <!-- JS PLUGINS -->
    <!-- Required plugins -->
    <script src="https://cdn.jsdelivr.net/npm/preline/dist/index.js"></script>
    <!-- Apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/lodash/lodash.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/preline/dist/helper-apexcharts.js"></script>

    <script>
        window.addEventListener("load", () => {
            (function() {
                buildChart(
                    "#hs-multiple-bar-charts",
                    (mode) => ({
                        chart: {
                            type: "bar",
                            height: 300,
                            toolbar: {
                                show: false,
                            },
                            zoom: {
                                enabled: false,
                            },
                        },
                        series: [{
                                name: "Chosen Period",
                                data: [
                                    23000, 44000, 55000, 57000, 56000, 61000, 58000, 63000,
                                    60000,
                                    66000, 34000, 78000,
                                ],
                            },
                            {
                                name: "Last Period",
                                data: [
                                    17000, 76000, 85000, 101000, 98000, 87000, 105000, 91000,
                                    114000,
                                    94000, 67000, 66000,
                                ],
                            },
                        ],
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: "16px",
                                borderRadius: 0,
                            },
                        },
                        legend: {
                            show: false,
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        stroke: {
                            show: true,
                            width: 8,
                            colors: ["transparent"],
                        },
                        xaxis: {
                            categories: [
                                "January",
                                "February",
                                "March",
                                "April",
                                "May",
                                "June",
                                "July",
                                "August",
                                "September",
                                "October",
                                "November",
                                "December",
                            ],
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            crosshairs: {
                                show: false,
                            },
                            labels: {
                                style: {
                                    colors: "#9ca3af",
                                    fontSize: "13px",
                                    fontFamily: "Inter, ui-sans-serif",
                                    fontWeight: 400,
                                },
                                offsetX: -2,
                                formatter: (title) => title.slice(0, 3),
                            },
                        },
                        yaxis: {
                            labels: {
                                align: "left",
                                minWidth: 0,
                                maxWidth: 140,
                                style: {
                                    colors: "#9ca3af",
                                    fontSize: "13px",
                                    fontFamily: "Inter, ui-sans-serif",
                                    fontWeight: 400,
                                },
                                formatter: (value) => (value >= 1000 ? `${value / 1000}k` : value),
                            },
                        },
                        states: {
                            hover: {
                                filter: {
                                    type: "darken",
                                    value: 0.9,
                                },
                            },
                        },
                        tooltip: {
                            y: {
                                formatter: (value) =>
                                    `$${value >= 1000 ? `${value / 1000}k` : value}`,
                            },
                            custom: function(props) {
                                const {
                                    categories
                                } = props.ctx.opts.xaxis;
                                const {
                                    dataPointIndex
                                } = props;
                                const title = categories[dataPointIndex];
                                const newTitle = `${title}`;

                                return buildTooltip(props, {
                                    title: newTitle,
                                    mode,
                                    hasTextLabel: true,
                                    wrapperExtClasses: "min-w-28",
                                    labelDivider: ":",
                                    labelExtClasses: "ms-2",
                                });
                            },
                        },
                        responsive: [{
                            breakpoint: 568,
                            options: {
                                chart: {
                                    height: 300,
                                },
                                plotOptions: {
                                    bar: {
                                        columnWidth: "14px",
                                    },
                                },
                                stroke: {
                                    width: 8,
                                },
                                labels: {
                                    style: {
                                        colors: "#9ca3af",
                                        fontSize: "11px",
                                        fontFamily: "Inter, ui-sans-serif",
                                        fontWeight: 400,
                                    },
                                    offsetX: -2,
                                    formatter: (title) => title.slice(0, 3),
                                },
                                yaxis: {
                                    labels: {
                                        align: "left",
                                        minWidth: 0,
                                        maxWidth: 140,
                                        style: {
                                            colors: "#9ca3af",
                                            fontSize: "11px",
                                            fontFamily: "Inter, ui-sans-serif",
                                            fontWeight: 400,
                                        },
                                        formatter: (value) =>
                                            value >= 1000 ? `${value / 1000}k` : value,
                                    },
                                },
                            },
                        }, ],
                    }), {
                        colors: ["#2563eb", "#d1d5db"],
                        grid: {
                            borderColor: "#e5e7eb",
                        },
                    }, {
                        colors: ["#6b7280", "#2563eb"],
                        grid: {
                            borderColor: "#404040",
                        },
                    }
                );
            })();
        });
    </script>
    <script>
        window.addEventListener("load", () => {
            (function() {
                buildChart(
                    "#hs-single-area-chart",
                    (mode) => ({
                        chart: {
                            height: 300,
                            type: "area",
                            toolbar: {
                                show: false,
                            },
                            zoom: {
                                enabled: false,
                            },
                        },
                        series: [{
                            name: "Sales",
                            data: @json($sales),
                        }, ],
                        legend: {
                            show: false,
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        stroke: {
                            curve: "straight",
                            width: 2,
                        },
                        grid: {
                            strokeDashArray: 2,
                        },
                        fill: {
                            type: "gradient",
                            gradient: {
                                type: "vertical",
                                shadeIntensity: 1,
                                opacityFrom: 0.1,
                                opacityTo: 0.8,
                            },
                        },
                        xaxis: {
                            type: "category",
                            tickPlacement: "on",
                            categories: @json($categories),
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            crosshairs: {
                                stroke: {
                                    dashArray: 0,
                                },
                                dropShadow: {
                                    show: false,
                                },
                            },
                            tooltip: {
                                enabled: false,
                            },
                            labels: {
                                style: {
                                    colors: "#9ca3af",
                                    fontSize: "13px",
                                    fontFamily: "Inter, ui-sans-serif",
                                    fontWeight: 400,
                                },
                                formatter: (title) => {
                                    let t = title;

                                    if (t) {
                                        const newT = t.split(" ");
                                        t = `${newT[0]} ${newT[1].slice(0, 3)}`;
                                    }

                                    return t;
                                },
                            },
                        },
                        yaxis: {
                            labels: {
                                align: "left",
                                minWidth: 0,
                                maxWidth: 140,
                                style: {
                                    colors: "#9ca3af",
                                    fontSize: "13px",
                                    fontFamily: "Inter, ui-sans-serif",
                                    fontWeight: 400,
                                },
                                formatter: (value) => (value >= 1000 ? `${value / 1000}k` : value),
                            },
                        },
                        tooltip: {
                            x: {
                                format: "MMMM yyyy",
                            },
                            y: {
                                formatter: (value) =>
                                    `${value >= 1000 ? `${value / 1000}k` : value}`,
                            },
                            custom: function(props) {
                                const {
                                    categories
                                } = props.ctx.opts.xaxis;
                                const {
                                    dataPointIndex
                                } = props;
                                const title = categories[dataPointIndex].split(" ");
                                const newTitle = `${title[0]} ${title[1]}`;

                                return buildTooltip(props, {
                                    title: newTitle,
                                    mode,
                                    valuePrefix: "",
                                    hasTextLabel: true,
                                    wrapperExtClasses: "min-w-28",
                                });
                            },
                        },
                        responsive: [{
                            breakpoint: 568,
                            options: {
                                chart: {
                                    height: 300,
                                },
                                labels: {
                                    style: {
                                        colors: "#9ca3af",
                                        fontSize: "11px",
                                        fontFamily: "Inter, ui-sans-serif",
                                        fontWeight: 400,
                                    },
                                    offsetX: -2,
                                    formatter: (title) => title.slice(0, 3),
                                },
                                yaxis: {
                                    labels: {
                                        align: "left",
                                        minWidth: 0,
                                        maxWidth: 140,
                                        style: {
                                            colors: "#9ca3af",
                                            fontSize: "11px",
                                            fontFamily: "Inter, ui-sans-serif",
                                            fontWeight: 400,
                                        },
                                        formatter: (value) =>
                                            value >= 1000 ? `${value / 1000}k` : value,
                                    },
                                },
                            },
                        }, ],
                    }), {
                        colors: ["#2563eb", "#9333ea"],
                        fill: {
                            gradient: {
                                stops: [0, 90, 100],
                            },
                        },
                        grid: {
                            borderColor: "#e5e7eb",
                        },
                    }, {
                        colors: ["#3b82f6", "#a855f7"],
                        fill: {
                            gradient: {
                                stops: [100, 90, 0],
                            },
                        },
                        grid: {
                            borderColor: "#404040",
                        },
                    }
                );
            })();
        });
    </script>

    <!-- JS THIRD PARTY PLUGINS -->
    <!-- Google Analytics. Global site tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-B73TDMXKF5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'G-B73TDMXKF5');
    </script>
@endpush
