@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-column gap-3">
            <h1>Последние новости</h1>
            <div class="d-flex gap-5">
                @foreach ($new as $item)
                    <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header">{{ $item->created_at }}</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ $item->content }}</p>
                            <a href="news/{{$item->id}}">Читать</a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $new->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
