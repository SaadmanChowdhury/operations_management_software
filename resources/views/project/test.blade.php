@include("header")

<h1>Create Or Update Project</h1>

<form action="/API/upsertProjectDetails" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label>projectID:</label>
        <input type="text" name="projectID">
    </div>

    <div>
        <label>project_name:</label>
        <input type="text" name="projectName">
    </div>

    <div>
        <label>client_id:</label>
        <input type="text" name="clientID">
    </div>

    <div>
        <label>manager_id:</label>
        <input type="text" name="managerID">
    </div>
    <div>
        <label>sales_total:</label>
        <input type="text" name="salesTotal">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Add project</button>
    </div>
</form>

@include("footer")
