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
    public function index(){ //Prekių išvedimas

     $products = Product::all();
     
     return view('shop.index', compact('products'));

    }   
   public function sorting(Request $request){ //Prekių išvedimas pagal kategorijas ir surūšiavimas kainų arba pavadinimų atžvilgiu didėjimo arba mažėjimo tvarka
      if($request->input('category') == 'all')
          $query = DB::table('products');
         else $query = Product::where('category', '=', $request->input('category'));
      if ($request->input('ascdesc') == 'priceasc')
         $query->orderBy('price', 'asc');  
      if  ($request->input('ascdesc') == 'pricedesc')
         $query->orderBy('price', 'desc'); 
      if ($request->input('ascdesc') == 'nameasc') 
        $query->orderBy('title', 'asc');        
      if ($request->input('ascdesc') == 'namedesc') 
        $query->orderBy('title', 'desc');           
     $products = $query->get();
     return view('shop.index', compact('products'));    
   }

   public function postSearch(Request $request) //Prekių paieška
{
  $query = Product::where('title', '=', $request->input('title'));
  $products = $query->get();
  return view('shop.search', compact('products'));
}

     public function getAddToCart(Request $request, $id){  //Prekių įdėjimas į krepšelį
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart); 
        return redirect('/');
     }
     public function deleteItem(Request $request, $title){ //Prekės pašalinimas

        if(!Session::has('cart'))
            return view('shop.shoppingcart', ['products' => null]);  
        $product = Product::find($title);    
        $oldCart = Session::has('cart') ? Session::get('cart') : null;              
       
        //put back in session array without deleted item
        Session::forget('cart', $title);
        //then you can redirect or whatever you need
        return redirect('/');
     }
     public function deleteCart(){ //Sunaikinti krepšelį
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
            return view('shop.shoppingcart', ['products' => null]);
        Session::flush('cart');
        return redirect('/');
     }
     public function cart(){ //Krepšelio sąrašo išvedimas
        if(!Session::has('cart'))
            return view('shop.shoppingcart', ['products' => null]);
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart); 
        return view('shop.shoppingcart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice ]);
     }
     public function getAddToWishlist(Request $request, $id){ //Prekių įdėjimas į wishlist
        $product = Product::find($id);
        $oldWishlist = Session::has('wishlist') ? Session::get('wishlist') : null;
        $wishlist = new Wishlist($oldWishlist);
        $wishlist->add($product, $product->id);

        $request->session()->put('wishlist', $wishlist); 
        return redirect('/');
     }
     public function wishlist(){ //Prekių wishlist sąrašas
       if(!Session::has('wishlist'))  
         return view('shop.wishlist', ['products' => null]);
       $oldWishlist = Session::get('wishlist');
       $wishlist = new Wishlist($oldWishlist);
       return view('shop.wishlist', ['products' => $wishlist->items]);  
     }

}
