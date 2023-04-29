@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa danh mục 
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
                                @foreach($edit_category_product as $key => $edit_pro)
                                <form role="form" action="{{URL::to('update-category-product',['category_id' => $edit_pro->category_id])}}" method="post">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" value="{{$edit_pro->category_name}}" class="form-control" name="category_product_name" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none;"  name="category_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả" cols="8">{{$edit_pro->category_desc}}</textarea>
                                </div>
                                <button type="submit" name="update-category-product" class="btn btn-info">Cập nhật</button>
                            </form>
                            @endforeach
                            </div>
                        </div>
                    </section>

            </div>
</div>        
@endsection