@extends('admin.layout.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h1>Quản lý dịch vụ</h1>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Services</a></li>
                                <li class="breadcrumb-item active"><a href="F{{ route('services.index') }}">List</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-8 card">
                <div class="row">
                    <div class="card-header">Danh sách dịch vụ</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Dịch vụ</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($services) > 0)
                                    @foreach ($services as $index => $service)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $service->service }}</td>
                                            <td>

                                                <button class="border-0 bg-white edit-item-btn showEdit"
                                                    data-bs-toggle="modal" data-bs-target="#showModal"
                                                    data-edit-value="{{ $service->service }}"
                                                    data-edit-id="{{ $service->id }}"><i
                                                        class="ri-pencil-fill text-warning fs-5"></i></button>
                                                <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="border-0 bg-white"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                        <i class="ri-delete-bin-7-fill fs-5 text-danger"></i>
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
                        {{ $services->links() }}
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <form class="tablelist-form" autocomplete="off" id="addService" method="post"
                    action="{{ route('services.store') }}">
                    @csrf
                    <div>
                        <label for="date-field" class="form-label">Dịch vụ
                        </label>
                        <input type="text" class="form-control" name="service">
                        @error('service')
                            <span class="text-danger fw-light "><i>{{ $message }}</i></span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.showEdit').click(function() {
                let id = $(this).attr('data-edit-id');
                let value = $(this).attr('data-edit-value');
                let form = `
                    <form class="tablelist-form" autocomplete="off" action="{{ route('services.update') }}" method="post" >
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="customername-field" class="form-label">Dịch vụ
                                </label>
                                <input type="hidden" id="customername-field" class="form-control" name="id" value="${id}"
                                     >
                                <input type="text" id="customername-field" class="form-control" name="service" value="${value}"
                                     >
                                
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
            });
        });
    </script>
@endsection
@endsection
