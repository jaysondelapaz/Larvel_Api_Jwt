<?php

Route::group([

    // 'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    $this->group(['as'=>'product','prefix'=>'product'], function(){
	    $this->get('/',['as'=>'index','uses'=>'AuthController@index']);
	    $this->post('find/{id?}',['as'=>'find','uses'=>'AuthController@find']);	
	    $this->post('store',['as'=>'store','uses'=>'AuthController@store']);
	    $this->post('update',['as'=>'update','uses'=>'AuthController@update']);
	    $this->any('delete/{id?}',['as'=>'delete','uses'=>'AuthController@destroy']);
    });
    
});