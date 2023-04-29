<?php use Gloudemans\Shoppingcart\Facades\Cart;?>
@extends('layout')
@section('content')
<section id="cart_items" >
		<div class="container col-sm-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Trang chủ</a></li>
				  <li class="active">Giỏ hàng của bạn</li>
				</ol>
			</div>
			<?php $content=Cart::content();?>
			
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh sản phẩm</td>
							<td class="description">Mô tả</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $key => $cart)
						<tr>
							<td class="cart_product">
								<a href=""><img width="80" src="{{asset('public/uploads/product/'.$cart->options->image)}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$cart->name}}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($cart->price).'VNĐ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{'update-cart-quantity'}}" method="post">
									{{ csrf_field() }}
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$cart->qty}}" autocomplete="off" size="2">
									
									<input type="hidden" value="{{$cart->rowId}}" name="rowId_cart" class="form-control">
									<input type="submit" value="cập nhật" name="update_qty" class="btn btn-default btn-sm">
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									<?php
									$subtotal=$cart->price*$cart->qty;
									echo number_format($subtotal).' VNĐ';
									
									?>
								</p> 
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{('delete-to-cart/'.$cart->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach

						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
	<section id="do_action">
		<div class="container">
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng <span>{{Cart::priceTotal().'VNĐ'}}</span></li>
							<li>Thuế <span>{{Cart::tax()}}</span></li>
							<li>Giá vận chuyển <span>Free</span></li>
							<li>Thành tiền:  <span>{{Cart::total().'VNĐ'}}</span></li>
						</ul>
						<?php 
									$customer_id=session()->get('customer_id');
									if($customer_id)
									{
									?>
										<a class="btn btn-default check_out" href="{{'checkout'}}">Thanh Toán</a>
									<?php 
									}
									else{
									?>
										<a class="btn btn-default check_out" href="{{'login-checkout'}}">Thanh Toán</a>
									<?php } ?>
								
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection