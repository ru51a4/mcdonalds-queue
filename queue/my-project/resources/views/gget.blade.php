@extends('layouts.app')

@section('content')
    <style>
        .gget .btn-primary {
            min-width: 150px;
            margin: 10px;
        }
    </style>
    <div class="row d-flex justify-content-center align-items-center gget">
        <div class="d-flex col-4 justify-content-center align-items-center flex-wrap">
            @foreach ($tasks as $task)
                <a href="/new/{{ $task->id }}">
                    <button class="btn btn-primary">{{ $task->name }}</button>
                </a>
            @endforeach
        </div>
    </div>
@endsection
