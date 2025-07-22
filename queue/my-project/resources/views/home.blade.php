@extends('layouts.app')

@section('content')
    <div class="row">
        <!--
                <div>
                    Статус Сотрудника - <span style="color:red;">На работе</span>
                    <button class="btn-primary btn">Поменять статус</button>
                </div>
                -->
    </div>
    <div class="row mt-4">
        <div>
            @if (!empty($t))
                Текущий талон
                <b>{{ $t->uuid }}</b>
            @else
                <b>Талонов нет</b>
            @endif
            <a href="/shift"><button class="btn-warning btn">Следущий</button>
            </a>
        </div>
    </div>
@endsection
