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

Route::get('test/auth/login', function(){
	return view('index');
});

Route::get('test/fuse', function(){
    return view('index');
});

Route::get('auth/{any}', function(){
    return view('index');
});

Route::get('test/users', function(){
    return view('index');
});


Route::get('json/user/get-all', function(){
    return [
       "checkbox" => 1,"name" => "Jeton", "email" =>"test@test.com" , "jobtitle" => "sofware developer","asd" => ""
    ];
});

Route::get('test/auth', function(){
    if(\Auth::check()){
        $token = session('accessToken');
        return response()->json(['status' => true, 'accessToken' => $token]);
    }else{
        return response()->json(['status' => false]);
    }

});
