<?php


namespace App\Service;


use App\Models\Product;
use App\Models\Rating;
use App\Service\Contracts\RatingProductServiceInterface;

class RatingProductService implements RatingProductServiceInterface
{

    public static function calculate(Rating $model, Product $product)
    {

        $rating = $product->ratings()->where('user_id', auth()->id())->first();
        if (is_null($rating)) {
            $model->rating = request()->post('star');
            $model->user_id = auth()->id();
            $product->ratings()->save($model);
        } else {
            $rating->update(['rating' => request()->post('star')]);
        }
    }
}
