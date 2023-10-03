<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ItemImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'item_id';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function itemImages() 
    {
        return $this->hasMany(BookImage::class, 'item_id');
    }
}
