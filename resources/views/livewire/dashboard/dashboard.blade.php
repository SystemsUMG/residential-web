@push('styles')
    @once
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.0/nouislider.min.css">
    @endonce
@endpush
<div class="pt-3">
    <div wire:ignore>
        <div id="date-range-slider"></div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold text-dark-emphasis">Tickets</h5>
                        </div>
                    </div>
                    <div id="chart" class="mt-4"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-9 fw-semibold text-dark-emphasis">
                                Estado de Casas Ocupadas/Vacantes
                            </h5>
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <div class="d-flex align-items-center">
                                        <div class="me-4">
                                            <span class="round-8 bg-danger rounded-circle me-2 d-inline-block"></span>
                                            <span class="fs-2">Ocupadas</span>
                                        </div>
                                        <div>
                                            <span
                                                class="round-8 bg-success rounded-circle me-2 d-inline-block"></span>
                                            <span class="fs-2">Vacantes</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-center">
                                        <div wire:ignore id="breakup"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row alig n-items-start">
                                <div class="col-8">
                                    <h5 class="card-title mb-9 fw-semibold text-dark-emphasis">Total de multas</h5>
                                    <h4 class="fw-semibold text-dark-emphasis mb-3">
                                        Q{!! round($totalPenalties,2) !!}</h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div
                                            class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-currency-dollar fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="earning"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="card-title fw-semibold text-dark-emphasis">Últimas transacciones</h5>
                    </div>
                    <div class="overflow-auto" style="height: 360px">
                        <ul class="timeline-widget mb-0 position-relative mb-n5">
                            @forelse($dataTransactions->sortByDesc('datetime') as $item)
                                <li class="timeline-item d-flex position-relative overflow-hidden">
                                    <div
                                        class="timeline-time text-dark flex-shrink-0 text-end">{!! $item['datetime'] !!}</div>
                                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                        <span
                                            class="timeline-badge border-2 border border-{!! $item['status'] !!} flex-shrink-0 my-8"></span>
                                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                    </div>
                                    <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold text-dark-emphasis">
                                        {!! $item['description'] !!}
                                        <p class="text-primary d-block fw-normal">{!! $item['type'] !!}</p>
                                    </div>
                                </li>
                            @empty
                                <li class="timeline-item d-flex position-relative overflow-hidden">
                                    No se encontraron resultados
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold text-dark-emphasis mb-4">Top 5 de Residentes con Multas</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold text-dark-emphasis mb-0">Id</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold text-dark-emphasis mb-0">Propietario</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold text-dark-emphasis mb-0">Casa</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold text-dark-emphasis mb-0">Total multas</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold text-dark-emphasis mb-0">Total deuda</h6>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($rankingPenalties as $rankingPenalty)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold text-dark-emphasis mb-0">
                                            {!! $rankingPenalty['id'] !!}
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">
                                            {!! $rankingPenalty['owner'] !!}
                                        </p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">
                                            {!! $rankingPenalty['code'] !!}
                                        </p>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <h6 class="fw-semibold text-dark-emphasis mb-0 fs-4">
                                            {!! $rankingPenalty['total_penalties'] !!}
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0 text-end">
                                        <h6 class="fw-semibold text-dark-emphasis mb-0 fs-4">
                                            Q{!! round($rankingPenalty['total_sum'], 2) !!}
                                        </h6>
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-bottom-0">
                                    <td colspan="5" class="fw-semibold text-dark-emphasis mb-0 fs-4 text-center">
                                        No se encontraron resultados
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    @once
        <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.0/nouislider.min.js"></script>
    @endonce
    <script>
        document.addEventListener('livewire:load', function () {
            let dateSlider = document.getElementById('date-range-slider');
            let dateMin = new Date('{{ $dateMin }}').getTime();
            let dateMax = new Date('{{ $dateMax }}').getTime();
            let startDate = new Date('{{ $startDate }}').getTime();
            let endDate = new Date('{{ $endDate }}').getTime();

            noUiSlider.create(dateSlider, {
                start: [startDate, endDate],
                behaviour: 'drag',
                connect: true,
                range: {
                    'min': dateMin,
                    'max': dateMax
                },
                tooltips: [
                    {
                        to: function (value) {
                            return formatDate(new Date(parseInt(value)));
                        },
                        from: function (value) {
                            return parseInt(value);
                        }
                    },
                    {
                        to: function (value) {
                            return formatDate(new Date(parseInt(value)));
                        },
                        from: function (value) {
                            return parseInt(value);
                        }
                    }
                ]
            });
            dateSlider.noUiSlider.on('update', function (values) {
                startDate = formatDate(new Date(parseInt(values[0])));
                endDate = formatDate(new Date(parseInt(values[1])));
                @this.
                set('startDate', startDate)
                @this.set('endDate', endDate)
                Livewire.emit('updateChart')
            });

            function formatDate(date) {
                const day = date.getDate().toString().padStart(2, '0');
                const month = (date.getMonth() + 1).toString().padStart(2, '0');
                const year = date.getFullYear();
                return `${day}-${month}-${year}`;
            }
        });

        let configTickets = {
            series: [{
                data: @json($dataTickets)
            }],
            chart: {
                type: "bar",
                height: 345,
                offsetX: -15,
                toolbar: {show: true},
                foreColor: "#84868e",
                fontFamily: 'inherit',
                sparkline: {enabled: false},
            },
            colors: @json($ticketColors),
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                }
            },
            markers: {size: 0},
            dataLabels: {
                enabled: true,
            },
            legend: {
                show: true,
            },
            grid: {
                borderColor: "rgba(0,0,0,0.1)",
                strokeDashArray: 3,
                xaxis: {
                    lines: {
                        show: false,
                    },
                },
            },
            xaxis: {
                type: "category",
                categories: @json($ticketCategories),
                labels: {
                    style: {
                        colors: @json($ticketColors),
                        fontSize: '0px'
                    }
                }
            },
            yaxis: {
                show: true,
                min: 0,
                max: 10,
                tickAmount: 4,
                labels: {
                    style: {
                        cssClass: "grey--text lighten-2--text fill-color",
                    },
                },
            },
            stroke: {
                show: true,
                width: 3,
                lineCap: "butt",
                colors: ["transparent"],
            },
            tooltip: {theme: "dark"},
            responsive: [
                {
                    breakpoint: 600,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 3,
                            }
                        },
                    }
                }
            ]
        };
        let ticketBar = new ApexCharts(document.querySelector("#chart"), configTickets);
        ticketBar.render();

        Livewire.on('updateDataTickets', function (data) {
            ticketBar.updateSeries([{
                data: data
            }])
        })

        let statusHouseConfig = {
            color: "#adb5bd",
            series: [{{ $houseNotAvailable ?? 0 }}, {{ $houseAvailable ?? 0 }}],
            labels: ["Vacantes", "Ocupadas"],
            chart: {
                width: 180,
                type: "donut",
                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    donut: {
                        size: '75%',
                    },
                },
            },
            stroke: {
                show: false,
            },

            dataLabels: {
                enabled: false,
            },

            legend: {
                show: false,
            },
            colors: ["#13DEB9", "#FA896B"],

            responsive: [
                {
                    breakpoint: 991,
                    options: {
                        chart: {
                            width: 150,
                        },
                    },
                },
            ],
            tooltip: {
                theme: "dark",
                fillSeriesColor: false,
            },
        };
        let statusHouseDonut = new ApexCharts(document.querySelector("#breakup"), statusHouseConfig);
        statusHouseDonut.render();


        let penaltiesConfig = {
            chart: {
                type: "area",
                height: 100,
                sparkline: {
                    enabled: true,
                },
                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
            },
            series: [
                {
                    name: "Multas",
                    color: "#49BEFF",
                    data: @json($dataPenalties),
                },
            ],
            legend: {
                show: true,
            },
            xaxis: {
                categories: @json($penaltyCategories),
            },
            stroke: {
                curve: "smooth",
                width: 2,
            },
            fill: {
                colors: ["#f3feff"],
                type: "solid",
                opacity: 0.05,
            },
            markers: {
                size: 0,
            },
            tooltip: {theme: "dark"},
        };
        let penaltyArea = new ApexCharts(document.querySelector("#earning"), penaltiesConfig)
        penaltyArea.render();

        Livewire.on('updateDataPenalties', function (data) {
            penaltyArea.updateSeries([{
                data: data
            }])
        })
    </script>
@endpush
