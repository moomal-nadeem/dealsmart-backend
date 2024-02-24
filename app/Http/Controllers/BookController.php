<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    public function addBook(Request $req) { 
        $d = new Book;
        $d->name=$req->input('name');
        $d->author=$req->input('author');
        $d->ratt=$req->input('ratt');
        $d->vie=$req->input('vie');
        $d->page=$req->input('page');
        $d->amazon=$req->input('amazon');
        $d->img=$req->file('img')->store('Products');
        $d->cover=$req->file('cover')->store('Products');
        $d->save();
       
        return $d;
        // return  "hello";
         }
         public function bookList(){
            return Book::all();
          }
          public function showByIdBook($id)
{
//    return "hello";
    return Book::find($id);
}
}
