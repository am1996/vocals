<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SongRequest;
use App\Models\Song;
Use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class PageController extends Controller
{
    public function aboutus(){
        return view("aboutus");
    }
    public function index(){
        return view("index",[
            "songs" => Song::paginate(10)
        ]);
    }
    public function getCreateSongPage(){
        return view("createsong");
    }
    public function createSong(SongRequest $request){
        $this->validate($request,[
            "name"=> "required",
            "singer"=>"required",
            "written_by"=>"required",
            "publisher"=>"required",
            "lyrics"=>"required",
            "album_name"=>"required",
            "album_img"=>"required"
        ]);
        $song = new Song;
        $song->name = $request["name"];
        $song->singer = $request["singer"];
        $song->written_by = $request["written_by"];
        $song->publisher = $request["publisher"];
        $song->lyrics = $request["lyrics"];
        $song->album_name = $request["album_name"];
        $song->album_img = $request["album_img"];
        $song->user_id = Auth::user()->id;
        $song->save();
        return redirect()->route('index')->withSuccess('Song Created Successfully!');
    }
    public function songDetails($id){
        $song = Song::query()->findOrFail($id);
        return view("details",[
            "song" => $song
        ]);
    }
    public function listSongs(){
        $search = $_GET["q"] ?? null;
        if(isset($search))
            $songs = Song::query()
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('singer', 'like', '%' . $search . '%')
            ->orWhere('lyrics', 'like', '%' . $search . '%')
            ->paginate(10);
        else 
            $songs = DB::table("songs")->paginate(10);
        return view("list", [
            "songs" => $songs
        ]);
    }
    function getDashboard(){
        $songs = Song::where("user_id",Auth::user()->id)->orderBy("updated_at")->paginate(10);
        return view("dashboard",[
            "songs" => $songs
        ]);
    }
    function getEditSong(Request $request,int $id){
        $song = Song::query()->findOrFail($id);
        if(intval($song->user_id) === auth()->user()->id)
            return view("editsong",[
                "song"=>$song
            ]);
        return abort(404);
    }
    function updateSong(Request $request,int $id){
        $this->validate($request,[
            "name"=> "required",
            "singer"=>"required",
            "written_by"=>"required",
            "publisher"=>"required",
            "lyrics"=>"required",
            "album_name"=>"required",
            "album_img"=>"required"
        ]);
        $song = Song::query()->findOrFail($id);
        if(intval($song->user_id) == auth()->user()->id){
            Song::findOrFail(intval($song->id))->update($request->all());
            return redirect("/$id")->with("success","Song Updated successfully");
        }
        return abort(401);
    }
    function deleteSong(Request $request,int $id){
        $song = Song::query()->findOrFail($id);
        if(intval($song->user_id) === auth()->user()->id){
            $song->delete();
            return Redirect::to("/")->with("success","Deleted Song Successfully!");
        }
        return abort(404);
    }
}
