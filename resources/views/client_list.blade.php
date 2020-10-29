@include("header")
<div class="user-list container-fluid">
    <div class="p-r row">
        <div class="page-title float-left">
            <h2 style="color: black;margin-left:21px">お客様一覧</h2>
        </div>
        <div class="btn-holder float-right">
            <a href="" class="register-btn btn-orange"><span class="fa fa-plus"></span> 新 規 追 加</a>
        </div>
    </div>
    <div class="d-flex">

        <div class="row row-content">
            <div class="content-width">

                <div id="table-nav" class="midori">
                    <div class="flex-col">
                        <ul class="display list-unstyled">
                            <li> コード <span class="fa fa-caret-down"></span></li>
                            <li>会社名 <span class="fa fa-caret-down"></span></li>
                            <li>責任者 <span class="fa fa-caret-down"></span></li>

                            @if (auth()->user()->user_authority == config('constants.User_authority.システム管理者'))
                                <li>受注顧合計<span class="fa fa-caret-down"></span></li>
                                <li>実績粗利<span class="fa fa-caret-down"></span></li>
                            @endif
                            <li><span class="fa fa-filter fa-lg"></span><span class="fa fa-caret-down"></span></li>
                        </ul>
                    </div>
                </div>


                <div class="clients">
                    <div class="card"">
                            <div class=" card-header">
                        <a>
                            <div class="display list-unstyled">
                                <li>001</li>
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
                <div class="card"">
                            <div class=" card-header">
                    <a>
                        <div class="display list-unstyled">
                            <li>002</li>
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
</div>
</div>
</div>



@include("footer")
