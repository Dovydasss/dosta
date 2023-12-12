<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'blog_post_id', 'user_id']; // Add necessary fields here


    public function blogPost()
{
    return $this->belongsTo(BlogPost::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
