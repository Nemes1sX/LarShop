<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Product;

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
}
