@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <h1>{{ $code }}</h1>
    </div>
    <div class="row">
        <a href="/gget">
            <button class="btn btn-primary">
                Следующий
            </button>
        </a>
    </div>
@endsection
