@include("header")

<h3>Create Project</h3>
<form action="/API/createProject" method="POST">
    @csrf
    <div>
        <label>project_name:</label>
        <input type="text" name="project_name">
    </div>
    <div>
        <label>customer_id:</label>
        <input type="number" name="customer_id">
    </div>
    <div>
        <label>manager_id:</label>
        <input type="number" name="manager_id">
    </div>
    <div>
        <label>sales_total:</label>
        <input type="number" name="sales_total">
    </div>


    <div>
        <button type="submit">Add Project</button>
    </div>
</form>

@include("footer")
