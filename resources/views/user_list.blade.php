@include("header")
<div class="user-list container-fluid">
    <div class="p-r row">
        <div class="page-title float-left">
            <h2 style="color: black;margin-left:21px">ユーザー一覧</h2>
        </div>
        <div class="btn-holder float-right">
            <a href="" class="register-btn btn-orange"><span class="fa fa-plus"></span> Register</a>
        </div>
    </div>
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
                        <li> SE</li>
                    </a>
                    <a href="">
                        <li> PG</li>
                    </a>
                </ul>
                <hr />

                <div id="table-nav" class="primary">
                    <div class="flex-col">
                        <ul class="display list-unstyled">
                            <li> コード <span class="fa fa-caret-down"></span></li>
                            <li>氏名 <span class="fa fa-caret-down"></span></li>
                            <li>所属 <span class="fa fa-caret-down"></span></li>
                            <li>ポジション <span class="fa fa-caret-down"></span></li>
                            <li>入場日 <span class="fa fa-caret-down"></span></li>
                            <li>経過月数 <span class="fa fa-caret-down"></span></li>
                            <li>単価(最新) <span class="fa fa-caret-down"></span></li>

                            <li><span class="fa fa-filter fa-lg"></span><span class="fa fa-caret-down"></span></li>
                        </ul>
                    </div>

                </div>

                @php
                    use Carbon\Carbon;
                @endphp

                <div class="staffs">
                    @foreach ($users as $user)
                        @php
                            
                            $mytime=Carbon::today();
                            $time_diff=floor(($mytime->diffInDays($user->admission_day))/365);
                            $unit='年';
                            if($time_diff==0)
                            {
                                $time_diff=floor(($mytime->diffInDays($user->admission_day))/30);
                                $unit='月';
                            }
                        @endphp
                        <div class="card" id="user-row-{{ $user->user_id }}">
                            <div class="card-header">
                                <a>
                                    <div class="display list-unstyled">
                                        <li>{{ $user->user_id }}</li>
                                        <li><img src="img/pro_icon.png" class="smallpic">
                                            <div class="user-name">{{ $user->name }}</div>
                                        </li>
                                        <li>{{ $user->location }}</li>
                                        <li class="pos">{{ $user->position }}</li>
                                        <li>{{ $user->admission_day }}</li>
                                        <li>{{ $time_diff}}{{ $unit }}</li>
                                        <li>{{ $user->unit_price }}</li>
                                        <li><span class="fa fa-ellipsis-v"></span></li>

                                    </div>
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



@include("footer")
