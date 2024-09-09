<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TourAttribute;
class AttributeController extends Controller
{
    //
    public function index()
    {

        $attributes = Attribute::orderByDesc('created_at')->paginate(10);
        $title = 'Attributes';
        return view('admin.Attributes.index', compact('attributes', 'title'));

    }


    public function create()
    {
        return view('admin.Attributes.add');
    }


    public function store(Request $request)
    {

        $request->validate([
            'attribute' => 'required|max:255',
        ], [
            'attribute' => "Thuộc tính không được để trống"
        ]);
        Attribute::create($request->all());
        return redirect()->route('attributes.index')
            ->with('success', 'Thêm thuộc tính thành công');
    }

    public function show(Attribute $attribute)
    {
        return view('attributes.show', compact('attribute'));
    }


    public function edit(Attribute $attribute)
    {
        return view('admin.Attributes.edit', compact('attribute'));
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attribute' => 'required|max:255',

        ], [
            'attribute' => "Thuộc tính không được để trống"

        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        $attr = Attribute::find($request->id)->update($request->all());
        if ($attr) {
            return redirect()->route('attributes.index')
                ->with('success', 'Cập nhật thuộc tính thành công');
        }
        return redirect()->back()
            ->with('error', 'Cập nhật thuộc tính thất bại');
    }


    public function destroy(Attribute $attribute)
    {

        
        if ($attribute->delete()) {
            TourAttribute::where('attribute_id',$attribute->id)->delete();
            return redirect()->route('attributes.index')
                ->with('success', 'Xóa thuộc tính thành công');
        }
        return redirect()->back()
            ->with('error', 'Xóa thuộc tính thất bại');

    }
}
