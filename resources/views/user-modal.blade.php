@include("header")

<?php
    // $loggedInUser = auth()->user();
    // $loggedInAuthority = $loggedInUser->user_authority;

    $loggedInUser =  (object)[
        "name" => "Samiul",
        "admission_day" => "Today",
        "exit_day" => "N/A",
        "unit_price" => "200,000円"
    ];
    $loggedInAuthority = config('constants.User_authority.一般ユーザー');
    // $loggedInAuthority = config('constants.User_authority.システム管理者');
?>

<div>
    <h1 class="form-ht">
        Edit User
    </h1>

    <span class="close">
        <img src="img/cross.png" class="cross" alt="cross button">
    </span>
</div>

<div class="form-container">
    <form id="formInput" action="" method="post">
        @csrf
        

        <div class="row">
            <div class="column left">
                {{-- Img Field Starts --}}
                <div>
                    {{-- <h4>Image</h4> --}}
                    <img src="img/dp.png" class="dp" alt="display photo">
                </div>
                {{-- Img Field Ends --}}
            </div>

            <div class="column right">
                {{-- Name Field Starts --}}
                <div><label for="name">Name</label></div>
                <div><input type="text" id="nameInput" name="name"></div>
                {{-- Name Field Ends --}}

                {{-- Email Field Starts --}}
                <div><label for="email">Email</label></div>
                <div><input type="email" id="emailInput" name="email"></div>
                {{-- Email Field Ends --}}

                {{-- Password Field Starts --}}
                <div><label for="password">Password</label></div>
                <div><input type="password" id="passwordInput" name="password"></div>
                {{-- Password Field Ends --}}

                {{-- Location Dropdown Starts --}}
                <div><label>Location</label></div>
                <div class="custom-select">
                    <select id="locationInput">
                        <option>Miyazaki</option>
                        <option>Tokyo</option>
                        <option>Fukuoka</option>
                    </select>
                </div>
                {{-- Location Dropdown Ends --}}

                {{-- Position Dropdown Starts --}}
                <div><label>Position</label></div>
                <div class="custom-select">
                    <select id="positionInput">
                        @foreach (config('constants.Position') as $position => $value)
                            <option>{{ $position }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Position Dropdown Ends --}}

                {{-- Starting_year Field Starts --}}
                <div><label for="starting_year">Starting Year</label></div>
                @if ($loggedInAuthority == config('constants.User_authority.システム管理者'))
                    <div><input type="date" id="starting_yearInput" name="starting_year"></div>
                @else
                    <div>{{ $loggedInUser->admission_day }}</div>
                @endif
                {{-- Starting_year Field Ends --}}

                {{-- Resignation_year Field Starts --}}
                <div><label for="resignation_year">Resignation Year</label></div>
                @if ($loggedInAuthority == config('constants.User_authority.システム管理者'))
                    <div><input type="date" id="resignation_yearInput" name="resignation_year"></div>
                @else
                    <div>{{ $loggedInUser->exit_day }}</div>
                @endif
                {{-- Resignation_year Field Ends --}}

                {{-- Salary Field Starts --}}
                <div><label for="salary">Salary ¥</label></div>
                @if ($loggedInAuthority == config('constants.User_authority.システム管理者'))
                    <div><input type="number" id="salaryInput" name="salary"></div>
                @else
                    <div>{{ $loggedInUser->unit_price }}</div>
                @endif
                {{-- Salary Field Ends --}}

                {{-- buttons start --}}
                <a class="button submit-button" id="submit-button">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    更新</a>
                @if ($loggedInAuthority == config('constants.User_authority.システム管理者'))
                    <a class="button delete-button" id="delete-button">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                            削除</a>
                @endif
                {{-- buttons end --}}

            </div>
        </div>

    </form>
</div>


<script>
    const submitButton = document.getElementById('submit-button');
    const deleteButton = document.getElementById('delete-button');

    submitButton.addEventListener('click', saveData);
    if (deleteButton != null)
        deleteButton.addEventListener('click', deleteData);

    function deleteData(e) {
        e.preventDefault();
        var myobj = document.getElementById("formInput");
        myobj.remove();
    }

    function saveData(e) {
        e.preventDefault();

        /*
        const name = document.querySelector('#nameInput');
        const email = document.querySelector('#emailInput');
        const password = document.querySelector('#passwordInput');
        const location = document.querySelector('#locationInput');
        const position = document.querySelector('#positionInput');
        const starting_year = document.querySelector('#starting_yearInput');
        const resignation_year = document.querySelector('#resignation_yearInput');
        const salary = document.querySelector('#salaryInput');
        */

        /*
        const savedForm = {
            name: name,
            email: email,
            password: password,
            location: location,
            position: position,
            starting_year: starting_year,
            resignation_year: resignation_year,
            salary: salary,
        };
        */

        const savedData = {
            name: document.querySelector('#nameInput').value,
            email: document.querySelector('#emailInput').value,
            password: document.querySelector('#passwordInput').value,
            location: document.querySelector('#locationInput').value,
            position: document.querySelector('#positionInput').value,
            starting_year: document.querySelector('#starting_yearInput').value,
            resignation_year: document.querySelector('#resignation_yearInput').value,
            salary: document.querySelector('#salaryInput').value,
        };

    }

</script>

@include("footer")
