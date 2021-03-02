<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/* Author 		: No name
   Class Name 	: Registrasi_pendaftaran_model*/

class Registrasi_pendaftaran_model extends CI_Model
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

	public function get_jadwal($tanggal)
	{
      $query = $this->db->query("SELECT jp.*,p.* FROM tb_detail_praktek dp
      	                         JOIN tb_jadwal_praktek jp ON dp.id_jadwal=jp.id_jadwal
      	                         JOIN tb_poliklinik p ON jp.id_poliklinik=p.id_poliklinik
      	                         WHERE jp.tanggal_praktek='$tanggal'
      	                         AND dp.status='0' AND jp.status='0' 
                                 GROUP BY jp.id_poliklinik
      	                         ORDER BY jp.id_jadwal ASC");

      return $query;
	}

	public function check_kode()
  {
      $query = $this->db->query("SELECT MAX(no_rekam_medik) as no_rekam_medik 
      	                       FROM tb_daftar_pasien ORDER BY id_daftar_pasien DESC");
      $hasil = $query->row();
      return $hasil->no_rekam_medik;
  }

    public function selected_poli($id_jadwal)
    {
        $time_now = date('H:i');
        
    	$query = $this->db->query("SELECT dp.*,d.* FROM tb_detail_praktek dp
			                       JOIN tb_dokter d ON dp.id_dokter=d.id_dokter
			                       WHERE dp.id_jadwal='$id_jadwal' AND dp.status='0' 
                             AND dp.jam_end > '$time_now' ORDER BY dp.jam_start ASC");

    	return $query->result();
    }

    public function insert_daftar_baru($array)
    {
    	return $this->db->insert('tb_daftar_pasien', $array);
    }

    public function ajax_jadwal($tanggal,$jadwal)
    {

    	if ( $jadwal == 'all' ){

    		$query = $this->db->query("SELECT dp.*,dps.*,dtp.*,p.nama_poliklinik,d.nama_dokter FROM tb_daftar_periksa dp 
    		                       JOIN tb_daftar_pasien dps ON dp.id_daftar_pasien=dps.id_daftar_pasien
    		                       JOIN tb_detail_praktek dtp ON dp.id_detail_praktek=dtp.id_detail_praktek
    		                       JOIN tb_dokter d ON dtp.id_dokter=d.id_dokter
                                   JOIN tb_jadwal_praktek jp ON dtp.id_jadwal=jp.id_jadwal
                                   JOIN tb_poliklinik p ON jp.id_poliklinik=p.id_poliklinik
                                   WHERE dp.tanggal='$tanggal'");
    	}
    	else{

    		$query = $this->db->query("SELECT dp.*,dps.*,dtp.*,p.nama_poliklinik,d.nama_dokter FROM tb_daftar_periksa dp 
    		                       JOIN tb_daftar_pasien dps ON dp.id_daftar_pasien=dps.id_daftar_pasien
    		                       JOIN tb_detail_praktek dtp ON dp.id_detail_praktek=dtp.id_detail_praktek
    		                       JOIN tb_dokter d ON dtp.id_dokter=d.id_dokter
                                   JOIN tb_jadwal_praktek jp ON dtp.id_jadwal=jp.id_jadwal
                                   JOIN tb_poliklinik p ON jp.id_poliklinik=p.id_poliklinik
                                   WHERE dp.tanggal='$tanggal' AND dp.id_detail_praktek='$jadwal'");
    	}
    	

    	return $query->result();
    }

    public function select_jadwal($tanggal)
    {
        $time_now = date('H:i');

    	$query = $this->db->query("SELECT dp.*,d.*,p.nama_poliklinik FROM tb_detail_praktek dp
    		                       JOIN tb_jadwal_praktek jp ON dp.id_jadwal=jp.id_jadwal
			                       JOIN tb_poliklinik p ON jp.id_poliklinik=p.id_poliklinik
			                       JOIN tb_dokter d ON dp.id_dokter=d.id_dokter
			                       WHERE jp.tanggal_praktek='$tanggal' AND dp.status='0' AND dp.jam_end > '$time_now'
                                   ORDER BY dp.jam_start ASC");

    	return $query->result();
    }

    public function cetak($id)
    {
    	$query = $this->db->query("SELECT dp.*,p.nama_poliklinik FROM tb_daftar_periksa dp 
    		                      JOIN tb_detail_praktek dtp ON dp.id_detail_praktek=dtp.id_detail_praktek
    		                      JOIN tb_jadwal_praktek jp ON dtp.id_jadwal=jp.id_jadwal
    		                      JOIN tb_poliklinik p ON jp.id_poliklinik=p.id_poliklinik
    		                      WHERE sha1(dp.id_daftar_periksa)='$id'");

    	return $query->row();
    }

    public function select_side_pasien($q)
    {
      $query = $this->db->query("SELECT * FROM tb_daftar_pasien 
                                 WHERE ( no_rekam_medik LIKE '%$q%' OR nama_pasien LIKE '%$q%' ) 
                                   ORDER BY no_rekam_medik DESC LIMIT 30");
      $hasil = $query->result();
      $json  = [];
      foreach ( $hasil as $row ) {
        
        $json[] = ['id'  => $row->id_daftar_pasien,
                   'text'=> $row->no_rekam_medik.' | '.ucwords($row->nama_pasien) ];
      }

      return json_encode($json);
    }

  public function check_kode_reg()
  {
      $query = $this->db->query("SELECT MAX(no_registrasi) as no_registrasi 
                               FROM tb_daftar_periksa ORDER BY id_daftar_periksa DESC");
      $hasil = $query->row();
      return $hasil->no_registrasi;
  }

  public function proses_btn($id){

     $this->status_daftar    = '1';
     return $this->db->update('tb_daftar_periksa', $this, 
                     array('sha1(id_daftar_periksa)' => $id));
  }

  public function pending_btn($id){

     $this->status_daftar    = '2';
     return $this->db->update('tb_daftar_periksa', $this, 
                     array('sha1(id_daftar_periksa)' => $id));
  }

  public function cancel_btn($id){

     $this->status_daftar    = '0';
     return $this->db->update('tb_daftar_periksa', $this, 
                     array('sha1(id_daftar_periksa)' => $id));
  }


}

