<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index',['filter' => 'auth']);
$routes->get('/dashboard/get-rekap-kunjungan', 'Home::rekapKunjungan');
$routes->get('/dashboard/get-grafik-kunjungan', 'Home::grafikKunjungan');
$routes->get('/rekam-medis', 'Home::rekamMedis',['filter' => 'auth']);
$routes->get('/rekam-medis/pendaftaran', 'Rekammedis::pendaftaran',['filter' => 'auth']);
$routes->get('/rekam-medis/pasien', 'Rekammedis::pasien',['filter' => 'auth']);
$routes->get('/rekam-medis/update-panggil', 'Rekammedis::updatePanggil');

$routes->get('/rekam-medis/tindakan', 'Master::tindakan',['filter' => 'auth']);
$routes->get('/rekam-medis/tindakan/tambah', 'Master::tambahTindakan',['filter' => 'auth']);
$routes->post('/rekam-medis/tindakan/tambah', 'Master::tambahTindakan',['filter' => 'auth']);
$routes->get('/rekam-medis/tindakan/ubah', 'Master::ubahTindakan',['filter' => 'auth']);
$routes->post('/rekam-medis/tindakan/ubah', 'Master::ubahTindakan',['filter' => 'auth']);
$routes->get('/rekam-medis/tindakan/hapus', 'Master::hapusTindakan',['filter' => 'auth']);
$routes->get('/pasien/cetak-kartu', 'Pasien::cetakKartu',['filter' => 'auth']);

$routes->get('/rekam-medis/pasien/tambah', 'Pasien::tambah',['filter' => 'auth']);
$routes->post('/rekam-medis/pasien/tambah', 'Pasien::tambah',['filter' => 'auth']);
$routes->get('/rekam-medis/pasien/hapus', 'Pasien::hapus',['filter' => 'auth']);
$routes->post('/rekam-medis/pasien/ubah', 'Pasien::ubah',['filter' => 'auth']);

$routes->get('/rekam-medis/pendaftaran/tambah', 'Rekammedis::tambahPendaftaran',['filter' => 'auth']);
$routes->post('/rekam-medis/pendaftaran/tambah', 'Rekammedis::tambahPendaftaran',['filter' => 'auth']);
$routes->get('/rekam-medis/pendaftaran/hapus', 'Rekammedis::hapusPendaftaran',['filter' => 'auth']);
$routes->get('/rekam-medis/pendaftaran/get-pasien', 'Rekammedis::dataPasien',['filter' => 'auth']);
$routes->get('/rekam-medis/pendaftaran/cetak-antrian', 'Rekammedis::cetakAntrian',['filter' => 'auth']);
$routes->get('/rekam-medis/pendaftaran/ubah', 'Rekammedis::ubahPendaftaran',['filter' => 'auth']);
$routes->post('/rekam-medis/pendaftaran/ubah', 'Rekammedis::ubahPendaftaran',['filter' => 'auth']);

$routes->get('/rekam-medis/pasien-registrasi', 'Rekammedis::pasienRegistrasi',['filter' => 'auth']);
$routes->get('/rekam-medis/pemeriksaan', 'Rekammedis::pemeriksaan',['filter' => 'auth']);
$routes->get('/rekam-medis/get-kunjungan', 'Rekammedis::dataKunjungan');
$routes->get('/rekam-medis/modal-erm', 'Rekammedis::modalErm');
$routes->get('/rekam-medis/view', 'Rekammedis::viewPdf');

$routes->get('/diagnosa/get-icdx', 'Diagnosa::getIcdx');
$routes->get('/tindakan/get-tindakan', 'Master::getTindakan');

$routes->post('/rekam-medis/save-pemeriksaan-fisik', 'Pemeriksaan::savePemeriksaanFisik');
$routes->post('/rekam-medis/save-dokumen-penunjang', 'Pemeriksaan::saveDokument');

