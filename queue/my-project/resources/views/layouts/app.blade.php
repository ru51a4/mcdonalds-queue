<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>McDonalds</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/jumbotron/">


    <!-- Bootstrap core CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src='https://www.hCaptcha.com/1/api.js' async defer></script>

    <script src="/js/app.js"></script>
    <style>
        .container {
            background: white;
        }

        .avatar {
            margin: 10px;
            max-width: 80px;
            border: 2px solid black;
        }

        .nickname {
            text-align: center
        }

        .nickname-author {
            font-weight: bold;
        }

        .card:not(:last-child) {
            border-bottom: 0px !important;
        }

        .card {
            border-radius: 0px !important;
            padding: 0px !important;
        }

        a:not(:last-child) .card {
            border-bottom: 0px !important;
        }

        .card-avatar {
            margin-top: 5px;
        }

        .dashboard a {
            color: black;
            text-decoration: auto;
        }

        .auth .nickname-author {
            margin-right: 10px;
        }

        .container {
            background-color: white !important;
            margin: 20px;
            border-radius: 10px;
            min-height: 90vh;
            display: flex;
            flex-direction: column;

        }

        body {
            background: url(https://thumbs.gfycat.com/PotableEmbarrassedFrenchbulldog-max-1mb.gif) repeat;
        }

        footer {
            margin-top: 100%;
            cursor: pointer;
            justify-self: flex-end;
        }

        .card-body {
            justify-content: space-between !important;
            display: flex;
            flex-direction: column;
        }

        .card-bottom {
            display: flex;
            justify-content: space-between;
        }

        .reply div {
            color: black !important;
        }

        footer {
            margin-top: auto !important;
        }

        .card-text {
            word-break: break-all;
        }

        .card-avatar {
            max-width: 10%;
            min-width: 100px;
        }

        .status {
            font-weight: 100;
            font-size: 12px;
            margin: 0px !important;
        }

        body {
            display: flex;
            justify-content: center;
        }

        .post_image {
            max-width: 300px;
        }

        .reply {
            cursor: pointer;
            background-color: #f6993f;
        }
    </style>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


</head>

<body>

    <div class="container py-4">
        <header class="pb-3 mb-4 border-bottom d-flex flex-row justify-content-between">
            <div class="logo">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <img src="/logo.png" width="100px" class="mx-2">
                    <span class="fs-4">McDonalds</span>
            </div>
            @if (auth()->user())
                <div class="auth d-flex flex-row align-items-center">
                    <a href="/user">
                        <div class="nickname-author">{{ auth()->user() ? auth()->user()->name : '' }}</div>
                    </a>
                    <a href="/logout">
                        <button type="submit" class="btn btn-primary">Выйти</button>
                    </a>
                </div>
            @endif
            </a>
        </header>
        <div class="d-flex justify-content-center flex-row align-items-center flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if (Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                @endif
            @endforeach
        </div>
        @yield('content')
        <footer class="pt-3 text-muted border-top">
            ru51a4 &copy; 2025
        </footer>
    </div>
    <!-- Modal -->
    <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="modalzoomimage" src="">
                </div>

            </div>
        </div>
    </div>

    <style>
        .modal-dialog {
            max-width: max-content !important;
        }

        .modal-body {
            display: flex;
            justify-content: center;
        }
    </style>
</body>

</html>
