<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showLogin');
Route::get('login', 'HomeController@showLogin');
Route::get('logout', 'HomeController@doLogout');
Route::post('login', 'HomeController@doLogin');

Route::get('dashboard','DashboardController@index');
Route::get('dashboard_pasien','DashboardController@pasien');
Route::get('dashboard_cari','DashboardController@cari');
Route::get('pengaturan','DashboardController@pengaturan');
Route::post('pengaturan','DashboardController@savePengaturan');
Route::get('license','DashboardController@license');
Route::post('license','DashboardController@saveLicense');
Route::get('pengaturan/bridging','DashboardController@bridging');
Route::post('pengaturan/bridging','DashboardController@saveBridging');

Route::get('calendar/seelist', 'CalendarController@seelist');
Route::post('calendar/seelist', 'CalendarController@seelist');
Route::resource('calendar', 'CalendarController');
Route::resource('gallery', 'GalleryController');
Route::resource('notes','NoteController');

Route::get('profile', 'UserController@profile');
Route::get('user/datatable','UserController@datatable');
Route::resource('user', 'UserController');

Route::resource('registrasi', 'RegistrasiController');

Route::get('dokter/datatable','DokterController@datatable');
Route::get('dokter/simpletable','DokterController@simpletable');
Route::get('dokter/simpletabletindakan','DokterController@simpletabletindakan');
Route::resource('dokter', 'DokterController');

Route::get('tarif_dokter/bulk','TarifDokterController@bulk');
Route::post('tarif_dokter/bulk','TarifDokterController@bulkPost');
Route::resource('tarif_dokter', 'TarifDokterController');

Route::get('paramedis/datatable','ParamedisController@datatable');
Route::get('paramedis/simpletable','ParamedisController@simpletable');
Route::get('paramedis/simpletabletindakan','ParamedisController@simpletabletindakan');
Route::resource('paramedis', 'ParamedisController');

Route::get('obat/datatable','ObatController@datatable');
Route::resource('obat', 'ObatController');

Route::get('satuan/datatable','SatuanController@datatable');
Route::resource('satuan', 'SatuanController');

Route::get('tarif_limit/datatable','TarifLimitController@datatable');
Route::resource('tarif_limit', 'TarifLimitController');

Route::get('ruangan/datatable','RuanganController@datatable');
Route::get('ruangan/simpletable/{id}','RuanganController@simpletable');
Route::get('ruangan/simpletable','RuanganController@simpletable');
Route::get('ruangan/combobox','RuanganController@combobox');
Route::resource('ruangan', 'RuanganController');

Route::get('tindakan/datatable','TindakanController@datatable');
Route::get('tindakan/simpletable','TindakanController@simpletable');
Route::get('tindakan/rajaltable','TindakanController@rajalTable');
Route::get('tindakan/penunjangtable/{id}','TindakanController@penunjangtable');
Route::get('tindakan/penunjangbpjs/{id}','TindakanController@penunjangbpjs');
Route::get('tindakan/bulk','TindakanController@inputBulk');
Route::resource('tindakan', 'TindakanController');

Route::get('diagnosa/datatable','DiagnosaController@datatable');
Route::get('diagnosa/simpletable','DiagnosaController@simpletable');
Route::get('diagnosa/list_diagnosa/{id}','DiagnosaController@listDiagnosa');
Route::post('diagnosa/hapus_diagnosa', 'DiagnosaController@hapusDiagnosa');
Route::post('diagnosa/tambah_diagnosa','DiagnosaController@tambahDDiagnosa');
Route::resource('diagnosa', 'DiagnosaController');

//Pasien Controller
Route::get('pasien/datatable','PasienController@datatable');
Route::get('pasien/datatable_id','PasienController@datatableId');
Route::post('pasien/tambah_tindakan', 'PasienController@tambah_tindakan');
Route::post('pasien/hapus_tindakan', 'PasienController@hapus_tindakan');
Route::post('pasien/soft_delete', 'PasienController@soft_delete');
Route::post('pasien/update_data', 'PasienController@update_data');
Route::post('pasien/tambah_baru', 'PasienController@tambah_baru');
Route::get('pasien/list_tindakan/{id}', 'PasienController@list_tindakan');
Route::get('pasien/history/{type}/{id}', 'PasienController@history');
Route::post('pasien/hapus_riwayat', 'PasienController@hapus_riwayat');
Route::get('pasien/datatable','PasienController@datatable');
Route::get('pasien/generate','PasienController@generate');
Route::get('pasien/cetak_kartu','PasienController@cetakKartu');
Route::get('pasien/cetak/{id}' ,'PasienController@cetak');
Route::get('pasien/barcode/{id}','PasienController@barcode');
Route::get('pasien/kartu/{id}','PasienController@kartu');
Route::get('pasien/edit_rm','PasienController@editRm');
Route::post('pasien/edit_rm','PasienController@updateRm');
Route::get('pasien/label/{id}','PasienController@label');
Route::get('pasien/label_map/{id}','PasienController@labelMap');
Route::resource('pasien', 'PasienController');

Route::get('rawat_jalan/datatable','RawatJalanController@datatable');
Route::get('rawat_jalan/datatable_antrian','RawatJalanController@datatableAntrian');
Route::get('rawat_jalan/datatable_keluar','RawatJalanController@datatable_keluar');
Route::get('rawat_jalan/popup_table','RawatJalanController@popup_table');
Route::get('rawat_jalan/popup_table_byreg','RawatJalanController@popup_table_byreg');
Route::get('rawat_jalan/popup_table_full','RawatJalanController@popup_table_full');
Route::get('rawat_jalan/popup_table_bynorm/{id}','RawatJalanController@popup_table_bynorm');
Route::get('rawat_jalan/register', 'RawatJalanController@register');
Route::get('rawat_jalan/pasien', 'RawatJalanController@pasien');
Route::get('rawat_jalan/pasien/{id}', 'RawatJalanController@pasienProses');
Route::post('rawat_jalan/selesai_periksa', 'RawatJalanController@selesaiPeriksa');
Route::post('rawat_jalan/tambah_dokter', 'RawatJalanController@tambah_dokter');
Route::post('rawat_jalan/hapus_dokter', 'RawatJalanController@hapus_dokter');
Route::get('rawat_jalan/list_tindakan/{id}', 'RawatJalanController@list_tindakan');
Route::post('rawat_jalan/tambah_tindakan', 'RawatJalanController@tambah_tindakan');
Route::post('rawat_jalan/hapus_tindakan', 'RawatJalanController@hapus_tindakan');
Route::get('rawat_jalan/list_diagnosa/{id}', 'RawatJalanController@list_diagnosa');
Route::get('rawat_jalan/list_poli/{id}', 'RawatJalanController@list_poli');
Route::post('rawat_jalan/tambah_diagnosa', 'RawatJalanController@tambah_diagnosa');
Route::post('rawat_jalan/hapus_diagnosa', 'RawatJalanController@hapus_diagnosa');
Route::post('rawat_jalan/hapus_pasien', 'RawatJalanController@hapus_pasien');
Route::post('rawat_jalan/tambah_poli', 'RawatJalanController@tambah_poli');
Route::post('rawat_jalan/hapus_poli', 'RawatJalanController@hapus_poli');
Route::post('rawat_jalan/update_total', 'RawatJalanController@update_total');
Route::post('rawat_jalan/get_single_poli','RawatJalanController@get_single_poli');
Route::get('rawat_jalan/antrian','RawatJalanController@antrian');
Route::get('rawat_jalan/list_lab/{id}', 'RawatJalanController@list_lab');
Route::get('rawat_jalan/list_rad/{id}', 'RawatJalanController@list_rad');
Route::post('rawat_jalan/hapus_lab', 'RawatJalanController@hapus_lab');
Route::post('rawat_jalan/hapus_rad', 'RawatJalanController@hapus_rad');
Route::get('rawat_jalan/struk/{id}', 'RawatJalanController@cetakStruk');
Route::post('rawat_jalan/rujuk_ruangan', 'RawatJalanController@rujuk_ruangan');
Route::get('rawat_jalan/list_rawatinap/{id}', 'RawatJalanController@list_rawatinap');
Route::get('rawat_jalan/list_pasien', 'RawatJalanController@list_pasien');
Route::resource('rawat_jalan', 'RawatJalanController');

