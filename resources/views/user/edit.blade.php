@include("header")

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous"></script>

<h3>Create User</h3>

<form id="edit_form" action="{{ route('user.update', $user->user_id) }}" method="POST">
    @csrf
    @method('put')
    <div>
        <label>Name:</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}">
    </div>
    <div>
        <label>Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}">
    </div>
    <div>
        <label>password:</label>
        <input type="password" id="password" name="password" required>

    </div>
    <div>
        <label>tel:</label>
        <input type="text" id="tel" name="tel" value="{{ $user->tel }}">

    </div>
    <div>
        <label>position:</label>
        <input type="text" id="position" name="position" value="{{ $user->position }}">
    </div>
    <div>
        <label>admission_day:</label>
        <input type="text" id="admission_day" name="admission_day" value="{{ $user->admission_day }}">
    </div>
    <div>
        <label>unit_price:</label>
        <input type="text" id="unit_price" name="unit_price" value="{{ $user->unit_price }}">
    </div>
    <div>
        <label>user_authority:</label>
        <input type="text" id="user_authority" name="user_authority" value="{{ $user->user_authority }}">
    </div>

    <div>
        <button type="submit">Update User</button>
    </div>

    <div id="message"></div>
</form>

<script>
    $(document).ready(function() {
        $('#edit_form').submit(function(e) {
            e.preventDefault();

            var name = $('#name').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var tel = $('#tel').val();
            var position = $('#position').val();
            var admission_day = $('#admission_day').val();
            var unit_price = $('#unit_price').val();
            var user_authority = $('#user_authority').val();
            var _token = $('input[name=_token]').val();

            $.ajax({
                type: "put",
                url: "{{ route('user.update', $user->user_id) }}",
                data: {
                    name: name,
                    email: email,
                    password: password,
                    tel: tel,
                    position: position,
                    admission_day: admission_day,
                    unit_price: unit_price,
                    user_authority: user_authority,
                    _token: _token
                },
                cache: false,
                success: function(data) {
                    $('#message').html(data);
                    console.log(data);
                },
                error: function(err) {
                    console.log(err);
                }
            }); // end of ajax method
        }); //end of form submit
    }); //end of document ready

</script>

@include("footer")
