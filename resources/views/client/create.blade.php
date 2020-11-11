@include("header")

<div>
    <h1 class="form-ht">Client Register</h1>
    <span class="close"><img src="img/cross.png" class="cross" alt="cross button"></span>
</div>

<div id="reg_modal" class="form-container">
    <form id="reg_form" action="" method="">
        @csrf

        <div class="row">
            <div class="column left">
                <div><button type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>  更新</button> </div>
            </div>
        
            <div class="column right">
                <div><label for="name">Name</label></div>
                <div><input type="text" id="nameInput" name="name" required></div>
            
                <div><label>Point of contact person ID</label></div>
                <div><input type="number" name="user_id" id="user_id" required></div>
            </div>
        </div>

        <div id="message"></div>
    </form>
</div>

<script>
    function getFormData() {
        return {
            client_name: $('#nameInput').val(),
            user_id: $('#user_id').val(),
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
        
        /*
        if (err.status == "422") {
            if (err.responseJSON.errors.email != null) {
                $('#message').html(err.responseJSON.errors.email);
            } */
    }

    $(document).ready(function() {
        $('#reg_form').submit(function(e) {
            console.log(getFormData());
            e.preventDefault();

            $.ajax({
                type: "post",
                url: "/API/createClient",
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