<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;

class BlogPost extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = ['title', 'content', 'user_id'];

    public function user() {
      return $this->belongsTo(User::class);
    }

    public function comments(){
      return $this->hasMany(Comment::class);
    }
}
