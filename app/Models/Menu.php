<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'is_visible'];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'menu_page', 'menu_id', 'page_id');
    }

    public function getMenuItemsOrderedAttribute()
    {
        return $this->menuItems()->orderBy('order')->get();
    }



    
}
