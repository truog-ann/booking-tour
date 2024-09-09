@extends('admin.layout.master')
@section('content')
    @php
        if (!function_exists('countBook')) {
            function countBook($id)
            {
                return \App\Models\Booking::where('tour_id', $id)->count();
            }
        }

    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col">

                <div class="h-100">
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Đơn hàng mới
                                            </p>
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                {{ $dataBook['bookNew'] }} </h4>

                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                <i class="bx bx-pause-circle text-warning"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                        <div class="col-xl-4 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Đơn hàng hoàn
                                                thành
                                            </p>
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                {{ $dataBook['bookDone'] }} </h4>


                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-success-subtle rounded fs-3">
                                                <i class="bx bx-check-circle text-success"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                        <div class="col-xl-4 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Đơn hàng đã
                                                hủy
                                            </p>
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                {{ $dataBook['bookCancel'] }} </h4>


                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-danger-subtle rounded fs-3">
                                                <i class="bx bx-x-circle text-danger"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title mb-0">Thống kê doanh thu năm</h4>
                                        <span>Doanh thu: {{ number_format($total, 0, '.', '.') }} VNĐ</span>
                                    </div>
                                    <form action="{{ route('stastics') }}">
                                        <select class="card-title mb-0" name='year' id="submit">
                                            @foreach ($years as $val)
                                                <option value="{{ $val->year }}">{{ $val->year }}</option>
                                            @endforeach
                                        </select>
                                    </form>

                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div id="charts"></div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="d-flex gap-2">
                                        <h4 class="card-title mb-0">Tour có nhiều lượt đặt </h4><span><a
                                                href="{{ route('tours.index') }}">[Xem tất cả]</a></span>
                                    </div>

                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tiêu đề</th>
                                                    <th scope="col">Thành phố</th>
                                                    <th scope="col">Số lượt đặt</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tours as $index => $val)
                                                    <tr class="">
                                                        <td>{{ $index + 1 }}</td>

                                                        <td scope="row" style="width: 60%"><a
                                                                href="{{ route('tours.show', $val->id) }}">
                                                                {{ Str::limit($val->title, 60) }} </a>
                                                        </td>
                                                        <td>{{ $val->provinces->name }}</td>
                                                        <td>{{ countBook($val->id) }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                    </div>





                </div> <!-- end .h-100-->

            </div> <!-- end col -->


        </div>

    </div>
@section('scripts')
    <script>
        let dataShow = @json($arr);
        let total = @json($total);

        function show(dataShow, total) {
            var options = {
                series: [{
                    name: 'Doanh thu',
                    data: dataShow
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return (val / total * 100).toFixed(2) + "%";
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },

                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#D8E3F0',
                                colorTo: '#BED1E6',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function(val) {
                            return new Intl.NumberFormat('vi-VN').format(val) + " VNĐ";
                        }

                    },


                },
                title: {
                    floating: true,
                    offsetY: 330,
                    align: 'center',
                    style: {
                        color: '#444'
                    }
                },
            };

            var chart = new ApexCharts(document.querySelector("#charts"), options);
            chart.render();
        }
        $(document).ready(function() {
            show(dataShow, total);
            $("#submit").on('change', function() {
                const year = $(this).val();
                $.ajax({
                    url: "/get-stastic/" + year,
                    type: "GET",
                    success: function(val) {
                        $("#charts").html('');
                        show(val.data, val.total);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', status, error);
                    }
                })
            })
        })
    </script>
@endsection
@endsection
