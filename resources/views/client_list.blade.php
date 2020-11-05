@include("header")

{{-- ///====PAGE TITLE --}}
        <div class="page-title float-left">
            <h2 style="color: black;margin-left:21px">お客様一覧</h2>
        </div>

        {{-- ///====REGISTER BUTTON====/// --}}
        <div id="client-list" class="btn-holder float-right">
            <a href="" class="register-btn btn-orange"><span class="fa fa-plus"></span> 新 規 追 加</a>
        </div>
    </div>
    <div class="d-flex">
        @csrf
        <div class="row row-content">
            <div class="content-width">

                {{-- ///====CLIENT-TABLE HEADER====/// --}}
                <div id="table-nav" class="midori">
                    <div class="flex-col">
                        <ul class="display list-unstyled">
                            <li> コード </span></li>
                            <li>会社名 </span></li>
                            <li>責任者 </span></li>
                            <li>受注顧合計 </span></li>
                            @if ($loggedInAuthority == config('constants.User_authority.システム管理者'))
                                <li>実績粗利 </span></li>
                            @endif

                            @if ($loggedInAuthority == config('constants.User_authority.システム管理者'))
                                <li><span class="fa fa-filter fa-lg"></span><span class="fa fa-caret-down"></span></li>
                            @endif
                        </ul>
                    </div>
                </div>


                {{-- ///====CLIENT-TABLE DETAILS====/// --}}

                <div class="clients">

                    {{-- row starts --}}
                    <div class="card"">
                            <div class=" card-header">
                        <div class="flex-col">
                            <div class="display list-unstyled">
                                <li> 0001 </span></li>
                                <li>GT宮崎 </span></li>
                                <li><img src="img/pro_icon.png" class="smallpic">
                                    <div class="user-name">ソフィア</div>
                                </li>
                                <li>10,000 </span></li>
                                @if ($loggedInAuthority == config('constants.User_authority.システム管理者'))
                                    <li>50000000円 </span></li>
                                @endif

                                @if ($loggedInAuthority == config('constants.User_authority.システム管理者'))
                                    <li><span><img class="edit" src="img/edit.png" alt=""></span></li>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                {{-- row ends --}}

                {{-- row starts --}}
                <div class="card" id="client-row">
                    <div class="card-header">
                        <div class="flex-col">
                            <div class="display list-unstyled">
                                <li> 0002 </span></li>
                                <li>Core.NET </span></li>
                                <li><img src="img/pro_icon.png" class="smallpic">
                                    <div class="user-name">ソフィア</div>
                                </li>
                                <li>20,000 </span></li>
                                @if ($loggedInAuthority == config('constants.User_authority.システム管理者'))
                                    <li>50000000円 </span></li>
                                @endif

                                @if ($loggedInAuthority == config('constants.User_authority.システム管理者'))
                                    <li><span><img class="edit" src="img/edit.png" alt=""></span></li>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                {{-- row ends --}}

                {{-- row starts --}}
                <div class="card"">
                            <div class=" card-header">
                    <div class="flex-col">
                        <div class="display list-unstyled">
                            <li> 0003 </span></li>
                            <li>Kishida Dengyou </span></li>
                            <li><img src="img/pro_icon.png" class="smallpic">
                                <div class="user-name">ソフィア</div>
                            </li>
                            <li>30,000 </span></li>
                            @if ($loggedInAuthority == config('constants.User_authority.システム管理者'))
                                <li>50000000円 </span></li>
                            @endif

                            @if ($loggedInAuthority == config('constants.User_authority.システム管理者'))
                                <li><span><img class="edit" src="img/edit.png" alt=""></span></li>
                            @endif
                        </div>
                    </div>

                </div>
                {{-- row ends --}}
            </div>
        </div>
        <div class="card"">
                            <div class=" card-header">
            <a>
                <div class="display list-unstyled">
                    <li>003</li>
                    <li>GT宮崎</li>
                    <li><img src="img/pro_icon.png" class="smallpic">
                        <div class="user-name">ソフィア</div>
                    </li>

                    @if (auth()->user()->user_authority == config('constants.User_authority.システム管理者'))
                        <li class="pos">100000</li>
                        <li>Y50,00000</li>
                    @endif
                    <li><span><img src="img/edit.png" alt=""></span></li>
                </div>
            </a>

        </div>
    </div>

</div>
</div>
@include("footer")
