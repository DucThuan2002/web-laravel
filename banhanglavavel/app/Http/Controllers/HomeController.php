<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Session\SessionManager;
use App\Http\Controllers\Controller;  
session_start();

class HomeController extends Controller
{
    public function index()
    {
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        $all_product=DB::table('tbl_product')->where('product_status','1')->orderBy('brand_id','desc')->limit(4)->get();
        return view('pages.home')->with('category',$category_product)->with('brand',$brand_product)->with('all_product',$all_product);
    }

    public function tim_kiem(Request $request)
    {

        $keywords=$request->key;
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        $search=DB::table('tbl_product')->where('product_status','1')->where('product_name','like','%'.$keywords.'%')->get();
        return view('pages.product.search')->with('category',$category_product)->with('brand',$brand_product)->with('search',$search);

    }
}
