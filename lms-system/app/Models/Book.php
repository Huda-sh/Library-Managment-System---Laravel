<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable=['name','author','date','price','category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function billItem()
    {
        return $this->hasMany(BillItem::class);
    }
    public function cartItem()
    {
        return $this->hasMany(CartItem::class);
    }
    public function rent()
    {
        return $this->hasMany(Rent::class);
    }
}
