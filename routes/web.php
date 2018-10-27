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

# Map selector routes
Route::prefix('/room')->group(function (){
  Route::get('/', 'RoomController@index')->name("Room.index");
  Route::get('/new', 'RoomController@new')->name("Room.new");
  Route::get('/join', 'RoomController@join')->name("Room.join");
  Route::get('/{conn_string}', 'RoomController@show')->name("Room.show");
  Route::post('battleplan/set', 'RoomController@setBattleplan')->name("Room.setBattleplan");
  Route::post('battleplan/get', 'RoomController@getBattleplan')->name("Room.getBattleplan");
  Route::post('battleplan/save', 'RoomController@saveBattleplan')->name("Room.saveBattleplan");
  Route::post('battleplan/delete', 'RoomController@deleteBattleplan')->name("Room.deleteBattleplan");
});

Route::prefix('/battleplan')->group(function (){
  Route::post('/new', 'BattleplanController@new')->name("Battleplan.new");
  Route::post('/load', 'BattleplanController@load')->name("Battleplan.load");
});

Route::prefix('/battlefloor')->group(function (){
  Route::post('/update', 'BattlefloorController@update')->name("Battlefloor.update");
  Route::post('/getDraws', 'BattlefloorController@getDraws')->name("Battlefloor.getDraws");
});
