<!DOCTYPE html>
<html>

<head>
    <title>GT宮崎 稼働管理</title>

    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/sweetalert2.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>

    <script src="/js/lookup.js"></script>
    <script src="/js/sweetalert2.min.js"></script>
    <script src="/js/validator.js"></script>
    <script src="/js/toast.js"></script>

    <script>
    function showBody() {
        $("body").css('transition', '2s ease-in');
        $("body").css('opacity', '1');
        setTimeout(function() {
            $("body").css('transition', 'unset')
        }, 2000);
    }

    fetchUserList();
    fetchClientList();
    </script>
</head>

<body>

    <input type="hidden" id="CSRF-TOKEN" value="{{ csrf_token() }}">
    {{--

    <body style="opacity: 0;" onload="showBody()"> --}}

    <div id="id01" class="w3-modal">
        <div class="w3-modal-content">
            <div class="w3-container ">

                <div class="w3-modal-content-header"> お願い </div>
                <hr>

                <span class="w3-container-text">スクリーンの解像度の影響で画面が正確に表示されておりませんと検出致しました。
                    恐れ入りますが、
                    デザインがスクリーンと合うまで、</span>
                </br></br>

                <div class="w3-container-text"> Windowsの場合は、<span class="w3-container-button">Ctrl ー</span> と、</div>
                <div class="w3-container-text"> Macの場合は、<span class="w3-container-button">Cmd ー</span> </div>
                </br>
                <div class="w3-container-text"> をお押しください。
                </div>
            </div>
        </div>
    </div>

    @include("sidebar")

    <div id="background-shade"></div>
    <div id="background-shade-for-design-anomaly" class="bg-shade"></div>
    <div class="page-container">