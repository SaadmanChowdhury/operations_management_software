@include("header")

{{-- ///====PAGE TITLE --}}
<div class="page-title">
    @csrf
    <span class="fa fa-user"></span>
    ユーザー一覧
    
</div>


<div class="row row-content">
    <div class="content-width">

        {{-- ///====FILTER NAVIGATION====/// --}}
        <div style="min-width: 1200px">
            <ul class="userlist-nav center list-unstyled">
                <a href="">
                    <li> 全て</li>
                </a>
                <a href="">
                    <li> PM</li>
                </a>
                <a href="">
                    <li> PL</li>
                </a>
                <a href="">
                    <li> SE</li>
                </a>
                <a href="">
                    <li> PG</li>
                </a>
            </ul>

            <ul class="userlist-nav center list-unstyled" style="float: right;">
                <a href="" onclick="adjustRowHeight()">
                    <li class="fa fa-list"> </li>
                </a>
                @if ($loggedUser->user_authority == 'システム管理者')
                <a href="" onclick="userRegisterModalHandler()">
                    <li> + 登録</li>
                </a>
                @endif
            </ul>


            <hr />

        </div>



        {{-- ///====USER-TABLE HEADER====/// --}}
        <div id="table-nav" class="mild-midori">
            <div class="flex-col">
                <ul class="display list-unstyled">
                    {{--
                    <li> コード <span class="fa fa-caret-down"></span></li>
                    <li>氏名 <span class="fa fa-caret-down"></span></li>
                    <li>所属 <span class="fa fa-caret-down"></span></li>
                    <li>ポジション <span class="fa fa-caret-down"></span></li>
                    <li>経過月数 <span class="fa fa-caret-down"></span></li>
                    <li>単価(最新) <span class="fa fa-caret-down"></span></li>
                    <li><span class="fa fa-filter fa-lg"></span><span class="fa fa-caret-down"></span></li>
                    --}}


                    <li>コード</li>
                    <li>氏名</li>
                    <li>所属</li>
                    <li>ポジション</li>
                    <li>経過月数</li>

                    @if ($loggedUser->user_authority == 'システム管理者')
                    <li>単価(最新)</li>
                    @endif

                    <li><span class="fa fa-filter fa-lg fa-color-mild-midori">Filter</span> </li>
                </ul>
            </div>

        </div>


        <div class="staffs table-body">

        </div>
    </div>
</div>

@include("user.edit")
@include("user.create")

<script src="/js/user.js"></script>
@include("footer")