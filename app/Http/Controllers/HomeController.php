<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Transformers\CategoryTransformer;

class HomeController extends Controller
{
    public function index(){
        $category = Category::query()->firstWhere('name', 'home');
        return view('home')->with([
            'category' => (new CategoryTransformer)->transform($category)
        ]);
    }
}
