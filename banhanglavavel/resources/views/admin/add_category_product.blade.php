@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục 
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
                                <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" class="form-control" name="category_product_name" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none;" name="category_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả" cols="8"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển thị</label>
                                        <select name="category_product_status" class="form-control input-sm m-bot15">
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiển Thị</option>
                                        </select>
                               </div>
                                
                                <button type="submit" name="add_category_product" class="btn btn-info">Lưu</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
</div>
            
@endsection