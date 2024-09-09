<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserVoucher extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'user_voucher';
    protected $fillable =[
        'voucher_id',
        'user_id',
        'using_voucher'
    ];
}
