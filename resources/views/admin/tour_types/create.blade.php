@extends('admin.layout.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Create Tour Type</h1>
                <div class="card">
                    <div class="card-header">Create Tour Type</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('tourTypes.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="attribute_id">Loại hình du lịch:</label>
                                <input type="text" class="form-control" id="name_type" name="name_type" value="{{ old('name_type') }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Tour Attribute</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
