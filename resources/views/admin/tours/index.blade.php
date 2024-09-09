@extends('admin.layout.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Quản lý Tour</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('tours.index') }}">Tours</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('tours.index') }}">List</a></li>
                        </ol>
                    </div>

                </div>
            </div>
            <div class="col-md-12 card">
                <div class="card-header d-flex justify-content-between">
                    <strong class="card-header border-0 fs-5">Danh sách chuyến du lịch</strong>
                    <div>
                        <a href="{{ route('tours.create') }}" class="btn btn-primary mb-3">Thêm Tour mới</a>

                    </div>

                </div>
                <div class="filter mt-2">
                    <form action="{{ route('tours.index') }}" method="get">
                        {{-- @csrf --}}
                        <div class="row">
                            <div class="col-4 form-group">
                                <div class="d-inline-flex w-100">
                                    <div style="width: calc(150% ); margin-left: 15px">
                                        <input type="text" name="title" id="" placeholder="Tiêu đề"
                                            value="{{ request()->title }}" class="form-control mt-2">
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="d-inline-flex w-100">
                                        <div style="width: calc(40%); margin-right: 15px">
                                            <select class="form-control mt-2" name="province">
                                                <option value="">Thành phố</option>
                                                @foreach ($provinces as $value)
                                                    <option value="{{ $value->id }}"
                                                        @if (request()->province == $value->id) selected @endif>
                                                        {{ $value->name }}</option>
                                                @endforeach
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
                                    <a href="{{ route('tours.index') }}" class="btn btn-primary">
                                        Bỏ lọc
                                    </a>
                                    <button type="submit" class="btn btn-info">Lọc</button>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
                <div class="card-body table-rep-plugin">
                    <div class="table table-bordered table-responsive card" data-pattern="priority-columns">
                        <table id="admintable" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 20%">Tiêu đề</th>
                                    <th>Số ngày</th>
                                    <th>Giá </th>
                                    <th>Giá khuyến mại</th>
                                    <th>Thành phố</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($tours) > 0)
                                    @foreach ($tours as $index => $tour)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td style="max-height: 100px; overflow: hidden;width: 20%">
                                                {!! nl2br(wordwrap($tour->title, 70, "\n", true)) !!}
                                            </td>
                                            <td>{{ $tour->day }}</td>
                                            <td>{{ number_format($tour->price, 0, '.', '.') }} VND</td>
                                            <td>{{ number_format($tour->promotion, 0, '.', '.') }} VND</td>
                                            <td>{{ $tour->provinces->name }}</td>

                                            <td>
                                                @php
                                                    echo $tour->is_active == 1
                                                        ? '<span class="badge bg-success-subtle text-success text-uppercase">Kích hoạt</span>'
                                                        : '<span class="badge bg-success-subtle text-danger text-uppercase">Khóa</span>';
                                                @endphp
                                            </td>
                                            <td>
                                                <button class="btn"><a class=""
                                                        href="{{ route('tours.show', ['tour' => $tour->id]) }}"
                                                        data-target="dropdownMenu{{ $tour->id }}"> <i
                                                            class="ri-eye-fill fs-5"></i></a>
                                                </button>

                                                <form action="{{ route('tours.destroy', $tour->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn border-0 border-spacing-0 p-0"
                                                        onclick="return confirm('Bạn có chăc chắn muốn xóa chuyến du lịch này?')">
                                                        <i class="ri-delete-bin-7-fill fs-5 text-danger"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <td class="fw-bold">Không có dữ liệu</td>
                                @endif

                            </tbody>
                        </table>
                        {{ $tours->links() }}

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
