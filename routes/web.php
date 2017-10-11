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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'DashboardController@index');

    //ini adalah route buat user
    Route::get('/user', ['uses' => 'UserController@index', 'middleware' => ['permission:user-view']]);
    Route::get('/user/tambah', ['uses' => 'UserController@create', 'middleware' => ['permission:user-create']]);
    Route::get('/user/query', ['uses' => 'UserController@search', 'middleware' => ['permission:user-view']]);
    Route::post('/user/store', ['uses' => 'UserController@store', 'middleware' => ['permission:user-create']]);
    Route::get('/user/edit/{id}', ['uses' => 'UserController@edit', 'middleware' => ['permission:user-edit']]);
    Route::post('/user/update/{id}', ['uses' => 'UserController@update', 'middleware' => ['permission:user-edit']]);
    Route::get('/user/hapus/{id}', ['uses' => 'UserController@destroy', 'middleware' => ['permission:user-delete']]);
    Route::get('/user/makeuserrole/{user}/{role}', ['uses' => 'UserController@makeUserRole', 'middleware' => ['permission:user-edit']]);
    Route::get('/user/deleuserrole/{user}/{role}', ['uses' => 'UserController@deleUserRole', 'middleware' => ['permission:user-edit']]);

    //ini adalah route buat permission
    Route::get('/permission', ['uses' => 'PermissionController@index', 'middleware' => ['permission:permission-view']]);
    Route::get('/permission/tambah', ['uses' => 'PermissionController@create', 'middleware' => ['permission:permission-create']]);
    Route::get('/permission/query', ['uses' => 'PermissionController@search', 'middleware' => ['permission:permission-view']]);
    Route::post('/permission/store', ['uses' => 'PermissionController@store', 'middleware' => ['permission:permission-create']]);
    Route::get('/permission/edit/{id}', ['uses' => 'PermissionController@edit', 'middleware' => ['permission:permission-edit']]);
    Route::post('/permission/update/{id}', ['uses' => 'PermissionController@update', 'middleware' => ['permission:permission-edit']]);
    Route::get('/permission/hapus/{id}', ['uses' => 'PermissionController@destroy', 'middleware' => ['permission:permission-delete']]);
    Route::get('/permission/makepermirole/{perm}/{role}', ['uses' => 'PermissionController@makePermiRole', 'middleware' => ['permission:permission-edit']]);
    Route::get('/permission/delepermirole/{perm}/{role}', ['uses' => 'PermissionController@delePermiRole', 'middleware' => ['permission:permission-edit']]);

    //ini adalah route buat role
    Route::get('/role', ['uses' => 'RoleController@index', 'middleware' => ['permission:role-view']]);
    Route::get('/role/tambah', ['uses' => 'RoleController@create', 'middleware' => ['permission:role-create']]);
    Route::post('/role/store', ['uses' => 'RoleController@store', 'middleware' => ['permission:role-create']]);
    Route::get('/role/edit/{id}', ['uses' => 'RoleController@edit', 'middleware' => ['permission:role-edit']]);
    Route::post('/role/update/{id}', ['uses' => 'RoleController@update', 'middleware' => ['permission:role-edit']]);
    Route::get('/role/hapus/{id}', ['uses' => 'RoleController@destroy', 'middleware' => ['permission:role-delete']]);

    //ini adalah route buat jasa
    Route::get('/jasa', ['uses' => 'JasaController@index', 'middleware' => ['permission:jasa-view']]);
    Route::get('/jasa/query', ['uses' => 'JasaController@search', 'middleware' => ['permission:jasa-view']]);
    Route::get('/jasa/add', ['uses' => 'JasaController@create', 'middleware' => ['permission:jasa-create']]);
    Route::post('/jasa/store', ['uses' => 'JasaController@store', 'middleware' => ['permission:jasa-create']]);
    Route::get('/jasa/edit/{id}', ['uses' => 'JasaController@edit', 'middleware' => ['permission:jasa-edit']]);
    Route::post('/jasa/update/{id}', ['uses' => 'JasaController@update', 'middleware' => ['permission:jasa-edit']]);
    Route::get('/jasa/delete/{id}', ['uses' => 'JasaController@destroy', 'middleware' => ['permission:jasa-delete']]);

    //ini adalah route buat pemasukan
    Route::get('/pemasukan', ['uses' => 'PemasukanController@index', 'middleware' => ['permission:pemasukan-view']]);
    Route::get('/pemasukan/query', ['uses' => 'PemasukanController@search', 'middleware' => ['permission:pemasukan-view']]);
    Route::get('/pemasukan/report', ['uses' => 'PemasukanController@report', 'middleware' => ['permission:pemasukan-view']]);
    Route::get('/pemasukan/pdf', ['uses' => 'PemasukanController@pdf', 'middleware' => ['permission:pemasukan-view']]);
    Route::get('/pemasukan/add', ['uses' => 'PemasukanController@create', 'middleware' => ['permission:pemasukan-create']]);
    Route::post('/pemasukan/store', ['uses' => 'PemasukanController@store', 'middleware' => ['permission:pemasukan-create']]);
    Route::get('/pemasukan/edit/{id}', ['uses' => 'PemasukanController@edit', 'middleware' => ['permission:pemasukan-edit']]);
    Route::post('/pemasukan/update/{id}', ['uses' => 'PemasukanController@update', 'middleware' => ['permission:pemasukan-edit']]);
    Route::get('/pemasukan/delete/{id}', ['uses' => 'PemasukanController@destroy', 'middleware' => ['permission:pemasukan-delete']]);

    //ini adalah route buat pengeluaran
    Route::get('/pengeluaran', ['uses' => 'PengeluaranController@index', 'middleware' => ['permission:pengeluaran-view']]);
    Route::get('/pengeluaran/query', ['uses' => 'PengeluaranController@search', 'middleware' => ['permission:pengeluaran-view']]);
    Route::get('/pengeluaran/report', ['uses' => 'PengeluaranController@report', 'middleware' => ['permission:pengeluaran-view']]);
    Route::get('/pengeluaran/pdf', ['uses' => 'PengeluaranController@pdf', 'middleware' => ['permission:pengeluaran-view']]);
    Route::get('/pengeluaran/add', ['uses' => 'PengeluaranController@create', 'middleware' => ['permission:pengeluaran-create']]);
    Route::post('/pengeluaran/store', ['uses' => 'PengeluaranController@store', 'middleware' => ['permission:pengeluaran-create']]);
    Route::get('/pengeluaran/edit/{id}', ['uses' => 'PengeluaranController@edit', 'middleware' => ['permission:pengeluaran-edit']]);
    Route::post('/pengeluaran/update/{id}', ['uses' => 'PengeluaranController@update', 'middleware' => ['permission:pengeluaran-edit']]);
    Route::get('/pengeluaran/delete/{id}', ['uses' => 'PengeluaranController@destroy', 'middleware' => ['permission:pengeluaran-delete']]);
});