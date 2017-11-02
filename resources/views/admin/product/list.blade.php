@extends('admin.master')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Product
            <small>List</small>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr align="center">
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Date</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        <?php $stt=0; ?>
        @foreach($data as $list)
        <?php $stt++ ?>
        <tr class="odd gradeX" align="center">
            <td>{!! $stt !!}</td>
            <td>{!! $list['name'] !!}</td>
            <td>{!! number_format($list['price'], 0, ",",".") !!} VNĐ</td>
            <td>
                {!!
                    \carbon\carbon::createFromTimestamp(strtotime($list["created_at"]))->diffForHumans()

                !!}
            </td>
            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return confirm('ban co muon xoa');" href=" {!! URL::route('admin.product.getDelete', $list['id']) !!} "> Delete</a></td>
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href=" {!! URL::route('admin.product.getEdit', $list['id']) !!} ">Edit</a></td>
        </tr>
        @endforeach()
        </tbody>
    </table>
@endsection()
