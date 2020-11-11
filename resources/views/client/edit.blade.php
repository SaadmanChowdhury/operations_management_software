@include("header")

<h1 class="form-ht">Edit Client</h1>

<div id="edit_modal" class="form-container">
    <form id="edit_form" action="" method="">
        @csrf
        <div><input type="hidden" id="id" value="{{ $client->client_id }}"></div>

        <div class="row">
            
            <div class="column left">
                <div><button type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>  更新</button> </div>
                @if ($loggedUser->user_authority == config('constants.User_authority.システム管理者'))
                    <div><a class="button delete-button" id="deleteButton"> <i class="fa fa-trash-o" aria-hidden="true"></i> 削除</a></div>
                @endif
            </div>
        
            <div class="column right">
                <div><label for="name">Name</label></div>
                <div><input type="text" name="name" id="name" value="{{ $client->client_name }}"></div>
            
                <div><label>Point of contact person ID</label></div>
                <div><input type="number" name="user_id" id="user_id" value="{{ $client->user_id }}"></div>
            </div>
        </div>
        
        <div id="message"></div>
    </form>
</div>

<script>
    function getFormData() {
        return {
            id: $('#id').val(),
            client_name: $('#name').val(),
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
            if (err.responseJSON.errors.point_of_contact_person_id != null) {
                $('#message').html("エラー　： " + "担当者が入力していないです。");
            }
            if (err.responseJSON.errors.customer_name != null) {
                $('#message').html("エラー　： " + "顧客名が入力していないです。");
            }
        }*/
    }

    $(document).ready(function() {
        $('#edit_form').submit(function(e) {
            console.log(getFormData());
            e.preventDefault();

            $.ajax({
                type: "post",
                url: "/API/updateClient",
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
                url: "/API/deleteClient",
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