<?php

namespace App\Http\Controllers;
use App\Models\Imag;
use Illuminate\Http\Request;

class ImagController extends Controller
{
    public function addImg(Request $req, $id) { 
        $d = new Imag;
        $d->pID=$id;
        $d->img=$req->file('img')->store('Products');
        $d->save();
        return $d;
        // return  $id;
         }

         public function searchImg($id){
            return Imag::where('pID','LIKE',"$id")->get();
          }

          public function imagDelete($id){
            $res = Imag::where('id',$id)->delete();
            if($res)
             {
                return ["res"=>"Product has been deleted"];
             }else{
                return ["res"=>"fail to delete"];
             }
           
            }

}
