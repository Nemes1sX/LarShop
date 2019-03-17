<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Cart;
use App\Wishlist;
use Session;

class ProductController extends Controller
{
    public function index(){

     $products = Product::all();
     
     return view('shop.index', compact('products'));

    }//
    public function vodka(){
       $products = DB::table('products')
                    ->select('*')
                    ->where('category', 'Degtinė')
                    ->get();
       
       return view('shop.index', compact('products'));             
    }
    public function whiskey(){
        $products = DB::table('products')
                     ->select('*')
                     ->where('category', 'Viskis')
                     ->get();
        
        return view('shop.index', compact('products'));             
     }
     public function sorttitleasc(){
        $products = DB::table('products')
                            ->orderBy('title', 'asc')
                            ->get();
                            
    return view('shop.index', compact('products'));             
     }

     public function sorttitledesc(){
        $products = DB::table('products')
        ->orderBy('title', 'desc')
        ->get();
     return view('shop.index', compact('products'));
     }             

     public function sorttitlevodkaasc(){
        $products = DB::table('products')
        ->where('category', 'Degtinė')
        ->orderBy('title', 'asc')
        ->get();
     return view('shop.index', compact('products'));       
     }      

     public function sorttitlevodkadesc(){
        $products = DB::table('products')
        ->where('category', 'Degtinė')
        ->orderBy('title', 'desc')
        ->get();
     return view('shop.index', compact('products'));   
     }      
     
     public function sorttitlewhiskeyasc(){
      $products = DB::table('products')
      ->where('category', 'Viskis')
      ->orderBy('title', 'asc')
      ->get();
   return view('shop.index', compact('products'));       
   }      

   public function sorttitlewhiskeydesc(){
      $products = DB::table('products')
      ->where('category', 'Viskis')
      ->orderBy('title', 'desc')
      ->get();
   return view('shop.index', compact('products'));   
   }   
   
   public function sorting(Request $request){
      $query = Product::where('category', '=', $request->input('category'));
      if ($request->has('ascdesc') == 'priceasc')
         $query->orderBy('price', 'asc');  
      elseif  ($request->has('ascdesc') == 'pricedesc')
         $query->orderBy('price', 'desc'); 
      elseif ($request->has('ascdesc') == 'nameasc') 
        $query->orderBy('title', 'asc');        
      elseif ($request->has('ascdesc') == 'namedesc') 
        $query->orderBy('title', 'desc');           
     $products = $query->get();
     //dd($query);
     return view('shop.index', compact('products'));    
   }

   public function postSearch(Request $request)
{
  $query = Product::where('title', '=', $request->input('title'));
  $products = $query->get();
  return view('shop.index', compact('products'));
}

     public function getAddToCart(Request $request, $id){
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart); 
        return redirect('/');
     }
     public function deleteItem(Request $request, $title){

        if(!Session::has('cart'))
            return view('shop.shoppingcart', ['products' => null]);  
        $product = Product::find($title);    
        $oldCart = Session::has('cart') ? Session::get('cart') : null;              
       
        //put back in session array without deleted item
        Session::forget('cart', $title);
        //then you can redirect or whatever you need
        return redirect('/');
     }
     public function deleteCart(){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
            return view('shop.shoppingcart', ['products' => null]);
        Session::flush('cart');
        return redirect('/');
     }
     public function cart(){
        if(!Session::has('cart'))
            return view('shop.shoppingcart', ['products' => null]);
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart); 
        return view('shop.shoppingcart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice ]);
     }
     public function getAddToWishlist(Request $request, $id){
        $product = Product::find($id);
        $oldWishlist = Session::has('wishlist') ? Session::get('wishlist') : null;
        $wishlist = new Wishlist($oldWishlist);
        $wishlist->add($product, $product->id);

        $request->session()->put('wishlist', $wishlist); 
        return redirect('/');
     }
     public function wishlist(){
       if(!Session::has('wishlist'))  
         return view('shop.wishlist', ['products' => null]);
       $oldWishlist = Session::get('wishlist');
       $wishlist = new Wishlist($oldWishlist);
       return view('shop.wishlist', ['products' => $wishlist->items]);  
     }

}
