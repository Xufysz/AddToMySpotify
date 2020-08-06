<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('spotify-callback', 'SpotifyController@callback')->name('spotify.callback');

Route::get('spotify-show', 'SpotifyController@getPlaylist')->name('spotify.show');
Route::post('spotify-add', 'SpotifyController@addSong')->name('spotify.add');
Route::get('spotify-search', 'SpotifyController@searchSongs')->name('spotify.search');
