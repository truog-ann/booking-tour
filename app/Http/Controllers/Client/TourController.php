<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseJson;
use App\Models\Province;
use App\Models\Rate;
use App\Models\Tour;
use App\Models\Tour_image;
use App\Models\TourComment;
use App\Models\TourType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class TourController extends Controller
{
    public $response;
    public $query;
    public function __construct(ResponseJson $response)
    {
        $this->response = $response;
        $this->query = Tour::clone()->where('is_active', 1);

    }
    public function index(Request $request)
    {
        $type_id = $request->type_id;
        $province = $request->province;
        $rate = $request->rate;
        $sortByPrice = $request->sort;
        if (isset($rate) && $rate !== []) {
            $id = Rate::select('tour_id')
                ->selectRaw('AVG(rate) as avg_rate')
                ->groupBy('tour_id')
                ->havingRaw('ROUND(AVG(rate)) IN (' . implode(',', array_map('intval', $rate)) . ')')
                ->pluck('tour_id');
            $this->query->whereIn('id', $id);
        }
        if (isset($province) && $province !== null) {
            $this->query->where('province_id', $province);
        }
        if (isset($type_id) && $type_id !== null) {
            $this->query->where('type_id', $type_id);
        }
        ;
        if (isset($sortByPrice)) {
            if ($sortByPrice == 'desc') {
                $this->query->orderByDesc('price')->get();
            } else {
                $this->query->orderBy('price')->get();
            }
        } else {
            $this->query->orderByDesc('created_at');
        }
        $tours = $this->query->get();
        $provinces_id = Tour::where('deleted_at', null)->groupBy('province_id')->get('province_id');
        $types_id = Tour::where('deleted_at', null)->groupBy('type_id')->get('type_id');
        $provinces = Province::whereIn('id', $provinces_id)->get();
        $tour_type = TourType::whereIn('id', $types_id)->get();
        foreach ($tours as $tour) {
            $tour->type = $tour->types()->value('name_type');
            $tour->rates = [
                'rate' => number_format($tour->rates()->avg('rate'), 0),
                'qty' => $tour->rates()->count('rate')
            ];
            $tour->images = $tour->images()->value('image');
            $tour->location = [
                'province' => $tour->provinces()->value('name'),
                'district' => $tour->districts()->value('name'),
                'ward' => $tour->wards()->value('name')
            ];
        }


        if ($tours) {
            return $this->response->responseSuccess(['tours' => $tours, 'provinces' => $provinces, 'types' => $tour_type]);
        }
        return $this->response->responseFailed();
    }
    public function show(Request $request)
    {
        $this->query->where('slug', $request->slug)->first();
        // $rate = $this->query->rates();
        $tour = Tour::where('slug', $request->slug)->first();
        //Kiểu du lịch của tour
        $tour->type = $tour->types()->value('name_type');
        //Lịch trình tour
        $tour->itineraries = $tour->itineraries()->orderBy('day')->get(['day', 'title', 'itinerary']);
        //Ảnh của tour
        $tour->images = $tour->images()->get('image');
        //Attributes của tour
        $tour->attributes = $tour->attributes()->get();
        //Hotels của tour
        $tour->hotels = $tour->hotels()->where('is_active', 1)->where('status', 1)->get();

        foreach ($tour->hotels as $hotel) {
            $hotel->images = $hotel->images()->take(1)->value('image');
        }
        //Địa điểm tour
        $tour->location = [
            'province' => $tour->provinces()->value('name'),
            'district' => $tour->districts()->value('name'),
            'ward' => $tour->wards()->value('name')
        ];
        //Đánh giá của tour
        $tour->rate = [
            'rate' => number_format($tour->rates()->avg('rate'), 0),
            'qty' => $tour->rates()->count('rate')
        ];
        //Bình luận của tour
        $tour->comments = $tour->comments()->orderByDesc('created_at')->get(['comments', 'name', 'created_at']);
        //Các tour cùng kiểu du lịch
        // $tour_same_type = Tour::where('is_active', 1)
        //     ->where('type_id', $this->query->type->id)->whereNot('id', $request->id)
        //     ->take(8)->get();
        // foreach ($tour_same_type as $tour) {
        //     $tour->type = $tour->types()->value('name_type');
        //     $tour->rates = [
        //         'rate' => number_format($tour->rates()->avg('rate'), 1),
        //         'qty' => $tour->rates()->count('rate')
        //     ];
        //     $tour->images = $tour->images()->value('image');
        //     $tour->location = [
        //         'province' => $tour->provinces()->value('name'),
        //         'district' => $tour->districts()->value('name'),
        //         'ward' => $tour->wards()->value('name')
        //     ];
        // }
        $data = [
            'tour' => $tour,

        ];
        if ($data) {
            $this->query->update(['views' => $tour->views += 1]);
            return $this->response->responseSuccess($data);
        }
        return $this->response->responseFailed();
    }
    public function review(Request $request)
    {

        $tour = Tour::where('id', $request->tour_id)->first();
        if ($tour) {
            $arr = [
                'comments' => $request->comments,
                'tour_id' => $tour->id,
                'name' => $request->name,
            ];
            TourComment::create($arr);
            if ($request->rate) {
                $arr['rate'] = $request->rate;
            }
            Rate::create($arr);
            return $this->response->responseSuccess([], "Đánh giá thành công");
        }
        return $this->response->responseFailed("Tour không tồn tại");
    }
}
