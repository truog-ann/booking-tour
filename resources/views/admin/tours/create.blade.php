@extends('admin.layout.master')
@section('content')
@section('styles')
 <style>
    #itine{
        display: none;
    }
 </style>
 
@endsection
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Quản lý Tour</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('tours.index') }}">Tours</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('tours.create') }}">Create</a></li>
                        </ol>
                    </div>

                </div>
            </div>
            <div class="card">
                <h3 class="card-header border-0 fs-5">Thêm chuyến du lịch</h3>
                <div class="card-body">
                    <form method="POST" action="{{ route('tours.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <label for="date-field" class="form-label">Tiêu đề
                                </label>

                                <input type="text" value="{{ old('title') }}" name="title" id=""
                                    class="form-control" placeholder="Nhập tiêu dề">
                                @error('title')
                                    <span class="text-danger fw-light ">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="date-field" class="form-label">Giá
                                </label>
                                <input type="text" value="{{ old('price') }}" name="price" id="price"
                                    class="form-control" placeholder="Nhập giá">
                                @error('price')
                                    <span class="text-danger fw-light ">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="date-field" class="form-label">Giá khuyến mại
                                </label>

                                <input type="text" value="{{ old('promotion') }}" name="promotion"
                                    placeholder="Nhập giá khuyến mại" id="promotion" class="form-control">
                                @error('promotion')
                                    <span class="text-danger fw-light ">{{ $message }}</span>
                                @enderror
                                @session('promotion')
                                <span class="text-danger fw-light ">{{ session('promotion') }}</span>
                                      @endsession
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-md-4">
                                <label for="date-field" class="form-label">Tỉnh/Thành phố
                                </label>

                                <select class="js-example-basic-single form-control" name="province_id" id="province_id">
                                    <option value="">-- Chọn --</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                                @error('province_id')
                                    <span class="text-danger fw-light "><i>{{ $message }}</i></span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="date-field" class="form-label">Quận/Huyện
                                </label>
                                <select name="district_id" id="district_id" class="form-control js-example-basic-single">
                                    <option value="">-- Chọn thành phố trước --</option>
                                </select>
                                @error('district_id')
                                    <span class="text-danger fw-light ">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="date-field" class="form-label">Xã/Phường
                                </label>

                                <select name="ward_id" id="ward_id" class="form-control js-example-basic-single">
                                    <option value="">-- Chọn quận/huyện trước --</option>

                                </select>
                                @error('ward_id')
                                    <span class="text-danger fw-light ">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                

                           <div class="row mt-3">
                            <div class="col-4">
                                <label for="date-field" class="form-label">Số ngày
                                </label>
                                <input type="number" value="{{ old('day') }}" class="form-control" name="day"
                                    id="day" id="day">
                                @error('day')
                                    <span class="text-danger fw-light ">{{ $message }}</span>
                                @enderror
                                @session('vudz')
                                <span class="text-danger fw-light ">{{ session('vudz') }}</span>
                                      @endsession
   
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label for="date-field" class="form-label">Kiểu du lịch
                                </label>
                                <select class="js-example-basic-single form-control" name="type_id" id="">
                                    <option value="">-- Chọn --</option>

                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name_type }}</option>
                                    @endforeach
                                </select>
                                @error('province_id')
                                    <span class="text-danger fw-light ">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="date-field" class="form-label">Thuộc tính
                                </label>
                                <select name="attributes[]" multiple="multiple" class="js-example-basic-multiple"
                                    id="" class="form-control">
                                    @foreach ($attributes as $attribute)
                                        <option value="{{ $attribute->id }}">{{ $attribute->attribute }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('attributes')
                                    <span class="text-danger fw-light ">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>
                        <div class="row mt-2 " id="itine" >
                            <h2 class="ancute"></h2>
                            <div id="itineraries">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="customername-field" class="form-label">
                                            Ảnh </label>
                                        <input type="file" class="form-control" id="fileUpload" name="images[]"
                                            placeholder="Enter Name" multiple>
                                    </div>
                                    @error('images')
                                        <span class="text-danger fw-light ">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-4">
                                <label for="date-field" class="form-label">Khách sạn
                                </label>
                                <select name="hotels[]" multiple="multiple" class="js-example-basic-multiple"
                                    id="hotels" class="form-control">
                                </select>
                                @error('hotels')
                                    <span class="text-danger fw-light ">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="date-field" class="form-label">Kích hoạt
                                </label>
                                <div class="form-check form-switch">

                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                        name="is_active" checked value="1" id="is_active">
                                </div>

                            </div>
                            <div id="preview-container" class="d-flex flex-wrap mt-3 gap-3"></div>

                        </div>
                        <div class="row mt-3">
                            @error('description')
                                <span class="text-danger fw-light ">{{ $message }}</span>
                            @enderror
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0">Mô tả</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <textarea name="description" class="ckeditor-classic">{{ old('description') }}</textarea>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>

               
                        <button type="submit" id="" class="btn btn-primary my-3" href="#"
                            role="button">Thêm</button>

                    </form>
                </div>

            </div>
        </div>

    </div>

@section('scripts')

    <script>
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
            $('#itine').addClass('d-hidden');

            if ($('#day').val()) {
                deptrai();

            }
            
            $('#day').on('change', function() {
                 deptrai();
            })
          
            function deptrai(){
              
                $('#itine').show();
                $('.ancute').text('Lịch Trình');

                // $('#itineraries').html('');
                var currentInputs = $('#itineraries').children('.child').length;
                let days = $('#day').val();
                if (currentInputs > days) {
                    $('#itineraries').children('.child:gt(' + (days - 1) + ')').remove();
                } else {
                    for (let i = currentInputs + 1; i <= days; i++) {
                        let html = `
                <div class="child mt-2" id="div${i}">
                    <label for="">Ngày ${i}</label>
                    <div class="row" >
                        <div class="col-md-4">
                            <label for="basiInput" class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control itinerary" id="title" name="title_itineraries[]">
                             
                            </div>    
                        <div class="col-md-8">
                            <label for="basiInput" class="form-label">Lịch trình cụ thể</label>
                            <textarea name="itineraries[]" class="ckeditor-classic-2"></textarea>
                            
                        </div>                      
                    </div>
                </div>`;
                        $('#itineraries').append(html);

                    }
                    $('.ckeditor-classic-2').each(function() {
                        ClassicEditor
                            .create(this)
                            .catch(error => {
                                console.error(error);
                            });
                    });
                }
            }

            $("#fileUpload").on("change", function() {
                let files = $(this)[0].files;
                $("#preview-container").empty();
                if (files.length > 0) {
                    for (let i = 0; i < files.length; i++) {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            $("<div class='preview'><img class='' width='150px' height='150px' src='" +
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
            $("#preview-container").on("click", ".delete", function() {
                $(this).parent(".preview").remove();
                $('#fileUpload').val(''); // Clear input value if needed
            });
            $('#province_id').on('change', function() {
                var provinceId = $(this).val();
                console.log(provinceId);
                $.ajax({
                    url: '/get-districts/' + provinceId,
                    type: 'GET',
                    success: function(data) {
                        $('#district_id').empty();
                        $.each(data, function(key, value) {
                            $('#district_id').append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
                $.ajax({
                    url: '/get-hotels/' + provinceId,
                    type: 'GET',
                    success: function(data) {
                        $('#hotels').empty();
                        $.each(data, function(key, value) {
                            $('#hotels').append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
            $('#district_id').on('change', function() {
                var districtId = $(this).val();
                $.ajax({
                    url: '/get-wards/' + districtId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#ward_id').empty();
                        $.each(data, function(key, value) {
                            $('#ward_id').append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    }
                });

            });
        });
    </script>
@endsection
@endsection
