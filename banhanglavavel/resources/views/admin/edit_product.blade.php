@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa sản phẩm
                        </header>
                        <div class="panel-body">
                            <?php
                                $message=session()->get('message');
                                if(isset($message))
                                {
                                    echo "<span class='text-alert'>$message</span>";
                                    session()->put('message',null);
                                }
                            ?>
                            
                            <div class="position-center">
                                @foreach($edit_product as $key => $edit_pro)
                                <form role="form" action="{{URL::to('update-product',['product_id' => $edit_pro->product_id,'image'=> $edit_pro->product_image])}}" method="post" enctype="multipart/form-data">                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                                        <input type="text" value="{{$edit_pro->product_name}}" class="form-control" name="product_name" id="exampleInputEmail1" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá sản phẩm</label>
                                        <input type="text" value="{{$edit_pro->product_price}}" class="form-control" name="product_price" id="exampleInputEmail1" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Hình ảnh sản phầm</label>
                                        <input type="file" class="form-control" name="product_image" id="exampleInputEmail1" >
                                        <img src="{{ asset('public/uploads/product/'.$edit_pro->product_image) }}" width="200">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô tả sản phầm</label>
                                        <textarea style="resize: none;"  name="product_desc" class="form-control" id="exampleInputPassword1" cols="8" >{{$edit_pro->product_desc}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nội dung sản phầm</label>
                                        <input type="text" value="{{$edit_pro->product_content}}" class="form-control" name="product_content" id="exampleInputEmail1" >
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputFile">Danh mục sản phẩm</label>
                                        <select name="category_id" class="form-control input-sm m-bot15">
                                            @foreach($category as $key => $cate)
                                                @if($cate->category_id==$edit_pro->category_id)
                
                                                        <option value="{{$cate->category_id}}" selected>{{$cate->category_name}}</option>
                                                    
                                                @else 
                                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                
                                                @endif
                                            @endforeach
                                            </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile">Thương hiệu sản phẩm</label>
                                            <select name="brand_id" class="form-control input-sm m-bot15">
                                                @foreach($brand as $key => $bra)
                                                    @if($bra->brand_id==$edit_pro->brand_id)
                    
                                                            <option value="{{$bra->brand_id}}" selected>{{$bra->brand_name}}</option>
                                                        
                                                    @else 
                                                        <option value="{{$bra->brand_id}}">{{$bra->brand_name}}</option>
                                                    
                                                    @endif
                                                @endforeach
                                            </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile">Hiển thị</label>
                                            <select name="product_status" class="form-control input-sm m-bot15">
                                                @if($edit_pro->product_id==0)
                                                    <option value="0">Ẩn</option>
                                                @else
                                                    <option value="1">Hiển Thị</option>
                                                @endif
                                            </select>
                                    </div>
                                    <button type="submit" name="update-brand-product" class="btn btn-info">Cập nhật</button>
                                </form>
                            @endforeach
                            </div>
                        </div>
                    </section>

            </div>
</div>        
@endsection