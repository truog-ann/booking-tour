<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourHotel extends Model
{
    use HasFactory;
    protected $table = 'tour_hotel';
    protected $fillable = [
        'tour_id',
        'hotel_id',
    ];
}
