<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Session\SessionManager;
use App\Http\Controllers\Controller;  
session_start();

class BrandProduct extends Controller
{
        public function add_brand_product(Request $request)
        {
            return  view('admin.add_brand_product');
        }
        
        public function all_brand_product(Request $request)
        {
            $all_brand_product=DB::table('tbl_brand_product')->get();
            $manager_brand=view("admin.all_brand_product")->with("all_brand_product",$all_brand_product);
            return view("admin_layout")->with("admin.all_brand_product",$manager_brand);
    
        }
    
        public function save_brand_product(Request $request)
        {
            $data=array();
            $data['brand_name']=$request->brand_product_name;
            $data['brand_desc']=$request->brand_product_desc;
            $data['brand_status']=$request->brand_product_status;
            if(DB::table('tbl_brand_product')->insert($data))
            {
                session()->put('message', 'thêm thành công thương hiệu sản phẩm');
            }  
            return redirect('add-brand-product');
        }
        public function unactive_brand_product($brand_product_id)
        {
                DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status' => 1]);
                return redirect('all-brand-product');
        }
    
        public function active_brand_product($brand_product_id)
        {
            DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status' => 0]);
                return redirect('all-brand-product');
        }
    
        public function edit_brand_product()
        {
            $edit_brand_product=DB::table('tbl_brand_product')->where('brand_id',1)->get();
            $edit_brand=view("admin.edit_brand_product")->with("edit_brand_product",$edit_brand_product);
            return view("admin_layout")->with("admin.edit_brand_product",$edit_brand);
        }   
         
    
        public function update_brand_product($brand_product_id,Request $request)
        {
            
            $data=array();
            $data['brand_name']=$request->brand_product_name;
            $data['brand_desc']=$request->brand_product_desc;
            // print_r($data);
            DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update($data);
            $edit_brand_product=DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->get();
            $edit_brand=view("admin.edit_brand_product")->with("edit_brand_product",$edit_brand_product);
            return view("admin_layout")->with("admin.edit_brand_product",$edit_brand);
        }   
    
        public function delete_brand_product($brand_product_id)
        {
            
           
            if(DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->delete())
            {
                session()->put('message', 'xóa thành công danh mục sản phẩm');
            }  
            return redirect('all-brand-product');
        }

        // end function admin

        public function show_brand_home($brand_id)
        {
            $category=DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
            $brand_product=DB::table('tbl_brand_product')->orderBy('brand_id','desc')->get();
            $brand_by_id=DB::table('tbl_product')->join('tbl_brand_product','tbl_brand_product.brand_id','='
                                                        ,'tbl_product.brand_id')->where('tbl_brand_product.brand_id','=',$brand_id)->get();
                                                        
            return view('pages.brand.show_brand')->with("category",$category)
                                                        ->with("brand",$brand_product)
                                                        ->with("brand_by_id",$brand_by_id);
                        
        }
}
