@extends('admin.layout.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Quản lý khách sạn</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('hotels.index') }}">Hotels</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('hotels.index') }}">List</a></li>
                        </ol>
                    </div>

                </div>
            </div>
            <div class="col-md-12 card">
                <div class="card-header d-flex justify-content-between">
                    <strong class="card-header border-0 fs-5">Danh sách khách sạn</strong>
                    <div>
                        <a href="{{ route('hotels.create') }}" class="btn btn-primary mb-3">Thêm khách sạn mới</a>

                    </div>

                </div>
                <div class="filter mt-2">
                    <form action="{{ route('hotels.index') }}" method="get">
                        {{-- @csrf --}}
                        <div class="row">
                            <div class="col-4 form-group">
                                <div class="d-inline-flex w-100">
                                    <div style="width: calc(100% -135px); margin-right: 15px">
                                        <input type="text" name="name" id="" placeholder="Tên khách sạn"
                                            value="{{ request()->name }}" class="form-control mt-2">
                                    </div>
                                    <div style="width: calc(40%); ">
                                        <select class="form-control mt-2" name="province">
                                            <option value="">Thành phố</option>
                                            @foreach ($provinces as $value)
                                                <option value="{{ $value->id }}"
                                                    @if (request()->province == $value->id) selected @endif>
                                                    {{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="d-inline-flex w-100 ">

                                        <div style="width: calc(40%); margin-right:1rem;">

                                            <select class="form-control mt-2" name="status">
                                                <option value="" selected>Trạng thái phòng</option>
                                                <option @if (request()->status == 1) selected @endif value="1">
                                                    Còn phòng</option>
                                                <option @if (isset(request()->status) && request()->status == 0) selected @endif value="0">
                                                    Hết phòng</option>
                                            </select>
                                        </div>
                                        <div style="width: calc(40%); ">

                                            <select class="form-control mt-2" name="is_active">
                                                <option value="" selected>Trạng thái</option>
                                                <option @if (request()->is_active == 1) selected @endif value="1">
                                                    Kích hoạt</option>
                                                <option @if (isset(request()->is_active) && request()->is_active == 0) selected @endif value="0">
                                                    Khóa</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 form-group mt-2">
                                <div class="pull-right " style="margin-bottom: 15px">
                                    <a href="{{ route('hotels.index') }}" class="btn btn-primary">
                                        Bỏ lọc
                                    </a>
                                    <button type="submit" class="btn btn-info">Lọc</button>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive card">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Giá</th>
                                    <th>Giá khuyến mại</th>
                                    <th>Thành phố</th>
                                    <th>Trạng thái phòng</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($hotels)>0)
                                    @foreach ($hotels as $index => $hotel)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td style="max-height: 100px; overflow: hidden;width: 20%">
                                                {!! nl2br(wordwrap($hotel->name, 80, "\n", true)) !!}
                                            </td>
                                            <td>{{ number_format($hotel->price, 0, '.', '.') }} VND</td>
                                            <td>{{ number_format($hotel->promotion, 0, '.', '.') }} VND</td>
                                            <td>{{ $hotel->province->name }}</td>

                                            <td>
                                                @php
                                                    echo $hotel->status == 1
                                                        ? '<span class="badge bg-success-subtle text-success text-uppercase">Còn phòng</span>'
                                                        : '<span class="badge bg-success-subtle text-danger text-uppercase">Hết phòng</span>';
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                    echo $hotel->is_active == 1
                                                        ? '<span class="badge bg-success-subtle text-success text-uppercase">Kích hoạt</span>'
                                                        : '<span class="badge bg-success-subtle text-danger text-uppercase">Khóa</span>';
                                                @endphp
                                            </td>
                                            <td class="d-flex gap-2">
                                                <button class="border-0 bg-white">
                                                    <a class=""
                                                        href="{{ route('hotels.show', ['hotel' => $hotel->id]) }}"
                                                        data-target="dropdownMenu{{ $hotel->id }}"><i
                                                            class="ri-eye-fill fs-5"></i></a>
                                                </button>


                                                <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn border-0"
                                                        onclick="return confirm('Bạn có chăc chắn muốn xóa khách sạn này?')"><i
                                                            class="ri-delete-bin-7-fill fs-5 text-danger"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <td class="fw-bold">Không có dữ liệu</td>
                                @endif

                            </tbody>
                        </table>
                        {{ $hotels->links() }}

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