// Rawat Inap Place
Route::get('rawat_inap/datatable/{id}','RawatInapController@datatable');
Route::get('rawat_inap/datatablebelum/{id}','RawatInapController@datatablebelum');
Route::get('rawat_inap/datatablebelum2/{id}','RawatInapController@datatablebelum2');
Route::get('rawat_inap/datatablebelumpulang/{id}','RawatInapController@datatablebelumpulang');
Route::get('rawat_inap/update_tanggal_keluar' , 'RawatInapController@updateTanggalKeluar');

Route::get('rawat_inap/datatable','RawatInapController@datatable');
Route::get('rawat_inap/datatable_keluar','RawatInapController@datatable_keluar');
Route::get('rawat_inap/datatable_ruangan','RawatInapController@datatable_ruangan');
Route::get('rawat_inap/popup_table','RawatInapController@popup_table');
Route::get('rawat_inap/popup_table_byreg','RawatInapController@popup_table_byreg');
Route::get('rawat_inap/popup_table_full','RawatInapController@popup_table_full');
Route::get('rawat_inap/register', 'RawatInapController@register');
Route::get('rawat_inap/pasien', 'RawatInapController@pasien');
Route::get('rawat_inap/pasien/{id}', 'RawatInapController@pasien');
Route::get('rawat_inap/makan','RanapGiziController@index');
Route::post('rawat_inap/hapus_dokter', 'RawatInapController@hapus_dokter');
Route::post('rawat_inap/tambah_dokter', 'RawatInapController@tambah_dokter');
Route::get('rawat_inap/list_tindakan/{id}', 'RawatInapController@list_tindakan');
Route::post('rawat_inap/tambah_tindakan', 'RawatInapController@tambah_tindakan');
Route::post('rawat_inap/hapus_tindakan', 'RawatInapController@hapus_tindakan');
Route::get('rawat_inap/list_diagnosa/{id}', 'RawatInapController@list_diagnosa');
Route::post('rawat_inap/tambah_diagnosa', 'RawatInapController@tambah_diagnosa');
Route::post('rawat_inap/hapus_diagnosa', 'RawatInapController@hapus_diagnosa');
Route::post('rawat_inap/pasien_pulang', 'RawatInapController@pasien_pulang');
Route::post('rawat_inap/tambah_koreksi_ruangan', 'RawatInapController@tambah_koreksi_ruangan');
Route::post('rawat_inap/tambah_pindah_ruangan', 'RawatInapController@tambah_pindah_ruangan');
Route::get('rawat_inap/list_ruangan/{id}', 'RawatInapController@list_ruangan');
Route::get('rawat_inap/list_dokter_visite/{id}', 'RawatInapController@listDokterVisite');
Route::get('rawat_inap/list_visite/{id}', 'RawatInapController@listVisite');
Route::get('rawat_inap/struk/{id}', 'RawatInapController@cetakStruk');
Route::post('rawat_inap/tambah_visite', 'RawatInapController@tambahVisite');
Route::post('rawat_inap/hapus_visite', 'RawatInapController@hapusVisite');
Route::get('rawat_inap/list_gizi/{id}', 'RanapGiziController@listGizi');
Route::post('rawat_inap/order_gizi', 'RanapGiziController@orderGizi');
Route::post('rawat_inap/hapus_gizi', 'RanapGiziController@hapusGizi');

Route::resource('rawat_inap', 'RawatInapController');

// Bayi
Route::get('bayi/register', 'BayiController@register');
Route::get('bayi/pasien', 'BayiController@pasien');
Route::get('bayi/pasien/{id}', 'BayiController@pasien');
Route::get('bayi/list_pasien', 'BayiController@list_pasien');
Route::resource('bayi', 'BayiController');

//Pasien Route
Route::get('rest/pasien/{id}', 'RestController@pasien');
Route::get('rest/pasien_id/{id}', 'RestController@pasienById');
Route::get('rest/pasien_kartu/{id}', 'RestController@pasienByKartu');
Route::get('rest/pasien_nik/{id}', 'RestController@pasienByNik');
Route::get('rest/rawat_inap/{id}', 'RestController@rawat_inap');
Route::get('rest/rawat_inap_byid/{id}', 'RestController@rawat_inap_byid');
Route::get('rest/rawat_inap_byreg/{id}', 'RestController@rawat_inap_byreg');
Route::get('rest/rawat_inap_belum/{id}', 'RestController@rawat_inap_belum');
Route::get('rest/rawat_inap_norm/{id}', 'RestController@rawat_inap_norm');
Route::get('rest/rawat_jalan/{id}', 'RestController@rawat_jalan');
Route::get('rest/rawat_jalan_byreg/{id}', 'RestController@rawat_jalan_byreg');
Route::get('rest/ugd/{id}', 'RestController@ugd');
Route::get('rest/ugd_byreg/{id}', 'RestController@ugd_byreg');
Route::get('rest/dokter_rawat_inap/{id}', 'RestController@dokter_rawat_inap');
Route::get('rest/dokter_rawat_jalan/{id}', 'RestController@dokter_rawat_jalan');
Route::get('rest/kelurahan', 'RestController@kelurahan');

/* Laboratorium */
Route::get('lab_kategori/datatable', 'LabKategoriController@datatable');
Route::resource('lab_kategori', 'LabKategoriController');

Route::get('lab_pemeriksaan/datatable', 'LabPemeriksaanController@datatable');
Route::resource('lab_pemeriksaan', 'LabPemeriksaanController');

Route::get('lab_antrian/datatable', 'LabAntrianController@datatable');
Route::resource('lab_antrian', 'LabAntrianController');

Route::get('lab_aps/datatable', 'LabApsController@datatable');
Route::resource('lab_aps', 'LabApsController');

Route::get('lab_selesai/datatable', 'LabSelesaiController@datatable');
Route::resource('lab_selesai', 'LabSelesaiController');

Route::post('lab/permintaan', 'LabController@kirimPermintaan');
Route::get('lab/hasil', 'LabController@hasil');
Route::post('lab/hasil', 'LabController@simpanHasil');
Route::post('lab/ambildata', 'LabController@ambilData');
Route::post('lab/ambildetail', 'LabController@ambilDetail');
Route::post('lab/tambah_pemeriksaan', 'LabController@tambahPemeriksaan');
Route::post('lab/hapus_periksa', 'LabController@hapusPeriksa');
Route::get('lab/kategori/{id}', 'LabController@kategori');
Route::get('lab/periksa/{id}', 'LabController@periksa');
Route::get('lab/cetak/{id}', 'LabController@cetakHasil');
Route::get('lab/list_periksa/{id}', 'LabController@listPeriksa');
Route::get('lab/data_periksa/{id}', 'LabController@dataPeriksa');
Route::resource('lab', 'LabController');

Route::get('lab_pa/hasil', 'LabPaController@hasil');
Route::post('lab_pa/ambildata', 'LabPaController@ambilData');
Route::post('lab_pa/hasil', 'LabPaController@simpanHasil');
Route::resource('lab_pa', 'LabPaController');

