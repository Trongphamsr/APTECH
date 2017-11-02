@extends('admin.master')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Product
            <small>Edit</small>
        </h1>
    </div>
    <style>
        .icon_del
        {
            position: relative;
            top:-140px; left: 10px;
        }
        #insert
        {
            margin-top: 20px;
        }
    </style>
    <!-- /.col-lg-12 -->
    <form action="" method="POST" enctype="multipart/form-data" name="frmEditProduct">
        <div class="col-lg-7" style="padding-bottom:120px">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            @include('admin.Display_error.error')
            <div class="form-group">
                <label>Category Parent</label>
                <select class="form-control" name="sltParent">
                    <option value="">Please Choose Category</option>
                    <!--tạo hàm đệ quy-->
                    <?php  cate_parent($cate, 0,"--", $product['cate_id']); ?>
                </select>
            </div>
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="txtName" value="{!! old('txtName', isset($product)? $product['name']: null) !!}" placeholder="Please Enter Username" />
            </div>
            <div class="form-group">
                <label>Price</label>
                <input class="form-control" name="txtPrice" value="{!! old('txtPrice', isset($product)? $product['price']: null) !!}" placeholder="Please Enter Password" />
            </div>
            <div class="form-group">
                <label>Intro</label>
                <textarea class="form-control" rows="3" name="txtIntro">
                   {!! old('txtIntro', isset($product)? $product['intro']: null) !!}
                </textarea>
                <script type="text/javascript">ckeditor('txtIntro')</script>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea class="form-control" rows="3" name="txtContent">
                    {!! old('txtContent', isset($product)? $product['content']: null) !!}
                </textarea>
                <script type="text/javascript">ckeditor('txtContent')</script>
            </div>
            <div class="form-group">
                <label>image curent</label>
                <img style="height: 400px; width: 300px; margin-left: 30px" src="{!! asset('resources/upload/'.$product['image']) !!}" class="image_curent">
                <input type="hidden" name="img_curent" value="{!! $product['image'] !!}">
            </div>
            <div class="form-group">
                <label>Images</label>
                <input type="file" name="fImages">
            </div>
            <div class="form-group">
                <label>Product Keywords</label>
                <input class="form-control" name="txtKeywords" value="{!! old('txtKeywords', isset($product)? $product['keywords']: null) !!}" placeholder="Please Enter Category Keywords" />
            </div>
            <div class="form-group">
                <label>Product Description</label>
                <textarea class="form-control" name="txtDescription" rows="3">
                   {!! old('txtDescription', isset($product)? $product['description']: null) !!}
                </textarea>
                <script type="text/javascript">ckeditor('txtDescription')</script>
            </div>
            <div class="form-group">
                <label>Product Status</label>
                <label class="radio-inline">
                    <input name="rdoStatus" value="1" checked="" type="radio">Visible
                </label>
                <label class="radio-inline">
                    <input name="rdoStatus" value="2" type="radio">Invisible
                </label>
            </div>
            <button type="submit" class="btn btn-default">Product Edit</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                @foreach($product_image as $key=> $item)
                    <div class="form-group" id="{!! $key !!}">
                        <lable>image detail {!! $key !!}</lable><br>
                        <img style="width: 200px; height: 300px; margin-top: 20px;" src="{!! asset('resources/upload/detail/'. $item['image']) !!}" idHinh="{!! $item['id'] !!}" class="imgDetail" id="{!! $key !!}">
                        <a id="del_img_demo" href="javascript:void(0)" type="button"  class="btn btn-danger btn-circle icon_del"><i  class="fa fa-times"></i></a>
                    </div>
                    {{--<input type="file" name="fProductDetail[]">--}}
                    {{--name'fProductDetail'--}}
                @endforeach()
                {{--tao them buttum them nhieu hinh--}}
                <button type="button" class="btn btn-primary" id="addImages">Add Images</button>
                {{--chua tam hinh--}}
                <div id="insert"></div>
            </div>
    </form>
@endsection()