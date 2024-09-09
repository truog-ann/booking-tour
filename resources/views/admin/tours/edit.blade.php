<!-- resources/views/admin/tours/edit.blade.php -->
@extends('admin.layout.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Edit Tour</h1>
                <div class="card">
                    <div class="card-header">Edit Tour</div>
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
                        <form action="{{ route('tours.update', $tour->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $tour->title }}" required>
                            </div>
                            <div class="form-group">
                                <label for="type_id">Type:</label>
                                <select class="form-control" id="type_id" name="type_id" required>
                                    @foreach ($tourTypes as $type)
                                        <option value="{{ $type->id }}" {{ $tour->type_id == $type->id ? 'selected' : '' }}>{{ $type->name_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="province_id">Province:</label>
                                <select class="form-control" id="province_id" name="province_id" required>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}" {{ $tour->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="district_id">District:</label>
                                <select class="form-control" id="district_id" name="district_id" required>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}" {{ $tour->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ward_id">Ward:</label>
                                <select class="form-control" id="ward_id" name="ward_id" required>
                                    @foreach ($wards as $ward)
                                        <option value="{{ $ward->id }}" {{ $tour->ward_id == $ward->id ? 'selected' : '' }}>{{ $ward->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="day">Day:</label>
                                <input type="number" class="form-control" id="day" name="day" value="{{ $tour->day }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description" required>{{ $tour->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="map">Map:</label>
                                <input type="text" class="form-control" id="map" name="map" value="{{ $tour->map }}" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" class="form-control" id="price" name="price" value="{{ $tour->price }}" required>
                            </div>
                            <div class="form-group">
                                <label for="promotion">Promotion:</label>
                                <input type="text" class="form-control" id="promotion" name="promotion" value="{{ $tour->promotion }}" required>
                            </div>
                            <div class="form-group">
                                <label for="private">Private:</label>
                                <input type="checkbox" id="private" name="private" {{ $tour->private ? 'checked' : '' }}>
                            </div>
                            <div class="form-group">
                                <label for="views">Views:</label>
                                <input type="number" class="form-control" id="views" name="views" value="{{ $tour->views }}" required>
                            </div>
                            <div class="form-group">
                                <label for="rate">Rate:</label>
                                <input type="number" class="form-control" id="rate" name="rate" value="{{ $tour->rate }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Tour</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
