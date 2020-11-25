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

            <div id="table-nav" class="midori">
                <div class="flex-col">
                    <ul class="display list-unstyled">
                        <li>project_id</li>
                        <li>project_name</li>
                        <li>client_id</li>
                        <li>manager_id</li>
                        <li>sales_total</li>
                    </ul>
                </div>
            </div>


            <div class="table-body">
                @foreach ($list as $project)
                <div class="card">
                    <div class="card-header">
                        <div class="display list-unstyled">
                            <li>{{ $project->project_id }}</li>
                            <li>{{ $project->project_name }}</li>
                            <li>{{ $project->client_id }}</li>
                            <li>{{ $project->manager_id }}</li>

                            @if ($loggedInAuthority == config('constants.User_authority.システム管理者') ||
                            $loggedInUser->user_id == $project->manager_id)
                            <li>{{ $project->sales_total }}</li>
                            @else
                            <li></li>
                            @endif

                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

@include("footer")
