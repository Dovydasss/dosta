<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Header extends Model
{
    use HasFactory;
    protected $table = 'header';
    protected $fillable = [
        'show_header',
        'header_image',
        'header_first',
        'width',
        'height'

    ];

    public function getHeaderImageUrlAttribute()
    {
        if ($this->header_image) {
            return Storage::url($this->header_image);
        }

        return null;
    }
}
