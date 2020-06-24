<?php

use Illuminate\Support\Str;

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
    return redirect()->route('home.dashboard');
});

Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login');

Route::middleware(['auth'])->group(function () {
    Route::post('logout', 'LoginController@logout')->name('logout');

    Route::middleware(['confirmed'])->group(function () {
        Route::get('home', 'HomeController@dashboard')->name('home.dashboard');

        Route::middleware(['permission'])->group(function () {
            Route::name('marker.')->prefix('marker')->group(function () {
                Route::get('{id}/audit', 'MarkerController@audit')->name('audit');
                Route::get('{id}/unaudit', 'MarkerController@unaudit')->name('unaudit');
                Route::get('design', 'MarkerController@design')->name('design');
                Route::get('teaching/confirm', 'MarkerController@confirm')->name('confirm');
                Route::get('teaching/{id?}', 'MarkerController@teaching')->name('teaching');
                Route::get('upload', 'MarkerController@showUploadForm')->name('upload');
                Route::post('import', 'MarkerController@import')->name('import');
                Route::get('pdf/{id}', 'MarkerController@pdf')->name('pdf');
                Route::get('recommendation/{id}', 'MarkerController@showRecommendationForm')->name('recommend');
                Route::post('recommendation/{id}', 'MarkerController@recommend')->name('uprecommend');
            });

            Route::name('player.')->prefix('player')->group(function () {
                Route::get('document/{id}', 'PlayerController@document')->name('document');
                Route::get('upload', 'PlayerController@showUploadForm')->name('upload');
                Route::post('import', 'PlayerController@import')->name('import');
                Route::get('seq', 'PlayerController@showSeqForm')->name('seq');
                Route::get('draw', 'PlayerController@draw')->name('draw');
                Route::get('pdf/{id}', 'PlayerController@pdf')->name('pdf');
                Route::get('recommendation/{id}', 'PlayerController@showRecommendationForm')->name('recommend');
                Route::post('recommendation/{id}', 'PlayerController@recommend')->name('uprecommend');
                Route::get('secno', 'PlayerController@showSecnoForm')->name('secno');
                Route::get('draw-secno', 'PlayerController@drawSecno')->name('draw-secno');
            });

            Route::name('document.')->prefix('document')->group(function () {
                Route::put('seq', 'DocumentController@seq')->name('seq');
                Route::put('secno', 'DocumentController@secno')->name('secno');
            });

            Route::name('review.')->prefix('review')->group(function () {
                Route::post('design', 'ReviewController@design')->name('design');
                Route::post('teaching/{id}', 'ReviewController@teaching')->name('teaching');
            });

            Route::name('user.')->prefix('user')->group(function () {
                Route::get('upload', 'UserController@showUploadForm')->name('upload');
                Route::post('import', 'UserController@import')->name('import');
                Route::post('upload-summary', 'UserController@uploadSummary')->name('upload-summary');
            });

            foreach (['user', 'role', 'permission', 'group', 'gender', 'department', 'subject', 'education', 'degree', 'document', 'review', 'setting', 'player', 'marker'] as $endpoint) {
                $controller = Str::ucfirst($endpoint) . 'Controller';

                Route::name($endpoint . '.')->prefix($endpoint)->group(function () use ($controller) {
                    Route::get('/', $controller . '@index')->name('index');
                    Route::get('registration', $controller . '@create')->name('create');
                    Route::post('/', $controller . '@store')->name('store');
                    Route::get('{id}', $controller . '@edit')->name('edit');
                    Route::put('{id}', $controller . '@update')->name('update');
                    Route::delete('/', $controller . '@delete')->name('delete');
                });
            }

            Route::get('log', 'LogController@index')->name('log.index');

            Route::name('password.')->prefix('password')->group(function () {
                Route::get('change', 'PasswordController@edit')->name('edit');
                Route::put('change', 'PasswordController@change')->name('change');
                Route::get('reset/{id}', 'PasswordController@reset')->name('reset');
            });

            Route::name('role.')->prefix('role')->group(function () {
                Route::get('{id}/permission', 'RoleController@permission')->name('permission');
                Route::post('{id}/assign', 'RoleController@assign')->name('assign');
            });

            Route::name('summary.')->prefix('summary')->group(function () {
                Route::get('player', 'SummaryController@player')->name('player');
                Route::get('marker', 'SummaryController@marker')->name('marker');
                Route::get('rank', 'SummaryController@rank')->name('rank');
                Route::get('detail/{id}', 'SummaryController@detail')->name('detail');
                Route::get('export/{id}', 'SummaryController@export')->name('export');
            });
        });
    });

    Route::get('user/{id}/confirm', 'UserController@showConfirmForm')->name('user.confirm');
    Route::put('user/{id}/confirm', 'UserController@confirm');
    Route::get('player/{id}/confirm', 'PlayerController@showConfirmForm')->name('player.confirm');
    Route::put('player/{id}/confirm', 'PlayerController@confirm');
    Route::get('marker/{id}/confirm', 'MarkerController@showConfirmForm')->name('marker.confirm');
    Route::put('marker/{id}/confirm', 'MarkerController@confirm');
});
