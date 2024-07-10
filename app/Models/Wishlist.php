<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public $items = null;

    public function __construct($oldWishlist)
    {
        if ($oldWishlist) {
            $this->items = $oldWishlist->items;
        }

    }
    public function add($item, $id){

        $storedItem = ['item' => $item];

        if ($this->items)
        {
            if (array_key_exists($id, $this->items))
            {
                $storedItem = $this->items[$id];
            }
        }

        $this->items[$id] = $storedItem;


    }
    //
}
