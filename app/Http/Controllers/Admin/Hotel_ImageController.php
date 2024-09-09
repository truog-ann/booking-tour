<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

class Hotel_ImageController extends Controller
{
    //
    public function index()
    {
        $hotelImages = HotelImage::all();
        return view('admin.Hotel_images.index', compact('hotelImages'));
    }


    public function create()
    {
        $hotels = Hotel::all();
        return view('admin.Hotel_images.add', compact('hotels'));
    }

    public function show($id)
    {
        $hotelImages = HotelImage::where('hotel_id', $id)->get();
        return view('admin.Hotel_images.show', compact('hotelImages'));
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'hotel_id' => 'required',
            'images' => 'required|array|max:5', // Số lượng ảnh tối đa là 5
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        foreach ($request->file('images') as $image) {
            $imageName = "storage/hotels/" . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/hotels'), $imageName);
            HotelImage::create([
                'hotel_id' => $request->hotel_id,
                'image' => $imageName
            ]);
        }
        return redirect()->back()
            ->with('success', 'Hotel Image added successfully.');


    }





    public function edit(HotelImage $hotelImage)
    {
        $hotels = Hotel::all();
        return view('admin.Hotel_images.edit', compact('hotelImage', 'hotels'));
    }


    public function update(Request $request, HotelImage $hotelImage)
    {
        $request->validate([
            'hotel_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $hotelImage->hotel_id = $request->hotel_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $hotelImage->image = $imageName;
        }

        $hotelImage->save();

        return redirect()->route('hotel_images.show', $request->hotel_id)
            ->with('success', 'Hotel Image updated successfully');
    }


    public function destroy($id)
    {
        $data = HotelImage::find($id);
        if ($data) {
            $imagePath = public_path($data->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $data->delete();
        }
        return back()->with('success', 'Hotel image is deleted.');
        ;
    }
}
