@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Kết quả tìm kiếm</h2>
						@foreach($search as $key => $sea)
						<a href="{{ asset('chi-tiet-san-pham/' . $sea->product_id) }}" >
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
										<img src="{{ asset('public/uploads/product/' . $sea->product_image) }}" alt="" />
											<h2>{{number_format($sea->product_price).' VNĐ'}}</h2>
											<p>{{$sea->product_name}}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
										</div>
									
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
									</ul>
								</div>
							</div>
						</div>
						</a>
						@endforeach

					</div><!--features_items-->
@endsection