<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class HotelRequest extends FormRequest
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
        return [
            'name' => 'required',
            'price' => 'required',
            'promotion' => 'required',
            'services' => 'required',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif',
            'description' => 'required',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'ward_id' => 'required|exists:wards,id',
            'address' => 'required',
            'status' => 'nullable',
            'is_active' => 'nullable',
        ];
    }
}
