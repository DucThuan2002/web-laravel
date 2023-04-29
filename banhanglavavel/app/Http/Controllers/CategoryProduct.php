<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Session\SessionManager;
use App\Http\Controllers\Controller;

session_start();

class CategoryProduct extends Controller
{
    public function add_category_product(Request $request)
    {
        return  view('admin.add_category_product');
    }
    
    public function all_category_product(Request $request)
    {
        $all_category_product=DB::table('tbl_category_product')->get();
        $manager_category=view("admin.all_category_product")->with("all_category_product",$all_category_product);
        return view("admin_layout")->with("admin.all_category_product",$manager_category);

    }

    public function save_category_product(Request $request)
    {
        $data=array();
        $data['category_name']=$request->category_product_name;
        $data['category_desc']=$request->category_product_desc;
        $data['category_status']=$request->category_product_status;
       
        if(DB::table('tbl_category_product')->insert($data))
        {
            session()->put('message', 'thêm thành công danh mục sản phẩm');
        }  
        return redirect('add-category-product');
    }
    public function unactive_category_product($category_product_id)
    {
            DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status' => 1]);
            return redirect('all-category-product');
    }

    public function active_category_product($category_product_id)
    {
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status' => 0]);
            return redirect('all-category-product');
    }

    public function edit_category_product($category_product_id)
    {
        $edit_category_product=DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $edit_category=view("admin.edit_category_product")->with("edit_category_product",$edit_category_product);
        return view("admin_layout")->with("admin.edit_category_product",$edit_category);
    }    

    public function update_category_product($category_product_id,Request $request)
    {
        
        $data=array();
        $data['category_name']=$request->category_product_name;
        $data['category_desc']=$request->category_product_desc;
        // print_r($data);
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        $edit_category_product=DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $edit_category=view("admin.edit_category_product")->with("edit_category_product",$edit_category_product);
        return view("admin_layout")->with("admin.edit_category_product",$edit_category);
    }   

    public function delete_category_product($category_product_id)
    {
        
       
        if(DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete())
        {
            session()->put('message', 'xóa thành công danh mục sản phẩm');
        }  
        return redirect('all-category-product');
    }

    // end function admin page

     public function show_category_home($category_id)
    {
        $category=DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand_product')->orderBy('brand_id','desc')->get();
        $category_by_id=DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','='
                                                    ,'tbl_product.category_id')->where('tbl_category_product.category_id','=',$category_id)->get();
                                                    
        return view('pages.category.show_category')->with("category",$category)
                                                    ->with("brand",$brand_product)
                                                    ->with("category_by_id",$category_by_id);
                    
    }
    
    
   
}
