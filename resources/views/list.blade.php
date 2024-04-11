@extends("templates.template")
@section('content')
<div style="min-height:40vh">
    <h1 class="display-7">Songs:</h1>
    <hr>
    @include('components.songs')
</div>
@endsection