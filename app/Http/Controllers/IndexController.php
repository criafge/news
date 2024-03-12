<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {

        return view('index', ['new' => News::latest()->limit(12)->paginate(4), 'popular' => News::orderBy('like', 'desc')->limit(12)->paginate(4), 'categories' => Category::all()]);
    }
}
