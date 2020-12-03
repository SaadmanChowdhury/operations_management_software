<!DOCTYPE html>
<html>

<head>
    <title>GT宮崎 稼働管理</title>

    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="stylesheet" href="/css/app.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="/js/dynamic-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>

    <script>
        function showBody() {
            $("body").css('transition', '2s ease-in');
            $("body").css('opacity', '1');
            setTimeout(function() {
                $("body").css('transition', 'unset')
            }, 2000);
        }

    </script>
</head>

<body>

    <input type="hidden" id="CSRF-TOKEN" value="{{ csrf_token() }}">
    {{--

    <body style="opacity: 0;" onload="showBody()"> --}}

        @include("sidebar")

        <div id="background-shade"></div>
        <div class="page-container">
