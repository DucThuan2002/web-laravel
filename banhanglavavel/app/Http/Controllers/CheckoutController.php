<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Session\SessionManager;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

session_start();


class CheckoutController extends Controller
{
    public function login_checkout()
    {
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        return view("pages.checkout.login_checkout")->with("category",$category_product)->with("brand",$brand_product);
    }

    public function add_customer(Request $request)
    {
        $data=array();
        $data['customer_name']=$request->customer_name;
        $data['customer_email']=$request->customer_email;
        $data['customer_password']=md5($request->customer_password);
        $data['customer_phone']=$request->customer_phone;
        $insert_customer=DB::table('tbl_customer')->insertGetId($data);

        session()->put('customer_id',$insert_customer);
        session()->put('customer_name',$request->customer_name);
        return  redirect('checkout');
    }

     public function checkout()
    {
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        return view("pages.checkout.show_checkout")->with("category",$category_product)->with("brand",$brand_product);
    }
    public function save_checkout_customer(Request $request)
    {
        $data=array();
        $data['shipping_name']=$request->shipping_name;
        $data['shipping_email']=$request->shipping_email;
        $data['shipping_notes']=$request->shipping_notes;
        $data['shipping_address']=$request->shipping_address;
        $data['shipping_phone']=$request->shipping_phone;
        $insert_shipping=DB::table('tbl_shipping')->insertGetId($data);

        session()->put('shipping_id',$insert_shipping);
        return  redirect('payment');
    }
    public function payment()
    {
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        return view("pages.checkout.payment")->with("category",$category_product)->with("brand",$brand_product);
 
    }

    public function logout_checkout()
    {
        session()->flush();
        return  redirect('login-checkout');
    }

    public function login_customer(Request $request)
    {
        $email=$request->email_account;
        $password=md5($request->password_account);
        $result=DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
        if($result)
        {
            session()->put('customer_id',$result->customer_id);
            return  redirect('checkout');
        }
        else
        {
            return  redirect('login-checkout');
        }
       
    }

    public function orders_place(Request $request)
    {
        // trang chủ
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand_product')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        // insert payment_method

        $data=array();
        $data['payment_method']=$request->payment_options;
        $data['payment_status']='Đang chờ xử lý';
        $payment_id=DB::table('tbl_payment')->insertGetId($data);

    //    insert order
        $order_data=array();
        $order_data['customer_id']=session()->get('customer_id');
        $order_data['shipping_id']=session()->get('shipping_id');
        $order_data['payment_id']=$payment_id;
        $order_data['order_total']=Cart::total();
        $order_data['order_status']='Đang chờ xử lý';
        $order_id=DB::table('tbl_order')->insertGetId($order_data);
        // insert order_details
        $order_details_data=array();
        $content=Cart::content();
        foreach($content as $v_content)
        {
            $order_details_data['order_id']=$order_id;
            $order_details_data['product_id']=$v_content->id;
            $order_details_data['product_name']=$v_content->name;
            $order_details_data['product_price']=$v_content->price;
            $order_details_data['product_sales_quantity']=$v_content->qty;
            DB::table('tbl_order_details')->insert($order_details_data);
        }
        if($data['payment_method']==1)
        {
            echo "thanh toán bằng thẻ ATM";
        }
        else if($data['payment_method']==2)
        {
            Cart::destroy();
            return view("pages.checkout.handcash")->with("category",$category_product)->with("brand",$brand_product);
        }
        else{
            echo "Thanh toán bằng thẻ ghi nợ";
        }
    }

    public function manager_order(){
        $all_order=DB::table('tbl_order')->join('tbl_customer','tbl_customer.customer_id','='
                                    ,'tbl_order.customer_id')->select('tbl_order.*','tbl_customer.customer_name')->get();
            $manager=view("admin.manager_order")->with("all_order",$all_order);
            return view("admin_layout")->with("admin.all_product",$manager);
    }



}
