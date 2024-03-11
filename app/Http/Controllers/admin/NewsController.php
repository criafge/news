<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNews;
use App\Http\Requests\UpdateNews;
use App\Models\News;

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
        return view('news', ['news' => $news]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('update-news', ['news' => $news]);
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
}
