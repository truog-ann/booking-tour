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
                            <li class="breadcrumb-item active"><a href="">Show</a></li>
                        </ol>
                    </div>

                </div>
            </div>
            <div class="col-md-12 card">
                <div class="row">
                    <strong class="card-header border-0 fs-5">Chi tiết bài viết</strong>
                    <div class="card-body">
                        <div class="card text-center">
                            <h2>{{ $post->title }}</h2>
                            <img class="align-items-center" src="{{ asset($post->thumbnail) }}" height="450px"
                                alt="Title" />


                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                {!! $post->body !!}
                            </p>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
