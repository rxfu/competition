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
    Route::get('home', 'HomeController@dashboard')->name('home.dashboard');

    Route::middleware(['permission'])->group(function () {
        Route::name('marker.')->prefix('marker')->group(function () {
            Route::get('{id}/audit', 'MarkerController@audit')->name('audit');
            Route::get('design', 'MarkerController@listDesign')->name('list-design');
            Route::get('teaching', 'MarkerController@listTeaching')->name('list-teaching');
            Route::get('{id}/design', 'MarkerController@design')->name('design');
            Route::get('{id}/teaching', 'MarkerController@teaching')->name('teaching');
            Route::post('{id}/{type}/mark', 'MarkerController@mark')->name('mark');
        });

        Route::name('document.')->prefix('document')->group(function () {
            Route::get('registration/{id?}', 'DocumentController@upload')->name('upload');
        });

        foreach (['user', 'role', 'permission', 'group', 'gender', 'department', 'subject', 'education', 'degree', 'document', 'review', 'setting', 'player', 'marker'] as $endpoint) {
            $controller = Str::ucfirst($endpoint) . 'Controller';

            Route::name($endpoint . '.')->prefix($endpoint)->group(function () use ($endpoint, $controller) {
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
        });
    });
});
