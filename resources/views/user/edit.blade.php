@include("header")

<h3>Create User</h3>

<form action="{{ route('user.update', $user->user_id) }}" method="POST">
    @csrf
    @method('put')
    <div>
        <label>Name:</label>
        <input type="text" name="name" value="{{ $user->name }}">
    </div>
    <div>
        <label>Email:</label>
        <input type="email" name="email" value="{{ $user->email }}">
    </div>
    <div>
        <label>password:</label>
        <input type="password" name="password" required>

    </div>
    <div>
        <label>tel:</label>
        <input type="text" name="tel" value="{{ $user->tel }}">

    </div>
    <div>
        <label>position:</label>
        <input type="text" name="position" value="{{ $user->position }}">
    </div>
    <div>
        <label>admission_day:</label>
        <input type="text" name="admission_day" value="{{ $user->admission_day }}">
    </div>
    <div>
        <label>unit_price:</label>
        <input type="text" name="unit_price" value="{{ $user->unit_price }}">
    </div>
    <div>
        <label>user_authority:</label>
        <input type="text" name="user_authority" value="{{ $user->user_authority }}">
    </div>

    <div>
        <button type="submit">Update User</button>
    </div>
</form>

@include("footer")
