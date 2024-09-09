<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = 'districts';
    protected $fillable = ['name','province_id','ward'];
    public function province()
    {
        return $this->belongsTo(Province::class);

    }
    public function wards()
    {
        return $this->hasMany(Ward::class);

    }
    public function tour()
    {
        return $this->hasMany(Tour::class);

    }
    public function hotel()
    {
        return $this->hasMany(Hotel::class);

    }
}
