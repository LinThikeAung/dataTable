<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

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

Route::get('/',[UserController::class,'index']);
Route::get('/user/{user}/delete',[UserController::class,'delete']);

Route::get('/user/datatables/ssr',function(){ // url go to  frontend Datatable jquery
    $users = User::query();// ::all() htet performent kaung dl
    return DataTables::of($users)
    ->editColumn('name',function($user){
        return "<span class='badge badge-primary'>".$user->name."</span>";
    })
    ->editColumn('email',function($user){
        return "<span class='badge badge-success'>".$user->email."</span>";
    })
    //fake column action insertion to fronent datatable ajax
    ->addColumn('action',function($user){//foreach lo bal single user pyit foreach($users as $user)
        //action coluimn mar paw chin de kaung
        // return $user->id;</or> $user->name.$user->email 
        return "<a class='btn btn-danger btn-sm delete' data-id =".$user->id.">Delete</a>";
    })
    ->addColumn('city',function($user){
        return $user->city->city;
    })
    ->addColumn('country',function($user){
        return $user->city->country;
    })
    ->rawColumns(['name','email','action'])//html code defined
    ->make(true);
});

