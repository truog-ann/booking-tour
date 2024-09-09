<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
{
  use HasFactory;
  use SoftDeletes;
  protected $table = 'tours';
  protected $fillable = [
    'id',
    'type_id',
    'title',
    'slug',
    'day',
    'description',
    'price',
    'promotion',
    'views',
    'location',
    'province_id',
    'district_id',
    'ward_id',
    'type',
    'is_active'

  ];
  public function attributes(){
    return $this->belongsToMany(Attribute::class,'tour_attribute');
}
  public function images()
  {
    return $this->hasMany(TourImage::class);
  }
  public function types()
  {
    return $this->belongsTo(TourType::class, 'type_id');
  }
  public function rates()
  {
    return $this->hasMany(Rate::class);
  }
  public function itineraries()
  {
    return $this->hasMany(Itinerary::class);
  }
  public function comments()
  {
    return $this->hasMany(TourComment::class);
  }
  public function provinces()
  {
    return $this->belongsTo(Province::class, 'province_id');
  }
  public function districts()
  {
    return $this->belongsTo(District::class, 'district_id');
  }
  public function wards()
  {
    return $this->belongsTo(Ward::class, 'ward_id');
  }
  public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'tour_hotel');
    }
}
