@extends('admin.layout.master')

@section('content')
@section('styles')
    <style>
        .limited-text {
            max-height: 100px;
            /* Độ cao tối đa ban đầu của vùng chứa */
            overflow: hidden;
            /* Ẩn nội dung vượt quá max-height */
        }

        .limited-text.expanded {
            max-height: none;
            /* Hiển thị toàn bộ nội dung khi mở rộng */
        }
    </style>
@endsection
<div class="container">

    <div class="row">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Quản lý Tour</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('tours.index') }}">Tours</a></li>
                            <li class="breadcrumb-item active"><a
                                    href="{{ route('tours.show', ['tour' => $tour->id]) }}">Show</a></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="card container">
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab"
                            aria-selected="false">
                            Thông tin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-bs-toggle="tab" href="#product1" role="tab" aria-selected="false">
                            Thư viện ảnh
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab" aria-selected="false">
                            Thuộc tính
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#hotels" role="tab" aria-selected="false">
                            Khách sạn
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#itineraries" role="tab"
                            aria-selected="false">
                            Lịch trình
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#comments" role="tab" aria-selected="true">
                            Bình luận
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#rates" role="tab" aria-selected="true">
                            Đánh giá
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content  text-muted">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        <div class="d-flex gap-3">
                            <h4 class="mt-2">Thông tin du lịch</h4>
                            <a type="button" class="btn btn-success" data-bs-toggle="modal" id="create-btn"
                                data-bs-target="#showModalTour">
                                Sửa</a>
                        </div>


                        <div class="row mt-3">
                            <div class="col-md-4">
                                <p>Tiêu đề: <strong>{{ $tour->title }}</strong></p>
                            </div>
                            <div class="col-md-4 d-flex gap-5">
                                <p>Trạng thái: <strong> @php
                                    echo $tour->is_active == 1
                                        ? '<span class="badge bg-success-subtle text-success text-uppercase">Kích hoạt</span>'
                                        : '<span class="badge bg-success-subtle text-danger text-uppercase">Khóa</span>';
                                @endphp</strong></p>
                                <span>
                                    <p>Số ngày: <strong>{{ $tour->day }} Ngày
                                            {{ $tour->day - 1 >= 1 ? $tour->day - 1 . ' Đêm' : '' }} </strong></p>
                                </span>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <p>Giá: <strong>{{ number_format($tour->price, 0, '.', '.') }} VND</strong></p>
                                <p>Giá khuyến mại: <strong>{{ number_format($tour->promotion, 0, '.', '.') }}
                                        VND</strong>
                                </p>
                                <p>Địa chỉ:
                                    <strong>
                                        {{ $tour->wards->name . ', ' . $tour->districts->name . ', ' . $tour->provinces->name }}
                                    </strong>
                                </p>
                            </div>
                            <div class="col-md-8 ">
                                <div class="limited-text">
                                    Mô tả:
                                    {!! $tour->description !!}
                                </div>

                                <button class="btn btn-outline-info button" onclick="toggleText()">Xem thêm</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="product1" role="tabpanel">
                        <div class="d-flex justify-content-between my-2">
                            <h4>Ảnh chuyến du lịch</h4>
                            <a type="button" class="btn btn-success" data-bs-toggle="modal" id="create-btn-image"
                                data-bs-target="#showModalImage">
                                Thêm ảnh</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="table-light">

                                    <tr>
                                        <th scope="col" class="text-black">#</th>
                                        <th scope="col" class="text-black">Ảnh</th>
                                        <th scope="col" class="text-black">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($tour->images) > 0)
                                        @foreach ($tour->images as $index => $image)
                                            <tr class="">
                                                <td class="text-black" scope="col">{{ $index + 1 }}</td>

                                                <td class="text-black">
                                                    <img width="200px" height="200px"
                                                        src="{{ asset($image->image) }}" alt="">
                                                </td>
                                                <td class="text-black">
                                                    <form action="{{ route('delImage.destroy', $image->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button type="submit" class="border-0 bg-white "
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="ri-delete-bin-line fs-4 text-danger"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td class="fw-bold">Không có dữ liệu</td>
                                    @endif

                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>


                            {{ $tour->images->links() }}

                        </div>

                    </div>
                    <div class="tab-pane" id="messages" role="tabpanel">
                        <h4>Thuộc tính của chuyến du lịch</h4>
                        <div class="row">
                            <div class="col-md-8 table-responsive">
                                <table class="table bg-white">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-black">#</th>
                                            <th scope="col" class="text-black">Thuộc tính</th>
                                            <th scope="col" class="text-black">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($tour->attributes) > 0)
                                            @foreach ($tour->attributes as $index => $attribute)
                                                <tr class="">
                                                    <td class="text-black" scope="col">{{ $index + 1 }}</td>

                                                    <td class="text-black">
                                                        {{ $attribute->attribute }}
                                                    </td>
                                                    <td class="text-black">
                                                        <form action="{{ route('delAttribute.destroy') }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="text" hidden name="tour_id"
                                                                value="{{ $tour->id }}">
                                                            <input type="text" hidden name="attribute_id"
                                                                value="{{ $attribute->id }}">
                                                            <button type="submit" class="border-0 bg-white "
                                                                onclick="return confirm('Are you sure?')">
                                                                <i class="ri-delete-bin-line fs-4 text-danger"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <td class="fw-bold">Không có dữ liệu</td>
                                        @endif

                                    </tbody>
                                </table>
                                {{ $tour->attributes->links() }}
                            </div>
                            <div class="col-md-4">
                                <form class="tablelist-form" autocomplete="off" id="" method="post"
                                    action="{{ route('addAttributes.store') }}">
                                    @csrf
                                    <div class="mb-3" id="modal-id" style="display: none;">
                                        <label for="id-field" class="form-label">ID</label>
                                        <input type="text" id="id-field" name="tour_id" class="form-control"
                                            placeholder="ID" value="{{ $tour->id }}" readonly />
                                    </div>
                                    <div>
                                        <label for="date-field" class="form-label">Thuộc tính
                                        </label>
                                        <select name="attributes[]" multiple="multiple"
                                            class="js-example-basic-multiple" id="" class="form-control">
                                            @foreach ($attributes as $attribute)
                                                <option value="{{ $attribute->id }}">{{ $attribute->attribute }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-success">Thêm</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="hotels" role="tabpanel">
                        <h4>Khách sạn của chuyến du lịch</h4>
                        <div class="row">
                            <div class="col-md-8 table-responsive">
                                <table class="table bg-white">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-black">#</th>
                                            <th scope="col" class="text-black">Tên</th>
                                            <th scope="col" class="text-black">Giá</th>
                                            <th scope="col" class="text-black">Địa chỉ</th>
                                            <th scope="col" class="text-black">Trạng thái</th>
                                            <th scope="col" class="text-black">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($tour->hotels) > 0)
                                            @foreach ($tour->hotels as $index => $hotel)
                                                <tr class="">
                                                    <td class="text-black" scope="col">{{ $index + 1 }}</td>

                                                    <td class="text-black">
                                                        {{ $hotel->name }}
                                                    </td>

                                                    <td class="text-black">
                                                        {{ number_format($hotel->promotion, 0, '.', '.') }} VND </td>
                                                    <td class="text-black"
                                                        style="max-height: 100px; overflow: hidden;width: 20%">
                                                        {!! nl2br(
                                                            wordwrap(
                                                                $hotel->address . ',' . $hotel->ward->name . ',' . $hotel->district->name . ',' . $hotel->province->name,
                                                                70,
                                                                "\n",
                                                                true,
                                                            ),
                                                        ) !!}

                                                    </td>
                                                    <td class="text-black">
                                                        @php
                                                            echo $hotel->status == 1
                                                                ? '<span class="badge bg-success-subtle text-success text-uppercase">Còn phòng</span>'
                                                                : '<span class="badge bg-success-subtle text-danger text-uppercase">Hết phòng</span>';
                                                        @endphp </td>
                                                    <td class="text-black">
                                                        <form action="{{ route('delHotel.destroy') }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="text" hidden name="tour_id"
                                                                value="{{ $tour->id }}">
                                                            <input type="text" hidden name="hotel_id"
                                                                value="{{ $hotel->id }}">
                                                            <button type="submit" class="border-0 bg-white "
                                                                onclick="return confirm('Are you sure?')">
                                                                <i class="ri-delete-bin-line fs-4 text-danger"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <td class="fw-bold">Không có dữ liệu</td>
                                        @endif

                                    </tbody>
                                </table>
                                {{ $tour->hotels->links() }}
                            </div>
                            <div class="col-md-4">
                                <form class="tablelist-form" autocomplete="off" id="" method="post"
                                    action="{{ route('addHotels.store') }}">
                                    @csrf
                                    <div class="mb-3" id="modal-id" style="display: none;">
                                        <label for="id-field" class="form-label">ID</label>
                                        <input type="text" id="id-field" name="tour_id" class="form-control"
                                            placeholder="ID" value="{{ $tour->id }}" readonly />
                                    </div>
                                    <div>
                                        <label for="date-field" class="form-label">Hotels
                                        </label>
                                        <select name="hotels[]" multiple="multiple" class="js-example-basic-multiple"
                                            id="" class="form-control">
                                            @foreach ($hotels as $hotel)
                                                <option value="{{ $hotel->id }}">{{ $hotel->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-success">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="itineraries" role="tabpanel">
                        <h4>Lịch trình của chuyến du lịch</h4>
                        <div class="edit">
                            <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal"
                                data-bs-target="#showModal">Thêm</button>
                        </div>

                        <div class="table-responsive">
                            <table class="table bg-white">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-black">#</th>
                                        <th scope="col" class="text-black">Ngày</th>
                                        <th scope="col" class="text-black">Tiêu đề </th>
                                        <th scope="col" class="text-black">Lịch trình cụ thể</th>
                                        <th scope="col" class="text-black">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($tour->itineraries) > 0)
                                        @foreach ($tour->itineraries()->orderby('day')->get() as $index => $itinerary)
                                            <tr class="">
                                                <td class="text-black" scope="col">{{ $index + 1 }}</td>

                                                <td class="text-black">
                                                    Ngày {{ $itinerary->day }}
                                                </td>
                                                <td class="text-black">
                                                    {{ $itinerary->title }}
                                                </td>
                                                <td class="text-black " style="max-width: 600px">
                                                    {!! $itinerary->itinerary !!}
                                                </td>
                                                <td class="text-black d-flex gap-2">
                                                    <button class="border-0 bg-white edit-item-btn showEdit"
                                                        data-bs-toggle="modal" data-bs-target="#editItinerary"
                                                        data-edit-id="{{ $itinerary->id }}"> <i
                                                            class="ri-pencil-fill fs-4 text-warning"></i>
                                                    </button>
                                                    <form action="{{ route('delItinerary.destroy', $itinerary->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="tour_id"
                                                            value="{{ $tour->id }}">
                                                        <button type="submit" class="border-0 bg-white "
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="ri-delete-bin-line fs-4 text-danger"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td class="fw-bold">Không có dữ liệu</td>
                                    @endif

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="tab-pane" id="comments" role="tabpanel">
                        <h4>Bình luận</h4>
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table bg-white">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-black">#</th>
                                            <th scope="col" class="text-black">Nội dung</th>
                                            <th scope="col" class="text-black">Người đăng</th>
                                            <th scope="col" class="text-black">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($tour->comments) > 0)
                                            @foreach ($tour->comments as $index => $comment)
                                                <tr class="">
                                                    <td class="text-black" scope="col">{{ $index + 1 }}</td>

                                                    <td class="text-black">
                                                        {{ $comment->comments }}
                                                    </td>
                                                    <td class="text-black">
                                                        {{ $comment->name }}
                                                    </td>
                                                    <td class="text-black">
                                                        <form action="{{ route('delComment.destroy', $comment->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="text" hidden name="tour_id"
                                                                value="{{ $tour->id }}">
                                                            <input type="text" hidden name="comment_id"
                                                                value="{{ $comment->id }}">
                                                            <button type="submit" class="border-0 bg-white "
                                                                onclick="return confirm('Are you sure?')">
                                                                <i class="ri-delete-bin-line fs-4 text-danger"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <td class="fw-bold">Không có dữ liệu</td>
                                        @endif


                                    </tbody>
                                </table>
                                {{ $tour->comments->links() }}
                            </div>

                        </div>

                    </div>
                    <div class="tab-pane" id="rates" role="tabpanel">
                        <h4>Đánh giá <i
                                class="ri-star-s-fill text-warning"></i>{{ number_format($tour->rates()->avg('rate'), 1) }}({{ $tour->rates()->count('rate') }})
                        </h4>
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table bg-white">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-black">#</th>
                                            <th scope="col" class="text-black">Đánh giá</th>
                                            <th scope="col" class="text-black">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($tour->rates) > 0)
                                            @foreach ($tour->rates as $index => $rate)
                                                <tr class="">
                                                    <td class="text-black" scope="col">{{ $index + 1 }}</td>

                                                    <td class="text-black">
                                                        {{ $rate->rate }} <i
                                                            class="ri-star-s-fill text-warning fs-3"></i>
                                                    </td>
                                                    <td class="text-black">
                                                        <form action="{{ route('delRate.destroy', $rate->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="text" hidden name="tour_id"
                                                                value="{{ $tour->id }}">
                                                            <input type="text" hidden name="rate_id"
                                                                value="{{ $rate->id }}">
                                                            <button type="submit" class="border-0 bg-white "
                                                                onclick="return confirm('Are you sure?')">
                                                                <i class="ri-delete-bin-line fs-4 text-danger"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <td class="fw-bold">Không có dữ liệu</td>
                                        @endif

                                    </tbody>
                                </table>
                                {{ $tour->attributes->links() }}
                            </div>

                        </div>

                    </div>
                </div>
            </div><!-- end card-body -->

            {{-- start form add Itinerary --}}
            <div class="modal fade modal-lg" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm lịch trình</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                id="close-modal"></button>
                        </div>
                        <form class="tablelist-form" autocomplete="off" action="{{ route('addItinerary.store') }}"
                            method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3" id="modal-id" style="display: none;">
                                    <label for="id-field" class="form-label">ID</label>
                                    <input type="text" id="id-field" class="form-control" name="tour_id"
                                        value="{{ $tour->id }}" placeholder="ID" readonly />
                                </div>

                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Ngày
                                    </label>
                                    <input type="text" id="customer-field" class="form-control" name="day"
                                        placeholder="" />

                                </div>

                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Tiêu đề
                                    </label>
                                    <input type="text" class="form-control" name="title" placeholder="" />

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lịch trình cụ thể
                                    </label>
                                    <textarea name="itinerary" class="ckeditor-classic"></textarea>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-success" id="add-btn">Thêm
                                    </button>
                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- end form add Itinerary --}}
            {{-- start form edit hotel --}}
            <div class="modal fade modal-lg" id="showModalTour" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-xl">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel">Sửa chuyến du lịch</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                id="close-modal"></button>
                        </div>
                        <form class="tablelist-form" autocomplete="off" id="editForm" method="post"
                            action="{{ route('tours.update', ['tour' => $tour->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3" id="modal-id" style="display: none;">
                                    <label for="id-field" class="form-label">ID</label>
                                    <input type="text" id="id-field" class="form-control" placeholder="ID"
                                        readonly />
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="customername-field" class="form-label">
                                            Tiêu đề</label>
                                        <input type="text" id="customername-field" class="form-control"
                                            value="{{ $tour->title }}" name="title" placeholder="Enter Name" />
                                        @error('title')
                                            <span class="text-danger fs-10">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="email-field" class="form-label">Giá</label>
                                        <input type="text" id="email-field" class="form-control" name="price"
                                            id="price" value="{{ $tour->price }}" placeholder="" />
                                        @error('price')
                                            <span class="text-danger fs-10">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="phone-field" class="form-label">Giá khuyến mại</label>
                                        <input type="text" id="phone-field" class="form-control" name="promotion"
                                            id="promotion" value="{{ $tour->promotion }}" placeholder="" />
                                        @error('promotion')
                                            <span class="text-danger fs-10">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label for="date-field" class="form-label">Tỉnh/Thành phố
                                        </label>
                                        <select name="province_id" id="provinces" class="form-control">
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}"
                                                    @if ($tour->province_id == $province->id) selected @endif>
                                                    {{ $province->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('province_id')
                                            <span class="text-danger fs-10">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="date-field" class="form-label">Quận/Huyện
                                        </label>
                                        <select name="district_id" id="districts" class="form-control">
                                            <option value="">--Chọn--</option>

                                        </select>
                                        @error('district_id')
                                            <span class="text-danger fs-10">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="date-field" class="form-label">Xã/Phường
                                        </label>
                                        <select name="ward_id" id="wards" class="form-control">
                                            <option value="">--Chọn--</option>

                                        </select>
                                        @error('ward_id')
                                            <span class="text-danger fs-10">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="mb-3 col-md-6">
                                        <label for="date-field" class="form-label">Kiêu du lịch
                                        </label>
                                        <select name="type_id" id="" class="form-control">
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}"
                                                    @if ($tour->type_id == $type->id) selected @endif>
                                                    {{ $type->name_type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status-field" class="form-label">Trạng thái</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="flexSwitchCheckChecked" name="is_active" value="1"
                                                id="active" @if ($tour->is_active == 1) checked @endif>

                                        </div>
                                    </div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0">Mô tả</h4>
                                            </div><!-- end card header -->

                                            <div class="card-body">
                                                <textarea name="description" class="ckeditor-classic-1">
                                                {{ $tour->description }}
                                            </textarea>
                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div>
                                    <!-- end col -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-success" id="add-btn">Cập nhật</button>
                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- end form edit hotel --}}

            {{-- start add image hotel --}}
            <div class="modal fade modal-lg" id="showModalImage" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-xl">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm ảnh</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                id="close-modal"></button>
                        </div>
                        <form class="tablelist-form" autocomplete="off" id="" method="post"
                            enctype="multipart/form-data" action="{{ route('addImage.store') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3" id="modal-id" style="display: none;">
                                    <label for="id-field" class="form-label">ID</label>
                                    <input type="text" id="id-field" class="form-control" name="tour_id"
                                        placeholder="ID" value="{{ $tour->id }}" readonly />
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="customername-field" class="form-label">
                                            Ảnh</label>
                                        <input type="file" class="form-control" id="fileUpload" name="images[]"
                                            placeholder="Enter Name" multiple>
                                        <div id="preview-container" class="d-flex flex-wrap mt-3 gap-3"></div>
                                    </div>


                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-success" id="add-btn">Thêm</button>
                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- end add image hotel --}}

            <div class="modal fade" id="editItinerary" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                id="close-modal"></button>
                        </div>
                        <div id="formEdit">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->

