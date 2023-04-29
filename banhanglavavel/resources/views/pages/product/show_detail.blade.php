@extends('layout')
@section('content')
@foreach($product_detail as $key => $pro_de)
<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{asset('/public/uploads/product/'.$pro_de->product_image)}}" alt="" />
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="{{asset('/public/frontend/images/similar1.jpg')}}" alt=""></a>
										  <a href=""><img src="{{asset('/public/frontend/images/similar2.jpg')}}" alt=""></a>
										  <a href=""><img src="{{asset('/public/frontend/images/similar3.jpg')}}" alt=""></a>
										</div>
										
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<!-- <img src="{{asset('/public/uploads/product/'.$pro_de->product_image)}}" class="newarrival" alt="" /> -->
								<h2>{{$pro_de->product_name}}</h2>
								<p>Mã ID: {{$pro_de->product_id}}</p>
								<!-- <img src="{{asset('/public/uploads/product/'.$pro_de->product_image)}}" alt="" /> -->
								<form action="{{url('/save-cart')}}" method="post">
									@csrf
									<span>
										<span>{{number_format($pro_de->product_price)." VNĐ"}}</span>
										<label for="quantity">Số lượng:</label>
										<input type="number" min="1" value="1" name="quantity" id="quantity">
										<input type="hidden" value="{{$pro_de->product_id}}" name="productid_hidden"/>
										<button type="submit" class="btn btn-fefault cart">
											<i class="fa fa-shopping-cart"></i>
											Thêm giỏ hàng
										</button>
									</span>
								</form>
								<p><b>Tình trạng:</b> Còn tồn hàng</p>
								<p><b>Tình trạng:</b> Mới 100%</p>
								<p><b>Thương hiệu:</b> {{$pro_de->brand_name}}</p>
								<p><b>Danh mục:</b> {{$pro_de->category_name}}</p>
								<a href=""><img src="{{asset('/public/frontend/images/share.png')}}" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
								<li ><a href="#reviews" data-toggle="tab">Đánh giá (5)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								
							<p>{!!$pro_de->product_desc!!}</p>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
							<p>{!!$pro_de->product_content!!}</p>
							</div>
							
							
							
							<div class="tab-pane fade " id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="{{asset('/public/frontend/images/rating.png')}}" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
                    @endforeach

                    <div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm có liên quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
								@foreach($related_product as $key => $rel_pro)	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{asset('/public/uploads/product/'.$rel_pro->product_image)}}" alt="" />
											<h2>{{number_format($rel_pro->product_price).' VNĐ'}}</h2>
											<p>{{$rel_pro->product_name}}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
												</div>
											</div>
										</div>
									</div>
								@endforeach	
								</div>
		
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
@endsection