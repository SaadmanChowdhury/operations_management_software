@include("header")

<h1 class="form-ht">Edit Client</h1>

<div class="form-container">
<form id="edit_form" action="" method="">
    @csrf
    {{-- @method('put') --}}

    <div><input type="hidden" id="id" value="{{ $client->customer_id }}"></div>

    <div>
        <div><label>Name</label></div>
        <div><input type="text" id="name" name="name" value="{{ $client->customer_name }}"></div>
    </div>

    <div>
        <div><label>Point of Contact Person ID</label></div>
        <div><input type="number" id="point_of_contact_person_id" name="point_of_contact_person_id" value="{{ $client->point_of_contact_person_id }}"></div> 
    </div>

    <div><button type="submit" onclick="">Update Client</button></div>
    <div id="message"></div>
</form>
</div>

<script>
    function getFormData() {
        return {
            id: $('#id').val(),
            customer_name: $('#name').val(),
            point_of_contact_person_id: $('#point_of_contact_person_id').val(),
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
            if (err.responseJSON.errors.point_of_contact_person_id != null) {
                $('#message').html("エラー　： " + "担当者が入力していないです。");
            }
            if (err.responseJSON.errors.customer_name != null) {
                $('#message').html("エラー　： " + "顧客名が入力していないです。");
            }
        }
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
    });

</script>

@include("footer")
