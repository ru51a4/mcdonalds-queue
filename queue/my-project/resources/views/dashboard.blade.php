@extends('layouts.app')

@section('content')
    <style>
        .gget .btn-primary {
            min-width: 150px;
            margin: 10px;
        }
    </style>
    <div class="row d-flex justify-content-center">
        <div class="col-6 d-flex justify-content-center align-items-center flex-column">
            <div class="row">
                <h2>В ожидание</h2>
            </div>
            <div class="row mt-5 d-flex justify-content-center align-items-center flex-column">
                @foreach ($tasks as $task)
                    <div>
                        <h4>{{ $task->uuid }}</h4>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="col-6 d-flex  align-items-center flex-column">
            <div class="row">
                <h2>В работе</h2>
            </div>
            <div class="row mt-5">
                @foreach ($tasks_currrent as $task)
                    <div>
                        <h4>{{ $task->uuid }} - Сотрудник({{ $task->user->name }}) </h4>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        window.setTimeout(function() {
            window.location.reload();
        }, 3000);
    </script>
@endsection