$routes->get('/farmasi', 'Home::farmasi',['filter' => 'auth']);
$routes->get('/farmasi/obat', 'Farmasi::obat',['filter' => 'auth']);
$routes->get('/farmasi/obat/tambah', 'Farmasi::tambahObat',['filter' => 'auth']);
$routes->post('/farmasi/obat/tambah', 'Farmasi::tambahObat',['filter' => 'auth']);
$routes->get('/farmasi/obat/hapus', 'Farmasi::hapusObat',['filter' => 'auth']);
$routes->get('/farmasi/obat/ubah', 'Farmasi::ubahObat',['filter' => 'auth']);
$routes->post('/farmasi/obat/ubah', 'Farmasi::ubahObat',['filter' => 'auth']);
$routes->get('/farmasi/obat/detail', 'Farmasi::detailObat',['filter' => 'auth']);
$routes->post('/farmasi/obat/detail', 'Farmasi::detailObat',['filter' => 'auth']);
$routes->get('/farmasi/obat-keluar', 'Farmasi::obatKeluar');
$routes->get('/farmasi/obat-keluar/export', 'Farmasi::exportObatKeluar');

$routes->get('/farmasi/supplier', 'Farmasi::supplier',['filter' => 'auth']);
$routes->get('/farmasi/supplier/tambah', 'Farmasi::tambahSupplier',['filter' => 'auth']);
$routes->post('/farmasi/supplier/tambah', 'Farmasi::tambahSupplier',['filter' => 'auth']);
$routes->get('/farmasi/supplier/ubah', 'Farmasi::ubahSupplier',['filter' => 'auth']);
$routes->post('/farmasi/supplier/ubah', 'Farmasi::ubahSupplier',['filter' => 'auth']);
$routes->get('/farmasi/supplier/hapus', 'Farmasi::hapusSupplier',['filter' => 'auth']);
$routes->get('/farmasi/supplier/get-supplier', 'Farmasi::getSupplier',['filter' => 'auth']);

$routes->get('/farmasi/resep', 'Farmasi::resep',['filter' => 'auth']);
$routes->get('/farmasi/resep/detail', 'Farmasi::detailResep',['filter' => 'auth']);
$routes->get('/farmasi/obat/data-obat', 'Farmasi::dataObat',['filter' => 'auth']);
$routes->get('/farmasi/obat/data-obat-pemeriksaan', 'Farmasi::dataObatPemeriksaan');
$routes->get('/farmasi/obat/export', 'Farmasi::exportObat',['filter' => 'auth']);
$routes->get('/farmasi/obat/hapus', 'Farmasi::hapusObat',['filter' => 'auth']);

$routes->post('/farmasi/resep/save-resep', 'Farmasi::inputResep',['filter' => 'auth']);
$routes->post('/farmasi/resep/save-resep-bebas', 'Farmasi::inputResepBebas',['filter' => 'auth']);
$routes->post('/farmasi/resep/update-resep-bebas', 'Farmasi::updateResepBebas',['filter' => 'auth']);
$routes->get('/farmasi/resep/cetak-label', 'Farmasi::cetakLabel',['filter' => 'auth']);

$routes->get('/farmasi/resep-bebas', 'Farmasi::resepBebas',['filter' => 'auth']);
$routes->get('/farmasi/resep-bebas/tambah', 'Farmasi::resepBebasTambah',['filter' => 'auth']);
$routes->get('/farmasi/resep-bebas/detail', 'Farmasi::detailResepBebas',['filter' => 'auth']);

$routes->get('/farmasi/obat-masuk', 'Farmasi::obatMasuk',['filter' => 'auth']);
$routes->get('/farmasi/obat-masuk/tambah', 'Farmasi::obatMasukTambah',['filter' => 'auth']);
$routes->post('/farmasi/obat-masuk/tambah', 'Farmasi::obatMasukTambah',['filter' => 'auth']);
$routes->get('/farmasi/obat-masuk/export', 'Farmasi::obatMasukExport',['filter' => 'auth']);

$routes->get('/keuangan', 'Home::keuangan',['filter' => 'auth']);
$routes->get('/keuangan/kasir', 'Keuangan::kasir',['filter' => 'auth']);
$routes->get('/keuangan/kasir/detail', 'Keuangan::detailInvoice',['filter' => 'auth']);
$routes->get('/kasir/invoice', 'Kasir::cetakInvoice',['filter' => 'auth']);
$routes->post('/keuangan/kasir/save-pembayaran', 'Keuangan::simpanPembayaran',['filter' => 'auth']);
$routes->post('/keuangan/kwitansi', 'Keuangan::kwitansi',['filter' => 'auth']);
$routes->get('/keuangan/laporan-keuangan', 'Keuangan::laporanKeuangan',['filter' => 'auth']);
$routes->get('/keuangan/detail-laporan-keuangan', 'Keuangan::detailLaporanKeuangan',['filter' => 'auth']);
$routes->get('/keuangan/laporan-keuangan/export', 'Keuangan::laporanKeuanganExport',['filter' => 'auth']);

