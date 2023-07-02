<?php

namespace App\Models;

use App\Models\Category;
use App\Models\BookImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'book_id';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookImages() 
    {
        return $this->hasMany(BookImage::class, 'book_id');
    }
}
