@include("header")

<h3>Create Client</h3>
<form action="{{ route('client.store') }}" method="POST">
    @csrf
    <div>
        <label>customer_name:</label>
        <input type="text" name="customer_name">
    </div>
    <div>
        <label>point_of_contact_person_id:</label>
        <input type="number" name="point_of_contact_person_id">
    </div>

    <div>
        <button type="submit">Add Client</button>
    </div>
</form>

@include("footer")
