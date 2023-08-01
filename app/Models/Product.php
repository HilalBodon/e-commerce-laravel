<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'category_id'];//i have to add image id an make it function.

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}