<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Copy;
use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(){
        return Book::all();
    }

    public function show($id){
        return Book::find($id);
    }

    public function destroy($id){
        Book::find($id)->delete();
        //még nem létezik... most már igen
        return redirect('/book/list');
    }

    public function update(Request $request, $id){
        $book = Book::find($id);
        $book->author = $request->author;
        $book->title = $request->title;
        $book->pieces = $request->pieces;
        $book->save();
        //még nem létezik...
        return redirect('/book/list');
    }

    public function store(Request $request){
        $book = new Book();
        $book->author = $request->author;
        $book->title = $request->title;
        $book->pieces = $request->pieces;
        $book->save();
        //még nem létezik...
        return redirect('/book/list');
    }

    //view függvények
    public function listView(){
        $books = Book::all();
        return view('book.list', ['books' => $books]);
    }

    public function bookCopy(){
        $books = Book::with('copy')->get();
        return $books;
    }

    public function showAll(){
        $books = Book::with('copy')->get();

        $user = Auth::user();
        $lendings = Lending::with('copy')->where('user_id', '=', $user->id)->get();

        $copies = Copy::with('copy')->get();
        return $copies;

        return [$books, $lendings, $copies];
    }

}