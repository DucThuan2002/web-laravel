<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Session\SessionManager;
use App\Http\Controllers\Controller;  
session_start();

class ProductController extends Controller
{
    public function add_product()
        {
            $category_product=DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
            $brand_product=DB::table('tbl_brand_product')->orderBy('brand_id','desc')->get();
            $manager_brand_category=view("admin.add_product")->with("category_product",$category_product)->with("brand_product",$brand_product);
            return view("admin_layout")->with("admin.add_product",$manager_brand_category);
        }
        
        public function all_product()
        {
            $all_product=DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','='
                                    ,'tbl_product.category_id')
                                                ->join('tbl_brand_product','tbl_brand_product.brand_id','='
                                                ,'tbl_brand_product.brand_id')->get();
            $manager=view("admin.all_product")->with("all_product",$all_product);
            return view("admin_layout")->with("admin.all_product",$manager);
    
        }
    
        public function save_product(Request $request)
        {
            $data=array();
            $data['product_name']=$request->product_name;
            $data['product_price']=$request->product_price;
            $data['product_desc']=$request->product_desc;
            $data['product_content']=$request->product_content;
            $data['category_id']=$request->category_id;
            $data['brand_id']=$request->brand_id;
            $data['product_status']=$request->product_status;

            // xử lý file
            $get_file=$request->file('product_image');
            if(isset($get_file))
            {
                $get_name_image=$get_file->getClientOriginalName();
                $name_image=current(explode('.',$get_name_image));
                $new_image=$name_image.rand(0,999).'.'.$get_file->getClientOriginalExtension();
                $get_file->move("public/uploads/product",$new_image);
                $data['product_image']=$new_image;
                if(DB::table('tbl_product')->insert($data))
                {
                    session()->put('message', 'thêm thành công sản phẩm');
                }  
                return redirect('add-product');
            }

            $data['product_image']='';
            if(DB::table('tbl_product')->insert($data))
             {
                session()->put('message', 'thêm thành sản phẩm');
             }  
            return redirect('add-product');
        }
        public function unactive_product($product_id)
        {
                DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status' => 1]);
                return redirect('all-product');
        }
    
        public function active_product($product_id)
        {
            DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status' => 0]);
                return redirect('all-product');
        }
    
        public function edit_product($product_id)
        {
            $edit_product=DB::table('tbl_product')->where('product_id',$product_id)->get();
            $category=DB::table('tbl_category_product')->get();
            $brand=DB::table('tbl_brand_product')->get();
            $edit=view("admin.edit_product")->with("edit_product",$edit_product)->with("category",$category)->
                                                with("brand",$brand);
            return view("admin_layout")->with("admin.edit_product",$edit);
        }   
         
    
        public function update_product($product_id,$image,Request $request)
        {
            
            $data=array();
            $data['product_name']=$request->product_name;
            $data['product_desc']=$request->product_desc;
            $data['product_content']=$request->product_content;
            $data['product_price']=$request->product_price;
            $data['product_status']=$request->product_status;
            $data['category_id']=$request->category_id;
            $data['brand_id']=$request->brand_id;
            if($request->file('product_image')==null)
            {
                
                DB::table('tbl_product')->where('product_id',$product_id)->update($data);
                $edit_product=DB::table('tbl_product')->where('product_id',$product_id)->get();
                $category=DB::table('tbl_category_product')->get();
                $brand=DB::table('tbl_brand_product')->get();
                $edit=view("admin.edit_product")->with("edit_product",$edit_product)->with("category",$category)->
                                                    with("brand",$brand);
                return view("admin_layout")->with("admin.edit_product",$edit);
            }
            else{
                $file_path = public_path("uploads/product/$image");
                if(file_exists($file_path))
                {
                    unlink($file_path);
                }
                
                $get_file=$request->file('product_image');
                $get_name_image=$get_file->getClientOriginalName();
                $name_image=current(explode('.',$get_name_image));
                $new_image=$name_image.rand(0,999).'.'.$get_file->getClientOriginalExtension();
                $get_file->move("public/uploads/product",$new_image);
                $data['product_image']=$new_image;
                DB::table('tbl_product')->where('product_id',$product_id)->update($data);
                $edit_product=DB::table('tbl_product')->where('product_id',$product_id)->get();
                $category=DB::table('tbl_category_product')->get();
                $brand=DB::table('tbl_brand_product')->get();
                $edit=view("admin.edit_product")->with("edit_product",$edit_product)->with("category",$category)->
                                                    with("brand",$brand);
                return view("admin_layout")->with("admin.edit_product",$edit);
            }
            
        }   
    
        public function delete_product($product_id,$image)
        {
            $file_path = public_path("uploads/product/$image");
            if(file_exists($file_path))
                {
                    unlink($file_path);
                }
           
            if(DB::table('tbl_product')->where('product_id',$product_id)->delete())
            {
                session()->put('message', 'xóa thành công  sản phẩm');
            }  
            return redirect('all-product');
        }

        // end function admin

        public function show_detail_product($product_id)
        {
            $category=DB::table('tbl_category_product')->get();
            $brand=DB::table('tbl_brand_product')->get();
            $detail_product=DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','='
                                    ,'tbl_product.category_id')
                                                ->join('tbl_brand_product','tbl_brand_product.brand_id','='
                                                ,'tbl_brand_product.brand_id')->where('product_id','=',$product_id)->get();
            foreach($detail_product as $key => $value)
            {
                    $category_id=$value->category_id;
            }
            $related_product=DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','='
            ,'tbl_product.category_id')
                        ->join('tbl_brand_product','tbl_brand_product.brand_id','='
                        ,'tbl_brand_product.brand_id')->where('tbl_category_product.category_id','=',$category_id)
                                                    ->whereNotIn('tbl_product.product_id',[$product_id])->get();
            return view('pages.product.show_detail')->with('category',$category)->with('brand',$brand)
                                                    ->with('product_detail',$detail_product)
                                                    ->with('related_product',$related_product);
        }
}
