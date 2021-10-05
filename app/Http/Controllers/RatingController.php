<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rating;
use App\Service\RatingProductService;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    protected $ratingModel;

    public function __construct(Rating $rating)
    {
        $this->ratingModel = $rating;
    }

    public function add(Product $product)
    {
        RatingProductService::calculate($this->ratingModel, $product);

        return redirect()->back();
    }

}
