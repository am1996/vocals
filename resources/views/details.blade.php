@extends("templates.template")
@section('content')
<div class="row">
    <div class="col-md-4">
        <img src="{{$song->album_img ?? ''}}" class="rounded float-left" style="width:300px;" />
    </div>
    <div class="col-md-8">
        <h1 class="my-2">{{$song->name ?? ''}}</h1>
        <h6 class="text-muted">{{$song->singer ?? ''}} - {{$song->album_name ?? ''}}</h6>
        <h6 class="text-muted small">Published By:<br> {{$song->publisher ?? ''}}</h6>
        <h6 class="text-muted small">Written By:<br> {{$song->written_by ?? ''}}</h6>
        <p>{{$song->lyrics ?? ''}}</p>
        @if(isset(auth()->user()->id))
            @if(auth()->user()->id == $song->user_id)
            <div class="btn-group float-right" role="group" aria-label="Basic example">
                <a href="{{route('geteditsong',$song->id)}}" class="btn btn-success text-light">Edit</a>
                <a onclick="return confirm('Are you sure you want to delete?');" href="{{route('deletesong',$song->id)}}" class="btn btn-danger text-light">Delete</a>
            </div>
            @endif
        @endif
    </div>
</div>
@endsection