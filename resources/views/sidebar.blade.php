<div class="container-fluid">
    {{-- ////====HEADER====//// --}}
    {{-- <div class="logo-holder box-shadow">
        <div class="header-icon row">
            <div class="sys-name">
                <img class="float-left" src="img/favicon.png">
                <h6 class="label-text float-left">実績管理システム</h6>
            </div>

            <div class="user-profile">
                <a href="{{ route('logout') }}" class="fa fa-sign-out float-right" id="sidebar-logout"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <p class="label-text float-right">ソフィア<br><span class="text-xs">ユーザー</span></p>
                <img class="float-right" src="img/pro_icon2.png">

            </div>
        </div>
    </div> --}}


    <div id="header_top" onmouseenter="sidebar_expand(this)" onmouseleave="sidebar_contract(this)">
        {{-- <div id="header_top" onmouseenter="sidebar_expand(this)">
            --}}


            <div class="container">
                <div class="p-r list-unstyled" id="nav">

                    <li>
                        <a href="/assign">
                            <img src="img/svghome.svg" alt=""id="sidebar-svg" >
                            <span class="label-text sidebar hide">アサインサマリー</span>
                        </a>
                    </li>

                    <li>
                        <a href="/project">
                            <img src="img/projectsvg.svg" alt=""id="sidebar-svg" >
                            <span class="label-text sidebar hide">案件一覧</span>
                        </a>
                    </li>

                    <li>
                        <a href="/user">
                            <img src="img/usersvg.svg" alt=""id="sidebar-svg" >
                            <span class="label-text sidebar hide">ユーザー一覧</span>
                        </a>
                    </li>

                    <li>
                        <a href="/client">
                            <img src="img/clientsvg.svg" alt=""id="sidebar-svg" >
                            <span class="label-text sidebar hide">顧客一覧</span>
                        </a>
                    </li>

                    <li id="sidebar-logout-link-li">
                        <a href="{{ route('logout') }}" id="sidebar-logout-link"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <img src="img/logout-svg.svg" alt=""id="sidebar-svg" >
                            <span class="label-text sidebar hide">ログアウト</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                    {{-- <li>
                        <a href="">
                            <span class="fa fa-sign-out " id="sidebar-logout"></span>
                            <span class="label-text hide">ログアウト</span>
                        </a>
                    </li> --}}

                </div>
            </div>
        </div>
    </div>
