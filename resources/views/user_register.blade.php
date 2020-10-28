@include("header")

<div>
    <h1 class="form-ht">
        User Register
    </h1>

    <span class="close">
        <img src="img/cross.png" class="cross" alt="cross button">
    </span>
</div>

<div class="form-container">
    <div id="error"></div>
    <form id="formInput" action="" method="GET">
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

                {{-- Location Dropdown Starts --}}
                <div><label>Location</label></div>
                <div class="custom-select">
                    <select id="locationInput" required>
                        <option>Miyazaki</option>
                        <option>Tokyo</option>
                        <option>Fukuoka</option>
                    </select>
                </div>
                {{-- Location Dropdown Ends --}}

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

                {{-- Starting_date Field Starts --}}
                <div><label for="starting_date">Starting Year</label></div>
                <div><input type="date" id="starting_dateInput" name="starting_date" required></div>
                {{-- Starting_date Field Ends --}}

                {{-- Salary Field Starts --}}
                <div><label for="salary">Salary ¥</label></div>
                <div><input type="number" id="salaryInput" name="salary" required></div>
                {{-- Salary Field Ends --}}

                {{-- buttons start --}}
                    {{-- <a class="button submit-button" id="submit-button">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> 更新</a> --}}
                    {{-- <input type="submit" id="saveInput" name="save" value='更新> --}}
                <button type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>  更新</button> 
                {{-- buttons end --}}

            </div>
        </div>

    </form>
</div>


<script>
    // JS validations for future use
    const name = document.getElementById('nameInput');
    const email = document.getElementById('emailInput');
    const password = document.getElementById('passwordInput');
    const location = document.getElementById('locationInput');
    const position = document.getElementById('positionInput');
    const starting_date = document.getElementById('starting_dateInput');
    const salary = document.getElementById('salaryInput');
    const form = document.getElementById('formInput');
    const errorElement = document.getElementById('error');

    form.addEventListener('submitEvent', (e) => {
        let messages = [];

        if (name.value === '' || name.value == null) {
            messages.push('Name is required');
        } else if (email.value === '' || email.value == null) {
            messages.push('Email is required');
        } else if (password.value === '' || password.value == null || password.length <= 8 || password.length => 20) {
            messages.push('Password must be minimum of 8 and maximum of 20 digits');
        } else if (starting_date.value === '' || starting_date.value == null) {
            messages.push('Set starting date please');
        } else if (salary.value === '' || salary.value == null) {
            messages.push('Please write your current salary');
        } else {
            pass;
        }

        if (message.length > 0) {
            e.preventDefault();
            errorElement.innerText = messages.join(', ');
        }
    })


    
</script>

@include("footer")
