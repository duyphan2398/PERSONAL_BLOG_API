<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Post;
use App\Transformers\CategoryTransformer;
use App\Transformers\PostTransformer;

class HomeController extends Controller
{
    public function index(){
        $category = Category::query()->firstWhere('name', 'home');
        return view('home')->with([
            'category' => (new CategoryTransformer)->transform($category)
        ]);
    }

    public function getPost(Post $post){
        return view('post')->with([
            'post' => (new PostTransformer)->transform($post)
        ]);
    }
}