Route::get('radiologi_pemeriksaan/datatable', 'RadiologiPemeriksaanController@datatable');
Route::resource('radiologi_pemeriksaan', 'RadiologiPemeriksaanController');

Route::get('radiologi_antrian/datatable', 'RadiologiAntrianController@datatable');
Route::resource('radiologi_antrian', 'RadiologiAntrianController');

Route::get('radiologi_proses/datatable', 'RadiologiProsesController@datatable');
Route::resource('radiologi_proses', 'RadiologiProsesController');

Route::get('radiologi_hasil/datatable', 'RadiologiHasilController@datatable');
Route::resource('radiologi_hasil', 'RadiologiHasilController');

Route::post('radiologi/permintaan', 'RadiologiController@kirimPermintaan');
Route::get('radiologi/hasil', 'RadiologiController@hasil');
Route::post('radiologi/hasil', 'RadiologiController@simpanHasil');
Route::post('radiologi/ambildata', 'RadiologiController@ambilData');
Route::post('radiologi/ambildetail', 'RadiologiController@ambilDetail');
Route::get('radiologi/kategori/{id}', 'RadiologiController@kategori');
Route::get('radiologi/periksa/{id}', 'RadiologiController@periksa');
Route::get('radiologi/list_periksa/{id}', 'RadiologiController@listPeriksa');
Route::get('radiologi/cetak/{id}', 'RadiologiController@cetakHasil');
Route::get('radiologi/data_periksa/{id}', 'RadiologiController@dataPeriksa');
Route::resource('radiologi', 'RadiologiController');


Route::get('penunjang/laboratorium', 'PenunjangController@laboratorium');
Route::get('penunjang/radiologi', 'PenunjangController@radiologi');
Route::get('penunjang/pa', 'PenunjangController@pa');
Route::get('penunjang/gizi', 'PenunjangController@gizi');
Route::get('penunjang/fisioterapi', 'PenunjangController@fisioterapi');
Route::get('penunjang/utd', 'PenunjangController@utd');
Route::get('penunjang/list_tindakan/{slug}/{id}', 'PenunjangController@list_tindakan');
Route::get('penunjang/list_tindakan_inap/{slug}/{id}', 'PenunjangController@list_tindakan_inap');
Route::get('penunjang/list_tindakan_aps/{slug}/{id}', 'PenunjangController@list_tindakan_aps');
Route::get('penunjang/fisioterapi_dokter', 'PenunjangController@fisioterapi_dokter');
Route::post('penunjang/tambah_tindakan', 'PenunjangController@tambah_tindakan');
Route::post('penunjang/hapus_tindakan_aps', 'PenunjangController@hapus_tindakan_aps');

Route::get('unit/hemodialisa', 'UnitController@hemodialisa');
Route::get('unit/icu', 'UnitController@icu');
Route::get('unit/ok', 'UnitController@ok');

Route::get('billing/rawat_inap', 'BillingController@rawat_inap');
Route::post('billing/rawat_inap_view', 'BillingController@rawat_inap_view');
Route::get('billing/rawat_inap_print/{id}/{mode}', 'BillingController@rawat_inap_print');
Route::get('billing/rawat_jalan', 'BillingController@rawat_jalan');
Route::post('billing/rawat_jalan_post', 'BillingController@rawat_jalan_post');
Route::get('billing/rawat_jalan_print/{id}/{mode}', 'BillingController@rawat_jalan_print');
Route::get('billing/ugd', 'BillingController@ugd');
Route::post('billing/ugd_view', 'BillingController@ugd_view');
Route::get('billing/ugd_print/{id}/{mode}', 'BillingController@ugd_print');
Route::get('billing/jasa_dokter', 'BillingController@jasa_dokter');
Route::get('billing/dp', 'BillingController@downPayment');
Route::get('billing/dp/{id}', 'BillingController@downPayment');
Route::post('billing/dp', 'BillingController@saveDownPayment');
Route::get('billing/obat_aps/{id}/{mode}', 'BillingController@aps_obat_print');
Route::get('billing/vk_print/{id}/{mode}', 'PembayaranController@vkPrint');
Route::get('billing/ok_print/{id}/{mode}', 'PembayaranController@okPrint');
Route::get('billing/rawat_jalan_all/{id}/{mode}', 'BillingController@rawat_jalan_all');
Route::get('billing/rawat_inap_all/{id}/{mode}', 'BillingController@rawat_inap_all');
Route::get('billing/rawat_vk_all/{id}/{mode}', 'BillingController@vk_all');
Route::get('billing/verifikasi', 'PembayaranController@verifikasi');
Route::post('billing/verifikasi', 'PembayaranController@doVerifikasi');


Route::get('billing_carabayar/rawat_jalan/{id}', 'BillingCaraBayarController@rawatJalan');
Route::get('billing_carabayar/datatable', 'BillingCaraBayarController@datatable');
Route::post('billing_carabayar/rawat_jalan', 'BillingCaraBayarController@postRawatJalan');
Route::get('billing_carabayar/igd', 'BillingCaraBayarController@igd');
Route::get('billing_carabayar/igd/{id}', 'BillingCaraBayarController@igdDetail');
Route::get('billing_carabayar/igd_datatable', 'BillingCaraBayarController@igdDatatable');
Route::post('billing_carabayar/igd', 'BillingCaraBayarController@postIgd');
Route::get('billing_carabayar/rawat_inap', 'BillingCaraBayarController@rawatInap');
Route::get('billing_carabayar/rawat_inap/{id}', 'BillingCaraBayarController@rawatInapDetail');
Route::get('billing_carabayar/rawat_inap_datatable', 'BillingCaraBayarController@rawatInapTable');
Route::post('billing_carabayar/rawat_inap', 'BillingCaraBayarController@postRawatInap');
Route::get('billing_carabayar/riwayat', 'BillingCaraBayarController@riwayat');
Route::get('billing_carabayar/riwayat_datatable', 'BillingCaraBayarController@riwayatDatatable');
Route::resource('billing_carabayar', 'BillingCaraBayarController');

Route::group(array('prefix' => 'invoice'), function()
{
	Route::get('/rawat_inap', 'InvoiceController@rawat_inap');
	Route::post('/rawat_inap_view', 'InvoiceController@rawat_inap_view');
	Route::get('/rawat_inap_print/{id}/{mode}', 'InvoiceController@rawat_inap_print');
	Route::get('/rawat_jalan', 'InvoiceController@rawat_jalan');
	Route::post('/rawat_jalan_post', 'InvoiceController@rawat_jalan_post');
	Route::get('/rawat_jalan_print/{id}/{mode}', 'InvoiceController@rawat_jalan_print');
	Route::get('/ugd', 'InvoiceController@ugd');
	Route::post('/ugd_view', 'InvoiceController@ugd_view');
	Route::get('/ugd_print/{id}/{mode}', 'InvoiceController@ugd_print');
	Route::get('/jasa_dokter', 'InvoiceController@jasa_dokter');
});

