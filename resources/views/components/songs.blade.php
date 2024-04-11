<div class="row mb-3">
    @forelse ($songs as $song)
        <div class="col-md-6 col-lg-4 col-sm-12 my-2">
            <div class="card">
                <img class="card-img-top" src="{{$song->album_img}}" width="100%" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$song->name}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{$song->singer}}</h6>
                    <p class="card-text small">Written By:<br> {{$song->written_by}}</p>
                    <a href="{{ route('details',$song->id) }}" class="card-link">Show Lyrics</a>
                </div>
            </div>
        </div>
    @empty
        <h3>No songs found</h3>
    @endforelse
</div>
@if($songs->total() > $songs->perPage())
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="{{ ($songs->currentPage() == 1) ? ' disabled page-item' : 'page-item' }}">
                <a class="page-link" href="{{ $songs->url($songs->currentPage()-1) }}" tabindex="-1">Previous</a>
            </li>
            <li class="page-item disabled"><d class="page-link">{{$songs->currentPage()}} of {{$songs->lastPage()}}</d></li>
            <li class="{{ ($songs->currentPage() == $songs->lastPage()) ? ' disabled page-item' : 'page-item' }}">
                <a class="page-link" href="{{ $songs->url($songs->currentPage()+1) }}">Next</a>
            </li>
        </ul>
    </nav>
@endif