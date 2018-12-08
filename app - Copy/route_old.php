<?php
/** Gudang **/
Route::get('gudang_obat/datatable/{id}','GudangObatController@datatable');
Route::post('gudang_obat/editdatatable/{id}','GudangObatController@editdatatable');
Route::get('gudang_obat/detaildatatable/{id}','GudangObatController@detaildatatable');
Route::get('gudang_obat/detaildatatable_edit/{id}','GudangObatController@detaildatatable_edit');

//Route::get('gudang_obat/{id}','GudangObatController@index');
Route::get('gudang_obat/{id}', array('before'=>'group', 'uses'=>'GudangObatController@index'));
Route::resource('gudang_obat', 'GudangObatController');

Route::get('gudang_masuk/datatable/{id}','GudangMasukController@datatable');
Route::post('gudang_masuk/list_transaksi/{id}','GudangMasukController@list_transaksi');
Route::get('gudang_masuk/check_pasien/{id}','GudangMasukController@check_pasien');
Route::post('gudang_masuk/tambah_transaksi/{id}','GudangMasukController@tambah_transaksi');
Route::post('gudang_masuk/hapus_transaksi/{id}','GudangMasukController@hapus_transaksi');
//Route::get('gudang_masuk/{id}','GudangMasukController@index');
Route::get('gudang_masuk/{id}', array('before'=>'group', 'uses'=>'GudangMasukController@index'));
Route::resource('gudang_masuk', 'GudangMasukController');
Route::any('gudang_masuk/getdata/{id}','GudangMasukController@getdata');
Route::get('gudang_masuk/pdf/{noreg}', 'GudangMasukController@pdfCreate');
Route::get('gudang_masuk/excel/{mode}/{noreg}', 'GudangMasukController@excelCreate');
Route::post('gudang_masuk/check_transaksi/{id}','GudangMasukController@check_transaksi');
Route::post('gudang_masuk/edit_transaksi/{id}','GudangMasukController@edit_transaksi');

Route::get('gudang_keluar/datatable/{id}','GudangKeluarController@datatable');
Route::get('gudang_keluar/list_transaksi/{pref}/{id}','GudangKeluarController@list_transaksi');
Route::get('gudang_keluar/check_pasien/{id}','GudangKeluarController@check_pasien');
Route::post('gudang_keluar/tambah_transaksi/{id}','GudangKeluarController@tambah_transaksi');
Route::post('gudang_keluar/check_transaksi/{id}','GudangKeluarController@check_transaksi');
Route::post('gudang_keluar/hapus_transaksi/{id}','GudangKeluarController@hapus_transaksi');
//Route::get('gudang_keluar/{id}','GudangKeluarController@index');
Route::get('gudang_keluar/{id}', array('before'=>'group', 'uses'=>'GudangKeluarController@index'));
Route::resource('gudang_keluar', 'GudangKeluarController');
Route::any('gudang_keluar/getdata/{id}','GudangKeluarController@getdata');
Route::post('gudang_keluar/edit_transaksi/{id}','GudangKeluarController@edit_transaksi');