Route::group(array('prefix' => 'report'), function()
{
	Route::get('/rawat_inap', 'ReportController@rawat_inap');
	Route::post('/rawat_inap_view', 'ReportController@rawat_inap_view');
	Route::get('/rawat_inap_print', 'ReportController@rawat_inap_print');
	Route::get('/rawat_inap_excel/{mode}', 'ReportController@rawat_inap_excel');
	
	Route::get('/rawat_jalan', 'ReportController@rawat_jalan');
	Route::post('/rawat_jalan_view', 'ReportController@rawat_jalan_view');
	Route::get('/rawat_jalan_print', 'ReportController@rawat_jalan_print');
	Route::get('/rawat_jalan_excel/{mode}', 'ReportController@rawat_jalan_excel');
	
	Route::get('/ugd', 'ReportController@ugd');
	Route::post('/ugd_view', 'ReportController@ugd_view');
	Route::get('/ugd_print', 'ReportController@ugd_print');
	Route::get('/ugd_excel/{mode}', 'ReportController@ugd_excel');
	
// Laporan Stok Obat, keluar Masuk Obat dan Laba Rugi Obat di Apotek Dinas dan Askes
	Route::get('/stok_obat/{pref}', 'ReportController@stokObat');
	Route::get('/stokObat_excel/{pref}/{mode}', 'ReportController@stokObat_excel');
	
	Route::get('/keluar_masuk_obat/{pref}', 'ReportController@keluarMasukObat');
	Route::post('/keluar_masuk_obat_view/{pref}', 'ReportController@keluarMasukObat_view');
	Route::post('/keluarMasukObat_excel/{pref}/{mode}', 'ReportController@keluarMasukObat_excel');

	Route::get('/rincian_keluar_obat/{pref}', 'ReportController@rincianKeluarObat');
	Route::post('/rincian_keluar_obat_view/{pref}', 'ReportController@rincianKeluarObat_view');

	Route::get('/obat_keluar/{id}', array('before'=>'group', 'uses'=>'ReportController@obatKeluar'));
	Route::post('/obat_keluar_view/{id}', 'ReportController@obatKeluar_view');
//	Route::get('/obat_keluar_excel', 'ReportController@obatKeluar_excel');
	Route::get('/obat_keluar_excel/{id}/{mode}', 'ReportController@obatKeluar_excel');

	Route::post('/rincian_rawat_inap', 'ReportController@rincianRawatInap');
	
	
	Route::get('/laba_rugi_obat/{pref}', 'ReportController@labaRugiObat');
	Route::post('/laba_rugi_obat_view/{pref}', 'ReportController@labaRugiObat_view');
	Route::get('/labaRugiObat_excel/{pref}/{mode}', 'ReportController@labaRugiObat_excel');
//=========================
	
	Route::get('/hemodialisa', 'ReportController@hemodialisa');
	Route::post('/hemodialisa_view', 'ReportController@hemodialisa_view');
	Route::get('/hemodialisa_print/{id}', 'ReportController@hemodialisa_print');
	Route::get('/poli_bulan', 'ReportController@poli_bulan');
	Route::post('/poli_bulan_view', 'ReportController@poli_bulan_view');

	Route::get('/bulan_poli/{id}', 'ReportController@bulan_poli');
	Route::get('/bulan_inap/{id}', 'ReportController@bulan_inap');
	Route::post('/rekap_golongan', 'ReportController@rekap_golongan');
	
	Route::get('/tanggal_inap/{id}', 'ReportController@tanggal_inap');
	Route::get('/rekap_golongan/{id}', 'ReportController@rekap_golongan');
	Route::post('/tanggal_inap/rekap_golongan_view', 'ReportController@rekap_golongan_view');
	Route::get('/tanggal_inap/rekap_golongan_print', 'ReportController@rekap_golongan_print');
	Route::get('/tanggal_inap/rekap_golongan_excel/{mode}', 'ReportController@rekap_golongan_excel');
	
	//Route::get('/tanggal/{id}', 'ReportController@tanggal');
	Route::get('/bulan/penyakit', array('before'=>'group', 'uses'=>'ReportController@penyakit'));
	Route::get('/bulan/penyakit_excel/{mode}', 'ReportController@penyakit_excel');
	Route::get('/bulan/{id}', 'ReportController@bulan');
	Route::get('/penunjang_tanggal/{id}', 'ReportController@penunjangTanggal');
	Route::post('/penunjang/{id}', 'ReportController@penunjang');

	Route::get('/tanggal/morbiditas', array('before'=>'group', 'uses'=>'ReportController@morbiditas'));
	Route::post('/tanggal/morbiditas_view', 'ReportController@morbiditas_view');
	Route::get('/tanggal/morbiditas_print', 'ReportController@morbiditas_print');
	Route::get('/tanggal/morbiditas_excel/{mode}', 'ReportController@morbiditas_excel');
	
	Route::get('/pasien_ruangan', 'ReportController@pasien_ruangan');
	Route::post('/pasien_ruangan_view', 'ReportController@pasien_ruangan_view');
	Route::get('/pasien_ruangan_print', 'ReportController@pasien_ruangan_print');
	Route::get('/pasien_ruangan_excel/{mode}', 'ReportController@pasien_ruangan_excel');

	Route::post('/penyakit', array('before'=>'group', 'uses'=>'ReportController@penyakit'));
	Route::get('/penyakit_excel/{mode}', 'ReportController@penyakit_excel');

	//Route::get('/konsumsi', 'ReportController@konsumsi');
	Route::get('/konsumsi', array('before'=>'group', 'uses'=>'ReportController@konsumsi'));
	Route::post('/konsumsi_view', 'ReportController@konsumsi_view');
	Route::get('/konsumsi_print', 'ReportController@konsumsi_print');
	Route::get('/konsumsi_excel/{mode}', 'ReportController@konsumsi_excel');

	Route::get('/gizi', array('before'=>'group', 'uses'=>'ReportController@gizi'));
	Route::post('/gizi_view', 'ReportController@gizi_view');
	Route::get('/gizi_excel/{mode}', 'ReportController@gizi_excel');


	Route::get('/jasa_dokter/{tipe}', array('before'=>'group', 'uses'=>'ReportController2@jasa_dokter'));
	Route::post('/jasa_dokter_view/{tipe}', 'ReportController2@jasa_dokter_view');
	Route::get('/jasa_dokter_detail/{tipe}/{id}', 'ReportController2@jasa_dokter_detail');
	Route::get('/jasa_dokter_print/{tipe}', 'ReportController2@jasa_dokter_print');
	Route::get('/jasa_dokter_excel/{tipe}/{mode}', 'ReportController2@jasa_dokter_excel');

	Route::get('/distribusi_obat/{pref}', 'ReportObatController@distribusiObat');
	Route::post('/distribusi_obat_view/{pref}', 'ReportObatController@distribusiObat_view');
	Route::post('/distribusi_obat_excel/{pref}/{mode}', 'ReportObatController@distribusiObat_excel');

	Route::get('/retur_obat/{pref}', 'ReportObatController@returObat');
	Route::post('/retur_obat_view/{pref}', 'ReportObatController@returObat_view');
	Route::post('/retur_obat_excel/{pref}/{mode}', 'ReportObatController@returObat_excel');

	Route::get('/pembelian_obat/{pref}', 'ReportObatController@pembelianObat');
	Route::post('/pembelian_obat_view/{pref}', 'ReportObatController@pembelianObat_view');
	Route::post('/pembelian_obat_excel/{pref}/{mode}', 'ReportObatController@pembelianObat_excel');

	Route::get('/penjualan_obat/{pref}', 'ReportObatController@penjualanObat');
	Route::post('/penjualan_obat_view/{pref}', 'ReportObatController@penjualanObat_view');
	Route::post('/penjualan_obat_excel/{pref}/{mode}', 'ReportObatController@penjualanObat_excel');

	Route::get('/penjualan_perobat/{pref}', 'ReportObatController@penjualanPerObat');
	Route::post('/penjualan_perobat_view/{pref}', 'ReportObatController@penjualanPerObat_view');
});

