@include("header")

<h1 class="form-ht">Create Client</h1>

<div class="form-container">
    <form id="create_form" action="" method="">
        @csrf

        <div><label>customer_name</label></div>
        <div><input type="text" id="name" name="customer_name"></div>

        <div><label>point_of_contact_person_id</label></div>
        <div><input type="number" id="point_of_contact_person_id" name="point_of_contact_person_id"></div>

        <div><button type="submit">Add Client</button></div>
        <div id="message"></div>
    </form>
</div>


<script>
    function getFormData() {
        return {
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
    }

    $(document).ready(function() {
        $('#create_form').submit(function(e) {
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
