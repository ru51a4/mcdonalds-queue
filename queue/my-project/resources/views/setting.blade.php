@extends('layouts.app')

@section('content')
    <style>
        .gget .btn-primary {
            min-width: 150px;
            margin: 10px;
        }
    </style>
    <div class="row d-flex justify-content-center align-items-center gget">
        <div class="d-flex col-4 justify-content-between align-items-center flex-wrap">
            @foreach ($tasks as $task)
                <div> <span class="btn btn-primary">{{ $task->name }}</span>
                    <a href="/delete/{{ $task->id }}">
                        <button class="btn btn-danger">Удалить</button>
                    </a>
                    <a href="/toggle/{{ $task->id }}">
                        @if (!isset($t[$task->id]))
                            <button class="btn btn-warning">Назначить</button>
                        @else
                            <button class="btn btn-danger">Убрать</button>
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
        <div class="d-flex col-4 justify-content-center align-items-center">
            <form action="/add" class="d-flex flex-column" method="POST">
                <input class="form-control" name="name" type="text">
                <button class="btn mt-3 btn-success">Добавить</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            </form>
        </div>
    </div>
@endsection
