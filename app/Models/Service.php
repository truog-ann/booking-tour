<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory;
    
    protected $table = 'services';
    protected $fillable = [
        'service'
    ];
    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_service');
    }
}
