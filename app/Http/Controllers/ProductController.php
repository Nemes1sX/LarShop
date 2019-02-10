<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Cart;
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
     public function getAddToCart(Request $request, $id){
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        //$cart = Cart::restoreCart($oldCart);
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
       //dd($request->session()->get('cart'));
        return redirect('/');
     }
     public function cart(){
        if(!Session::has('cart'))
            return view('shop.shoppingcart', compact('products' => null);
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart); 
        return view('shop.shoppingcart', compact('products' => $cart->items))   
     }
     public function wishlist(){
         return view('shop.wishlist');
     }

}