Route::get('laporanrl/rl1_1', 'LaporanController@rl1_1');
Route::post('laporanrl/rl1_1', 'LaporanController@post_rl1_1');
Route::get('laporanrl/{id}', 'LaporanController@rl');
Route::post('laporanrl/{id}', 'LaporanController@post_rl');
Route::resource('laporanrl', 'LaporanController');

Route::group(array('prefix' => 'klaim_bpjs'), function()
{
	Route::get('/tanggal/{slug}', 'KlaimBpjsController@tanggal');
	Route::get('/rawat_inap', 'KlaimBpjsController@rawat_inap');
	Route::get('/rawat_inap_input','KlaimBpjsController@rawatInapInput');
	Route::get('/rawat_jalan_input','KlaimBpjsController@rawatJalanInput');

	Route::post('/rawat_inap_one','KlaimBpjsController@rawatInapInputOne');
	Route::post('/rawat_jalan_one','KlaimBpjsController@rawatJalanInputOne');
	Route::post('/rawat_inap_input','KlaimBpjsController@rawatInapInputPost');

	Route::get('/ugd_input','KlaimBpjsController@ugdInput');
	Route::post('/ugd_input_one','KlaimBpjsController@ugdInputOne');

});

Route::group(array('prefix' => 'pendapatan'), function()
{
	Route::get('/tanggal/{slug}', 'PendapatanController@tanggal');
	Route::get('/rawat_inap', 'PendapatanController@rawat_inap');
	Route::get('/rawat_inap_input','PendapatanController@rawatInapInput');
	Route::get('/rawat_jalan_input','PendapatanController@rawatJalanInput');

	Route::post('/rawat_inap_one','PendapatanController@rawatInapInputOne');
	Route::post('/rawat_jalan_one','PendapatanController@rawatJalanInputOne');
	Route::post('/rawat_inap_input','PendapatanController@rawatInapInputPost');

	Route::get('/ugd_input','PendapatanController@ugdInput');
	Route::post('/ugd_input_one','PendapatanController@ugdInputOne');

});

Route::group(array('prefix' => 'pembayaran'), function()
{
	Route::get('/rj_belum', 'PembayaranController@rjBelum');
	Route::get('/rj_belum_table', 'PembayaranController@rjBelumTable');

	Route::get('/rj_sudah', 'PembayaranController@rjSudah');
	Route::get('/rj_sudah_table', 'PembayaranController@rjSudahTable');

	Route::get('/detail_rj/{id}', 'PembayaranController@detailRj');

	Route::get('/ri_belum', 'PembayaranController@riBelum');
	Route::get('/ri_belum_table', 'PembayaranController@riBelumTable');
	Route::get('/detail_ri/{id}', 'PembayaranController@detailRi');

	Route::get('/aps_belum', 'PembayaranController@apsBelum');
	Route::get('/aps_belum_table', 'PembayaranController@apsBelumTable');

	Route::get('/penunjang_belum', 'PembayaranController@penunjangBelum');
	Route::get('/penunjang_belum_table', 'PembayaranController@penunjangBelumTable');
	Route::get('/detail_penunjang/{id}', 'PembayaranController@detailPenunjang');

	Route::get('/detail_obat/{id}', 'PembayaranController@detailObat');

	Route::post('/proses_rj' , 'PembayaranController@prosesRj');
	Route::post('/proses_ri' , 'PembayaranController@prosesRi');
	Route::post('/proses_obat' , 'PembayaranController@prosesObat');
	Route::post('/proses_penunjang' , 'PembayaranController@prosesPenunjang');
	Route::get('/penunjang_print/{id}/{mode}', 'PembayaranController@penunjangPrint');

	Route::get('/flag_obat', 'PembayaranController@flagObat');

	Route::get('/vk', 'PembayaranController@vkBelum');
	Route::get('/vk_table', 'PembayaranController@vkBelumTable');
	Route::get('/detail_vk/{id}', 'PembayaranController@detailVK');

	Route::get('/ok', 'PembayaranController@okBelum');
	Route::get('/ok_table', 'PembayaranController@okBelumTable');
	Route::get('/detail_ok/{id}', 'PembayaranController@detailOK');


});


Route::group(array('prefix' => 'jasa_dokter'), function()
{
	Route::get('dokter', 'JasaDokterController@dokter');
	Route::get('dokter_view', 'JasaDokterController@dokter_view');
	Route::get('rawat_inap', 'JasaDokterController@rawat_inap');
	Route::get('rawat_inap_klaim', 'JasaDokterController@rawat_inap_klaim');
	Route::post('rawat_inap_view', 'JasaDokterController@rawat_inap_view');
	Route::get('rawat_inap_print/{id}', 'JasaDokterController@rawat_inap_print');
	Route::get('rawat_jalan', 'JasaDokterController@rawat_jalan');
	Route::get('rawat_jalan_view', 'JasaDokterController@rawat_jalan_view');
	Route::get('rawat_jalan_print/{id}', 'JasaDokterController@rawat_jalan_print');
	Route::get('ugd', 'JasaDokterController@ugd');
	Route::get('ugd_view', 'JasaDokterController@ugd_view');
	Route::get('ugd_print/{id}', 'JasaDokterController@ugd_print');
	Route::get('check_klaim/{id}', 'JasaDokterController@check_klaim');
	Route::post('simpan_klaim', 'JasaDokterController@simpan_klaim');

});

Route::group(array('prefix' => 'sep'), function()
{
	Route::get('/coba_list', 'SepController@cobaList');
	
	Route::get('/data_peserta', 'SepController@dataPeserta');
	Route::get('/data_peserta_view', 'SepController@dataPesertaView');
	
	Route::get('/peserta/{id}', 'SepController@peserta');
	Route::post('/peserta_view/{id}', 'SepController@pesertaView');
	Route::get('/peserta_info/{nomor}', 'SepController@pesertaInfo');
	
	Route::get('/rujukan/data_ppk', 'SepController@ppkData');
	Route::post('/rujukan/ppk_data_view', 'SepController@ppkDataView');

	Route::get('/rujukan/ppkPelayananSearch', 'SepController@ppkPelayananSearch');
	Route::get('/rujukan/ppkRujukanSearch', 'SepController@ppkRujukanSearch');
	Route::get('/rujukan/poliSearch', 'SepController@poliSearch');
	Route::get('/rujukan/diagnosaSearch', 'SepController@diagnosaSearch');
	
	Route::get('/rujukan/ppk_new', 'SepController@ppkNew');
	Route::get('/rujukan/ppk_new_view', 'SepController@ppkNewView');
	
	Route::get('/rujukan/daftar_pasien', 'SepController@daftarPasien');
	Route::post('/rujukan/daftar_pasien_view', 'SepController@daftarPasienView');
	
	Route::get('/rujukan/data/{id}', 'SepController@rujukan');
	Route::post('/rujukan_view/data/{id}', 'SepController@rujukanView');
	
	Route::get('/buat', 'SepController@sepCreate');
	Route::post('/buat_proses', 'SepController@sepCreateProcess');
	
	Route::get('/detail', 'SepController@sepDetail');
	Route::match(array('GET', 'POST'), '/detail_view/{any}', 'SepController@sepDetailView');
	
	Route::get('/update_tanggal_pulang', 'SepController@updateTanggalPulang');
	Route::post('/update_tanggal_pulang_proses', 'SepController@updateTanggalPulangProcess');
	
	Route::get('/hapus_data', 'SepController@sepDelete');
	Route::post('/hapus_data_proses', 'SepController@sepDeleteProcess');
	
	Route::get('/list_sep', 'SepController@listSep');
	Route::get('/list_sep_json/{id}', 'SepController@listSepJson');
	Route::get('/list_view/{id}', 'SepController@listSepView');
	
	Route::get('/update_norm' , 'SepController@updateNorm');
	Route::post('/update_sep', 'SepController@updateSep');

	Route::get('/cetak_sep' , 'SepController@cetakSep');
	Route::get('/sep_print/{id}', 'SepController@sepPrint');
	Route::get('/sep_print2/{id}', 'SepController@sepPrint2');
	Route::get('/pdf_sep/{id}', 'PdfController@sepPdf');

	Route::any('/getppkdata','SepController@getPpkData');
	Route::any('/getdiagnosadata','SepController@getDiagnosaData');
});

