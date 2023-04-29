@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa thương hiệu sản phẩm
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
                                @foreach($edit_brand_product as $key => $edit_bra)
                                <form role="form" action="{{URL::to('update-brand-product',['brand_id' => $edit_bra->brand_id])}}" method="post">                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" value="{{$edit_bra->brand_name}}" class="form-control" name="brand_product_name" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none;"  name="brand_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả" cols="8">{{$edit_bra->brand_desc}}</textarea>
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