<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotels';
    protected $fillable = [
        'name',
        'price',
        'promotion',
        'description',
        'province_id',
        'district_id',
        'ward_id',
        'address',
        'status',
        'location',
        'is_active'
    ];
    public function province()
    {

        return $this->belongsTo(Province::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class, 'hotel_service');
    }
    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tour_hotel');
    }
    public function images()
    {
        return $this->hasMany(HotelImage::class);
    }
    public function comments()
    {
        return $this->hasMany(HotelComment::class);
    }
}
