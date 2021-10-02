<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function productImageDelete($id)
    {
        $image = ProductImage::query()->find($id);
        $image->delete();
        return response()->json(['success' => 'Image was delete successfully.']);
    }
}
