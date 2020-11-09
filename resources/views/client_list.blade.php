@include("header")

{{-- ///====PAGE TITLE --}}
<div class="page-title">
    <span class="fa fa-users" style="height: 40px; width: 40px; font-size: 40px; color: #505050;"></span>
    顧客一覧
</div>

{{-- ///====REGISTER BUTTON====/// --}}
{{-- <div id="client-list" class="btn-holder float-right">
    <a href="" class="register-btn btn-orange"><span class="fa fa-plus"></span> 新 規 追 加</a>
</div> --}}

<div class="d-flex">

    <div class="row row-content">
        <div class="content-width">

            <ul class="userlist-nav center list-unstyled">
                <a href="">
                    <li> 全て</li>
                </a>
            </ul>
            <ul class="userlist-nav center list-unstyled" style="float: right;">
                <a href="" onclick="adjustRowHeight()">
                    <li class="fa fa-list"> </li>
                </a>
            </ul>

            <hr />

            {{-- ///====CLIENT-TABLE HEADER====/// --}}
            <div id="table-nav" class="midori">
                <div class="flex-col">
                    <ul class="display list-unstyled">
                        <li> コード</li>
                        <li>会社名</li>
                        <li>責任者</li>
                        @if ($loggedInAuthority == config('constants.User_authority.システム管理者'))
                            <li>受注顧合計</li>
                            <li>実績粗利</li>
                        @endif

                        @if ($loggedInAuthority == config('constants.User_authority.システム管理者'))
                            <li><span class="fa fa-filter fa-lg"></span><span class="fa fa-caret-down"></span></li>
                        @endif
                    </ul>
                </div>
            </div>


            {{-- ///====CLIENT-TABLE DETAILS====/// --}}

            <div class="client table-body">

                @foreach ($list as $client)
                    <div class="card" id="client-row-{{ $client->client_id }}">
                        <div class=" card-header">
                            <div class="display list-unstyled">
                                <li>{{ $client->client_id }}</li>
                                <li>{{ $client->client_name }}</li>
                                <li>
                                    <img src="img/pro_icon.png" class="smallpic">
                                    {{-- <div class="user-name">{{ $client->user_id }}
                                    </div> --}}
                                    <div class="user-name">中村</div>
                                </li>

                                @if ($loggedInAuthority == config('constants.User_authority.システム管理者'))
                                    <li>5000,0000 円</li>
                                    <li>1200,0000 円</li>
                                @endif
                                <li><span><img src="img/edit.png" alt=""></span></li>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include("footer")