/* Kepegawaian */

Route::get('sispeg_jabatan/datatable','SispegJabatanController@datatable');	
Route::resource('sispeg_jabatan', 'SispegJabatanController');

Route::get('sispeg_pangkat/datatable','SispegPangkatController@datatable');
Route::resource('sispeg_pangkat', 'SispegPangkatController');

Route::get('sispeg_pegawai/datatable','SispegPegawaiController@datatable');
Route::resource('sispeg_pegawai', 'SispegPegawaiController');

Route::get('sispeg_mutasi/datatable','SispegMutasiContoller@datatable');
Route::resource('sispeg_mutasi', 'SispegMutasiContoller');

Route::get('sispeg_pensiun/datatable','SispegPensiunController@datatable');
Route::resource('sispeg_pensiun', 'SispegPensiunController');

/* Inventori */
Route::get('asset_kategori/datatable','AssetKategoriController@datatable');	
Route::resource('asset_kategori', 'AssetKategoriController');

Route::get('asset_merk/datatable','AssetMerkController@datatable');	
Route::resource('asset_merk', 'AssetMerkController');

Route::get('asset_pemilik/datatable','AssetPemilikController@datatable');	
Route::resource('asset_pemilik', 'AssetPemilikController');

Route::get('asset_inventori/datatable','AssetInventoriController@datatable');	
Route::resource('asset_inventori', 'AssetInventoriController');

/* Akuntansi */
Route::get('akun_rekening/datatable','AkunRekeningController@datatable');	
Route::resource('akun_rekening', 'AkunRekeningController');

Route::get('akun_pendapatan/datatable','AkunPendapatanController@datatable');	
Route::resource('akun_pendapatan', 'AkunPendapatanController');

Route::get('akun_transaksi/datatable','AkunTransaksiController@datatable');	
Route::resource('akun_transaksi', 'AkunTransaksiController');

Route::get('akun_mutasi/datatable','AkunMutasiController@datatable');	
Route::resource('akun_mutasi', 'AkunMutasiController');

Route::get('akun_statement/datatable','AkunStatementController@datatable');	
Route::resource('akun_statement', 'AkunStatementController');


/** Apotek **/
Route::get('apotek_obat/datatable/{id}','ApotekObatController@datatable');
Route::post('apotek_obat/editdatatable/{id}','ApotekObatController@editdatatable');
Route::post('apotek_obat/check_id/{id}','ApotekObatController@checkid');
Route::get('apotek_obat/detaildatatable/{id}','ApotekObatController@detaildatatable');
Route::get('apotek_obat/detaildatatable_apotek/{id}','ApotekObatController@detaildatatable_apotek');
Route::get('apotek_obat/detaildatatable_edit/{id}','ApotekObatController@detaildatatable_edit');
Route::get('apotek_obat/detailobat/{id}','ApotekObatController@detailObat');
Route::get('apotek_obat/bulk','ApotekObatController@bulkUpdate');
Route::get('apotek_obat/sync','ApotekObatController@syncUpdate');
Route::get('apotek_obat/tarif','ApotekObatController@tarifR');
Route::post('apotek_obat/tarif','ApotekObatController@doTarifR');
//Route::get('apotek_obat/{id}','ApotekObatController@index');
Route::get('apotek_obat/{id}', array('before'=>'group', 'uses'=>'ApotekObatController@index'));
Route::resource('apotek_obat', 'ApotekObatController');

Route::get('apotek_keluar/datatable','ApotekKeluarController@datatable');
Route::get('apotek_keluar/list_transaksi/{pref}/{id}','ApotekKeluarController@list_transaksi');
Route::get('apotek_keluar/check_pasien/{id}','ApotekKeluarController@check_pasien');
Route::get('apotek_keluar/total_penjualan/{pref}/{id}','ApotekKeluarController@total_penjualan');
Route::post('apotek_keluar/tambah_transaksi/{id}','ApotekKeluarController@tambah_transaksi');
Route::post('apotek_keluar/update_ujr/{id}','ApotekKeluarController@update_ujr');
Route::post('apotek_keluar/check_transaksi/{id}','ApotekKeluarController@check_transaksi');
Route::post('apotek_keluar/hapus_transaksi/{id}','ApotekKeluarController@hapus_transaksi');
Route::post('apotek_keluar/edit_transaksi/{id}','ApotekKeluarController@edit_transaksi');
Route::post('apotek_keluar/check_counter/{id}','ApotekKeluarController@check_counter');
Route::any('apotek_keluar/getdata/{id}','ApotekKeluarController@getdata');
Route::get('apotek_keluar/pdf/{noreg}', 'ApotekKeluarController@pdfCreate');
Route::get('apotek_keluar/cetak_transaksi/{noreg}', 'ApotekKeluarController@cetakTransaksi');
Route::get('apotek_keluar/excel/{mode}/{noreg}', 'ApotekKeluarController@excelCreate');
Route::get('apotek_keluar/data_penjualan/{id}','ApotekKeluarController@dataPenjualan');
Route::get('apotek_keluar/cetak_etiket/{id}','ApotekKeluarController@cetakEtiket');
Route::resource('apotek_keluar', 'ApotekKeluarController');

Route::get('apotek_masuk/datatable/{id}','ApotekMasukController@datatable');
Route::post('apotek_masuk/list_transaksi/{id}','ApotekMasukController@list_transaksi');
Route::get('apotek_masuk/check_pasien/{id}','ApotekMasukController@check_pasien');
Route::post('apotek_masuk/tambah_transaksi/{id}','ApotekMasukController@tambah_transaksi');
Route::post('apotek_masuk/hapus_transaksi/{id}','ApotekMasukController@hapus_transaksi');
Route::get('apotek_masuk/{id}','ApotekMasukController@index');
Route::resource('apotek_masuk', 'ApotekMasukController');

Route::get('apotek_habis/datatable','ApotekHabisController@datatable');
Route::resource('apotek_habis', 'ApotekHabisController');

Route::get('apotek_expire/datatable','ApotekExpireController@datatable');
Route::resource('apotek_expire', 'ApotekExpireController');

Route::get('apotek_opname/datatable','ApotekOpnameController@datatable');
Route::post('apotek_opname/update_stok','ApotekOpnameController@updateStok');
Route::post('apotek_opname/update_het','ApotekOpnameController@updateHet');
Route::resource('apotek_opname', 'ApotekOpnameController');

Route::get('gudang_opname/datatable','GudangOpnameController@datatable');
Route::post('gudang_opname/update_stok','GudangOpnameController@updateStok');
Route::resource('gudang_opname', 'GudangOpnameController');

/* Apotek Suplier */
Route::get('askes_supplier/datatable','AskesSupplierController@datatable');
Route::resource('askes_supplier', 'AskesSupplierController');
Route::get('askes_jenis/datatable','AskesJenisController@datatable');
Route::resource('askes_jenis', 'AskesJenisController');

