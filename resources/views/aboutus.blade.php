@extends("templates.template")
@section("content")
<section class="container about-us">
    <div class="row">
      <div class="col-md-6 mt-5">
        <h2>About Vocal: Your One-Stop Shop for Song Lyrics</h2>
        <p>Vocal is a passionate community dedicated to the power of lyrics. We believe that lyrics are more than just words on a page; they're stories, emotions, and experiences set to music.</p>
        <p>Here at Vocal, we provide a comprehensive platform for everything lyrics-related:</p>
        <ul class="list-group">
          <li class="list-group-item">Massive Lyric Database: Search and explore a vast collection of lyrics from across genres and decades.</li>
          <li class="list-group-item">Community Connection: Engage with other music enthusiasts. Discuss lyrics, interpretations, and the stories behind the songs.</li>
          <li class="list-group-item">Contribute to the Cause: Help us build the most accurate and complete lyric database by submitting missing or corrected lyrics.</li>
          <li class="list-group-item">Lyric Exploration Tools: Go beyond the surface. Analyze lyrics for meaning, rhyme schemes, and word usage patterns.</li>
          <li class="list-group-item">Songwriting Inspiration: Find lyrical inspiration for your own songwriting endeavors. Discover new themes, metaphors, and storytelling techniques.</li>
        </ul>
      </div>
      <div class="col-md-6 d-flex justify-content-center align-items-center">
        <img src="{{ asset('images/bg.png') }}" alt="Image representing Vocal" class="img-fluid rounded"> </div>
    </div>
  </section>
  
  <section class="container mission">
    <h2>Our Mission</h2>
    <p>Vocal aims to empower music lovers and aspiring songwriters by providing a central hub for lyric discovery, analysis, and community interaction. We strive to:</p>
    <ul>
      <li>Foster a deeper appreciation for the art of songwriting.</li>
      <li>Connect people through the shared language of music.</li>
      <li>Make lyrics a readily available resource for everyone.</li>
    </ul>
  </section>
  
  <section class="container join-us my-5">
    <h2>Join the Vocal Community!</h2>
    <p>Whether you're a casual listener, a dedicated music fan, or an aspiring songwriter, Vocal welcomes you. Explore our platform, share your passion for lyrics, and contribute to building a vibrant music community.</p>
    <a href="/" class="btn btn-primary">Explore Vocal Now</a>
  </section>
</section>
@endsection