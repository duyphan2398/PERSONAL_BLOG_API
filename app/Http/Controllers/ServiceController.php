<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Transformers\CategoryTransformer;

class ServiceController extends Controller
{
    public function index(){
        $category = Category::query()->firstWhere('name', 'services');
        return view('blade_shared')->with([
            'category' => (new CategoryTransformer)->transform($category)
        ]);
    }
}
