@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-center">
            <form action="{{ route('news.store') }}" method="POST" class="w-50">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Название</label>
                    <input type="text" class="form-control" name="title">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Описание</label>
                    <textarea class="form-control" name="content"></textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <select name="category_id" class="form-select">
                        <option value="" selected>Выберите категорию</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>

        </div>

        <div class="d-flex flex-column gap-3">
            <h1>Новости</h1>
            <div class="d-flex gap-5">
                @foreach ($newses as $news)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">{{ $news->title }}</h5>
                                <form action="{{ route('news.destroy', $news->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-light"><img src="./img/basket.png"
                                            alt="X" style="height: 25px"></button>
                                </form>
                            </div>
                            <h6 class="card-subtitle mb-2 text-body-secondary">{{ $news->category_name }}</h6>
                            @if ($news->is_blocked === 0)
                                <h6 class="card-subtitle mb-2 text-body-secondary">Ограничений нет </h6>
                            @else
                                <h6 class="card-subtitle mb-2 text-body-secondary">Заблокирована</h6>
                            @endif
                            <h6 class="card-subtitle mb-2 text-body-secondary">{{ $news->created_at }}</h6>
                            <p class="card-text">{{ $news->content }}</p>
                            <div class="d-flex align-items-center gap-3">
                                <a href="{{ route('news.edit', $news->id) }}" class="card-link">Редактировать</a>
                                @if ($news->is_blocked === 0)
                                    <a href="{{ route('change-limit', $news->id) }}"
                                        class="btn btn-outline-danger">Заблокировать</a>
                                @else
                                    <a href="{{ route('change-limit', $news->id) }}"
                                        class="btn btn-outline-success">Разблокировать</a>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            {{ $newses->links('pagination::bootstrap-5') }}
        </div>

        <div class="d-flex flex-column gap-3">
            <h1>Пользователи</h1>
            @foreach ($users as $user)
                <div class="d-flex gap-5">
                    <div class="card border-light mb-3" style="max-width: 18rem;">
                        @if ($user->is_blocked === 0)
                            <div class="card-header">Не в блоке</div>
                        @else
                            <div class="card-header">Заблокирован</div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <h5 class="card-title">{{ $user->email }}</h5>
                            @if ($user->is_blocked === 0)
                                <a href="{{ route('change-user-limit', $user->id) }}"
                                    class="btn btn-outline-danger">Заблокировать</a>
                            @else
                                <a href="{{ route('change-user-limit', $user->id) }}"
                                    class="btn btn-outline-success">Разблокировать</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
@endsection
