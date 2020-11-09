@include("header")

<div>
    <h1 class="form-ht">User Register</h1>
    <span class="close"><img src="img/cross.png" class="cross" alt="cross button"></span>
</div>

<div id="reg_modal" class="form-container">
    <form id="reg_form" action="" method="">
        @csrf
        
        <div class="row">

            <div class="column left">
                {{-- Img Field Starts --}}
                <div><img src="img/dp.png" class="dp" alt="display photo"></div>
                {{-- Img Field Ends --}}
            </div>

            <div class="column right">
                {{-- Name Field Starts --}}
                <div><label for="name">Name</label></div>
                <div><input type="text" id="nameInput" name="name" required></div>
                {{-- Name Field Ends --}}

                {{-- Email Field Starts --}}
                <div><label for="email">Email</label></div>
                <div><input type="email" id="emailInput" name="email" required></div>
                {{-- Email Field Ends --}}

                {{-- Password Field Starts --}}
                <div><label for="password">Password</label></div>
                <div><input type="password" id="passwordInput" name="password" required></div>
                {{-- Password Field Ends --}}

                {{-- Telephone Field Starts --}}
                <div><label for="tel">Telephone</label></div>
                <div><input type="text" id="telInput" name="tel" required></div>
                {{-- Telephone Field Ends --}}

                {{-- Position Dropdown Starts --}}
                <div><label>Position</label></div>
                <div class="custom-select">
                    <select id="positionInput" required>  
                        @foreach (config('constants.Position') as $position => $value)
                            <option>{{ $position }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Position Dropdown Ends --}}

                {{-- Location Dropdown Starts --}}
                <div><label>Location</label></div>
                <div class="custom-select">
                    <select id="locationInput" required>
                        @foreach (config('constants.Location') as $location => $value)
                            <option>{{ $location }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Location Dropdown Ends --}}

                {{-- Starting_date Field Starts --}}
                <div><label for="admission_day">Admission Day</label></div>
                <div><input type="date" id="admission_dayInput" name="admission_day" required></div>
                {{-- Starting_date Field Ends --}}

                {{-- Salary Field Starts --}}
                <div><label for="salary">Salary ¥</label></div>
                <div><input type="number" id="salaryInput" name="salary" required></div>
                {{-- Salary Field Ends --}}

                {{-- Authority Dropdown Starts --}}
                <div><label>User Authority</label></div>
                <div class="custom-select">
                    <select id="authorityInput" required>
                        @foreach (config('constants.User_authority') as $authority => $value)
                            <option name="user_authority">{{ $authority }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Authority Dropdown Ends --}}

                {{-- buttons start --}}
                <div><button type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>  更新</button> </div>
                {{-- buttons end --}}

            </div>
        </div>

        <div id="message"></div>

    </form>
</div>


<script>

    function getFormData() {
        return {
            name: $('#nameInput').val(),
            email: $('#emailInput').val(),
            password: $('#passwordInput').val(),
            tel: $('#telInput').val(),
            position: $('#positionInput').val(),
            location: $('#locationInput').val(),
            admission_day: $('#admission_dayInput').val(),
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
        
        if (err.status == "422") {
            if (err.responseJSON.errors.email != null) {
                $('#message').html(err.responseJSON.errors.email);
            }
            /*
            if (err.responseJSON.errors.customer_name != null) {
                $('#message').html("エラー　： " + "顧客名が入力していないです。");
            }*/
        } 
    }

    $(document).ready(function() {
        $('#reg_form').submit(function(e) {
            console.log(getFormData());
            e.preventDefault();

            $.ajax({
                type: "post",
                url: "/API/createUser",
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
    });

    /*
    //modal auto close function
    $('#reg_form').submit(function() {
        e.preventDefault();
        $('#reg_modal').modal('hide');
        return false;
    }); */

</script>

@include("footer")

