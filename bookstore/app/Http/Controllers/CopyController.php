<?php

namespace App\Http\Controllers;

use App\Models\Copy;
use Illuminate\Http\Request;

class CopyController extends Controller
{
    public function index(){
        return Copy::all();
    }

    public function show ($user_id, $copy_id, $start)
    {
        $lending = Copy::where('user_id', $user_id)->where('copy_id', $copy_id)->where('start', $start)->get();
        return $lending[0];
    }


    public function destroy($id){
        Copy::find($id)->delete();
        //még nem létezik... most már igen
        return redirect('/book/list');
    }

    public function update(Request $request, $id){
        $copy = Copy::find($id);
        $copy->publications = $request->publications;
        $copy->book_id = $request->book_id;
        $copy->status = $request->status;
        $copy->hardcovered = $request->hardcovered;
        $copy->save();
        //még nem létezik...
        return redirect('/copy/list');
    }

    public function store(Request $request){
        $copy = new Copy();
        $copy->publications = $request->publications;
        $copy->book_id = $request->book_id;
        $copy->status = $request->status;
        $copy->hardcovered = $request->hardcovered;
        $copy->save();
        //még nem létezik...
        return redirect('/copy/list');
    }

    public function bookCopy(){
        $copies = Copy::with('copy')->get();
        return $copies;
    }
}
