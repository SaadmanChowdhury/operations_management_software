@include("header")

<h1>User List view testing text</h1>

{{-- {{ $list }} --}}

@for ($i = 0; $i < count($list); $i++)
    {{ $list[$i]->name }}<br>
@endfor

@include("footer")
