<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cate_request;
use App\Http\Requests\Product_request;
use App\Cate;
use App\Image;
use File;
use App\Product;
// khi su dung ajax k dk dung Illuminate
//use Illuminate\Http\Request;
use Request;
use Auth;
//use Illuminate\Support\Facades\Input;

class Product_controller extends Controller
{
    public function getlist()
    {
        $data = Product::select('id', 'name', 'price', 'cate_id', 'created_at')->orderBy('id', 'DESC')->get()->toArray();
        return view('admin.product.list', compact('data'));

    }
    public function getAdd()
    {

        $cate = Cate::select('id', 'name', 'parent_id')->get()->toArray();
        // là lơi hiển thị form
        return view('admin.product.add', compact('cate'));
    }
    /**
     * @param product_request $product_request
     */
    public function postAdd(Product_request $product_request)
    {
        // hàm lấy tấm hình ra
        $file_name = $product_request->file('fImages')->getClientOriginalName();
        //$file_name=$product_request->file('fImages')->getClientOriginalName();
        $product = new Product();
        $product->name = $product_request->txtName;
        $product->alias = $product_request->txtName;
        $product->price = $product_request->txtPrice;
        $product->intro = $product_request->txtIntro;
        $product->content = $product_request->txtContent;
        $product->image = $file_name;
        $product->keywords = $product_request->txtKeyword;
        $product->description = $product_request->txtDescription;
        $product->user_id = Auth::user()->id ; // 1 ;
        $product->cate_id = $product_request->sltParent;
        $product_request->file('fImages')->move('resources/upload/', $file_name);
        $product->save();
        // cần xó số sp id vừa thêm vào
        $product_id = $product->id;
        $if = $product_request->fProductdetail;
        if($if)
        {
            foreach ($if as $file)
            {
                $product_image = new Image();
                if(isset($file))
                {
                    $product_image->image=$file->getClientOriginalName();
                    $product_image->product_id=$product_id;
                    $file->move('resources/upload/detail/', $file->getClientOriginalName());
                    $product_image->save();
                }
            }
        }
        return redirect()->route('admin.product.getlist')->with(['flash_level' => 'success', 'flash_message' => 'success !!  ok']);
    }


    public function getDelete($id)
    {
        $product_detail = Product::find($id)->pimages->toArray();
        foreach ($product_detail as $value) {
            //.$value ten file
            File::delete('resources/upload/detail/' . $value["image"]);
        }
        $product= Product::find($id);
        File::delete('resources/upload/'. $product->image);
        $product->delete($id);
        return redirect()->route('admin.product.getlist')->with(['flash_level' => 'success', 'flash_message' => 'success !! delete  ok']);
    }


    public function getEdit($id)
    {
        $cate= cate::select('id', 'name', 'parent_id')->get()->toArray();
        $product= Product::find($id);
        $product_image=Product::find($id)->pimages;
        //$product_image= Image::find($id);
        //$product_image= Image::where($id, product_id)
        return view('admin.product.edit', compact('cate', 'product', 'product_image'));
    }


    public function getDelImg($id){
        // sd ajax xoa anh trong edit
        // neu la ajax lay id hinh ten hinh
        if(Request::ajax()){
            $idHinh=(int)Request::get('idHinh');
            $image_detail= Image::find($idHinh);

            if(!empty($image_detail)){
                $img='resources/upload/detail/'.$image_detail->image;
                // neu file ton tai, xoa anh di
                if(File::exists($img)){
                    File::delete($img);
                }
                // xoa luon trong database
                $image_detail->delete();
            }
            return "ok";
        }
    }

    public function postEdit($id, Request $request){
        $product= Product::find($id);
        $product->name = Request::input('txtName');
        $product->alias = Request::input('txtName');
        $product->price = Request::input('txtPrice');
        $product->intro = Request::input('txtIntro');
        $product->content = Request::input('txtContent');
        $product->keywords = Request::input('txtKeywords');
        $product->description= Request::input('txtDescription');
        $product->user_id =Auth::user()->id; // 1 ;
        $product->cate_id = Request::input('sltParent');
        // duong dan tam hinh
        $img_curent='resources/upload/'.Request::input('img_curent');
        //Request::input('txtName')
        if(!empty(Request::file('fImages'))){
            //ten file
            $file_name=Request::file('fImages')->getClientOriginalName();
            // update
            $product->image=$file_name;
            // kiem tra file va di chuyen vao trong
            Request::file('fImages')->move('resources/upload/', $file_name);
            if(File::exists($img_curent)){
                File::delete('$img_curent');
            }
        }
        else{
            echo"no file";
        }
        $product->save();


        /* if(!empty($product->fEditDetail)){
             //fProductDetail
             foreach ($product->fEditDetail as $file){
                 $product_img=new product_image();
                 if(isset($file)){
                     $finename=$file->getClientOriginalName();
                     $product_img->image=$file->$finename;
                     $product_img->product_id = $id;
                     $file->move('resources/upload/detail/', $finename );
                     $product_img->save();
                 }
             }

         }
        */
        if(!empty(Request::file('fEditDetail'))){
            foreach (Request::file('fEditDetail') as $file){
                $product_img= new product_image();
                if(isset($file)){
                    $product_img->image = $file->getClientOriginalName();
                    $product_img->product_id = $id;
                    $file->move('resources/upload/detail/',$file->getClientOriginalName());
                    $product_img->save();
                }
            }

        }
        return redirect()->route('admin.product.getlist')->with(['flash_level' => 'success', 'flash_message' => 'success !! add  ok']);
    }
}
