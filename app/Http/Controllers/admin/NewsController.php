<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNews;
use App\Http\Requests\UpdateNews;
use App\Models\Category;
use App\Models\Grade;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNews $request)
    {
        News::create($request->validated());
        return redirect()->back()->with('success', 'Новость добавлена');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        $comments = $news->comments;
        foreach($comments as $comment){
            $comment->user_name = $comment->user->name;
        }
        $grades = Auth::user() ? Grade::where('user_id', Auth::user()->id)->where('news_id', $news->id)->first() : null;

        return view('news', ['news' => $news, 'comments' => $news->comments, 'grade' => $grades]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('edit-news-form', ['news' => $news, 'categories' => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNews $request, News $news)
    {
        $news->update($request->validated());
        return redirect()->back()->with('success', 'Новость обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->back()->with('success', 'Новость удалена');
    }

    public function changeLimit(News $news){
        if($news->is_blocked === 0){
            $news->update(['is_blocked' => true]);
        }else{
            $news->update(['is_blocked' => false]);
        }
        return redirect()->back()->with('success', 'Статус изменён!');
    }
}
