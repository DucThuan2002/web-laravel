<?php use Gloudemans\Shoppingcart\Facades\Cart;?>
@extends('layout')
@section('content')
<div>
<section id="cart_items">
		<div class="container col-sm-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div><!--/breadcrums-->

			
			


			
			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
				
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
			<h4 style="margin: 40px 0; font-size: 20px;">Chọn phương thức thanh toán</h4>
            <form action="{{'orders-place'}}" method="post">
            {{ csrf_field() }}
			<div class="payment-options">
					<span>
						<label><input name="payment_options" value="1" type="checkbox"> Trả bằng thẻ ATM</label>
					</span>
					<span>
						<label><input name="payment_options" value="2" type="checkbox"> Nhận tiền mặt</label>
					</span>
					<span>
						<label><input name="payment_options" value="3" type="checkbox"> Thẻ ghi nợ</label>
					</span>
                    <input style="margin-bottom: 16px;" type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-primary btn-sm">
				</div>
            </form>
		</div>
	</section> <!--/#cart_items-->
	</div>
@endsection