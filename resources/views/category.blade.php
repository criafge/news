@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-column gap-3">
            @foreach ($news as $item)
                <div class="card">
                    <div class="card-header">
                        {{$item->created_at}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$item->title}}</h5>
                        <p class="card-text">{{$item->content}}</p>
                        <a href="/news/{{ $item->id }}" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
