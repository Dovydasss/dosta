<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'page_id', 'author_id'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function comments()
{
    return $this->hasMany(Comment::class);
}



}

