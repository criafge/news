@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $news->title }}</div>

                    <div class="card-body">
                        {{ $news->content }}
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column gap-4">
            <div class="d-flex align-items-center gap-5">
                <div class="d-flex gap-2 align-items-center">
                    <div>{{ $news->like }}</div><a href="{{ route('change-grade', [$news->id, 1]) }}">
                        @if ($grade !== null && $grade->like === 1)
                            <img style="width: 40px" src="/img/like-true.png" alt="">
                        @else
                            <img style="width: 40px" src="/img/like.png" alt="">
                        @endif
                    </a>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <div>{{ $news->dislike }}</div><a href="{{ route('change-grade', [$news->id, 0]) }}">
                        @if ($grade !== null && $grade->dislike === 1)
                            <img style="width: 40px; transform: rotate(180deg)" src="/img/dislike-true.png" alt="">
                        @else
                            <img style="width: 40px; transform: rotate(180deg)" src="/img/dislike.png" alt="">
                        @endif
                    </a>
                </div>
            </div>
            <form action="{{ route('create-comment', $news->id) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="content" class="form-label">Добавить комментарий</label>
                    <textarea class="form-control" name="content"></textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
            @foreach ($comments as $comment)
                <div class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ $comment->content }}</li>
                    </ul>
                    <div class="card-footer">{{ $comment->user_name }}</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
