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
Route::get('/test', function(){
    return view("test");
});

Route::prefix('/room')->group(function () {
    Route::get('/', 'RoomController@index')->name("Room.index");
    Route::get('/create', 'RoomController@create')->name("Room.create");
    Route::get('/{conn_string}', 'RoomController@show')->name("Room.show");
    Route::post('/setBattleplan', 'RoomController@setBattleplan')->name("Room.setBattleplan");
    Route::get('/{conn_string}/getBattleplan', 'RoomController@getBattleplan')->name("Room.getBattleplan");
});

Route::prefix('/battleplan')->group(function () {
    Route::post('create', 'BattleplanController@create')->name("Battleplan.create");
    Route::post('save', 'BattleplanController@update')->name("Battleplan.update");
    Route::post('delete', 'BattleplanController@delete')->name("Battleplan.delete");
    Route::get('/', 'BattleplanController@index')->name("Battleplan.index");
    Route::get('/{battleplan}', 'BattleplanController@show')->name("Battleplan.show");
    Route::post('vote', 'BattleplanController@vote')->name("Battleplan.vote");
    Route::post('copy', 'BattleplanController@copy')->name("Battleplan.copy");
    Route::get('{battleplan}/getBattleplan', 'BattleplanController@getBattleplan')->name("Battleplan.getBattleplan");
});

Route::prefix('/operatorSlot')->group(function () {
    Route::post('update', 'OperatorSlotController@update')->name("OperatorSlot.update");
});

Route::prefix('/battlefloor')->group(function () {
    Route::post('/draw', 'BattlefloorController@draw')->name("Battlefloor.line");
    Route::post('/deleteDraw', 'BattlefloorController@deleteDraw')->name("Battleplan.deleteDraw");
});