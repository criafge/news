@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('home') }}">Назад</a>
        <div class=" d-flex justify-content-center">
            <form action="{{ route('news.update', $news->id) }}" method="POST" class="w-50">
                @csrf
                @method('patch')
                <div class="mb-3">
                    <label for="title" class="form-label">Название</label>
                    <input type="text" class="form-control" name="title" value="{{ $news->title }}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Описание</label>
                    <textarea class="form-control" name="content">{{ $news->content }}</textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <select name="category_id" class="form-select">
                        @foreach ($categories as $category)
                            @if ($news->category_id === $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->title }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
