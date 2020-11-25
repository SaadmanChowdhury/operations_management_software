@include("header")

{{-- ///====PAGE TITLE --}}
<div class="page-title">
    <span class="fa fa-users"></span>
    顧客一覧

    <input type="hidden" id="page-name" value="client_list">
    <input type="hidden" id="initial-preference" value="{{ $initialPreference }}">
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

                @if ($loggedInUser->user_authority == config('constants.User_authority.システム管理者'))
                <a href="" onclick="clientRegisterModalHandler()">
                    <li> + 登録</li>
                </a>
                @endif
            </ul>

            <hr />

            {{-- ///====CLIENT-TABLE HEADER====/// --}}
            <div id="table-nav" class="midori">
                <div class="flex-col">
                    <ul class="display list-unstyled">
                        <li> コード</li>
                        <li>会社名</li>
                        <li>責任者</li>
                        <li>受注顧合計</li>
                        <li>実績粗利</li>

                        <li><span class="fa fa-filter fa-lg fa-color-mild-midori">Filter</span></li>

                    </ul>
                </div>
            </div>


            {{-- ///====CLIENT-TABLE DETAILS====/// --}}

            <div class="client table-body">

                @foreach ($list as $client)
                    <div class="card _client" id="client-row-{{ $client->client_id }}">
                        <div class="card-header">
                            <div class="display list-unstyled">
                                <li>{{ $client->client_id }}</li>
                                <li>{{ $client->client_name }}</li>
                                <li>
                                    <img src="img/pro_icon.png" class="smallpic">
                                    <div class="user-name">
                                        {{ $client->user_id }}
                                    </div>
                                    {{-- <div class="user-name">中村</div>
                                    --}}
                                </li>

                                @if ($loggedInAuthority == config('constants.User_authority.システム管理者') || $loggedInUser->user_id == $client->user_id)
                                    <li>{{ $client->total_sale }} 円</li>
                                    <li>{{ $client->total_profit }} 円</li>

                                    <li>
                                        <div class="edit" onclick="clientEditModalHandler({{ $client->client_id }})">
                                            <span style="font-size: 11px; margin:6px;width:auto"
                                                class="fa fa-pencil"></span>編集
                                        </div>
                                    </li>
                                @else
                                    <li class="transparent">円</li>
                                    <li class="transparent">円</li>

                                    <li>
                                        <div class="edit transparent">
                                            <span style="font-size: 11px; margin:6px;width:auto"
                                                class="fa fa-pencil"></span>編集
                                        </div>
                                    </li>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@include("client.edit")
@include("client.create")

<script src="/js/client.js"></script>
@include("footer")
