@include("header")

<h3>Edit Client</h3>

<form id="edit_form" action="">
    @csrf
    {{-- @method('put') --}}
    <div>
        <input type="hidden" id="id" value="{{ $client->customer_id }}">

        <label>Name</label>
        <input type="text" id="name" name="name" value="{{ $client->customer_name }}">
    </div>
    <div>
        <label>Point of Contact Person ID</label>
        <input type="number" id="point_of_contact_person_id" name="point_of_contact_person_id" value="{{ $client->point_of_contact_person_id }}">
    </div>

    <div>
        <button type="submit" onclick="">Update Client</button>
    </div>

    <div id="message"></div>
</form>

<script>
    function getFormData() {
        return {
            id: $('#id').val(),
            name: $('#name').val(),
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
    }

    $(document).ready(function() {
        $('#edit_form').submit(function(e) {
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
