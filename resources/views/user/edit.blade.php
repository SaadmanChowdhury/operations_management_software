@include("header")

<h3>Create User</h3>

<form id="edit_form" action="">
    @csrf
    {{-- @method('put') --}}
    <div>
        <input type="hidden" id="id" value="{{ $user->user_id }}">

        <label>Name:</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}">
    </div>
    <div>
        <label>Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}">
    </div>
    <div>
        <label>password:</label>
        <input type="password" id="password" name="password" required>

    </div>
    <div>
        <label>tel:</label>
        <input type="text" id="tel" name="tel" value="{{ $user->tel }}">

    </div>
    <div>
        <label>position:</label>
        <input type="text" id="position" name="position" value="{{ $user->position }}">
    </div>
    <div>
        <label>admission_day:</label>
        <input type="text" id="admission_day" name="admission_day" value="{{ $user->admission_day }}">
    </div>
    <div>
        <label>unit_price:</label>
        <input type="text" id="unit_price" name="unit_price" value="{{ $user->unit_price }}">
    </div>
    <div>
        <label>user_authority:</label>
        <input type="text" id="user_authority" name="user_authority" value="{{ $user->user_authority }}">
    </div>

    <div>
        <button type="submit" onclick="">Update User</button>
    </div>

    <div id="message"></div>
</form>

<script>
    function getFormData() {
        return {
            id: $('#id').val(),
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            tel: $('#tel').val(),
            position: $('#position').val(),
            admission_day: $('#admission_day').val(),
            unit_price: $('#unit_price').val(),
            user_authority: $('#user_authority').val(),
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
    });

</script>

@include("footer")
