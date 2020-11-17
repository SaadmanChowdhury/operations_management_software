@include("header")

<h3>Create Project</h3>
<form action="/API/createProject" method="POST">
    @csrf
    <div>
        <label>project_name:</label>
        <input type="text" name="project_name">
    </div>

    <div>
        <label>Customer:</label>
        <select name="customer_id">
            <option value="">Select Customer</option>
            @foreach($customers as $customer)
            <option value="{{ $customer->customer_id }}">{{ $customer->customer_name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Manager:</label>
        <select name="manager_id">
            <option value="">Select Manager</option>
            @foreach($managers as $manager)
            <option value="{{ $manager->user_id }}">{{ $manager->name }}</option>
            @endforeach
        </select>
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
