<?php

namespace App\Http\Controllers;

use App\Cate;
use App\Http\Requests\Cate_request;
use Illuminate\Http\Request;

class Cate_controller extends Controller
{
    public function getAdd()
    {
        $parent = Cate::select('id','name','parent_id')->get()->toArray();
        return view('admin.cate.add', compact('parent'));
    }

    public function postAdd(Cate_request  $request)
    {
        $cate= new Cate;
        $cate->name        = $request->txtCateName;
        $cate->alias       = $request->txtCateName;
        $cate->order       = $request->txtOrder;
        $cate->parent_id   = $request->sltParent;
        $cate->keywords    = $request->txtKeywords;
        $cate->description = $request->txtDescription;
        $cate->save();
        //
        return redirect()->route('admin.cate.getlist')->with(['flash_level'=>'success','flash_message'=>'success !! complate add category ']);

    }

    public function getlist()
    {
        $list = Cate::select('id','name','parent_id')->orderBy('id', 'DESC')->get()->toArray();
        return view('admin.cate.list', compact('list'));
    }

    public function getDelete($id){
        $parent= Cate::where('parent_id', $id)->count();
        if($parent==0)
        {
            $cate= Cate::find($id);
            $cate->delete($id);
            return redirect()->route('admin.cate.getlist')->with(['flash_level'=>'success','flash_message'=>'success !! delete ok']);
        }
        else{
            echo"<script type='text/javascript'>
                    alert('sorry ! you can not delete')
                    window.location='";
            echo route('admin.cate.getlist');
            echo"'
            </script>";
        }

    }

    public function getEdit($id){
        $data=Cate::findOrFail($id)->toArray();
        $parent=Cate::select('id', 'name', 'parent_id')->get()->toArray();
        return view('admin.cate.edit', compact('parent','data', 'id'));
    }

    public function postEdit(Request $request, $id){
        $this->validate($request,
            ['txtCateName'=>'required'],
            ['txtCateName.required'=>'pleas enter name category']
        );
        $cate= Cate::find($id);
        // cập nhập
        $cate->name        = $request->txtCateName;
        $cate->alias       = $request->txtCateName;
        $cate->order       = $request->txtOrder;
        $cate->parent_id   = $request->bltParent;
        $cate->keywords    = $request->txtKeywords;
        $cate->description = $request->txtDescription;
        $cate->save();
        return redirect()->route('admin.cate.getlist')->with(['flash_level'=>'success','flash_message'=>'success !! complate edits category ']);
    }
}
