@include("header")

{{-- ///====PAGE TITLE --}}
<div class="page-title">
    <span class="fa fa-home"></span>
    アサインサマリー

    <input type="hidden" id="page-name" value="assign_summary">
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
            <ul class="userlist-nav center list-unstyled" style="margin-left: 30px;">
                <a href="">
                    <li> 無し
                    </li>
                </a>
                <a href="">
                    <li> 限界</li>
                </a>
                <a href="">
                    <li> 未だ</li>
                </a>
            </ul>

            <ul class="userlist-nav center list-unstyled" style="float: right; ">
                <a href="" onclick="alert('Adjust font size');">
                    <li class="fa fa-arrows-alt"> </li>
                </a>
            </ul>



            <hr />

            {{-- ///====ASSIGN-SUMMARY-TABLE HEADER====///
            --}}
            <div id="table-nav" class="gray _assign">
                {{-- <div class="flex-col">
                    <ul class="display list-unstyled">
                    </ul>
                </div> --}}
                <div class="assign-header-sub-row mild-yellow text-center">
                     2020
                </div>
                <div class="d-flex assign-header-sub-row mild-yellow text-center">
                    <div class="flex-1">name</div>
                    <div class="flex-3">project name</div>
                    <div class="flex-1">1</div>
                    <div class="flex-1">2</div>
                    <div class="flex-1">3</div>
                    <div class="flex-1">4</div>
                    <div class="flex-1">5</div>
                    <div class="flex-1">6</div>
                    <div class="flex-1">1</div>
                    <div class="flex-1">2</div>
                    <div class="flex-1">3</div>
                    <div class="flex-1">4</div>
                    <div class="flex-1">5</div>
                    <div class="flex-1">6</div>
                </div>
            </div>


            {{-- ///====ASSIGN-SUMMARY-TABLE DETAILS====///
            --}}
            <div class="d-flex assign-summary table-header _assign justify-content-center align-items-center">

                <div class="flex-1">name</div>
                <div class="flex-3">project name</div>
                <div class="flex-1">1</div>
                <div class="flex-1">2</div>
                <div class="flex-1">3</div>
                <div class="flex-1">4</div>
                <div class="flex-1">5</div>
                <div class="flex-1">6</div>
                <div class="flex-1">1</div>
                <div class="flex-1">2</div>
                <div class="flex-1">3</div>
                <div class="flex-1">4</div>
                <div class="flex-1">5</div>
                <div class="flex-1">6</div>
            </div>

            <div class="assign-summary table-body _assign">

                <div class="assign-user-tab">
                    <div class="d-flex assign-user-sub-row _header">
                        <div class="flex-1 yellow d-flex justify-content-center align-items-center">name</div>
                        <div class="flex-3 yellow justify-content-center align-items-center">project name</div>
                        <div class="flex-1 green">1</div>
                        <div class="flex-1 green">2</div>
                        <div class="flex-1 green">3</div>
                        <div class="flex-1 face-color">4</div>
                        <div class="flex-1 green">5</div>
                        <div class="flex-1 green">6</div>
                        <div class="flex-1 blue">1</div>
                        <div class="flex-1 blue">2</div>
                        <div class="flex-1 blue">3</div>
                        <div class="flex-1 blue">4</div>
                        <div class="flex-1 grey">5</div>
                        <div class="flex-1 grey">6</div>
                    </div>
                    <div class="assign-user-sub-row">
                        User 1 - project 1
                    </div>
                    <div class="assign-user-sub-row">
                        User 1 - project 2
                    </div>
                </div>

                <div class="assign-user-tab">
                    <div class="assign-user-sub-row _header">

                    </div>
                    <div class="assign-user-sub-row">

                    </div>
                </div>


                <div class="assign-user-tab">
                    <div class="assign-user-sub-row _header">

                    </div>
                    <div class="assign-user-sub-row">

                    </div>
                    <div class="assign-user-sub-row">

                    </div>
                    <div class="assign-user-sub-row">

                    </div>
                    <div class="assign-user-sub-row">

                    </div>
                </div>

                <div class="assign-user-tab">
                    <div class="assign-user-sub-row _header">

                    </div>
                    <div class="assign-user-sub-row">

                    </div>
                    <div class="assign-user-sub-row">

                    </div>
                </div>
                <div class="assign-user-tab">
                    <div class="assign-user-sub-row _header">

                    </div>
                    <div class="assign-user-sub-row">

                    </div>
                    <div class="assign-user-sub-row">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include("footer")
