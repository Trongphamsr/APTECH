@extends('admin.master')
@section('content')
    {{--dung value(old('name'))-> dể kiểm tra khi submit nếu có nỗi vẫn giữ nguyên giá trị ta vừa chọn--}}
    <div class="col-lg-12">
        <h1 class="page-header">Product
            <small>Add</small>
        </h1>
    </div>

    <!-- /.col-lg-12 -->
    <form action="{!! url('/admin/product/add') !!}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="col-lg-7" style="padding-bottom:120px">
            @include('admin/Display_error/error')
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="form-group">
                <label>Category Parent</label>
                <select class="form-control" name="sltParent">
                    <option value="">Please Choose Category</option>
                    <!--tạo hàm đệ quy-->
                    <?php  cate_parent($cate, 0,"--", old('sltParent')); ?>
                </select>
            </div>
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" id="search" name="txtName" placeholder="Please Enter Username" value="{!! old('txtName') !!}" />
            </div>
            <div class="form-group">
                <label>Price</label>
                <input class="form-control" name="txtPrice" placeholder="Please Enter price" value="{!! old('txtPrice') !!}" />
            </div>
            <div class="form-group">
                <label>Intro</label>
                <textarea class="form-control" rows="3" name="txtIntro">{!! old('txtIntro') !!}</textarea>
                <script type="text/javascript">ckeditor('txtIntro')</script>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea class="form-control" rows="3" name="txtContent">{!! old('txtContent') !!}</textarea>
                <script type="text/javascript">ckeditor('txtContent')</script>
            </div>
            <div class="form-group">
                <label>Images</label>
                <input type="file" name="fImages" value="{!! old('fImages') !!}">
            </div>
            <div class="form-group">
                <label>Product Keywords</label>
                <input class="form-control" name="txtKeyword" placeholder="Please Enter Category Keywords" value="{!! old('txtKeyword') !!}"/>
            </div>

            <div class="form-group">
                <label>Product Description</label>
                <textarea class="form-control" name="txtDescription" rows="3">{!! old('txtDescription') !!}</textarea>
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
            <button type="submit" class="btn btn-default">Product Add</button>
            <button type="reset" class="btn btn-default">Reset</button>

        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            @for($i=1; $i<=6;$i++)
                <div class="form-group">
                    <label>image product detail{!! $i !!}</label>
                    <input type="file" name="fProductdetail[]" />
                </div>
            @endfor
        </div>
    </form>
@endsection()
