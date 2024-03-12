@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between text-bg-dark">
            @foreach ($categories as $item)
                <p><a href="{{route('category', $item->id)}}"
                        class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">{{$item->title}}</a></p>
            @endforeach
        </div>
        <div class="d-flex flex-column gap-3">
            <h1>Последние новости</h1>
            <div class="d-flex gap-5">
                @foreach ($new as $item)
                    <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header">{{ $item->created_at }}</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ $item->content }}</p>
                            <p class="card-text">Оценили: {{ $item->like }}</p>
                            <p class="card-text">Не оценили: {{ $item->dislike }}</p>
                            <a href="news/{{ $item->id }}">Читать</a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $new->links('pagination::bootstrap-5') }}
        </div>
        <div class="d-flex flex-column gap-3">
            <h1>Популярные новости</h1>
            <div class="d-flex gap-5">
                @foreach ($popular as $item)
                    <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header">{{ $item->created_at }}</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ $item->content }}</p>
                            <p class="card-text">Оценили: {{ $item->like }}</p>
                            <p class="card-text">Не оценили: {{ $item->dislike }}</p>
                            <a href="news/{{ $item->id }}">Читать</a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $popular->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
