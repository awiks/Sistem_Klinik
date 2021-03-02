<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller'] = 'welcome';
$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*LOGIN*/
$route['login']                   = 'login/login';

/* INFORMASI KLINIK */
$route['informasi-klinik']                   = 'informasi-klinik/informasi_klinik';
$route['informasi-klinik/perbarui-satu']     = 'informasi-klinik/informasi_klinik/perbarui_satu';
$route['informasi-klinik/perbarui-dua']      = 'informasi-klinik/informasi_klinik/perbarui_dua';
$route['informasi-klinik/perbarui-tiga']     = 'informasi-klinik/informasi_klinik/perbarui_tiga';
$route['informasi-klinik/perbarui-empat']    = 'informasi-klinik/informasi_klinik/perbarui_empat';
$route['informasi-klinik/perbarui-lima']     = 'informasi-klinik/informasi_klinik/perbarui_lima';
$route['informasi-klinik/perbarui-enam']     = 'informasi-klinik/informasi_klinik/perbarui_enam';
$route['informasi-klinik/edit-satu/(:any)']  = 'informasi-klinik/informasi_klinik/edit_satu/$1';
$route['informasi-klinik/edit-dua/(:any)']   = 'informasi-klinik/informasi_klinik/edit_dua/$1';
$route['informasi-klinik/edit-tiga/(:any)']  = 'informasi-klinik/informasi_klinik/edit_tiga/$1';
$route['informasi-klinik/edit-empat/(:any)'] = 'informasi-klinik/informasi_klinik/edit_empat/$1';
$route['informasi-klinik/edit-lima/(:any)']  = 'informasi-klinik/informasi_klinik/edit_lima/$1';
$route['informasi-klinik/edit-enam/(:any)']  = 'informasi-klinik/informasi_klinik/edit_enam/$1';

/* METODE PEMBAYARAN */
$route['metode-pembayaran']       = 'metode-pembayaran/metode_pembayaran';
$route['metode-pembayaran/ajax']  = 'metode-pembayaran/metode_pembayaran/ajax';
$route['metode-pembayaran/modal_add']  = 'metode-pembayaran/metode_pembayaran/modal_add';
$route['metode-pembayaran/simpan']  = 'metode-pembayaran/metode_pembayaran/simpan';
$route['metode-pembayaran/modal_edit']  = 'metode-pembayaran/metode_pembayaran/modal_edit';
$route['metode-pembayaran/perbarui']  = 'metode-pembayaran/metode_pembayaran/perbarui';
$route['metode-pembayaran/delete']  = 'metode-pembayaran/metode_pembayaran/delete';
$route['metode-pembayaran/hapus']  = 'metode-pembayaran/metode_pembayaran/hapus';

/* KATEGORI KAMAR */
$route['kategori-kamar']       = 'kategori-kamar/kategori_kamar';
$route['kategori-kamar/ajax']       = 'kategori-kamar/kategori_kamar/ajax';
$route['kategori-kamar/modal_add']  = 'kategori-kamar/kategori_kamar/modal_add';
$route['kategori-kamar/modal_edit'] = 'kategori-kamar/kategori_kamar/modal_edit';
$route['kategori-kamar/delete']     = 'kategori-kamar/kategori_kamar/delete';
$route['kategori-kamar/hapus']      = 'kategori-kamar/kategori_kamar/hapus';
$route['kategori-kamar/simpan']     = 'kategori-kamar/kategori_kamar/simpan';
$route['kategori-kamar/perbarui']   = 'kategori-kamar/kategori_kamar/perbarui';


/* KAMAR */
$route['kamar']       = 'kamar/kamar';

/* ADMINISTRATOR */
$route['administrator']       = 'administrator/administrator';

/* SUPPLIER */
$route['supplier']            = 'supplier/supplier';
$route['supplier/ajax']       = 'supplier/supplier/ajax';
$route['supplier/modal_add']  = 'supplier/supplier/modal_add';
$route['supplier/modal_edit'] = 'supplier/supplier/modal_edit';
$route['supplier/delete']     = 'supplier/supplier/delete';
$route['supplier/hapus']      = 'supplier/supplier/hapus';
$route['supplier/simpan']     = 'supplier/supplier/simpan';
$route['supplier/perbarui']   = 'supplier/supplier/perbarui';

/* SATUAN */
$route['satuan']              = 'satuan/satuan';
$route['satuan/ajax']         = 'satuan/satuan/ajax';
$route['satuan/modal_add']    = 'satuan/satuan/modal_add';
$route['satuan/modal_edit']   = 'satuan/satuan/modal_edit';
$route['satuan/delete']       = 'satuan/satuan/delete';
$route['satuan/hapus']        = 'satuan/satuan/hapus';
$route['satuan/simpan']       = 'satuan/satuan/simpan';
$route['satuan/perbarui']     = 'satuan/satuan/perbarui';

