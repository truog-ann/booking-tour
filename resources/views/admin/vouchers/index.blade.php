@extends('admin.layout.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Vouchers</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('vouchers.index') }}">Vouchers</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('vouchers.index') }}">List</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h1>Manage Vouchers</h1>
                <a href="{{ route('vouchers.create') }}" class="btn btn-primary mb-3">Add New Voucher</a>
                <div class="card">
                    <div class="card-header">Voucher List</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Voucher</th>
                                    <th>Title</th>
                                    <th>Qty</th>
                                    <th>Type</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vouchers as $voucher)
                                    <tr>
                                        <td>{{ $voucher->voucher }}</td>
                                        <td>{{ $voucher->title }}</td>
                                        <td>{{ $voucher->qty }}</td>
                                        <td>{{ $voucher->discount_type == 1 ? 'Giảm Phần Trăm' : 'Giảm Tiền' }}</td>
                                        <td>{{ $voucher->start }}</td>
                                        <td>{{ $voucher->end }}</td>
                                        <td>
                                            @php
                                                echo $voucher->is_active == 1
                                                    ? '<span class="badge bg-success-subtle text-success text-uppercase">Active</span>'
                                                    : '<span class="badge bg-success-subtle text-danger text-uppercase">Block</span>';
                                            @endphp
                                        </td>
                                        <td>

                                            <a href="{{ route('vouchers.edit', $voucher->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this tour?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $vouchers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
