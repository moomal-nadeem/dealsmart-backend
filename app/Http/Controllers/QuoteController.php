<?php

namespace App\Http\Controllers;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    //
    public function addQuote(Request $req) { 
        $d = new Quote;
        $d->quote=$req->input('quote');
        $d->facebook=$req->input('facebook');
        $d->twitter=$req->input('twitter');
        $d->fla=$req->input('fla');
        $d->bID=$req->input('bID');
        $d->save();
       
        return $d;
        // return  "hello";
         }

        //  public function showByIdQuote($id)
        //  {
        //  //    return "hello";
        //      return Quote::find($id);
        //  }
         public function showByIdQuote($id){
            return Quote::where('bID',$id)->get();
        }
}
