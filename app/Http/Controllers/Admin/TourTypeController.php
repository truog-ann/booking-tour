<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourType;
use Illuminate\Http\Request;

class TourTypeController extends Controller
{
    public function index()
    {
        $types = TourType::orderByDesc('created_at')->paginate(10);
        $title = "Tour types list";
        return view('admin.tour_types.index', compact('types', 'title'));
    }



    public function store(Request $request)
    {
        $request->validate(['name_type' => 'required']);
        TourType::create($request->all());
        return redirect()->route('types.index')->with('success', 'Thêm danh mục mới thành công');
    }





    public function updateType(Request $request)
    {
        $request->validate(['name_type' => 'required']);
        $tourType = TourType::findOrFail($request->id);
        if ($tourType) {
            $tourType->update($request->all());
            return redirect()->route('types.index')->with('success', 'Cập nhật danh mục mới thành công');
        }
        return redirect()->route('types.index')->with('error', 'Cập nhật danh mục thất bại');

    }


    public function destroy($id)
    {
        try {
            TourType::find($id)->delete();
            return redirect()->route('types.index')->with('success', 'Xóa danh mục thành công');

        } catch (\Exception $e) {
            return redirect()->route('types.index')->with('error', 'Xóa danh mục thất bại');
        }
    }
}