$routes->get('/setting', 'Home::setting',['filter' => 'auth']);
$routes->get('/setting/buka-erm', 'Setting::dataErm',['filter' => 'auth']);
$routes->get('/setting/buka-erm/buka', 'Setting::bukaErm',['filter' => 'auth']);
$routes->get('/setting/informasi', 'Setting::informasi',['filter' => 'auth']);
$routes->post('/setting/informasi', 'Setting::informasi',['filter' => 'auth']);
$routes->get('/setting/poli', 'Setting::poli',['filter' => 'auth']);
$routes->get('/setting/poli/tambah', 'Setting::tambahPoli',['filter' => 'auth']);
$routes->post('/setting/poli/tambah', 'Setting::tambahPoli',['filter' => 'auth']);
$routes->get('/setting/poli/hapus', 'Setting::hapusPoli',['filter' => 'auth']);
$routes->get('/setting/poli/ubah', 'Setting::ubahPoli',['filter' => 'auth']);
$routes->post('/setting/poli/ubah', 'Setting::ubahPoli',['filter' => 'auth']);

$routes->get('/setting/unit', 'Setting::unit',['filter' => 'auth']);
$routes->get('/setting/unit/tambah', 'Setting::tambahUnit',['filter' => 'auth']);
$routes->post('/setting/unit/tambah', 'Setting::tambahUnit',['filter' => 'auth']);
$routes->get('/setting/unit/hapus', 'Setting::hapusUnit',['filter' => 'auth']);
$routes->get('/setting/unit/ubah', 'Setting::ubahUnit',['filter' => 'auth']);
$routes->post('/setting/unit/ubah', 'Setting::ubahUnit',['filter' => 'auth']);

$routes->get('/setting/pengguna', 'Setting::pengguna',['filter' => 'auth']);
$routes->get('/setting/pengguna/tambah', 'Setting::tambahPengguna',['filter' => 'auth']);
$routes->post('/setting/pengguna/tambah', 'Setting::tambahPengguna',['filter' => 'auth']);
$routes->get('/setting/pengguna/hapus', 'Setting::hapusPengguna',['filter' => 'auth']);
$routes->get('/setting/pengguna/ubah', 'Setting::ubahPengguna',['filter' => 'auth']);
$routes->post('/setting/pengguna/ubah', 'Setting::ubahPengguna',['filter' => 'auth']);

$routes->get('/setting/antrian', 'Setting::antrian');
$routes->get('/setting/antrian/non-aktif', 'Setting::nonaktifAntrian');
$routes->get('/setting/antrian/aktif', 'Setting::aktifAntrian');
$routes->get('/setting/antrian/reset', 'Setting::resetAntrian');

$routes->get('/hrd', 'Home::hrd',['filter' => 'auth']);
$routes->get('/hrd/karyawan', 'Hrd::karyawan',['filter' => 'auth']);
$routes->get('/hrd/karyawan/tambah', 'Hrd::tambahKaryawan',['filter' => 'auth']);
$routes->post('/hrd/karyawan/tambah', 'Hrd::tambahKaryawan',['filter' => 'auth']);
$routes->get('/hrd/karyawan/hapus', 'Hrd::hapusKaryawan',['filter' => 'auth']);
$routes->get('/hrd/karyawan/ubah', 'Hrd::ubahKaryawan',['filter' => 'auth']);
$routes->post('/hrd/karyawan/ubah', 'Hrd::ubahKaryawan',['filter' => 'auth']);

$routes->get('/antrian', 'Antrian::index');
$routes->get('/error/akses-error', 'Error::aksesError');

$routes->get('/keuangan/laporan-keuangan-2', 'Keuangan::laporanKeuangan2',['filter' => 'auth']);
$routes->get('/rekam-medis/pendaftaran/get-rm', 'Rekammedis::getRM');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
