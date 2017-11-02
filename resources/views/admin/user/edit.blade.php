@extends('admin.master')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">User
            <small>Edit</small>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-7" style="padding-bottom:120px">
        <form action="" method="POST">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            @include('admin.Display_error.error')
            <div class="form-group">
                <label>Default</label>
                <input class="form-control" name="macdinh" value="TrongPham" disabled />
            </div>
            <div class="form-group">
                <label>Username</label>
                <input class="form-control" value="{!! old('txtUser', asset($data) ? $data['name'] : null) !!}" name="txtUser"  placeholder="please enter tstUser" />
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" value="{!! old('txtPass', asset($data) ? $data['password'] : null) !!}" class="form-control" name="txtPass" placeholder="Please Enter Password" />
            </div>
            <div class="form-group">
                <label>RePassword</label>
                <input type="password" value="{!! old('txtRePass', asset($data) ? $data['password'] : null) !!}" class="form-control" name="txtRePass" placeholder="Please Enter RePassword" />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" value="{!! old('txtEmail', asset($data) ? $data['email'] : null) !!}" class="form-control" name="txtEmail" placeholder="Please Enter Email" />
            </div>
            {{-- neu khong phai la chinh minh khong duoc hien ra, admin de doi thanh admin de vao sua thong tin--}}
            @if(Auth::user()->id != $id)
            <div class="form-group">
                <label>User Level</label>
                <label class="radio-inline">
                    <input name="rdoLevel" value="1" checked="" type="radio"

                    @if($data['group_id']==1)
                        checked="checked"
                    @endif
                    >Admin
                </label>
                <label class="radio-inline">
                    <input name="rdoLevel" value="2" type="radio"

                   @if($data['group_id']!=1)
                    checked="checked"
                   @endif

                    >Member
                </label>
            </div>
            @endif
            <button type="submit" class="btn btn-default">User Edit</button>
            <button type="reset" class="btn btn-default">Reset</button>
         <form>
    </div>
@endsection()