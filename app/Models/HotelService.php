<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelService extends Model
{
    use HasFactory;
    protected $table='hotel_service';
    protected $fillable =['id','hotel_id','service_id'];

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
