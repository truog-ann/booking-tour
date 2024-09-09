<!-- resources/views/admin/users/index.blade.php -->

@extends('admin.layout.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Quản lý tài khoản</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">List</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-header border-0 fs-5">Danh sách tài khoản</strong>


                    </div>
                    <div class="filter mt-2">
                        <form action="{{ route('users.index') }}" method="get">
                            {{-- @csrf --}}
                            <div class="row">
                                <div class="col-4 form-group">
                                    <div class="d-inline-flex w-100">
                                        <div style="width: calc(150% ); margin-left: 15px">
                                            <input type="text" name="name" id="" placeholder="Tên tài khoản"
                                                value="{{ request()->name }}" class="form-control mt-2">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="d-inline-flex w-100 gap-3">


                                            <div style="width: calc(40%); ">

                                                <select class="form-control mt-2" name="role">
                                                    <option value="" selected>Vai trò</option>
                                                    <option @if (request()->role == 1) selected @endif
                                                        value="1">
                                                        Quản trị</option>
                                                    <option @if (isset(request()->role) && request()->role == 0) selected @endif
                                                        value="0">
                                                        Người dùng</option>
                                                </select>
                                            </div>
                                            <div style="width: calc(40%); ">

                                                <select class="form-control mt-2" name="is_active">
                                                    <option value="" selected>Trạng thái</option>
                                                    <option @if (request()->is_active == 1) selected @endif
                                                        value="1">
                                                        Kích hoạt</option>
                                                    <option @if (isset(request()->is_active) && request()->is_active == 0) selected @endif
                                                        value="0">
                                                        Khóa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 form-group mt-2">
                                    <div class="pull-right " style="margin-bottom: 15px">
                                        <a href="{{ route('users.index') }}" class="btn btn-primary">
                                            Bỏ lọc
                                        </a>
                                        <button type="submit" class="btn btn-info">Lọc</button>
                                    </div>
                                </div>


                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Ngày sinh</th>
                                    <th>SĐT</th>
                                    <th>Vai trò</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($users) > 0)
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td><img src="{{ asset($user->avatar) }}" alt="" width="100px"></td>
                                            <td>{{ $user->date_of_birth }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td> @php
                                                echo $user->role == 1
                                                    ? '<span class="badge bg-primary-subtle text-primary text-uppercase">Quản
                                        trị</span>'
                                                    : '<span class="badge bg-warning-subtle text-warning text-uppercase">Người
                                        dùng</span>';
                                            @endphp</td>
                                            <td>
                                                @php
                                                    echo $user->is_active == 1
                                                        ? '<span class="badge bg-success-subtle text-success text-uppercase">Kích
                                        hoạt</span>'
                                                        : '<span class="badge bg-success-subtle text-danger text-uppercase">Khóa</span>';
                                                @endphp
                                            </td>
                                            <td>

                                                <button class="border-0 bg-white edit-item-btn showEdit"
                                                    data-bs-toggle="modal" data-bs-target="#showModal"
                                                    data-edit-role="{{ $user->role }}"
                                                    data-edit-active="{{ $user->is_active }}"
                                                    data-edit-id="{{ $user->id }}">
                                                    <i class="ri-pencil-fill fs-4 text-warning"></i></button>
                                                @if ($user->id !== auth()->user()->id)
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="border-0 bg-white"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                            <i class="ri-delete-bin-7-fill fs-4 text-danger"></i></button>
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
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
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
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.showEdit').click(function() {
                let id = $(this).attr('data-edit-id');
                let value = $(this).attr('data-edit-role');
                let active = $(this).attr('data-edit-active');
                let form = `
                    <form class="tablelist-form" autocomplete="off" action="{{ route('users.update') }}" method="post" >
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <h3>
                                Cập nhật tài khoản
                                    </h3>
                                <input type="hidden" id="customername-field" class="form-control" name="id" value="${id}"
                                     >
                            </div>
                            
                        </div>
                        <div class="row justify-content-center"> 
                            <div class="col-4">
                                <label for="date-field" class="form-label">Quản trị
                                </label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="role"
                                ${value==1?'checked':''} value="1" id="role">
                            </div>
                            </div>
                            <div class="col-4">
                                <label for="date-field" class="form-label">Kích hoạt
                                </label>
                                <div class="form-check form-switch">

                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="is_active"
                                        ${active==1?'checked':''}  value="1" id="is_active">
                                </div>

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
