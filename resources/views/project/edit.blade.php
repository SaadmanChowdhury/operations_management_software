@include("header")

<h3>Create Project</h3>
<form action="/API/updateProject" method="POST">
    @csrf
    <div>
        <label>project_name:</label>
        <input type="hidden" name="project_id" value="{{ $project->project_id }}">
        <input type="text" name="project_name" value="{{ $project->project_name }}">
    </div>
    <div>
        <label>customer_id:</label>
        <input type="number" name="customer_id" value="{{ $project->customer_id }}">
    </div>
    <div>
        <label>manager_id:</label>
        <input type="number" name="manager_id" value="{{ $project->manager_id }}">
    </div>
    <div>
        <label>sales_total:</label>
        <input type="number" name="sales_total" value="{{ $project->sales_total }}">
    </div>

    <div>
        <button type="submit">Update Project</button>
    </div>
</form>

@include("footer")
