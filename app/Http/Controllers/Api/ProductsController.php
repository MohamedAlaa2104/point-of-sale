<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\ProductsResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function getCategories ()
    {
        $categories = Category::select('id', 'name_ar', 'name_en', 'renting_duration')->get();
        return response(CategoriesResource::collection($categories));
    }

    public function getProducts ($id)
    {
        $products = Product::select('id', 'name_ar', 'name_en')->where('category_id', $id)->get();
        return response(ProductsResource::collection($products));
    }
}
