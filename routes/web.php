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

Auth::routes();

Route::get('/', 'IndexController@index')->name("index");

Route::prefix('/room')->group(function (){
  Route::get('/', 'RoomController@index')->name("Room.index");
  Route::get('/create', 'RoomController@create')->name("Room.create");
  Route::get('/join', 'RoomController@join')->name("Room.join");
  Route::get('/{conn_string}', 'RoomController@show')->name("Room.show");
  Route::post('/setBattleplan', 'RoomController@setBattleplan')->name("Room.setBattleplan");
  Route::get('/{conn_string}/getBattleplan', 'RoomController@getBattleplan')->name("Room.getBattleplan");
});

Route::prefix('/battleplan')->group(function (){
  Route::post('create', 'BattleplanController@create')->name("Battleplan.create");
  Route::post('save', 'BattleplanController@update')->name("Battleplan.update");
  Route::post('delete', 'BattleplanController@delete')->name("Battleplan.delete");
});

Route::prefix('/operatorSlot')->group(function (){
  Route::post('update', 'OperatorSlotController@update')->name("OperatorSlot.update");
});

Route::prefix('/battlefloor')->group(function (){
  Route::post('/draw', 'BattlefloorController@draw')->name("Battlefloor.draw");
});
