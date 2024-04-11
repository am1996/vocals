@extends("templates.template")
@section("content")
<div>
    <div class="jumbotron p-5">
        <h1>Edit User Details</h1>
        <div class="card-body">
            <form action="{{route('edituser')}}" method="post" class="form" role="form" autocomplete="off">
                @csrf
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Fullname</label>
                    <div class="col-lg-9">
                        <input name="name" class="form-control @error('name') is-invalid @enderror" type="text" value="{{auth()->user()->name}}" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Email</label>
                    <div class="col-lg-9">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ auth()->user()->email }}" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label"></label>
                    <div class="col-lg-9">
                        <input type="submit" class="btn btn-primary" value="Save Changes">
                        <a href="{{route('changepassword')}}" class="btn btn-danger">Change Password</a>
                    </div>
                </div>
            </form>
        </div>
        <h1 class="display-7">Songs:</h1>
        <hr>
        @include('components.songs')
    </div>
</div>
@endsection