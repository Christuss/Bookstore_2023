<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LendingController extends Controller
{
    public function index(){
        return Lending::all();
    }

    public function show ($user_id, $copy_id, $start)
    {
        $lending = Lending::where('user_id', $user_id)->where('copy_id', $copy_id)->where('start', $start)->get();
        return $lending[0];
    }


    public function destroy($id){
        Lending::find($id)->delete();
        //még nem létezik... most már igen
        return redirect('/book/list');
    }

    public function update(Request $request, $id){
        $lending = Lending::find($id);
        $lending->user_id = $request->user_id;
        $lending->copy_id = $request->copy_id;
        $lending->start = $request->start;
        $lending->save();
        //még nem létezik...
        return redirect('/lending/list');
    }

    public function store(Request $request){
        $lending = new Lending();
        $lending->user_id = $request->user_id;
        $lending->copy_id = $request->copy_id;
        $lending->start = $request->start;
        $lending->save();
        //még nem létezik...
        return redirect('/lending/list');
    }

    public function filter(){
        $user = Auth::user();
        $lendings = Lending::with('copy')->where('user_id', '=', $user->id)->get();
        return $lendings;
    }

}
