<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelService;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    // Lấy danh sách các dịch vụ
    public function index()
    {
        $services = Service::orderByDesc('created_at')->paginate(10);
        $title = "Services list";
        return view('admin.services.index', compact('services','title'));
    }

    // Tạo mới một dịch vụ
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'service' => 'required|string|max:255'
        ]);

        $service = Service::create($validatedData);
        if ($service) {
            return redirect()->back()->with('success', 'Add service successfully');
        }
        return redirect()->back()->with('error', 'Add service faild');

    }

    // Cập nhật một dịch vụ
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'service' => 'required|string|max:255'
        ]);

        $service = Service::find($request->id);
        if ($service) {
            $service->update($validatedData);
            return redirect()->back()->with('success', 'Update service successfully');
        } else {
            return redirect()->back()->with('error', 'Update service faild');
        }
    }

    // Xóa một dịch vụ
    public function destroy($id)
    {
        $service = Service::find($id);
        if ($service) {
            HotelService::where('service_id',$id)->delete();
            $service->delete();
            return redirect()->back()->with('success', 'Delete service successfully');
        } 
            return redirect()->back()->with('error', 'Delete service faild');
        
    }
}