/* KATEGORI */
$route['kategori-obat']            = 'kategori-obat/kategori_obat';
$route['kategori-obat/ajax']       = 'kategori-obat/kategori_obat/ajax';
$route['kategori-obat/modal_add']  = 'kategori-obat/kategori_obat/modal_add';
$route['kategori-obat/modal_edit'] = 'kategori-obat/kategori_obat/modal_edit';
$route['kategori-obat/delete']     = 'kategori-obat/kategori_obat/delete';
$route['kategori-obat/hapus']      = 'kategori-obat/kategori_obat/hapus';
$route['kategori-obat/simpan']     = 'kategori-obat/kategori_obat/simpan';
$route['kategori-obat/perbarui']   = 'kategori-obat/kategori_obat/perbarui';

/* DATA OBAT */
$route['data-obat'] = 'data-obat/data_obat';
$route['data-obat/ajax'] = 'data-obat/data_obat/ajax';
$route['data-obat/modal_add'] = 'data-obat/data_obat/modal_add';
$route['data-obat/modal_edit'] = 'data-obat/data_obat/modal_edit';
$route['data-obat/delete'] = 'data-obat/data_obat/delete';
$route['data-obat/hapus'] = 'data-obat/data_obat/hapus';
$route['data-obat/simpan'] = 'data-obat/data_obat/simpan';
$route['data-obat/perbarui'] = 'data-obat/data_obat/perbarui';

/* STOK OBAT */
$route['stok-obat'] = 'stok-obat/stok_obat';
$route['stok-obat/ajax'] = 'stok-obat/stok_obat/ajax';
$route['stok-obat/modal_edit'] = 'stok-obat/stok_obat/modal_edit';
$route['stok-obat/simpan'] = 'stok-obat/stok_obat/simpan';
$route['stok-obat/perbarui'] = 'stok-obat/stok_obat/perbarui';
$route['stok-obat/stok-masuk'] = 'stok-obat/stok_obat/stok_masuk';
$route['stok-obat/add-obat-masuk'] = 'stok-obat/stok_obat/add_obat_masuk';
$route['stok-obat/ajax-stok-masuk'] = 'stok-obat/stok_obat/ajax_stok_masuk';
$route['stok-obat/select_side_supplier'] = 'stok-obat/stok_obat/select_side_supplier';
$route['stok-obat/select_side_obat'] = 'stok-obat/stok_obat/select_side_obat';
$route['stok-obat/ajax_add_data'] = 'stok-obat/stok_obat/ajax_add_data';
$route['stok-obat/add_data'] = 'stok-obat/stok_obat/add_data';
$route['stok-obat/simpan_add_data'] = 'stok-obat/stok_obat/simpan_add_data';
$route['stok-obat/det-stok/(:any)'] = 'stok-obat/stok_obat/det_stok/$1';
$route['stok-obat/delete'] = 'stok-obat/stok_obat/delete';
$route['stok-obat/hapus'] = 'stok-obat/stok_obat/hapus';
$route['stok-obat/modal_edit_add'] = 'stok-obat/stok_obat/modal_edit_add';
$route['stok-obat/perbarui_add'] = 'stok-obat/stok_obat/perbarui_add';





/* DOKTER JAGA */
$route['dokter-jaga'] = 'dokter-jaga/dokter_jaga';
$route['dokter-jaga/tampil_data'] = 'dokter-jaga/dokter_jaga/tampil_data';
$route['dokter-jaga/modal_add'] = 'dokter-jaga/dokter_jaga/modal_add';
$route['dokter-jaga/simpan'] = 'dokter-jaga/dokter_jaga/simpan';
$route['dokter-jaga/delete'] = 'dokter-jaga/dokter_jaga/delete';
$route['dokter-jaga/hapus'] = 'dokter-jaga/dokter_jaga/hapus';

$route['dokter-jaga/modal_add_jadwal'] = 'dokter-jaga/dokter_jaga/modal_add_jadwal';
$route['dokter-jaga/simpan_add_jadwal'] = 'dokter-jaga/dokter_jaga/simpan_add_jadwal';
$route['dokter-jaga/edit_jadwal'] = 'dokter-jaga/dokter_jaga/edit_jadwal';
$route['dokter-jaga/perbarui_jadwal'] = 'dokter-jaga/dokter_jaga/perbarui_jadwal';
$route['dokter-jaga/perbarui_edit_jadwal'] = 'dokter-jaga/dokter_jaga/perbarui_edit_jadwal';

$route['dokter-jaga/delete_jadwal'] = 'dokter-jaga/dokter_jaga/delete_jadwal';
$route['dokter-jaga/hapus_jadwal'] = 'dokter-jaga/dokter_jaga/hapus_jadwal';

