<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   
        public function addProduct(Request $req) { 
        $d = new Product;
        $d->name=$req->input('name');
        $d->total=$req->input('total');
        $d->offf=$req->input('offf');
        $d->afterOff=$req->input('afterOff');
        $d->stock=$req->input('stock');
        $d->smallDesc=$req->input('smallDesc');
        $d->Des=$req->input('Des');
        $d->smallDesc=$req->input('smallDesc');
        $d->cID=$req->input('cID');
        $d->rank=$req->input('rank');
        $d->img=$req->file('img')->store('Products');
        $d->save();
       
        return $d;
        // return  "hello";
         }



// ======== SHOW BY ID FUNCTION ===============================================================================================


public function showByIdProduct($id)
{
//    return "hello";
    $product = Product::find($id);
    
    return $product;

}

public function ptotal($id)
{

    $total = Order::where('pID','=',$id)->sum("qun");
    return $total;

}


// ================= SHOW ALL FUNCTION ==========================================================================================


public function productList(){
    return Product::all();
  }



// ===== DELETE FUNCTION ============================================================================================================
  
  public function productDelete($id){
    $res = Product::where('id',$id)->delete();
    
    if($res)
     {
        return ["res"=>"Product has been deleted"];
     }else{
        return ["res"=>"fail to delete"];
     }
   
    }
// =========== Search by Category id==================================================================================================
public function search($id){
  return Product::where('cID','LIKE',"$id")->get();
}
// ========== UPDATE FUNCTION ======================================================================================================


public function productEdit($id, Request $req){
    $d = Product::find($id);

    if($req->input('name') == 'undefined' || $req->input('name') == ''){
    }else{
          $d->name=$req->input('name');
    }


    if($req->input('total') == 'undefined' || $req->input('total') == ''){
    }else{
         $d->total=$req->input('total');
    }
    
    if($req->input('offf') == 'undefined' || $req->input('offf') == ''){
    }else{
      $d->offf=$req->input('offf');
    }

    if($req->input('afterOff') == 'undefined' || $req->input('afterOff') == ''){
    }else{
       $d->afterOff=$req->input('afterOff');
    }

    if($req->input('stock') == 'undefined' || $req->input('stock') == ''){
    }else{
      $d->stock=$req->input('stock');
    }

    if($req->input('rank') == 'undefined' || $req->input('rank') == ''){
    }else{
      $d->rank=$req->input('rank');
    }
    if($req->input('smallDesc') == 'undefined' || $req->input('smallDesc') == ''){
    }else{
    $d->smallDesc=$req->input('smallDesc');
    }

    if($req->input('Des') == 'undefined' || $req->input('Des') == ''){
    }else{
     $d->Des=$req->input('Des');
    }

    if($req->input('cID') == 'undefined' || $req->input('cID') == ''){  
    }else{
       $d->cID=$req->input('cID');
    }

    if($req->file('img')){
      $d->img = $req->file('img')->store('Products');
    }
    
    $d->save();
    return $d; 
    }


    public function zeroP(){
      return Product::where('stock','0')->get();
  }

  public function notZeroP(){
    return Product::where('stock', '<>', 0)->get();
}


}

