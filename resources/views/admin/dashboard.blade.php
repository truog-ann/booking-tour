@extends('admin.layout.master')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col">

                <div class="h-100">
                    <div class="row mb-3 pb-1">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1">Xin chào, {{ auth()->user()->name }}</h4>
                                </div>

                            </div><!-- end card header -->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Tổng chuyến
                                                du lịch
                                            </p>
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                {{ $dataShow['countTours'] }}
                                            </h4>
                                            <p href="{{ route('bookings.index') }}" class="text-decoration-underline">
                                                Tour mới trong tháng: {{ $dataShow['countTours'] }}</p>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-success-subtle rounded fs-3">
                                                <i class="bx bx-paper-plane text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Tổng số bài
                                                viết
                                            </p>
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                {{ $dataShow['countPosts'] }}
                                            </h4>

                                            <p href="{{ route('bookings.index') }}" class="text-decoration-underline">Bài
                                                viết mới trong tháng: {{ $dataShow['countPostsInMonth'] }} </p>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle rounded fs-3">
                                                <i class="bx bx-book text-success"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Khách hàng</p>
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                {{ $dataShow['countCustomers'] }}
                                            </h4>
                                            <p href="{{ route('users.index') }}" class="text-decoration-underline">Khách
                                                hàng trong tháng: {{ $dataShow['countCustomersInMonth'] }}
                                            </p>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                <a href="{{ route('users.index') }}">
                                                    <i
                                                        class="bx
                                                    bx-user-circle text-warning"></i>
                                                </a>

                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Tổng đơn hàng

                                            </p>
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                {{ $dataShow['countBookings'] }}
                                            </h4>
                                            <p href="{{ route('bookings.index') }}" class="text-decoration-underline">
                                                Đơn hàng trong tháng: {{ $dataShow['countBookingsInMonth'] }}</p>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                <a href="{{ route('bookings.index') }}">
                                                    <i class="bx bx-wallet text-primary"></i>

                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div> <!-- end row-->
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card card-animate">
                                <h3 class="card-header">
                                    Đơn hàng mới trong ngày
                                </h3>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 5%">#</th>
                                                <th style="width: 20%">Mã book</th>
                                                <th style="width: 20%">Tên </th>
                                                <th style="width: 20%">Ngày bắt đầu </th>
                                                <th style="width: 15%">Số tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">

                                            @if ($dataShow['booksInDay'] && count($dataShow['booksInDay']) > 0)
                                                @foreach ($dataShow['booksInDay'] as $index => $val)
                                                    <tr class="table-primary">
                                                        <td style="width: 5%" scope="row">{{ $index + 1 }}</td>
                                                        <td style="width: 20%">
                                                            {{ $val->booking_code }}
                                                        </td>
                                                        <td style="width: 20%">
                                                            {{ $val->user_name }}

                                                        </td>
                                                        <td style="width: 20%">
                                                            {{ $val->start }}

                                                        </td>
                                                        <td style="width: 15%">
                                                            {{ number_format($val->total_price, 0, '.', '.') }} VNĐ
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <td class="fw-bold text-center" colspan="5">
                                                    Chưa có đơn mới
                                                </td>
                                            @endif



                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Tổng doanh
                                                thu trong tháng

                                            </p>
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                {{ $dataShow['totalInMonth'] }} VND
                                            </h4>
                                            <p href="{{ route('bookings.index') }}" class="text-decoration-underline">
                                                Đơn hàng hoàn thành trong tháng: {{ $dataShow['countBookingsDoneMonth'] }}
                                            </p>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                <a href="{{ route('bookings.index') }}">
                                                    <i class="bx bx-money text-primary"></i>

                                                </a>
                                            </span>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div>
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Tổng doanh
                                                thu trong năm

                                            </p>
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                {{ $dataShow['totalInYear'] }} VND
                                            </h4>
                                            <p href="{{ route('bookings.index') }}" class="text-decoration-underline">
                                                Đơn hàng hoàn thành trong năm: {{ $dataShow['countBookingsDoneYear'] }}</p>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                <a href="{{ route('bookings.index') }}">
                                                    <i class="bx bx-money text-primary"></i>

                                                </a>
                                            </span>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div>
                        </div>
                    </div>




                </div> <!-- end .h-100-->

            </div> <!-- end col -->


        </div>

    </div>
@endsection
