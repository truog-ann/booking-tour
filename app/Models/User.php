<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Model implements Authenticatable
{
  use Notifiable;

  use AuthenticableTrait;
  use HasFactory;
  use SoftDeletes;
  protected $table = 'users';
  protected $fillable = [
    'name',
    'avatar',
    'email',
    'password',
    'date_of_birth',
    'phone',
    'address',
    'role',
    'is_active',


  ];
  public function vouchers()
  {
    return $this->belongsToMany(Voucher::class, 'user_voucher');
  }
  public function post_comment()
  {
    return $this->belongsTo(PostComment::class, 'post_id');
  }
  public function tour_comments()
  {
    return $this->hasMany(User::class);
  }
  public function bookings()
  {
    return $this->hasMany(Booking::class);
  }

}
