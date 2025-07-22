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
                <b>Текущий талон - нет</b>
            @endif
            @if ($disabled && empty($t))
                <a href="/shift"><button disabled="true" class="btn-warning btn">Следущий</button>
                </a>
                <script>
                    window.setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                </script>
            @else
                <a href="/shift"><button class="btn-warning btn">Следущий</button>
                </a>
                @if (!empty($t))
                    <a href="/leave"><button class="btn-danger mx-2 btn">Закончить</button>
                    </a>
                @endif
            @endif

        </div>
    </div>
@endsection
