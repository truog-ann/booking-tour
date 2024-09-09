@extends('admin.layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản lý danh mục</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('types.index') }}">Types</a></li>
                        <li class="breadcrumb-item active"><a href="F{{ route('types.index') }}">List</a></li>
                    </ol>
                </div>

            </div>
        </div>
        <div class="card col-8">
            <div class="card-header">Danh sách danh mục</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($types)>0)
                        @foreach ($types as $index => $type)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $type->name_type }}</td>
                            <td>
                                <button class="btn">
                                    <i class="ri-pencil-fill showEdit fs-5 text-warning align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#showModal"
                                        data-edit-value="{{ $type->name_type }}" data-edit-id="{{ $type->id }}""></i>
                                            </button>
                                        @if (!\App\Models\Tour::where('type_id', $type->id)->exists())
                                            <form action=" {{ route('types.destroy', $type->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn "
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa thuộc tính này không?')">
                                            <i class="ri-delete-bin-7-fill fs-5 text-danger"></i>
                                        </button>
                                        </form>
                                        @endif
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <td class="fw-bold">Không có dữ liệu</td>
                        @endif

                    </tbody>
                </table>
                {{ $types->links() }}
            </div>
        </div>
        <div class="col-md-4">
            <form class="tablelist-form" autocomplete="off" id="addService" method="post"
                action="{{ route('types.store') }}">
                @csrf
                <div>
                    <label for="date-field" class="form-label">Tên danh mục
                    </label>
                    <input type="text" class="form-control" name="name_type">
                    @error('name_type')
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
                    <form class="tablelist-form" autocomplete="off" action="{{ route('type.update') }}" method="post" >
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="customername-field" class="form-label">Tên danh mục
                                </label>
                                <input type="hidden" id="customername-field" class="form-control" name="id" value="${id}"
                                     >
                                <input type="text" id="customername-field" class="form-control" name="name_type" value="${value}"
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