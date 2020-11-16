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

            {{-- ///====PROJECT-TABLE HEADER====/// --}}
            <div id="table-nav" class="gray">
                <div class="flex-col">
                    <ul class="display list-unstyled">
                        <li> コード</li>
                        <li> コード</li>
                        <li> コード</li>
                        <li> コード</li>
                        <li> コード</li>
                    </ul>
                </div>
            </div>


            {{-- ///====PROJECT-TABLE DETAILS====/// --}}

            <div class="project table-body">

                <div class="card" id="project-row-">
                    <div class=" card-header">
                        <div class="display list-unstyled">
                            <li>準備中</li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include("footer")
