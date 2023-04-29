@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
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
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="product_name" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" class="form-control" name="product_price" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hình ảnh sản phầm</label>
                                    <input type="file" class="form-control" name="product_image" id="exampleInputEmail1" placeholder="Enter email">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phầm</label>
                                    <textarea style="resize: none;" name="product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả" cols="8"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phầm</label>
                                    <input type="text" class="form-control" name="product_content" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputFile">Danh mục sản phẩm</label>
                                        <select name="category_id" class="form-control input-sm m-bot15">
                                            @foreach($category_product as $key => $cate_pro)
                                            <option value="{{$cate_pro->category_id}}">{{$cate_pro->category_name}}</option>
                                            @endforeach
                                        </select>
                               </div>

                               <div class="form-group">
                                    <label for="exampleInputFile">Thương hiệu sản phẩm</label>
                                        <select name="brand_id" class="form-control input-sm m-bot15">
                                            @foreach($brand_product as $key => $bra_pro)
                                            <option value="{{$bra_pro->brand_id}}">{{$bra_pro->brand_name}}</option>
                                            @endforeach
                                        </select>
                               </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển thị</label>
                                        <select name="product_status" class="form-control input-sm m-bot15">
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiển Thị</option>
                                        </select>
                               </div>
                                
                                <button type="submit" name="add_product" class="btn btn-info">Lưu</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
</div>
            
@endsection