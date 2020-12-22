<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Transformers\CategoryTransformer;

class ContactController extends Controller
{
    public function index(){
        $category = Category::query()->firstWhere('name', 'contact');
        return view('contacts')->with([
            'category' => (new CategoryTransformer)->transform($category)
        ]);
    }
}