</div>
@section('scripts')
    <script src="{{ url('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js', []) }} "></script>
    <script>
        function toggleText() {
            var textContainer = document.querySelector('.limited-text');
            textContainer.classList.toggle('expanded');
            var buttonText = document.querySelector('.button');
            if (textContainer.classList.contains('expanded')) {
                buttonText.textContent = 'Thu gọn';
            } else {
                buttonText.textContent = 'Xem thêm';
            }
        }

        function upload() {
            $("#fileUpload").on("change", function() {
                let files = $(this)[0].files;
                $("#preview-container").empty();
                if (files.length > 0) {
                    for (let i = 0; i < files.length; i++) {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            $("<div class='preview'><img class='' width='200px' height='200px' src='" +
                                e.target
                                .result +
                                "'><i class='ri-delete-bin-3-line delete text-danger fs-2'></i></div>"
                            ).appendTo(
                                "#preview-container");
                        };
                        reader.readAsDataURL(files[i]);
                    }
                }
            });
        }
        $(document).ready(function() {
            $('#price').on('blur', function() {
                const value = this.value.replace(/[^0-9]/g, "");
                this.value = parseFloat(value).toLocaleString('vi-VN');
                if (value == "") {
                    this.value = "";
                }
            });
            $('#promotion').on('blur', function() {
                const value = this.value.replace(/[^0-9]/g, "");
                this.value = parseFloat(value).toLocaleString('vi-VN');
                if (value == "") {
                    this.value = "";
                }
            });
            $('.showEdit').click(function() {
                let id = $(this).attr('data-edit-id');
                $.ajax({
                    url: '/admin/get-itinerary/' + id,
                    type: 'GET',
                    success: function(data) {
                        let form = `
                    <form class="tablelist-form" autocomplete="off" action="{{ route('updateItinerary.update') }}" method="post" >
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="customername-field" class="form-label">Ngày
                                </label>
                                <input type="hidden" id="customername-field" class="form-control" name="id" value="${data[0].id}"
                                     >
                                <input type="text" id="customername-field" class="form-control" name="day" value="${data[0].day}"
                                     >
                                
                            </div>
                            <div class="mb-3">
                                <label for="customername-field" class="form-label">Tiêu đề
                                </label>
                               
                                <input type="text" id="customername-field" class="form-control" name="title" value="${data[0].title}"
                                     >
                                
                            </div>
                             <div class="mb-3">
                                <label for="customername-field" class="form-label">Lịch trình cụ thể
                                </label>
                                            <textarea name="itinerary" class="ckeditor-classic-3 form-control">
                                                ${data[0].itinerary}
                                            </textarea>
                                        </div>
                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="add-btn">Update
                                    </button>
                            </div>
                        </div>
                    </form>`;
                        $('#formEdit').html(form);
                        ClassicEditor
                            .create(document.querySelector('.ckeditor-classic-3'))
                            .catch(error => {
                                console.error(error);
                            });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });


            ClassicEditor
                .create(document.querySelector('.ckeditor-classic-1'))
                .catch(error => {
                    console.error(error);
                });
            upload();
            $("#preview-container").on("click", ".delete", function() {
                $(this).parent(".preview").remove();
                $('#fileUpload').val(''); // Clear input value if needed

            });
            $.ajax({
                url: '/get-districts/' + {{ $tour->province_id }},
                type: 'GET',
                success: function(data) {
                    $('#districts').empty();
                    $.each(data, function(key, value) {
                        if (value.id == {{ $tour->district_id }}) {
                            $('#districts').append('<option value="' + value.id +
                                '" selected> ' + value.name + '</option>');
                        } else {
                            $('#districts').append('<option value="' + value.id +
                                '"> ' + value.name + '</option>');

                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
            $.ajax({
                url: '/get-wards/' + {{ $tour->district_id }},
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $.each(data, function(key, value) {
                        if (value.id == {{ $tour->ward_id }}) {
                            $('#wards').append('<option value="' + value.id +
                                '" selected>' + value.name + '</option>');
                        } else {
                            $('#wards').append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        }
                    });
                }
            });
            $('#provinces').on('change', function() {
                var provinceId = $('#provinces').val();
                $.ajax({
                    url: '/get-districts/' + provinceId,
                    type: 'GET',
                    success: function(data) {
                        $('#districts').empty();
                        $.each(data, function(key, value) {
                            $('#districts').append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
            $('#districts').on('change', function() {
                var districtId = $('#districts').val();

                $.ajax({
                    url: '/get-wards/' + districtId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#wards').empty();
                        $.each(data, function(key, value) {
                            $('#wards').append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    }
                });

            });
        });
    </script>
@endsection
@endsection
