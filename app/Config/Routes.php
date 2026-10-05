<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//$routes->get('/mahasiswa', 'Mahasiswa::index');
/* $routes->get('/index', 'Home::index');
$routes->get('/dashboard', 'Dashboard::index');

$routes->post('login/auth','Login::auth');
$routes->get('logout','Login::logout');


*/
$routes->get('/index', 'Home::Index');
$routes->get('/login', 'Home::Login');
$routes->post('login/auth', 'Login::auth');
$routes->get('/logout', 'Login::logout');

$routes->get('/cekstatus', 'Home::cekStatus');
$routes->post('cekStatusKelayakan', 'Home::cekStatusKelayakan');

$routes->group('', ['filter' => 'auth'], function($routes){

    	// Dashboard admin
	$routes->get('/dashboard', 'Dashboard::index');

});
$routes->group('', ['filter' => 'role:admin'], function($routes){


    // Wilayah
	$routes->get('/wilayah', 'Wilayah::index');
	$routes->get('/wilayah/getdata', 'Wilayah::getData');
	$routes->post('wilayah/save', 'Wilayah::save');
	$routes->get('wilayah/getParent/(:segment)', 'Wilayah::getParent/$1');
	$routes->get('wilayah/editRt/(:num)', 'Wilayah::editRt/$1');
	$routes->get('wilayah/editRw/(:num)', 'Wilayah::editRW/$1');
	$routes->get('wilayah/editDsn/(:num)', 'Wilayah::editDsn/$1');
	$routes->post('wilayah/updatert', 'Wilayah::updateRt');
	$routes->post('wilayah/updaterw', 'Wilayah::updateRw');
	$routes->post('wilayah/updateDsn', 'Wilayah::updateDsn');
	$routes->post('/wilayah/import', 'Wilayah::import');
	$routes->post('wilayah/updateWil', 'Wilayah::updateWil');
	$routes->get('wilayah/getRw/(:num)', 'Wilayah::getRw/$1');
	$routes->get('wilayah/getRt/(:num)', 'Wilayah::getRt/$1');
	$routes->get('wilayah/getDusun', 'Wilayah::getDusun');
	$routes->get('/wilayah/getDusun', 'Wilayah::getDusun');
	$routes->get('/wilayah/getRW/(:num)', 'Wilayah::getRW/$1');
	$routes->get('/wilayah/getRT/(:num)', 'Wilayah::getRT/$1');
	$routes->get('wilayah/editWilayah/(:num)', 'Wilayah::editWilayah/$1');
	$routes->post('wilayah/delete/(:num)', 'Wilayah::delete/$1');

    // Keluarga
	$routes->get('/keluarga', 'Keluarga::index');
	$routes->get('/keluarga/getData', 'Keluarga::getData');
	$routes->post('keluarga/deleteKeluarga', 'Keluarga::deleteKeluarga');
	$routes->post('/keluarga/saveKeluarga', 'Keluarga::saveKeluarga');
	$routes->post('keluarga/updateKeluarga', 'Keluarga::updateKeluarga');
	$routes->get('/detailanggota/getdata', 'DetailAnggota::getData');
	$routes->get('/detailanggota', 'DetailAnggota::index');
	$routes->post('/detailanggota/cekKK', 'DetailAnggota::cekKK');
	$routes->get('/pekerjaan/getpekerjaan', 'Pekerjaan::getPekerjaan');
	$routes->get('keluarga/getDetailAnggota','Keluarga::getDetailAnggota');
	$routes->get('/tambahanggota','Keluarga::tambahanggota');
	$routes->post('detailanggota/simpanKepalaKeluarga','DetailAnggota::simpanKepalaKeluarga');
	$routes->post('detailAnggota/simpanAnggotaKeluarga', 'DetailAnggota::simpanAnggotaKeluarga');
	$routes->post('DetailAnggota/hapusAnggota/(:num)', 'DetailAnggota::hapusAnggota/$1');
	$routes->get('detailanggota/edit/(:num)', 'DetailAnggota::edit/$1');
	$routes->post('detailanggota/update', 'DetailAnggota::update');



    // Dataset
	$routes->get('/hitungNaiveBayes', 'Training::index');
	$routes->get('/calonTraining', 'Training::calonTraining');
	$routes->get('setKriteria', 'Training::tambahTraining');
	$routes->get('tambahCalonTraining', 'Training::tambahCalonTraining');
	$routes->get('tambahCalonTraining/getCalonTraining', 'Training::getCalonTraining');
	$routes->post('tambahCalonTraining/simpanTraining','Training::simpanTraining');
	$routes->get('calonTraining/getDataTraining', 'Training::getDataTraining');
	$routes->get('calonTraining/getDataTrainingSetKriteria', 'Training::getDataTrainingSetKriteria');
	$routes->post('training/simpanSetKriteria', 'Training::simpanSetKriteria');

	//Klasifikasi
	$routes->get('/calonKlasifikasi', 'Testing::index');
	$routes->get('calonKlasifikasi/getDataKlasifikasi', 'Testing::getDataKlasifikasi');
	$routes->get('tambahCalonKlasifikasi', 'Testing::tambahCalonKlasifikasi');
	$routes->get('tambahCalonKlasifikasi/getCalonKlasifikasi', 'Testing::getCalonKlasifikasi');
	$routes->post('tambahCalonKlasifikasi/simpanKlasifikasi','Testing::simpanKlasifikasi');
	$routes->get('setKriteriaKlaifikasi', 'Testing::tambahKriteriaKlasifikasi');
	$routes->post('testing/simpanSetKriteriaKlasifikasi', 'Testing::simpanSetKriteriaKlasifikasi');
	$routes->get('/result', 'Testing::hasilKlasifikasi');
	$routes->post('HasilPrediksi/HitungHasilKlasifikasi', 'Testing::HitungHasilKlasifikasi');
	$routes->get('result/getDataHasilKlasifikasi', 'Testing::getDataHasilKlasifikasi');
	$routes->post('result/hapusHasilPrediksi', 'Testing::hapusHasilPrediksi');
	$routes->post('result/resetHasilKlasifikasi', 'Testing::resetHasilKlasifikasi');
	

    // Kriteria dan Nilai Kriteria
	$routes->get('/kriteria', 'Kriteria::index');
	$routes->get('kriteria/getdata', 'Kriteria::getDataKriteria');
	$routes->get('kriteria/getDataKriteria', 'Kriteria::getDataKriteria');
	$routes->get('kriteria/getKriteriaById', 'Kriteria::getKriteriaById');
	$routes->get('kriteria/getNilaiKriteria', 'Kriteria::getNilaiKriteria');
	
	$routes->get('kriteria/getNilaiKriteriabyid', 'Kriteria::getNilaiKriteriabyid');
	$routes->get('kriteria/getDetailNilaiKriteria', 'Kriteria::getDetailNilaiKriteria');
	$routes->get('kriteria/getDetailKriteria', 'Kriteria::getDetailKriteria');
	$routes->post('kriteria/updateKriteria', 'Kriteria::updateKriteria');
	$routes->post('kriteria/insertKriteria', 'Kriteria::insertKriteria');
	$routes->post('kriteria/deleteKriteria', 'Kriteria::deleteKriteria');

	// Proses kelola nilai kriteria menu nilai kriteria 
	$routes->get('/nilaiKriteria', 'Kriteria::nilaiKriteria');
	$routes->post('kriteria/updateNilaiKriteria', 'Kriteria::updateNilaiKriteria');
	$routes->post('kriteria/simpanNilaiKriteria', 'Kriteria::simpanNilaiKriteria');
	$routes->get('/tambahNilaiKriteria','Kriteria::TambahNilaiKriteria');
	$routes->post('kriteria/deleteNilaiKriteria', 'Kriteria::deleteNilaiKriteria');
	$routes->get('kriteria/getNilai/(:num)', 'Kriteria::getNilai/$1');
	$routes->post('nilaiKriteria/deleteNilaiKriteria/(:num)', 'Kriteria::deleteNilaiKriteria/$1');


	//Klasifikasi
	$routes->get('/klasifikasi', 'Klasifikasi::index');
	$routes->get('/getHasilKlasifikasiAdmin', 'Testing::getDataHasilKlasifikasi');

	//pengguna
	$routes->get('/user', 'Pengguna::index');
	$routes->post('pengguna/simpanPengguna', 'Pengguna::simpanPengguna');
	$routes->get('pengguna/getDataUser', 'Pengguna::getDataUser');
	$routes->get('pengguna/getUser/(:num)', 'Pengguna::getUser/$1');
	$routes->post('pengguna/update', 'Pengguna::update');
	$routes->post('pengguna/hapus', 'Pengguna::hapus');
});

//------------------ Batas Role Kepala Desa
$routes->group('', ['filter' => 'role:kepala_desa'], function($routes){
	$routes->get('/hasilKlasifikasi', 'Testing::hasilKlasifikasi');
	$routes->get('/getHasilKlasifikasi', 'Testing::getDataHasilKlasifikasi');
	$routes->post('persetujuan/setujui', 'Testing::setujui');
	$routes->post('persetujuan/tolak', 'Testing::tolak');
	$routes->get('/penerimaBantuan', 'Testing::penerimaBantuan');
	$routes->get('/getHasilPersetujuan', 'Testing::getHasilPresetujuan');
	$routes->get('downloadHasilPersetujuan', 'Testing::downloadHasilPersetujuan');
	$routes->get('/setujuiMasal', 'Testing::halamanSetujuiMasal');
	$routes->get('/getDataPersetujuan', 'Testing::getDataPersetujuan');
	$routes->post('persetujuan/setujuiMasal','Testing::setujuiMasal');
});




?>