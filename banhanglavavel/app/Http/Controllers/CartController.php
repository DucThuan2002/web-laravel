<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Session\SessionManager;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

session_start();

class CartController extends Controller
{
    public function save_cart(Request $request)
    {
        
        
        
       
        $product_id=$request->productid_hidden;
        $quantity=$request->quantity;
        $product_info=DB::table('tbl_product')->where('product_id',$product_id)->first();
        // number_format();
        
       
        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        // $data=Cart::content();
        
        $data['id']=$product_id;
        $data['qty']=$quantity;
        $data['name']=$product_info->product_name;
        $data['price']=$product_info->product_price;
        $data['weight']=$product_info->product_price;
        $data['options']['image']=$product_info->product_image;
        // echo $data['price'];
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        Cart::add($data);
        return redirect("/show-cart");
        // Cart::destroy();
        }

    public function show_cart()
    {
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        return view("pages.cart.show_cart")->with("category",$category_product)->with("brand",$brand_product);
    }
    
    public function delete_to_cart($rowId)
    {
        Cart::update($rowId,0);
        return redirect("/show-cart");
    }

    public function update_cart_quantity(Request $request)
    {
        $rowId=$request->rowId_cart;
        $quantity=$request->cart_quantity;
        Cart::update($rowId,$quantity);
        return redirect("/show-cart");
    }
}
