<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Shorten Link</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

</head>
<body>
<div class="d-flex vh-100 justify-content-center align-items-center">

    <div class="p-3">
        <div class="d-flex justify-content-center">
            <img src="{{asset('logo.svg')}}" alt="Profilance Group Logo">
        </div>

        <div id="alert"></div>

        <div class="mt-4 bg-white shadow">
            <div class="p-4 d-flex flex-column align-items-center">
                <div class="lead font-weight-bold">
                    Тестовое задание
                </div>
                <div class="mt-4 text-center">
                    <form id="form" method="POST" action="{{ route('shorten-link') }}">
                        @csrf
                        <div class="form-group mb-4">
                            <input id="link" type="text" name="link" class="form-control" placeholder="Введите ссылку">
                        </div>
                        <button id="button" class="btn btn-success" type="submit">Сократить</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-4 sm:items-center sm:justify-between">

            <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $(document).ready(function () {
        let form = $('#form'),
            button = $('#button'),
            link = $('#link'),
            alert = $('#alert');

        button.on('click', function (e) {
            e.preventDefault();

            if(link.val() && is_url(link.val())){
                $.ajax({
                    method: 'POST',
                    url: "{{route('shorten-link')}}",
                    data: {
                        'link': link.val()
                    },
                    success: function(data){
                        console.log(data)
                        alert.html('<div class="mt-4 alert alert-success">Ссылка: <a href="'+data.link+'">'+data.shorten_link+'</a></div>');
                    },
                    error: function (data) {
                        alert.html('<div class="mt-4 alert alert-danger">'+data+'</div>');
                    }
                });
            } else {
                alert.html('<div class="mt-4 alert alert-danger">Введите валидную ссылку!</div>');
            }
        });
    });

    function is_url(str)
    {
        let regexp =  /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
        return regexp.test(str);
    }

</script>

</body>
</html>
