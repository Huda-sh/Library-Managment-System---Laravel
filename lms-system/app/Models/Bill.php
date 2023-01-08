<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable=['date','address','total','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function billItems()
    {
        return $this->hasMany(BillItem::class);
    }

}
