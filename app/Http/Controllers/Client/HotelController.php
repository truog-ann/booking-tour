<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseJson;
use Exception;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    //
    protected $responseJson;
    public function __construct(ResponseJson $responseJson)
    {
        $this->responseJson = $responseJson;
    }
    public function show(Request $request)
    {
        $hotel = \App\Models\Hotel::find($request->id);
        if ($hotel) {
            //Địa chỉ khách sạn
            $hotel->location = [
                'province' => $hotel->province()->value('name'),
                'district' => $hotel->district()->value('name'),
                'ward' => $hotel->ward()->value('name'),
            ];

            //Dịch vụ khách sạn
            $hotel->services = $hotel->services()->get();

            //Ảnh khách sạn
            $hotel->images = $hotel->images()->get('image');

            //Bình luận
            $hotel->comments = $hotel->comments()->orderByDesc('created_at')->get();


            return $this->responseJson->responseSuccess($hotel);

        }
        return $this->responseJson->responseFailed();

    }
}
