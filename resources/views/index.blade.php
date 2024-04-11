@extends("templates.template")
@section("content")
<div class="row">
    <div>
        <h1 class="display-4">Lyrical</h1>
        <p class="lead">A website created to be able to easily search for lyrics by parts of lyrics or title of the song.
        </p>
        <hr class="my-4">
        <p>This website's data is created by people for people</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="/aboutus" role="button">Learn more</a>
        </p>
    </div>
</div>
<h1 class="display-7">Songs:</h1>
<hr>
@include('components.songs')
@endsection