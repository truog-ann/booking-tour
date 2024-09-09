<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourRequest;
use App\Models\Attribute;
use App\Models\Hotel;
use App\Models\Tour;
use App\Models\TourImage;
use App\Models\Itinerary;
use App\Models\Province;
use App\Models\Rate;
use App\Models\TourAttribute;
use App\Models\TourComment;
use App\Models\TourHotel;
use App\Models\TourType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use League\Flysystem\UrlGeneration\PublicUrlGenerator;

class TourController extends Controller
{
    public function index(Request $request)
    {
        foreach(Tour::all() as $tour){
            $tour->update([
                'slug'=>Str::slug($tour->title)
            ]);
        }
        $provinces = Province::whereIn('id', Tour::groupBy('province_id')->get('province_id'))->get(['id', 'name']);
        $query = Tour::query();
        if ($request->title && $request->title != null) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        }
        if (isset($request->province)) {
            $query->where('province_id', intval($request->province));
        }
        if (isset($request->is_active)) {
            $query->where('is_active', intval($request->is_active));
        }
        $tours = $query->orderByDesc('created_at')->paginate(10);
        $title = "Tours list";
        return view('admin.tours.index', compact('tours', 'title', 'provinces'));
    }



    public function create()
    {

        $title = "Tour add";
        $attributes = Attribute::all();
        $provinces = Province::all();
        $types = TourType::all();
        return view('admin.tours.create', compact('title', 'provinces', 'attributes', 'types'));
    }

    public function store(TourRequest $request)
    {
        
        
        // Validate input
        $request->is_active ? $request->is_active : $request->merge(['is_active' => 0]);
        $request->merge(['views' => 0]);
        $slug = Str::slug($request->title);
        $checkSlug = Tour::where('slug', $slug)->get('id');
        if ($checkSlug) {
            $request->merge(['slug' => $slug . '-' . Str::random(3)]);
        } else {
            $request->merge(['slug' => $slug]);
        }
        $priceString = str_replace('.', '', $request->price);
        $promotionString = str_replace('.', '', $request->promotion);

        // Chuyển đổi chuỗi thành số
        $price = intval($priceString);
        $promotion = intval($promotionString);
        if (empty($request->title_itineraries) || empty($request->itineraries) || $request->title_itineraries == [] || $request->itineraries == []) {
            return back()->withInput()->with('error', 'Chưa Thêm Lịch Trình Cho Tour');
        }
        $tour = Tour::create([
            ...$request->all(),
            'price' => $price,
            'promotion' => $promotion,
        ]);        
        if ($tour) {
            for ($i = 0; $i < $request->day; $i++) {
                Itinerary::create([
                    'tour_id' => $tour->id,
                    'day' => $i + 1,
                    'title' => $request->title_itineraries[$i],
                    'itinerary' => $request->itineraries[$i],
                ]);
            }
            foreach ($request->images as $image) {
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/tours'), $imageName);
                TourImage::create([
                    'tour_id' => $tour->id,
                    'image' => "storage/tours/" . $imageName
                ]);
            }
            foreach ($request->input('attributes') as $attribute) {
                TourAttribute::create([
                    'tour_id' => $tour->id,
                    'attribute_id' => $attribute,
                ]);
            }
            foreach ($request->input('hotels') as $hotel) {
                TourHotel::create([
                    'tour_id' => $tour->id,
                    'hotel_id' => $hotel,
                ]);
            }
        }

        return redirect()->route('tours.index')->with('success', 'Tour created successfully.');
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết của một tour cụ thể
        $tour = Tour::find($id);
        $attributes = Attribute::all();
        $provinces = Province::all();
        $types = TourType::all();
        $tour->images = $tour->images()->paginate(5);
        $tour->attributes = $tour->attributes()->paginate(10);
        $tour->comments = $tour->comments()->paginate(10);
        $tour->rates = $tour->rates()->paginate(10);
        $tour->hotels = $tour->hotels()->paginate(10);
        $hotels = Hotel::where('is_active', 1)->where('province_id', $tour->province_id)->get();
        $title = "Tour show";
        return view('admin.tours.show', compact('tour', 'types', 'hotels', 'attributes', 'title', 'provinces'));
    }

    public function edit($id)
    {
        // Hiển thị form chỉnh sửa tour
        $tour = Tour::findOrFail($id);
        $tourTypes = TourType::all();
        return view('admin.tours.edit', compact('tour', 'tourTypes'));
    }

    public function update(Request $request, $id)
    {
        $priceString = str_replace('.', '', $request->price);
        $promotionString = str_replace('.', '', $request->promotion);

        // Chuyển đổi chuỗi thành số
        $price = intval($priceString);
        $promotion = intval($promotionString);
        if ($promotion > $price) {
           return back()->withInput()->with('error', 'The promotion field must be less than price');
       }
        // Validate input
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'price' => 'required',
            'promotion' => 'required',
            'type_id' => 'required|exists:tour_types,id',
            'description' => 'required',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'ward_id' => 'required|exists:wards,id',
            'is_active' => 'nullable'

        ]);

        // Cập nhật thông tin của tour
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        $slug = Str::slug($request->title);
        $checkSlug = Tour::where('slug', $slug)->get('id');
        if ($checkSlug) {
            $request->merge(['slug' => $slug . '-' . Str::random(3)]);
        } else {
            $request->merge(['slug' => $slug]);
        }
        $request->is_active ? $request->is_active : $request->merge(['is_active' => 0]);
        $tour = Tour::findOrFail($id);
        $tour->update($request->all());


        return redirect()->back()->with('success', 'Tour updated successfully.');
    }
    public function getItinerary($id)
    {
        $itinerary = Itinerary::where('id', $id)->get();
        return response()->json($itinerary);
    }
    public function addHotels(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hotels' => 'required|array',
            'hotels.*' => Rule::unique('tour_hotel', 'hotel_id')->where(function ($query) use ($request) {
                return $query->where('tour_id', $request->tour_id);
            }),

        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        foreach ($request->input('hotels') as $hotel) {
            TourHotel::create([
                'tour_id' => $request->tour_id,
                'hotel_id' => $hotel,
            ]);
        }

        return redirect()->back()->with('success', 'Add hotel successfully.');
    }
    public function delHotel(Request $request)
    {
        TourHotel::where('tour_id', $request->tour_id)->where('hotel_id', $request->hotel_id)
            ->delete();
        return redirect()->back()->with('success', 'Del hotel successfully.');

    }

    public function addItinerary(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'day' => 'required|numeric',
            'title' => 'required',
            'itinerary' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        Itinerary::create([
            'tour_id' => $request->tour_id,
            'day' => $request->day,
            'title' => $request->title,
            'itinerary' => $request->itinerary
        ]);
        Tour::find($request->tour_id)->update([
            'day' => Itinerary::where('tour_id', $request->tour_id)->count('day')
        ]);
        return redirect()->back()->with('success', 'Add Itinerary tour successfully');
    }
    public function updateItinerary(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'day' => 'required|numeric',
            'title' => 'required',
            'itinerary' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());

        }
        Itinerary::find($request->id)->update([
            'day' => $request->day,
            'title' => $request->title,
            'itinerary' => $request->itinerary
        ]);

        return redirect()->back()->with('success', 'Update Itinerary tour successfully');
    }

    public function delItinerary($id, Request $request)
    {
        $item = Itinerary::where('id', $id);
        if ($item) {
            $item->delete();
            Tour::find($request->tour_id)->update([
                'day' => Itinerary::where('tour_id', $request->tour_id)->count('day')
            ]);
        }
        return redirect()->back()->with('success', 'Update Itinerary tour successfully');
    }
    public function addImage(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);
        foreach ($request->file('images') as $image) {
            $imageName = "storage/tours/" . uniqid() . '.' . $image->getClientOriginalExtension();
            // dd($imageName);
            $image->move(public_path('storage/tours'), $imageName);
            TourImage::create([
                'tour_id' => $request->tour_id,
                'image' => $imageName
            ]);
        }
        return redirect()->back()->with('success', 'Add image tour successfully');


    }
    public function delImage($id)
    {
        $del = TourImage::find($id)->delete();
        if ($del) {
            return redirect()->back()->with('success', 'Delete image tour successfully');
        }
        return redirect()->back()->with('error', 'Delete image tour failed');

    }
    public function addAttributes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attributes' => 'required|exists:attributes,id',
            'attributes.*' =>
                Rule::unique('tour_attribute', 'attribute_id')->where(function ($query) use ($request) {
                    return $query->where('tour_id', $request->tour_id);
                }),
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        foreach ($request->input('attributes') as $attribute) {
            TourAttribute::create([
                'tour_id' => $request->tour_id,
                'attribute_id' => $attribute
            ]);
        }
        return redirect()->back()->with('success', 'Add attributes tour successfully');
    }
    public function delAttribute(Request $request)
    {
        TourAttribute::where('tour_id', $request->tour_id)
            ->where('attribute_id', $request->attribute_id)->delete();
        return redirect()->back()->with('success', 'Delete attributes tour successfully');
    }
    public function delRate($id)
    {
        $del = Rate::find($id)->delete();
        if ($del) {
            return redirect()->back()->with('success', 'Delete rate successfully');
        }
        return redirect()->back()->with('error', 'Delete rate failed');

    }
    public function delComment($id)
    {
        $del = TourComment::find($id)->delete();
        if ($del) {
            return redirect()->back()->with('success', 'Delete comment successfully');
        }
        return redirect()->back()->with('error', 'Delete comment failed');

    }
    public function destroy($id)
    {
        // Xóa một tour và các liên quan (hình ảnh, đánh giá, lịch trình)
        // TourImage::where('tour_id', $id)->delete();
      
        $tour = Tour::findOrFail($id);

        if($tour){
            TourAttribute::where('tour_id', $tour->id)->delete();
            TourComment::where('tour_id', $tour->id)->delete();
            Rate::where('tour_id', $tour->id)->delete();
            Itinerary::where('tour_id',$tour->id)->delete();
            TourHotel::where('tour_id',$tour->id)->delete();
            $arrImage = TourImage :: where('tour_id',$tour->id)->get();
            $idnew = TourImage :: where('tour_id',$tour->id)->get('id');

            foreach($arrImage as $imageTour){
                $imagePath =  public_path($imageTour->image);
                if(file_exists($imagePath)){
                    unlink($imagePath);
                }
            }
          
            TourImage :: whereIn('id',$idnew)->delete();
            $tour->delete();
        }
        // Tour::findOrFail($id)->delete();
        return redirect()->route('tours.index')->with('success', 'Tour deleted successfully.');
    }
}