$route['dokter-jaga/dokter'] = 'dokter-jaga/dokter_jaga/dokter';
$route['dokter-jaga/ajax_dokter'] = 'dokter-jaga/dokter_jaga/ajax_dokter';
$route['dokter-jaga/modal_add_dokter'] = 'dokter-jaga/dokter_jaga/modal_add_dokter';
$route['dokter-jaga/simpan_dokter'] = 'dokter-jaga/dokter_jaga/simpan_dokter';
$route['dokter-jaga/modal_edit_dokter'] = 'dokter-jaga/dokter_jaga/modal_edit_dokter';
$route['dokter-jaga/perbarui_dokter'] = 'dokter-jaga/dokter_jaga/perbarui_dokter';
$route['dokter-jaga/delete_dokter'] = 'dokter-jaga/dokter_jaga/delete_dokter';
$route['dokter-jaga/hapus_dokter'] = 'dokter-jaga/dokter_jaga/hapus_dokter';

$route['dokter-jaga/poliklinik'] = 'dokter-jaga/dokter_jaga/poliklinik';
$route['dokter-jaga/ajax_poliklinik'] = 'dokter-jaga/dokter_jaga/ajax_poliklinik';
$route['dokter-jaga/modal_add_poliklinik'] = 'dokter-jaga/dokter_jaga/modal_add_poliklinik';
$route['dokter-jaga/simpan_poliklinik'] = 'dokter-jaga/dokter_jaga/simpan_poliklinik';
$route['dokter-jaga/modal_edit_poliklinik'] = 'dokter-jaga/dokter_jaga/modal_edit_poliklinik';
$route['dokter-jaga/perbarui_poliklinik'] = 'dokter-jaga/dokter_jaga/perbarui_poliklinik';
$route['dokter-jaga/delete_poliklinik'] = 'dokter-jaga/dokter_jaga/delete_poliklinik';
$route['dokter-jaga/hapus_poliklinik'] = 'dokter-jaga/dokter_jaga/hapus_poliklinik';

$route['dokter-jaga/layanan'] = 'dokter-jaga/dokter_jaga/layanan';
$route['dokter-jaga/ajax_layanan'] = 'dokter-jaga/dokter_jaga/ajax_layanan';
$route['dokter-jaga/modal_add_layanan'] = 'dokter-jaga/dokter_jaga/modal_add_layanan';
$route['dokter-jaga/simpan_layanan'] = 'dokter-jaga/dokter_jaga/simpan_layanan';
$route['dokter-jaga/modal_edit_layanan'] = 'dokter-jaga/dokter_jaga/modal_edit_layanan';
$route['dokter-jaga/perbarui_layanan'] = 'dokter-jaga/dokter_jaga/perbarui_layanan';
$route['dokter-jaga/delete_layanan'] = 'dokter-jaga/dokter_jaga/delete_layanan';
$route['dokter-jaga/hapus_layanan'] = 'dokter-jaga/dokter_jaga/hapus_layanan';

/* REGISTRASI PENDAFTARAN */
$route['registrasi-periksa-pasien'] = 'registrasi-periksa-pasien/registrasi_pendaftaran';
$route['registrasi-periksa-pasien/tampil_antrian'] = 'registrasi-periksa-pasien/registrasi_pendaftaran/tampil_antrian';
$route['registrasi-periksa-pasien/check_jadwal'] = 'registrasi-periksa-pasien/registrasi_pendaftaran/check_jadwal';
$route['registrasi-periksa-pasien/select_jadwal'] = 'registrasi-periksa-pasien/registrasi_pendaftaran/select_jadwal';
$route['registrasi-periksa-pasien/add_lama'] = 'registrasi-periksa-pasien/registrasi_pendaftaran/add_lama';
$route['registrasi-periksa-pasien/add_baru'] = 'registrasi-periksa-pasien/registrasi_pendaftaran/add_baru';
$route['registrasi-periksa-pasien/select_side_pasien'] = 'registrasi-periksa-pasien/registrasi_pendaftaran/select_side_pasien';
$route['registrasi-periksa-pasien/simpan_lama'] = 'registrasi-periksa-pasien/registrasi_pendaftaran/simpan_lama';

