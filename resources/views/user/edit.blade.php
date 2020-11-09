@include("header")

<div>
    <h1 class="form-ht">Edit User</h1>
    <span class="close"><img src="img/cross.png" class="cross" alt="cross button"></span>
</div>

<div class="form-container">
    <form id="edit_form" action="" method="">
        @csrf

        <div class="row">
            <div class="column left">

                {{-- Img Field Starts --}}
                <div>
                    <img src="img/dp.png" class="dp" alt="display photo">
                </div>
                {{-- Img Field Ends --}}
            </div>

            <div class="column right">
                <input type="hidden" id="id" value="{{ $user->user_id }}">
                
                {{-- Name Field Starts --}}
                <div><label for="name">Name</label></div>
                <div><input type="text" id="nameInput" name="name" value="{{ $user->name }}" required></div>
                {{-- Name Field Ends --}}

                {{-- Email Field Starts --}}
                <div><label for="email">Email</label></div>
                <div><input type="email" id="emailInput" name="email" value="{{ $user->email }}"></div>
                {{-- Email Field Ends --}}

                {{-- Password Field Starts --}}
                <div><label for="password">Password</label></div>
                <div><input type="password" id="passwordInput" name="password"></div>
                {{-- Password Field Ends --}}

                {{-- Telephone Field Starts --}}
                <div><label for="tel">Telephone</label></div>
                <div><input type="text" id="telInput" name="tel" value="{{ $user->tel }}"></div>
                {{-- Telephone Field Ends --}}

                {{-- Location Dropdown Starts --}}
                <div><label>Location</label></div>
                <div class="custom-select">
                    <select id="locationInput" >
                        @foreach (config('constants.Location') as $location => $value)
                            @if ($user->location == $value) 
                                <option value="{{ $user->location }}" selected>{{ $location }}</option> 
                            @else
                                <option value="{{ $value }}">{{ $location }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                {{-- Location Dropdown Ends --}}

                {{-- Position Dropdown Starts --}}
                <div><label>Position</label></div>
                <div class="custom-select">
                    <select id="positionInput">
                        @foreach (config('constants.Position') as $position => $value)
                            @if ($user->position == $value) 
                                <option value="{{ $user->position }}" selected>{{ $position }}</option> 
                            @else
                                <option value="{{ $value }}">{{ $position }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                {{-- Position Dropdown Ends --}}

                {{-- Admission_Day Field Starts --}}
                <div><label for="admission_day">Admission Day</label></div>
                @if ($loggedUser->user_authority == config('constants.User_authority.システム管理者'))
                    <div><input type="date" id="admission_day" name="admission_day" value="{{ $user->admission_day }}"></div>
                @else
                    <div><p>{{ $user->admission_day }}</p></div>
                @endif
                {{-- Admission_Day Field Ends --}}

                {{-- Resignation_year Field Starts --}}
                <div><label for="resignation_year">Resignation Year</label></div>
                @if ($loggedUser->user_authority == config('constants.User_authority.システム管理者'))
                    <div><input type="date" id="resignation_yearInput" name="resignation_year"></div>
                @else
                    <div><p>{{ $user->exit_day }}</p></div>
                @endif
                {{-- Resignation_year Field Ends --}}

                {{-- Salary Field Starts --}}
                <div><label for="salary">Salary ¥</label></div>
                @if ($loggedUser->user_authority == config('constants.User_authority.システム管理者'))
                    <div><input type="number" id="salaryInput" name="salary" value="{{ $user->unit_price }}" required></div>
                @else
                    <div><p>{{ $user->unit_price }}</p></div>
                @endif
                {{-- Salary Field Ends --}}

                {{-- buttons start --}}
                {{-- <a class="button submit-button" id="submit-button"> <i class="fa fa-floppy-o" aria-hidden="true"></i> 更新</a> --}}
                <div><button type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>  更新</button> </div>
                @if ($loggedUser->user_authority == config('constants.User_authority.システム管理者'))
                    <a class="button delete-button" id="deleteButton"> <i class="fa fa-trash-o" aria-hidden="true"></i> 削除</a>
                @endif
                {{-- buttons end --}}

            </div>
        </div>

    </form>
</div>


<script>
    function getFormData() {
        return {
            id: $('#id').val(),
            name: $('#nameInput').val(),
            email: $('#emailInput').val(),
            password: $('#passwordInput').val(),
            tel: $('#telInput').val(),
            position: $('#positionInput').val(),
            location: $('#locationInput').val(),
            admission_day: $('#admission_day').val(),
            unit_price: $('#salaryInput').val(),
            user_authority: $('#authorityInput').val(),
            _token: $('input[name=_token]').val()
        };
    }

    function handleAJAXResponse(response) {

        if (response["resultStatus"]["isSuccess"])
            $('#message').html("Operation Succesful");

        else if (response["resultStatus"]["errorMessage"] === "UNAUTHORIZED_ACTION")
            $('#message').html("You are not authorized to make this change");

        else
            $('#message').html("Unhandled Status: " + response["resultStatus"]["errorMessage"]);
    }

    function handleAJAXError(err) {
        console.log(err);
    }

    $(document).ready(function() {
        $('#edit_form').submit(function(e) {
            console.log(getFormData());
            e.preventDefault();

            $.ajax({
                type: "post",
                url: "/API/updateUser",
                data: getFormData(),
                cache: false,
                success: function(response) {
                    handleAJAXResponse(response);
                },
                error: function(err) {
                    handleAJAXError(err);
                }
            });
        });

        $("#deleteButton").click(function(d) {
            d.preventDefault();
            $.ajax({
                type: "post",
                url: "/API/deleteUser",
                data: {
                    id: $('#id').val(),
                    _token: $('input[name=_token]').val() 
                },
                cache: false,
                success: function(response) {
                    handleAJAXResponse(response);
                },
                error: function(err) {
                    handleAJAXError(err);
                }
            }); 
        });
        

        
    });


</script>

@include("footer")
