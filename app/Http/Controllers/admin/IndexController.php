<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke()
    {
        $newses = News::paginate(4);
        foreach($newses as $news){
            $news->category_name = $news->category->title;
        }
        return view('admin', ['categories' => Category::all(), 'newses' => $newses, 'users' => User::where('role', 'user')->paginate(4)]);
    }
}
