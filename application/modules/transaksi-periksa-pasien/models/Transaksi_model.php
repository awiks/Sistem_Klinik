<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: No name
   Class Name 	: Transaksi_model*/

class Transaksi_model extends CI_Model
{

    public function __construct()
	{
		parent::__construct();
	}

	public function get_informasi()
	{
		$this->db->select('*');
		$this->db->from('tb_informasi_klinik');
		$this->db->where('id_informasi','1');

		return $this->db->get()->row();
	}

	public function truncate_temporary_table()
	{
		$query = $this->db->query("TRUNCATE TABLE tb_temporary_transaksi_periksa");

		return $query;
	}

	public function ajax_transaksi($bulan,$tahun)
	{

		if ( $bulan == 'all' ){

			$query = $this->db->query("SELECT tp.no_transaksi,dps.no_rekam_medik,dps.nama_pasien,
			                           d.nama_dokter,tp.biaya_layanan,tp.biaya_obat,tp.sub_total, 
			                           tp.id_transaksi_periksa FROM tb_transaksi_periksa tp 
				                       JOIN tb_daftar_periksa dp ON tp.id_daftar_periksa=dp.id_daftar_periksa
				                       JOIN tb_daftar_pasien dps ON dp.id_daftar_pasien=dps.id_daftar_pasien
				                       JOIN tb_detail_praktek dpk ON dp.id_detail_praktek=dpk.id_detail_praktek
				                       JOIN tb_dokter d ON dpk.id_dokter=d.id_dokter
				                       WHERE DATE_FORMAT(tp.tanggal_transaksi, '%Y')='$tahun'
				                       ORDER BY tp.tanggal_transaksi DESC");
		}
		else{

			$query = $this->db->query("SELECT tp.no_transaksi,dps.no_rekam_medik,dps.nama_pasien,
			                           d.nama_dokter,tp.biaya_layanan,tp.biaya_obat,tp.sub_total, 
			                           tp.id_transaksi_periksa FROM tb_transaksi_periksa tp 
				                       JOIN tb_daftar_periksa dp ON tp.id_daftar_periksa=dp.id_daftar_periksa
				                       JOIN tb_daftar_pasien dps ON dp.id_daftar_pasien=dps.id_daftar_pasien
				                       JOIN tb_detail_praktek dpk ON dp.id_detail_praktek=dpk.id_detail_praktek
				                       JOIN tb_dokter d ON dpk.id_dokter=d.id_dokter
				                       WHERE DATE_FORMAT(tp.tanggal_transaksi, '%Y')='$tahun' AND
				                       DATE_FORMAT(tp.tanggal_transaksi, '%c')='$bulan'
				                       ORDER BY tp.tanggal_transaksi DESC");
		}

		return $query->result();
	}

	public function check_kode_trans()
    {
      $query = $this->db->query("SELECT MAX(no_transaksi) as no_transaksi 
                               FROM tb_transaksi_periksa ORDER BY id_transaksi_periksa DESC");
      $hasil = $query->row();
      return $hasil->no_transaksi;
    }

	public function get_metode()
	{
		$this->db->select('*');
		$this->db->from('tb_metode_bayar');
		$this->db->where('status','0');
		return $this->db->get()->result();
	}

	public function tampil_discount_ppn()
	{
		$this->db->select('*');
		$this->db->from('tb_discount_ppn');
		$this->db->where('id_discount_ppn','1');
		return $this->db->get()->row();
	}

	public function modal_discount($id)
	{
	  if(empty($id)) show_404();
	  return $this->db->get_where('tb_discount_ppn', 
		                array('id_discount_ppn' => $id))->row();
	}

	public function perbarui_discount()
	{
	   $post = $this->security->xss_clean($this->input->post());
       $this->discount = $post['discount'];
       $this->ppn = $post['ppn'];
       return $this->db->update('tb_discount_ppn', $this, 
     	               array('sha1(id_discount_ppn)' => $post['id']));
	}

	public function select_regristrasi($q,$dt)
	{
		$query = $this->db->query("SELECT dp.id_daftar_periksa,dp.no_registrasi,
		                           dfp.nama_pasien FROM tb_daftar_periksa dp 
								   JOIN tb_daftar_pasien dfp ON dp.id_daftar_pasien=dfp.id_daftar_pasien
								   WHERE dp.status_daftar='1' AND dp.tanggal='$dt' AND 
								   ( dp.no_registrasi LIKE '%$q%' OR dfp.nama_pasien LIKE '%$q%' )
								   ORDER BY dp.id_daftar_pasien DESC LIMIT 20");
		
		$hasil = $query->result();
	    $json  = [];
	    foreach ( $hasil as $row ) {
	        
	        $json[] = ['id'  => $row->id_daftar_periksa,
	                   'text'=> $row->no_registrasi.' | '.ucwords($row->nama_pasien) ];
	    }

        return json_encode($json);
	}

	public function select_no_reg($no_reg)
	{
		$query = $this->db->query("SELECT dp.no_rekam_medik,dp.nama_pasien,p.nama_poliklinik,jp.id_poliklinik FROM tb_daftar_periksa dfp 
			                       JOIN tb_daftar_pasien dp ON dfp.id_daftar_pasien=dp.id_daftar_pasien
			                       JOIN tb_detail_praktek dtp ON dfp.id_detail_praktek=dtp.id_detail_praktek
			                       JOIN tb_jadwal_praktek jp ON dtp.id_jadwal=jp.id_jadwal
      	                           JOIN tb_poliklinik p ON jp.id_poliklinik=p.id_poliklinik
			                       WHERE dfp.id_daftar_periksa='$no_reg'");
		return $query->row();
	}

	public function select_side_obat($q)
	{
		$query = $this->db->query("SELECT b.*,s.* FROM tb_barang b 
								   JOIN tb_satuan s ON b.id_satuan=s.id_satuan
								   WHERE b.status='0' AND 
								   ( b.kode_barang LIKE '%$q%' OR b.nama_barang LIKE '%$q%' )
								   ORDER BY b.id_barang DESC LIMIT 20");
		
		$hasil = $query->result();
	    $json  = [];
	    foreach ( $hasil as $row ) {
	        
	        $json[] = ['id'  => $row->id_barang,
	                   'text'=> $row->kode_barang.' | '.ucwords($row->nama_barang) ];
	    }

        return json_encode($json);
	}

	public function select_obat($id)
	{
		$query = $this->db->query("SELECT jumlah_stok FROM tb_barang 
			                       WHERE id_barang='$id'");
		return $query->row();
	}

	public function select_layanan($poliklinik)
	{
		$query = $this->db->query("SELECT * FROM tb_layanan
			                       WHERE id_poliklinik='$poliklinik'");
		return $query->result();
	}

	public function select_jenis_layanan($layanan)
	{
		$query = $this->db->query("SELECT * FROM tb_layanan
			                       WHERE id_layanan='$layanan'");
		return $query->row();
	}

	public function simpan_temp_obat($array)
	{
		return $this->db->insert('tb_temporary_transaksi_periksa',$array);
	}

	public function edit($id)
	{
	  if(empty($id)) show_404();
	  return $this->db->get_where('tb_temporary_transaksi_periksa', 
		                array('sha1(id_temporary_transaksi_periksa)' => $id))->row();
	}

	public function tampil_data_obat($no_reg)
	{
		$query = $this->db->query("SELECT b.*,ttp.*,s.* 
			                       FROM tb_temporary_transaksi_periksa ttp 
			                       JOIN tb_barang b ON ttp.id_barang=b.id_barang
			                       JOIN tb_satuan s ON b.id_satuan=s.id_satuan
			                       WHERE ttp.id_daftar_periksa='$no_reg'");
		return $query->result();
	}

	public function delete(){
	  $id = $this->security->xss_clean($this->input->post('id'));
	  if(empty($id)) show_404();
   	  return $this->db->delete('tb_temporary_transaksi_periksa',
   	  	                array('sha1(id_temporary_transaksi_periksa)' => $id));
    }

	public function biaya_obat($no_reg)
	{
		$query = $this->db->query("SELECT sum(ttp.jumlah_obat * b.harga_jual) AS harga_jual 
			                       FROM tb_temporary_transaksi_periksa ttp 
			                       JOIN tb_barang b ON ttp.id_barang=b.id_barang
			                       WHERE ttp.id_daftar_periksa='$no_reg'");
		return $query->row();
	}

	public function select_metode($id_metode)
	{
		$query = $this->db->query("SELECT * FROM tb_metode_bayar
			                       WHERE id_metode='$id_metode'");
		return $query->row();
	}

	public function cetak($no_transaksi)
	{
		$query = $this->db->query("SELECT tp.*,l.deskripsi_layanan FROM tb_transaksi_periksa tp
								   JOIN tb_layanan l ON tp.id_layanan=l.id_layanan
			                       WHERE tp.no_transaksi='$no_transaksi'");

		return $query->row();
	}

	public function detail($detail)
	{
		$query = $this->db->query("SELECT tp.no_transaksi,dp.no_registrasi,dps.no_rekam_medik,dps.nama_pasien,
		                           d.nama_dokter,tp.biaya_layanan,tp.biaya_obat,tp.sub_total, 
		                           tp.tanggal_transaksi,l.deskripsi_layanan,tp.nama_poliklinik, 
		                           tp.id_transaksi_periksa,tp.diskon,tp.bayar,tp.nama_kasir FROM tb_transaksi_periksa tp 
			                       JOIN tb_daftar_periksa dp ON tp.id_daftar_periksa=dp.id_daftar_periksa
			                       JOIN tb_daftar_pasien dps ON dp.id_daftar_pasien=dps.id_daftar_pasien
			                       JOIN tb_detail_praktek dpk ON dp.id_detail_praktek=dpk.id_detail_praktek
			                       JOIN tb_dokter d ON dpk.id_dokter=d.id_dokter
			                       JOIN tb_layanan l ON tp.id_layanan=l.id_layanan
			                       WHERE sha1(tp.id_transaksi_periksa)='$detail'
");
		return $query->row();
	}
}