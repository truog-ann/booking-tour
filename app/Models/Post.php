<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    
    protected $table = 'posts';
    protected $fillable = [
      'title','slug','body','views','thumbnail','is_active'

    ];
    public function comments(){
      return $this->hasMany(PostComment::class);
    }
}
