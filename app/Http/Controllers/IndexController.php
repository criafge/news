<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {

        return view('index', ['new' => News::latest()->limit(12)->paginate(4)]);
    }
}
