@include("header")

<h3>Create Client</h3>
<form action="" method="">
    @csrf

    <div><label>customer_name</label></div>
    <div><input type="text" name="customer_name"></div>

    <div><label>point_of_contact_person_id</label></div>
    <div><input type="number" name="point_of_contact_person_id"></div>

    <div><button type="submit">Add Client</button></div>

</form>

@include("footer")