Route::get('swasta_supplier/datatable','SwastaSupplierController@datatable');
Route::resource('swasta_supplier', 'SwastaSupplierController');
Route::get('swasta_jenis/datatable','SwastaJenisController@datatable');
Route::resource('swasta_jenis', 'SwastaJenisController');

Route::get('ok_supplier/datatable','OkSupplierController@datatable');
Route::resource('ok_supplier', 'OkSupplierController');
Route::get('ok_jenis/datatable','OkJenisController@datatable');
Route::resource('ok_jenis', 'OkJenisController');

Route::get('gudang/datatable','GudangController@datatable');
Route::get('gudang/editdatatable','GudangController@editdatatable');
Route::get('gudang/detaildatatable','GudangController@detaildatatable');
Route::resource('gudang', 'GudangController');

Route::get('gudang_obat/supplier/{id}','GudangObatController@supplier');
Route::get('gudang_obat/simpletable_supplier','GudangObatController@simpletable_supplier');
Route::get('gudang_obat/list_supplier/{id}','GudangObatController@list_supplier');
Route::post('gudang_obat/tambah_supplier','GudangObatController@tambah_supplier');
Route::post('gudang_obat/hapus_supplier', 'GudangObatController@hapus_supplier');
Route::get('gudang_obat/detaildatatable','GudangObatController@detaildatatable');
Route::get('gudang_obat/resep/{id}','GudangObatController@resep');
Route::resource('gudang_obat', 'GudangObatController');

Route::get('gudang_pembelian/datatable','GudangPembelianController@datatable');
Route::post('gudang_pembelian/list_transaksi/','GudangPembelianController@list_transaksi');
Route::get('gudang_pembelian/check_pasien/{id}','GudangPembelianController@check_pasien');
Route::post('gudang_pembelian/tambah_transaksi/{id}','GudangPembelianController@tambah_transaksi');
Route::post('gudang_pembelian/hapus_transaksi/{id}','GudangPembelianController@hapus_transaksi');
Route::resource('gudang_pembelian','GudangPembelianController');

Route::get('gudang_hibah/datatable','GudangHibahController@datatable');
Route::post('gudang_hibah/list_transaksi/','GudangHibahController@list_transaksi');
Route::get('gudang_hibah/check_pasien/{id}','GudangHibahController@check_pasien');
Route::post('gudang_hibah/tambah_transaksi/{id}','GudangHibahController@tambah_transaksi');
Route::post('gudang_hibah/hapus_transaksi/{id}','GudangHibahController@hapus_transaksi');
Route::resource('gudang_hibah','GudangHibahController');

Route::get('gudang_distribusi/datatable','GudangDistribusiController@datatable');
Route::post('gudang_distribusi/list_transaksi/','GudangDistribusiController@list_transaksi');
Route::post('gudang_distribusi/tambah_transaksi/{id}','GudangDistribusiController@tambah_transaksi');
Route::post('gudang_distribusi/hapus_transaksi/{id}','GudangDistribusiController@hapus_transaksi');
Route::resource('gudang_distribusi','GudangDistribusiController');

Route::get('gudang_stok/datatable','GudangStokController@datatable');
Route::get('gudang_stok/editdatatable','GudangStokController@editdatatable');
Route::get('gudang_stok/detaildatatable','GudangStokController@detaildatatable');
Route::resource('gudang_stok', 'GudangStokController');

Route::get('gudang_penerimaan/datatable','GudangPenerimaanController@datatable');
Route::post('gudang_penerimaan/list_transaksi/','GudangPenerimaanController@list_transaksi');
Route::post('gudang_penerimaan/tambah_transaksi/{id}','GudangPenerimaanController@tambah_transaksi');
Route::post('gudang_penerimaan/hapus_transaksi/{id}','GudangPenerimaanController@hapus_transaksi');
Route::get('gudang_penerimaan/belum','GudangPenerimaanController@belum');
Route::get('gudang_penerimaan/belum_table','GudangPenerimaanController@belumTable');
Route::get('gudang_penerimaan/belum/{id}','GudangPenerimaanController@belumForm');
Route::post('gudang_penerimaan/belum/{id}','GudangPenerimaanController@simpanForm');
Route::resource('gudang_penerimaan','GudangPenerimaanController');

Route::get('gudang_retur/datatable','GudangReturController@datatable');
Route::get('gudang_retur/editdatatable','GudangReturController@editdatatable');
Route::get('gudang_retur/detaildatatable','GudangReturController@detaildatatable');
Route::resource('gudang_retur', 'GudangReturController');

Route::get('gudang_pemesanan/datatable','GudangPemesananController@datatable');
Route::get('gudang_pemesanan/editdatatable','GudangPemesananController@editdatatable');
Route::get('gudang_pemesanan/detaildatatable','GudangPemesananController@detaildatatable');
Route::post('gudang_pemesanan/list_transaksi','GudangPemesananController@list_transaksi');
Route::post('gudang_pemesanan/hapus_transaksi','GudangPemesananController@hapus_transaksi');
Route::post('gudang_pemesanan/tambah_transaksi','GudangPemesananController@tambah_transaksi');
Route::post('gudang_pemesanan/detail','GudangPemesananController@detail');
Route::resource('gudang_pemesanan', 'GudangPemesananController');

Route::get('gudang_habis/datatable','GudangHabisController@datatable');
Route::resource('gudang_habis', 'GudangHabisController');

Route::get('gudang_minimal/datatable','GudangMinimalController@datatable');
Route::resource('gudang_minimal', 'GudangMinimalController');

Route::get('askes_obat/datatable','AskesObatController@datatable');
Route::get('askes_obat/editdatatable','AskesObatController@editdatatable');
Route::get('askes_obat/detaildatatable','AskesObatController@detaildatatable');
Route::get('askes_obat/harga','AskesObatController@harga');
Route::post('askes_obat/harga','AskesObatController@simpanHarga');
Route::resource('askes_obat', 'AskesObatController');

Route::get('askes_retur/datatable','AskesReturController@datatable');
Route::post('askes_retur/list_transaksi/','AskesReturController@list_transaksi');
Route::post('askes_retur/tambah_transaksi/{id}','AskesReturController@tambah_transaksi');
Route::post('askes_retur/hapus_transaksi/{id}','AskesReturController@hapus_transaksi');
Route::resource('askes_retur','AskesReturController');


Route::group(array('prefix' => 'api'), function()
{
	Route::get('/pasien/{id}', 'ApiController@pasien');
	Route::get('/sep/list/{id}', 'ApiController@sepList');
	Route::get('/tarif/{id}', 'ApiController@tarif');
});

Route::group(array('prefix' => 'finance_report'), function()
{
	Route::get('/tanggal/{slug}', 'FinanceReportController@tanggal');
	Route::get('/lab_input', 'FinanceReportController@labInput');
	Route::get('/konsul_input', 'FinanceReportController@konsulInput');
	Route::get('/konsultelp_input', 'FinanceReportController@konsulTelpInput');
	Route::get('/visite_input', 'FinanceReportController@visiteInput');
	Route::get('/harian_input', 'FinanceReportController@harianInput');

});

Route::group(array('prefix' => 'verifikasi'), function()
{
	Route::get('/pembayaran_rj', 'VerifikasiController@pembayaranRJ');
});

//History Pasien Controller
//Route::get('history_pasien', 'HistoryPasienController@index');
Route::get('history_pasien', array('before'=>'group', 'uses'=>'HistoryPasienController@index'));	
Route::get('history_pasien/view/{id}', 'HistoryPasienController@view');
Route::get('history_pasien/view_inap/{id}', 'HistoryPasienController@viewInap');
Route::get('history_pasien/view_jalan/{id}', 'HistoryPasienController@viewJalan');
Route::get('history_pasien/view_ugd/{id}', 'HistoryPasienController@viewUgd');
Route::post('history_pasien/view_rawat', 'HistoryPasienController@viewRawat');
Route::post('history_pasien/view_rawat_data', 'HistoryPasienController@viewRawatData');

