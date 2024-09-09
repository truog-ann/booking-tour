<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostComment extends Model
{
    use HasFactory;
    
    protected $table = 'post_comments';
    protected $fillable = ['comments','post_id','user_id'];
    public function post(){
        return $this->belongsTo(Post::class);
      }

      public function user(){
        return $this->belongsTo(User::class,'user_id');
      }
    
    
    }
