<?php

namespace App\Models;

use App\Service\ImageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'short_description',
        'SKU',
        'price',
        'discount',
        'in_stock',
        'thumbnail',
        'category_id',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function gallery()
    {
        return $this->hasMany(ProductImage::class);
    }


    public function setThumbnailAttribute($image)
    {
        if (!empty($this->attributes['thumbnail'])) {
            ImageService::remove($this->attributes['thumbnail']);
        }

        $this->attributes['thumbnail'] = ImageService::upload($image);
    }
}
