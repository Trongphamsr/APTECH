@extends('admin.master')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">User
            <small>List</small>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr align="center">
            <th>ID</th>
            <th>Username</th>
            <th>Status</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        <?php $stt=0; ?>
        @foreach($user as $item)
         <?php $stt++ ?>
        <tr class="odd gradeX" align="center">
            <td>{!! $stt !!}</td>
            <td>{!! $item['name'] !!}</td>
            <td>
                @if($item['group_id']==1)
                    Subadmin
                @elseif($item['id']==10)
                    Admin
                @else
                    member
                @endif()

            </td>
            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return confirm('ban co muon xoa khong');" href="{!! URL::route('admin.user.getDelete', $item['id']) !!}"> Delete</a></td>
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.user.getEdit', $item['id']) !!}">Edit</a></td>
        </tr>
        @endforeach
         </tbody>
    </table>
@endsection()

