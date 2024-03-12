@extends('layouts.app')

@section('content')
    <div class="container">
        @if (auth()->user()->is_blocked !== 0)
            <h2>Ваш профиль заблокирован</h2>
        @endif
        <div class="row justify-content-center">
            <form action="{{ route('update-user') }}" method="POST" class="w-50">
                <h2>Изменить данные профиля</h2>

                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Имя</label>
                    <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" name="password">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </form>

        </div>
    </div>
@endsection
