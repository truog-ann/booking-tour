<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourImage extends Model
{
    use HasFactory;
    protected $table = 'tour_images';
    protected $fillable = [
        'tour_id',
        'image'
    ];
    public function tour(){
        return $this->belongsTo(Tour::class);
    }
}
