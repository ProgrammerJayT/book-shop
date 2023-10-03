<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'order_item_id';

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
