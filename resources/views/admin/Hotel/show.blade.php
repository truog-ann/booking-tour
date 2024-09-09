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
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản lý khách sạn</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('hotels.index') }}">Hotels</a></li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('hotels.show', ['hotel' => $hotel->id]) }}">Show</a></li>
                    </ol>
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
                            Dịch vụ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#settings" role="tab" aria-selected="true">
                            Bình luận
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content  text-muted">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        <div class="d-flex gap-3">
                            <h4 class="mt-2">Thông tin khách sạn</h4>
                            <a type="button" class="btn btn-success" data-bs-toggle="modal" id="create-btn"
                                data-bs-target="#showModal">
                                Sửa</a>
                        </div>


                        <div class="row mt-3">
                            <div class="col-md-4">
                                <p>Tên: <strong>{{ $hotel->name }}</strong></p>
                            </div>
                            <div class="col-md-4">
                                <p>Trạng thái kích hoạt: <strong> @php
                                    echo $hotel->is_active == 1
                                        ? '<span class="badge bg-success-subtle text-success text-uppercase">Active</span>'
                                        : '<span class="badge bg-success-subtle text-danger text-uppercase">Block</span>';
                                @endphp</strong></p>
                            </div>
                            <div class="col-md-4">
                                <p>Trạng thái phòng: <strong> @php
                                    echo $hotel->status == 1
                                        ? '<span class="badge bg-success-subtle text-success text-uppercase">Available</span>'
                                        : '<span class="badge bg-success-subtle text-danger text-uppercase">Full</span>';
                                @endphp</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <p>Giá: <strong>{{ number_format($hotel->price, 0, '.', '.') }} VND</strong></p>
                                <p>Giá khuyến mại: <strong>{{ number_format($hotel->promotion, 0, '.', '.') }}
                                        VND</strong>
                                </p>
                                <p>Địa chỉ:
                                    <strong>
                                        {{ $hotel->address . ', ' . $hotel->ward->name . ', ' . $hotel->district->name . ', ' . $hotel->province->name }}
                                    </strong>
                                </p>
                            </div>
                            <div class="col-md-8 ">
                                <div class="limited-text">
                                    Mô tả:
                                    {!! $hotel->description !!}
                                    <?= $hotel->description ?>
                                </div>

                                <button class="btn btn-outline-info button" onclick="toggleText()">Xem thêm</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="product1" role="tabpanel">
                        <div class="d-flex justify-content-between my-2">

                            <h4>Ảnh khách sạn</h4>
                            <a type="button" class="btn btn-success" data-bs-toggle="modal" id="create-btn-image"
                                data-bs-target="#showModalImage">
                                Thêm ảnh</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table  align-middle">
                                <thead class="table-light">

                                    <tr>
                                        <th scope="col" class="text-black">#</th>
                                        <th scope="col" class="text-black">Ảnh </th>
                                        <th scope="col" class="text-black">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($hotel->images) > 0)
                                        @foreach ($hotel->images as $index => $image)
                                            <tr class="">
                                                <td class="text-black" scope="col">{{ $index + 1 }}</td>

                                                <td class="text-black">
                                                    <img width="200px" height="200px" src="{{ asset($image->image) }}"
                                                        alt="">
                                                </td>
                                                <td class="text-black">
                                                    <form
                                                        action="{{ route('hotel_images.destroy', ['hotel_image' => $image->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="border-0 bg-white "
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa ảnh này không?')">
                                                            <i class="ri-delete-bin-7-fill fs-4 text-danger"></i>
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


                            {{ $hotel->images->links() }}

                        </div>

                    </div>
                    <div class="tab-pane" id="messages" role="tabpanel">

                        <h4>Dịch vụ của khách sạn</h4>
                        <div class="row">
                            <div class="col-md-8 table-responsive">
                                <table class="table bg-white">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-black">#</th>
                                            <th scope="col" class="text-black">Dịch vụ</th>
                                            <th scope="col" class="text-black">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($hotel->services) > 0)
                                            @foreach ($hotel->services as $index => $service)
                                                <tr class="">
                                                    <td class="text-black" scope="col">{{ $index + 1 }}</td>

                                                    <td class="text-black">
                                                        {{ $service->service }}
                                                    </td>
                                                    <td class="text-black">
                                                        <form
                                                            action="{{ route('hotel_services.destroy', ['hotel_service' => $service->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <input type="text" hidden name="hotel_id"
                                                                value="{{ $hotel->id }}">
                                                            <input type="text" hidden name="service_id"
                                                                value="{{ $service->id }}">
                                                            <button type="submit" class="border-0 bg-white "
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                                <i class="ri-delete-bin-7-fill fs-4 text-danger"></i>
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
                                {{ $hotel->services->links() }}
                            </div>
                            <div class="col-md-4">
                                <form class="tablelist-form" autocomplete="off" id="" method="post"
                                    action="{{ route('hotel_services.store') }}">
                                    @csrf
                                    <div class="mb-3" id="modal-id" style="display: none;">
                                        <label for="id-field" class="form-label">ID</label>
                                        <input type="text" id="id-field" name="hotel_id" class="form-control"
                                            placeholder="ID" value="{{ $hotel->id }}" readonly />
                                    </div>
                                    <div>
                                        <label for="date-field" class="form-label">Dịch vụ
                                        </label>
                                        <select name="services[]" multiple="multiple"
                                            class="js-example-basic-multiple" id="" class="form-control">
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->service }}
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
                    <div class="tab-pane" id="settings" role="tabpanel">
                        <h4>Bình luận</h4>
                        <div class="table-responsive">
                            <table class="table bg-white">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-black">#</th>
                                        <th scope="col" class="text-black">Bình luận</th>
                                        <th scope="col" class="text-black">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($hotel->comments) > 0)
                                        @foreach ($hotel->comments as $index => $comment)
                                            <tr class="">
                                                <td class="text-black" scope="col">{{ $index + 1 }}</td>

                                                <td class="text-black">
                                                    {{ $comment->comments }}
                                                </td>
                                                <td class="text-black">
                                                    <form
                                                        action="{{ route('hotel_comments.destroy', ['hotel_comment' => $comment->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
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
                            {{ $hotel->comments->links() }}
                        </div>
                    </div>
                </div>
            </div><!-- end card-body -->

            {{-- start form edit hotel --}}
            <div class="modal fade modal-lg" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-xl">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel">Sửa khách sạn</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                id="close-modal"></button>
                        </div>
                        <form class="tablelist-form" autocomplete="off" id="editForm" method="post"
                            action="{{ route('hotels.update', ['hotel' => $hotel->id]) }}">
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
                                            Tên</label>
                                        <input type="text" id="customername-field" class="form-control"
                                            value="{{ $hotel->name }}" name="name" placeholder="Enter Name" />
                                        @error('name')
                                            <span class="text-danger fs-10">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="email-field" class="form-label">Giá</label>
                                        <input type="text" id="email-field" class="form-control" name="price"  id="price"
                                            value="{{ $hotel->price }}" placeholder="" />
                                        @error('price')
                                            <span class="text-danger fs-10">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="phone-field" class="form-label">Giá khuyến mại</label>
                                        <input type="text" id="phone-field" class="form-control" name="promotion"
                                            id="promotion" value="{{ $hotel->promotion }}" placeholder="" />
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
                                            <option value="">--Chọn--</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}"
                                                    @if ($hotel->province_id == $province->id) selected @endif>
                                                    {{ $province->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('province_id')
                                            <span class="text-danger fs-10">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="date-field" class="form-label">Quận/Huện
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
                                    <div class="col-md-4">
                                        <label for="status-field" class="form-label">Địa chỉ</label>
                                        <input type="text" id="phone-field" class="form-control" name="address"
                                            value="{{ $hotel->address }}" placeholder="" />
                                        @error('address')
                                            <span class="text-danger fs-10">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="status-field" class="form-label">Trạng thái phòng</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="flexSwitchCheckChecked" name="status" value="1"
                                                id="status" @if ($hotel->status == 1) checked @endif>
                                            @error('status')
                                                <span class="text-danger fs-10">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="status-field" class="form-label">Trạng thái kich hoạt</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="flexSwitchCheckChecked" name="is_active" value="1"
                                                id="active" @if ($hotel->is_active == 1) checked @endif>
                                            @error('is_active')
                                                <span class="text-danger fs-10">{{ $message }}</span>
                                            @enderror
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
                                                <textarea name="description" class="ckeditor-classic">
                                                {{ $hotel->description }}
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
                            enctype="multipart/form-data" action="{{ route('hotel_images.store') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3" id="modal-id" style="display: none;">
                                    <label for="id-field" class="form-label">ID</label>
                                    <input type="text" id="id-field" class="form-control" name="hotel_id"
                                        placeholder="ID" value="{{ $hotel->id }}" readonly />
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="customername-field" class="form-label">
                                            File</label>
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


        </div>
        <!--end col-->

    </div>
    @section('scripts')
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
                upload();
                $("#preview-container").on("click", ".delete", function() {
                    $(this).parent(".preview").remove();
                    $('#fileUpload').val(''); // Clear input value if needed

                });
                $.ajax({
                    url: '/get-districts/' + {{ $hotel->province_id }},
                    type: 'GET',
                    success: function(data) {
                        $.each(data, function(key, value) {
                            if (value.id == {{ $hotel->district_id }}) {
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
                    url: '/get-wards/' + {{ $hotel->district_id }},
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $.each(data, function(key, value) {
                            if (value.id == {{ $hotel->ward_id }}) {

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
