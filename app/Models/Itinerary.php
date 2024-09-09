<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Itinerary extends Model
{
    use HasFactory;
    
    protected $table ='itineraries';
    protected $fillable = [
        'tour_id',
        'day',
        'title',
        'itinerary'

    ];
    public function tour(){
        return $this->belongsTo(Tour::class);
    }
}