Route::post('history_pasien/count_year', 'HistoryPasienController@countYear');
Route::post('history_pasien/delete','HistoryPasienController@deleteData');
Route::post('history_pasien/add','HistoryPasienController@store');
Route::post('history_pasien/update','HistoryPasienController@update');
Route::get('history_pasien/datatable','HistoryPasienController@datatable');


//Kategori Tindakan

Route::get('tindakan_jenis/datatable','TindakanJenisController@datatable');
Route::resource('tindakan_jenis', 'TindakanJenisController');

Route::get('kategori_tindakan/datatable','TindakanKategoriController@datatable');
Route::resource('kategori_tindakan', 'TindakanKategoriController');

Route::get('kategori_ruangan/datatable','KategoriRuanganController@datatable');
Route::resource('kategori_ruangan', 'KategoriRuanganController');

Route::get('kelas_ruangan/datatable','KelasRuanganController@datatable');
Route::resource('kelas_ruangan', 'KelasRuanganController');

Route::get('poli/datatable','PoliController@datatable');
Route::get('poli/dokter/{id}','PoliController@dokter');
Route::resource('poli', 'PoliController');

Route::post('crud/save_ajax','CrudController@save_ajax');
Route::post('crud/load_ajax','CrudController@load_ajax');

Route::get('menu/datatable','MenuController@datatable');
Route::resource('menu', 'MenuController');

Route::get('group/datatable','GroupController@datatable');
Route::resource('group', 'GroupController');

Route::get('asuransi_swasta/datatable','AsuransiSwastaController@datatable');
Route::resource('asuransi_swasta', 'AsuransiSwastaController');

Route::get('produsen/datatable','ProdusenController@datatable');
Route::resource('produsen', 'ProdusenController');

Route::get('rekanan/datatable','RekananController@datatable');
Route::resource('rekanan', 'RekananController');

Route::get('rekam_medis/datatable','RekamController@datatable');
Route::get('rekam_medis/tracer','RekamController@tracer');
Route::resource('rekam_medis', 'RekamController');

Route::get('deposit/datatable','DepositController@datatable');
Route::get('deposit/print/{id}','DepositController@cetak');
Route::resource('deposit', 'DepositController');

Route::get('diet/datatable','DietController@datatable');
Route::get('diet/print/{id}','DietController@cetak');
Route::resource('diet', 'DietController');

Route::get('gizi/datatable','GiziController@datatable');
Route::get('gizi/rawat_inap/{id}','GiziController@rawat_inap');
Route::get('gizi/print/{id}','GiziController@cetak');
Route::get('gizi/list_diet/{id}','GiziController@list_diet');
Route::post('gizi/tambah_diet', 'GiziController@tambah_diet');
Route::post('gizi/hapus_diet', 'GiziController@hapus_diet');

Route::resource('gizi', 'GiziController');

Route::get('registrasi_harian/datatable','RegistrasiHarianController@datatable');
Route::get('registrasi_harian/rawat_inap','RegistrasiHarianController@rawatInap');
Route::get('registrasi_harian/rawat_inap_table','RegistrasiHarianController@rawatInapTable');
Route::get('registrasi_harian/igd','RegistrasiHarianController@igd');
Route::get('registrasi_harian/igd_table','RegistrasiHarianController@igdTable');
Route::resource('registrasi_harian', 'RegistrasiHarianController');

Route::get('vk/datatable','VKController@datatable');
Route::resource('vk', 'VKController');

Route::get('ok/datatable','OkController@datatable');
Route::resource('ok', 'OkController');

Route::get('pendaftaran_harian/datatable','PendaftaranHarianController@datatable');
Route::get('pendaftaran_harian/register/{id}','PendaftaranHarianController@register');
Route::post('pendaftaran_harian/register/{id}','PendaftaranHarianController@editRegister');
Route::resource('pendaftaran_harian', 'PendaftaranHarianController');

Route::get('pendaftaran/get_reg/{id}','PendaftaranController@getReg');
Route::get('pendaftaran/aps/list_pasien','PendaftaranController@apsPasien');
Route::get('pendaftaran/aps','PendaftaranController@aps');
Route::post('pendaftaran/aps', 'PendaftaranController@doAps');
Route::resource('pendaftaran', 'PendaftaranController');

Route::group(array('prefix' => 'pendaftaran_ui'), function()
{
	Route::get('/rawat_jalan', 'PendaftaranUIController@rawatJalan');
});

Route::group(array('prefix' => 'vklaim_ui'), function()
{
	Route::get('/sep/cari', 'VklaimUIController@cariSEP');
});

Route::group(array('prefix' => 'vklaim'), function()
{
	Route::get('/cari_peserta/nik/{id}', 'VklaimController@cariPesertaByNik');
	Route::get('/cari_peserta/bpjs/{id}', 'VklaimController@cariPesertaByBPJS');
	Route::get('/cari_rujukan/rs_rujukan/{id}', 'VklaimController@cariRujukanRS');
	Route::get('/referensi/faskes/{p1}/{p2}', 'VklaimController@cariFaskes');
	Route::get('/cari_dpjp/{p1}/{p2}/{p3}', 'VklaimController@cariDPJP');

	Route::post('/sep/insert', 'VklaimSEPController@insertSEP');
	Route::get('/sep/insert_sample', 'VklaimSEPController@insertSEPSample');
	Route::get('/sep/cari/{sep}', 'VklaimSEPController@cariSEP');
	Route::post('/sep/hapus', 'VklaimSEPController@hapusSEP');
	Route::get('/sep/update', 'VklaimSEPController@updateSEP');
});

Route::group(array('prefix' => 'eklaim'), function()
{
	Route::get('/import_pasien', 'EKlaimController@importPasien');
	Route::get('/update_rm', 'EKlaimController@updateRM');
	Route::get('/import_rajal', 'EKlaimController@importRajal');
});

Route::group(array('prefix' => 'informasi'), function()
{
	Route::get('/tt', 'InformasiController@tt');
});

Route::group(array('prefix' => 'apotek_eresep'), function()
{
	Route::get('/datatable','ApotekResepController@datatable');
	Route::get('/list_transaksi/{pref}/{id}','ApotekResepController@list_transaksi');
	Route::get('/check_pasien/{id}','ApotekResepController@check_pasien');
	Route::get('/total_penjualan/{pref}/{id}','ApotekResepController@total_penjualan');
	Route::post('/tambah_eresep/{id}','ApotekResepController@tambah_resep');
	Route::post('/check_resep/{id}','ApotekResepController@check_resep');
	Route::post('/hapus_transaksi/{id}','ApotekResepController@hapus_transaksi');
	Route::post('/check_counter/{id}','ApotekResepController@check_counter');
	Route::any('/getdata/{id}','ApotekResepController@getdata');
	Route::get('/pdf/{noreg}', 'ApotekResepController@pdfCreate');
	Route::get('/cetak_transaksi/{noreg}', 'ApotekResepController@cetakTransaksi');
	Route::get('/excel/{mode}/{noreg}', 'ApotekResepController@excelCreate');
	Route::get('/data_penjualan/{id}','ApotekResepController@dataPenjualan');
	Route::get('/cetak_etiket/{id}','ApotekResepController@cetakEtiket');
	Route::get('/list_transaksi_byreg/{pref}/{id}','ApotekResepController@list_transaksi_byreg');

});
