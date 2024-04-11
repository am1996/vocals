<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;

class APISongController extends Controller
{
    public function all() {
        return Song::all();
    }
    public function search(Request $request){
        $q = $request->query()["q"] ?? "";
        $songs = Song::latest()
            ->where("name","LIKE","%$request->q%")
            ->OrWhere("singer","LIKE","%$request->q%")
            ->OrWhere("written_by","LIKE","%$request->q%")
            ->OrWhere("album_name","LIKE","%$request->q%")
            ->OrWhere("publisher","LIKE","%$request->q%")
            ->OrWhere("lyrics","LIKE","%$request->q%")
            ->get();
        if(count($songs) == 0) return response([ "Error"=>"Song not found!"],$status=404);
        return response($songs,$status=200);
    }
    public function create(Request $request){
        if(auth()->user()["id"] != $request->post()["id"])
            return response(["Error"=> "Unauthorized Access"],$status="401");
        $validated = Validator($request->post(),[
            'name' => 'required|min:5',
            'singer'=> 'required',
            'written_by'=> 'required',
            'album_name'=>'required',
            'album_img'=>'required|url',
            'publisher'=>'required',
            'lyrics'=>'required',
            'create'
        ]);
        if(count($validated->errors()) != 0) return $validated->errors();
        $song = Song::create($request->post());
        return $song;
    }
    public function getById($id) {
        $songs = Song::where("id","=",$id)->get();
        if(count($songs) == 0) return response([ "Error"=>"Song not found!"],$status=404);
        return response($songs,$status=200);
    }
}
