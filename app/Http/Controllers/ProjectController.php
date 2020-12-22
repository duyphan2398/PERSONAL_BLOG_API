<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Transformers\CategoryTransformer;

class ProjectController extends Controller
{
    public function index(){
        $category = Category::query()->firstWhere('name', 'projects');
        return view('projects')->with([
            'category' => (new CategoryTransformer)->transform($category)
        ]);
    }
}
