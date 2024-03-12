<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComment;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, News $news)
    {
        $request->validate([
            'content' => 'required'
        ], [
            'content.required' => 'Введите текст комментария'
        ]);
        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::user()->id,
            'news_id' => $news->id,
        ]);
        return redirect()->back();
    }
}
