<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BlogPost;
use App\Models\User;

class Comment extends Model
{
    use HasFactory; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'comment',
        'user_id', 
        'blog_post_id',
    ];

    /**
     * Get the user that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the blog post that the comment belongs to.
     */
    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }
}
