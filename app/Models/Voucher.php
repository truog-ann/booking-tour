<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'vouchers';
    protected $fillable = [
      'voucher',  
      'title',
      'qty',
      'value',
      'discount_type',  
      'max',
      'start',
      'end',
      'status'
    ];
    public function users()
    {
      return $this->belongsToMany(Voucher::class, 'user_voucher');
    }
}
