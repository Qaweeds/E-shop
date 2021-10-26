<?php

namespace App\Models;

use App\Service\ImageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Product extends Model
{
    use HasFactory, Rateable;

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


    public function scopeAvailable()
    {
        return $this->where('in_stock', '>' , 0);
    }

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

    public function price()
    {
        if ($this->discount) {
            return round($this->price - ($this->price * $this->discount / 100), 2);
        }
        return round($this->price, 2);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'wishlist', 'product_id', 'user_id');
    }

    public function getUserRatingForCurrentProduct()
    {
        $rating = $this->ratings()->where('rateable_id', $this->id)->get();

        return $rating->where('user_id', auth()->id())->first();
    }
}
