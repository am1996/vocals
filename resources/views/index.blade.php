@extends("templates.template")
@section("content")
<div class="row">
    <div>
        <h1 class="display-4">Lyrical</h1>
        <p class="lead">Vocals is your one-stop shop for everything lyrics! Whether you're a music enthusiast, a dedicated songwriter, or simply someone who appreciates the power of words set to music, Vocals is here to elevate your experience.
        Vocals empowers you to:

        Go beyond the surface: Analyze lyrics for meaning, rhyme schemes, and word usage patterns. (Optional, depending on functionality)
        Connect with fellow music lovers: Share your passion for lyrics and find new perspectives on your favorite songs.
        Celebrate the art of songwriting: Gain a deeper appreciation for the craft of lyric writing.
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