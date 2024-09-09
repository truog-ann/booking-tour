<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ward extends Model
{
    use HasFactory;
    protected $table = 'wards';
    protected $fillable = ['name', 'district_id'];
    public function district()
    {
        return $this->belongsTo(District::class);

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
