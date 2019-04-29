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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['as'=>'Backend.','prefix'=>''], function(){
	$this->get('/',['as'=>'index','uses'=>"ItemController@index"]);
	$this->post('store',['as'=>'store','uses'=>'ItemController@store']);
	$this->get('edit/{id?}',['as'=>'edit','uses'=>"ItemController@edit"]);
	$this->post('update/{id?}',['as'=>'update', 'uses'=>'ItemController@update']);
	$this->get('deleteconfirm/{id?}',['as'=>'deleteconfirm','uses'=>'ItemController@confirmdelete']);
	$this->any('destroy/{id?}',['as'=>'delete','uses'=>'ItemController@destroy']);
	
}); 