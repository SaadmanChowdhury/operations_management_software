@include("header")

{{-- ///====PAGE TITLE --}}
<div class="page-title">
    <span class="fa fa-newspaper-o"></span>
    案件一覧

    <input type="hidden" id="page-name" value="project_list">
    <input type="hidden" id="initial-preference" value="{{ $initialPreference }}">
</div>

{{-- ///====REGISTER BUTTON====/// --}}
{{-- <div id="client-list" class="btn-holder float-right">
    <a href="" class="register-btn btn-orange"><span class="fa fa-plus"></span> 新 規 追 加</a>
</div> --}}

<div class="d-flex">

    <div class="row row-content">
        <div class="content-width" style="">
        
        <div class="responsive-scroll">
            <ul class="userlist-nav center list-unstyled">
                <a href="">
                    <li>全て</li>
                </a>
                <a href="">
                    <li>A</li>
                </a>
                <a href="">
                    <li>B</li>
                </a>
                <a href="">
                    <li>C</li>
                </a>
                <a href="">
                    <li>○</li>
                </a>
                <a href="">
                    <li>Z</li>
                </a>
            </ul>
            <ul class="userlist-nav center list-unstyled" style="margin-left: 30px;">
                <a href="">
                    <li>見積</li>
                </a>
                <a href="">
                    <li>受注</li>
                </a>
                <a href="">
                    <li>検収</li>
                </a>
                <a href="">
                    <li>完了</li>
                </a>
            </ul>

            <ul class="userlist-nav center list-unstyled" style="margin-left: 30px;">
                <a href="">
                    <li>要件</li>
                </a>
                <a href="">
                    <li>設計</li>
                </a>
                <a href="">
                    <li>実装</li>
                </a>
                <a href="">
                    <li>テスト</li>
                </a>
                <a href="">
                    <li>開発完了</li>
                </a>
            </ul>
            <ul class="userlist-nav center list-unstyled" style="float: right;">
                <a href="" onclick="adjustRowHeight()" class="list-icon">
                    <li class="fa fa-list " > </li>
                </a>

                @if ($loggedInUser->user_authority == 'システム管理者')
                <a href="" onclick="ProjectRegisterModalHandler()">
                    <li> + 登録</li>
                </a>
                @endif
            </ul>

            <hr />
        </div>

            {{-- ///====PROJECT-TABLE HEADER====/// --}}
            <div class="project">
                <div id="table-nav" class="primary" style="">
                    <div class="flex-col">
                        <ul class="display list-unstyled">
                            <li> 案件名</li>
                            <li> 顧客</li>
                            <li> 担当</li>
                            <li> 見込</li>
                            <li> 営業状況</li>
                            <li> 作業工程</li>
                            <li> 受注月</li>
                            <li> 検収月</li>
                            <li> 売上高</li>
                            <li> 売上総利益</li>
                            <li> 利益率</li>
                            <li><span class="fa fa-filter fa-lg fa-color-primary">Filter</span> </li>
                        </ul>
                    </div>
                </div>
            </div>


            {{-- ///====PROJECT-TABLE DETAILS====/// --}}

            <div id="accordian" class="project table-body"    style="">
                <div class="mainLoader" id="main-loader"></div>


            </div>
        </div>
    </div>
</div>

    @include("project.edit")
    @include("project.create")

    <script src="/js/updatedProject.js"></script>
    <script src="/js/anamolyChecker.js"></script>
    @include("footer")
