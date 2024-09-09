<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TourRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        $priceString = str_replace('.', '', $request->price);
        $promotionString = str_replace('.', '', $request->promotion);

        // Chuyển đổi chuỗi thành số
        $price = intval($priceString);
        $promotion = intval($promotionString);

        if ($promotion > $price) {
             back()->withInput()->with('promotion', 'The promotion field must be less than price');
        }

        if(count($request->itineraries) === 0 || count($request->title_itineraries)){
            back()->withInput()->with('vudz', 'The  itineraries field must required');

        }
        return [
            'title' => 'required|max:255',
            'price' => 'required',
            'promotion' => 'required',
            'day' => 'required|numeric',
            'attributes' => 'required|array',
            'attributes.*' => 'required|numeric|exists:attributes,id',
            'type_id' => 'required|exists:tour_types,id',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'ward_id' => 'required|exists:wards,id',
            'is_active'=>'nullable',
            'description' => 'required',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif',
            'hotels'=>'required',
            'hotels.*' => 'required|numeric|exists:hotels,id',
            'itineraries'=> 'required|array',
            'itineraries .*'=>'required',
            'title_itineraries'=>'required|array',
            'title_itineraries .*'=>'required'
        ];
    }
}
