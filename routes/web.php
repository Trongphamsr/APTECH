<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');//->name('home');

// test thu
//Route::get('test', function(){
//   echo "hoc lap trinh php";
//});

Route::group(['middleware'=>'auth'], function (){
    // tat ca dg link nao nam trong nay deu dang nhap voi tk user group_id=2;
    Route::get('/blog', 'BlogController@index');
    Route::Group(['middleware'=>'admin'], function (){
        // tat ca dg link nao muon vao admin dang nhap voi tai khoan admingroup_id=1;


        Route::get('/CheckAdmin', 'AdminController@index');
    });
});

Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function(){
   Route::group(['prefix'=>'cate'], function(){
       Route::get('add', ['as'=>'admin.cate.getAdd', 'uses'=>'Cate_controller@getAdd']);
       Route::post('add', ['as'=>'admin.cate.postAdd', 'uses'=>'Cate_controller@postAdd']);
       Route::get('list', ['as'=>'admin.cate.getlist', 'uses'=>'Cate_controller@getlist']);
       Route::get('delete/{id}', ['as'=>'admin.cate.getDelete', 'uses'=>'Cate_controller@getDelete']);
       Route::get('edit/{id}', ['as'=>'admin.cate.getEdit', 'uses'=>'Cate_controller@getEdit']);
       Route::post('edit/{id}', ['as'=>'admin.cate.postEdit', 'uses'=>'Cate_controller@postEdit']);
   });


    Route::group(['prefix'=>'product'], function(){
        Route::get('add', ['as'=>'admin.product.getAdd', 'uses'=>'Product_controller@getAdd']);
        Route::post('add', ['as'=>'admin.product.postAdd', 'uses'=>'Product_controller@postAdd']);
        Route::get('list', ['as'=>'admin.product.getlist', 'uses'=>'Product_controller@getlist']);
        Route::get('delete/{id}', ['as'=>'admin.product.getDelete', 'uses'=>'Product_controller@getDelete']);
        Route::get('edit/{id}', ['as'=>'admin.product.getEdit', 'uses'=>'Product_controller@getEdit']);
        Route::post('edit/{id}', ['as'=>'admin.product.postEdit', 'uses'=>'Product_controller@postEdit']);
        // xoa anh chi tiet trong edit
        Route::get('delimg/{id}',['as'=>'admin.product.getDelImg','uses'=>'Product_controller@getDelImg']);
    });


    Route::group(['prefix'=>'user'], function(){
        Route::get('add', ['as'=>'admin.user.getAdd', 'uses'=>'User_controller@getAdd']);
        Route::post('add', ['as'=>'admin.user.postAdd', 'uses'=>'User_controller@postAdd']);
        Route::get('list', ['as'=>'admin.user.getlist', 'uses'=>'User_controller@getlist']);
        Route::get('delete/{id}', ['as'=>'admin.user.getDelete', 'uses'=>'User_controller@getDelete']);
        Route::get('edit/{id}', ['as'=>'admin.user.getEdit', 'uses'=>'User_controller@getEdit']);
        Route::post('edit/{id}', ['as'=>'admin.user.postEdit', 'uses'=>'User_controller@postEdit']);
    });
});
// sinh ra dg link login logout;
// php artisan route:list;


Route::get('create', function (){
   Schema::create('vd', function ($table){
        $table->string('name');
   });
});

Route::get('schema/drop_col', function(){
    Schema::table('users', function ($table){
        $table->dropColumn('Group_id');
    });
});

Route::get('themcot', function (){
    Schema::table('users', function ($table){
        $table->integer('group_id')->default(2);
    }) ;
    echo"da them cot email";
});