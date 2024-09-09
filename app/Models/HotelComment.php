<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelComment extends Model
{
    use HasFactory;
    
    protected  $table = 'hotel_comments';
    protected $fillable = [
        'comments', 
        'hotel_id',
        'user_id'
    ];

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
