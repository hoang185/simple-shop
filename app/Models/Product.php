<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'cat_id', 'product_color_id', 'name', 'namevi', 'size', 'image', 'price', 'quantity', 'product_sale', 'product_new', 'product_best',
    ];
    public function category(){
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }

    public function attribute() {
        return $this->hasMany(Attribute::class);
    }
}
