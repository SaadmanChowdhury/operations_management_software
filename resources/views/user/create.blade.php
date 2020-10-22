@include("header")

<h3>Create User</h3>
<form action="{{ route('user.store') }}" method="POST">
    @csrf
    <div>
        <label>Name:</label>
        <input type="text" name="name">
    </div>
    <div>
        <label>Email:</label>
        <input type="email" name="email">
    </div>
    <div>
        <label>password:</label>
        <input type="password" name="password">
    </div>
    <div>
        <label>tel:</label>
        <input type="text" name="tel">
    </div>
    <div>
        <label>position:</label>
        <input type="text" name="position">
    </div>
    <div>
        <label>admission_day:</label>
        <input type="text" name="admission_day">
    </div>
    <div>
        <label>unit_price:</label>
        <input type="text" name="unit_price">
    </div>
    <div>
        <label>user_authority:</label>
        <input type="text" name="user_authority">
    </div>


    <div>
        <button type="submit">Add User</button>
    </div>
</form>

@include("footer")