$route['registrasi-periksa-pasien/selected_poli'] = 'registrasi-periksa-pasien/registrasi_pendaftaran/selected_poli';
$route['registrasi-periksa-pasien/simpan_baru'] = 'registrasi-periksa-pasien/registrasi_pendaftaran/simpan_baru';
$route['registrasi-periksa-pasien/ajax_jadwal'] = 'registrasi-periksa-pasien/registrasi_pendaftaran/ajax_jadwal';
$route['registrasi-periksa-pasien/modal_proses'] = 'registrasi-periksa-pasien/registrasi_pendaftaran/modal_proses';
$route['registrasi-periksa-pasien/proses_btn'] = 'registrasi-periksa-pasien/registrasi_pendaftaran/proses_btn';
$route['registrasi-periksa-pasien/pending_btn'] = 'registrasi-periksa-pasien/registrasi_pendaftaran/pending_btn';
$route['registrasi-periksa-pasien/cancel_btn'] = 'registrasi-periksa-pasien/registrasi_pendaftaran/cancel_btn';
$route['registrasi-periksa-pasien/cetak/(:any)'] = 'registrasi-periksa-pasien/registrasi_pendaftaran/cetak/$1';
$route['registrasi-periksa-pasien/barcode/(:any)'] = 'registrasi-periksa-pasien/registrasi_pendaftaran/barcode/$1';

/* DAFTAR PASIEN */
$route['daftar-pasien'] = 'daftar-pasien/daftar_pasien';
$route['daftar-pasien/ajax'] = 'daftar-pasien/daftar_pasien/ajax';
$route['daftar-pasien/add'] = 'daftar-pasien/daftar_pasien/add';
$route['daftar-pasien/simpan'] = 'daftar-pasien/daftar_pasien/simpan';
$route['daftar-pasien/detail'] = 'daftar-pasien/daftar_pasien/detail';
$route['daftar-pasien/perbarui'] = 'daftar-pasien/daftar_pasien/perbarui';
$route['daftar-pasien/cetak/(:any)'] = 'daftar-pasien/daftar_pasien/cetak/$1';

/* PASIEN RAWAT INAP */
$route['pasien-rawat-inap'] = 'pasien-rawat-inap/pasien_rawat_inap';




/* TRANSAKSI */
$route['transaksi-periksa-pasien'] = 'transaksi-periksa-pasien/transaksi';
$route['transaksi-periksa-pasien/ajax'] = 'transaksi-periksa-pasien/transaksi/ajax';
$route['transaksi-periksa-pasien/add'] = 'transaksi-periksa-pasien/transaksi/add';
$route['transaksi-periksa-pasien/modal_discount'] = 'transaksi-periksa-pasien/transaksi/modal_discount';
$route['transaksi-periksa-pasien/perbarui_discount'] = 'transaksi-periksa-pasien/transaksi/perbarui_discount';
$route['transaksi-periksa-pasien/tampil_discount_ppn'] = 'transaksi-periksa-pasien/transaksi/tampil_discount_ppn';
$route['transaksi-periksa-pasien/select_regristrasi'] = 'transaksi-periksa-pasien/transaksi/select_regristrasi';
$route['transaksi-periksa-pasien/select_no_reg'] = 'transaksi-periksa-pasien/transaksi/select_no_reg';
$route['transaksi-periksa-pasien/select_layanan'] = 'transaksi-periksa-pasien/transaksi/select_layanan';
$route['transaksi-periksa-pasien/select_jenis_layanan'] = 'transaksi-periksa-pasien/transaksi/select_jenis_layanan';
$route['transaksi-periksa-pasien/select_side_obat'] = 'transaksi-periksa-pasien/transaksi/select_side_obat';
$route['transaksi-periksa-pasien/select_obat'] = 'transaksi-periksa-pasien/transaksi/select_obat';
$route['transaksi-periksa-pasien/tampil_data_obat'] = 'transaksi-periksa-pasien/transaksi/tampil_data_obat';
$route['transaksi-periksa-pasien/simpan_temp_obat'] = 'transaksi-periksa-pasien/transaksi/simpan_temp_obat';
$route['transaksi-periksa-pasien/modal_del'] = 'transaksi-periksa-pasien/transaksi/modal_del';
$route['transaksi-periksa-pasien/hapus'] = 'transaksi-periksa-pasien/transaksi/hapus';
$route['transaksi-periksa-pasien/modal_edit'] = 'transaksi-periksa-pasien/transaksi/modal_edit';
$route['transaksi-periksa-pasien/perbarui'] = 'transaksi-periksa-pasien/transaksi/perbarui';
$route['transaksi-periksa-pasien/biaya_obat'] = 'transaksi-periksa-pasien/transaksi/biaya_obat';
$route['transaksi-periksa-pasien/select_metode'] = 'transaksi-periksa-pasien/transaksi/select_metode';
$route['transaksi-periksa-pasien/simpan_trans'] = 'transaksi-periksa-pasien/transaksi/simpan_trans';
$route['transaksi-periksa-pasien/cetak/(:any)'] = 'transaksi-periksa-pasien/transaksi/cetak/$1';
$route['transaksi-periksa-pasien/detail/(:any)'] = 'transaksi-periksa-pasien/transaksi/detail/$1';