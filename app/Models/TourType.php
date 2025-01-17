<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tour_types';

    protected $fillable =[
          'name_type'
    ];
    public function tour(){
        return $this->hasMany(Tour::class);

    }
}
