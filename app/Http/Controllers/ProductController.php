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
     public function sortpriceasc(){
        $produtcts = DB::table('products')
                            ->orderBy('price', 'asc')
                            ->get();
     }
     public function sortpricedesc(){
        $produtcts = DB::table('products')
        ->orderBy('price', 'desc')
        ->get();
     }
     public function sorttitleasc(){
        $produtcts = DB::table('products')
        ->orderBy('title', 'asc')
        ->get();
     }
     public function sorttitledesc(){
        $produtcts = DB::table('products')
        ->orderBy('title', 'desc')
        ->get();
     }
     public function getAddToCart(Request $request, $id){
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart); 
        return redirect('/');
     }
     public function cart(){
        if(!Session::has('cart'))
            return view('shop.shoppingcart', compact('products', null));
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
         return view('shop.wishlist', compact('products', null));
       $oldWishlist = Session::get('wishlist');
       $wishlist = new Wishlist($oldWishlist);
       return view('shop.wishlist', ['products' => $wishlist->items]);  
     }

}
