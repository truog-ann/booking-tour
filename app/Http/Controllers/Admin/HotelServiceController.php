<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelService;
use App\Models\Service;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class HotelServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotelServices = HotelService::all();
        return view('admin.Hotel_services.index', compact('hotelServices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotels = Hotel::all();
        $services = Service::all();
        return view('admin.Hotel_services.create', compact('hotels', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->services[0]);
        $validator = Validator::make($request->all(), [
            'hotel_id' => 'required|exists:hotels,id',
            'services.*' => [
                'required',
                Rule::exists('services', 'id'),
                Rule::unique('hotel_service', 'service_id')->where(function ($query) use ($request) {
                    return $query->where('hotel_id', $request->hotel_id);
                })
            ],
        ]);
        if ($validator->fails()) {
            // dd($validator->errors()->messages());
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        foreach ($request->services as $service) {
            HotelService::create([
                'hotel_id' => $request->hotel_id,
                'service_id' => $service,
            ]);
        }
        return redirect()->back()->with('success', 'Hotel service added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hotelServices = HotelService::where('hotel_id', $id)->get();
        return view('admin.Hotel_services.show', compact('hotelServices'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HotelService $hotelService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HotelService $hotelService)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $hotelService->update($request->all());
        return redirect()->route('hotel_services.show', $request->hotel_id)->with('success', 'Hotel service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // dd($request->all());
        HotelService::where('hotel_id', $request->hotel_id)
            ->where('service_id', $request->service_id)
            ->delete();
        return redirect()->back()->with('success', 'Hotel service deleted successfully.');
    }
}
