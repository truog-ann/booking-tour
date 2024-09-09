@extends('admin.layout.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Quản lý bài viết</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Posts</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('posts.create') }}">Create</a></li>
                        </ol>
                    </div>

                </div>
            </div>
            <div class="col-md-12 card">
                <div class="row">
                    <strong class="card-header border-0 fs-5">Thêm bài viết mới</strong>
                    <div class="card-body">
                        <form class="tablelist-form" autocomplete="off" action="{{ route('posts.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="mb-3 col-5">
                                        <label for="customername-field" class="form-label">Tiêu đề
                                        </label>

                                        <input type="text" id="customername-field" class="form-control" name="title"
                                            value="{{ old('title') }}">
                                        @error('title')
                                            <span class="text-danger fw-light "><i>{{ $message }}</i></span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-5">
                                        <label for="customername-field" class="form-label">Ảnh đại diện
                                        </label>

                                        <input type="file" name="file" class="form-control"
                                            onchange="document.getElementById('thumbnail').src = window.URL.createObjectURL(this.files[0])">
                                        @error('file')
                                            <span class="text-danger fw-light "><i>{{ $message }}</i></span>
                                        @enderror
                                    </div>
                                    <div class="col-2">
                                        <label for="date-field" class="form-label">Kích hoạt
                                        </label>
                                        <div class="form-check form-switch">

                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                                name="is_active" checked value="1" id="active">
                                        </div>
                                    </div>
                                    <img id="thumbnail" src="" style="max-width: 200px; max-height:200px;" />

                                </div>

                                <div class="mt-3">
                                    <label for="customername-field" class="form-label">Nội dung
                                    </label>
                                    <textarea name="body" class="ckeditor-classic form-control">{{ old('description') }}
                                                </textarea>
                                    @error('body')
                                        <span class="text-danger fw-light "><i>{{ $message }}</i></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer mt-3">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="submit" class="btn btn-success" id="add-btn">Thêm
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
