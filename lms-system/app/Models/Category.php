<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // this to ensure that the model is ascoiated wiht the specified table
    protected $fillable=['name'];
    // protected $guarded=[];
    protected $table = "categories";


    public function books(){
        return $this->hasMany(Book::class);
    }
}
