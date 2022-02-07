<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'product_id', 'product_color_id', 'image-1', 'image-2', 'image-3', 'image-4'];

    public  function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function productColor() {
        return $this->belongsTo(ProductColor::class);
    }
}
