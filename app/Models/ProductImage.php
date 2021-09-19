<?php

namespace App\Models;

use App\Service\ImageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'product_id'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function setPathAttribute($image)
    {

        $this->attributes['path'] = ImageService::upload($image);
    }
}
