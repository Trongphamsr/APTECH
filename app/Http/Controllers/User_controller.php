<?php

namespace App\Http\Controllers;

use App\Http\Requests\User_request;
use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;
class User_controller extends Controller
{
    public function getList(){

        $user= User::select('id', 'name', 'group_id')->orderBy('id','DESC')->get()->toArray();
        return view('admin.user.list', compact('user'));
    }
    public function getAdd(){
        return view('admin.user.add');
    }
    public function postAdd(User_request $request){
        $user= new User;
        $user->name= $request->txtUser;
        $user->password= Hash::make($request->txtPass);
        $user->email= $request->txtEmail;
        $user->group_id=$request->rdoLevel; // 2;
        $user->remember_token= $request->_token;
        $user->save();
        return redirect()->route('admin.user.getlist')->with(['flash_level'=>'seccess', 'flash_message'=>'success user list oks']);
    }


    public function getDelete($id)
    {
        // tao hien tai tro den id // $user_curent_login= Auth::user()->id;
        $user= User::find($id);
        // neu admin, hoac admin binh thuong
        //if(($id==2)||($user_curent_login !=2) && $user['level']==1)

        if($user['group_id']==1)
        {
            return redirect()->route('admin.user.getlist')->with(['flash_level' => 'danger', 'flash_message' => 'sorry you cannot delete admin ']);
        }
        else
        {
            $user->delete($id);
            return redirect()->route('admin.user.getlist')->with(['flash_level' => 'success', 'flash_message' => 'success  delete !!  ok']);

        }
    }

    public function getEdit($id)
    {
        $data = User::find($id);
    // id khac 9 la khac subadmin->admin thuong, k sua dk subadmin ==9, va admin do k phai la chinh minh
        if((Auth::user()->id!=9)&&($id ==9 || ($data['group_id']==1 && (Auth::user()->id!=$id))))
        {
            return redirect()->route('admin.user.getlist')->with(['flash_level' => 'danger', 'flash_message' => 'sorry you cannot edit ']);
        }
        else
        {
            return view('admin.user.edit', compact('data', 'id'));
        }

    }


    public function postEdit($id, Request $request)
    {
        $user= User::find($id);

        if($request->input('txtPass'))
        {
            $this->validate($request,
                [
                    'txtRePass'=>'same:txtRePass'
                ],
                [
                    'txtRePass.same'=>'two pass dont match'
                ]);
            // tao bien pass de ma hoa;

            $pass=$request->input('txtPass');
            $user->password=Hash::make($pass);
        }
        $user->name=$request->txtUser;
        $user->email=$request->txtEmail;
        $user->group_id=$request->rdoLevel; // 2;
        $user->remember_token=$request->input('_token');
        $user->save();
        return redirect()->route('admin.user.getlist')->with(['flash_level' => 'success', 'flash_message' => 'success update !!  ok']);
    }
}
