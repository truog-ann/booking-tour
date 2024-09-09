<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class VoucherController extends Controller
{

    public function index()
    {
        $title = "Vouchers list";
        $vouchers = Voucher::orderByDesc('created_at')->paginate(10);
        return view('admin.vouchers.index', compact('vouchers', 'title'));
    }

    public function show(string $id)
    {
        $voucher = Voucher::findOrFail($id);
        return response()->json($voucher);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'voucher' => 'required',
            'title' => 'required',
            'qty' => 'required|numeric',
            'discount_type' => 'required|boolean',
            'value' => 'numeric',
            'max' => 'nullable',
            'start' => 'required|date',
            'end' => 'required|date',


        ]);
        $voucher = Voucher::query()->create($request->all());
        return response()->json($voucher, 201);
    }

    public function update(Request $request, string $id)
    {
        $voucher = Voucher::findOrFail($id);
        $data = $request->all();
        $voucher->update($data);
        return response()->json($voucher);
    }

    public function destroy($id)
    {
        $item = Voucher::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Voucher deleted']);
    }
}
