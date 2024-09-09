<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'provinces';
    protected $fillable = ['name'];
    public function tour()
    {
        return $this->hasMany(Tour::class);

    }
    public function districts()
    {
        return $this->hasMany(District::class);

    }
    public function hotel()
    {
        return $this->hasMany(Hotel::class);

    }


}
