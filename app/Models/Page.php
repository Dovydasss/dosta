<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'published', 'is_blog'];
    
    public function menus()
{
    return $this->belongsToMany(Menu::class, 'menu_page', 'page_id', 'menu_id');
}

public function blogPosts()
{
    return $this->hasMany(BlogPost::class);
}


}
