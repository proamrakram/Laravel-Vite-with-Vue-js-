<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class SearchingController extends Controller
{
    public function searchProducts()
    {
        $products = Product::with('category')->filter(request()->all())->paginate(10);
        return response()->json([ 'products' => $products]);
    }

    public function searchTrashedProducts()
    {
        $products = Product::with('category')->onlyTrashed()->filter(request()->all())->paginate(10);
        return response()->json([ 'products' => $products ]);
    }
}
