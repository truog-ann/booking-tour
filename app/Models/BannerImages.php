<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerImages extends Model
{
    use HasFactory;
   

    protected $table = 'banner_images';
    protected $fillable = [
        'banner_id',
        'image'
    ];
    public function banner(){
        return $this->belongsTo(Banner::class);
    }
}
