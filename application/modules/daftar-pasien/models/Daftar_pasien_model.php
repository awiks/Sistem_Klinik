<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: No name
   Class Name 	: Daftar_pasien_model*/

class Daftar_pasien_model extends CI_Model
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

	public function get_daftar_pasien()
	{
		$this->db->select('*');
		$this->db->from('tb_daftar_pasien');
		$this->db->order_by('id_daftar_pasien','DESC');

		return $this->db->get()->result();
	}

	public function get_cetak($id)
	{
		$this->db->select('*');
		$this->db->from('tb_daftar_pasien');
		$this->db->where('sha1(id_daftar_pasien)',$id);

		return $this->db->get()->row();
	}

	public function check_kode()
   {
      $query = $this->db->query("SELECT MAX(no_rekam_medik) as no_rekam_medik 
      	                       FROM tb_daftar_pasien ORDER BY id_daftar_pasien DESC");
      $hasil = $query->row();
      return $hasil->no_rekam_medik;
   }

   public function insert($data)
   {
	  return $this->db->insert('tb_daftar_pasien', $data);
   }

    public function detail($id)
    {
	  if(empty($id)) show_404();
	  return $this->db->get_where('tb_daftar_pasien', 
		                array('sha1(id_daftar_pasien)' => $id))->row();
    }

    public function update(){

	 $post = $this->security->xss_clean($this->input->post());
	 $this->nama_pasien    = $post['nama_pasien'];
	 $this->tanggal_lahir  = date('Y-m-d',strtotime($post['tanggal_lahir']));
	 $this->jenis_kelamin  = $post['jenis_kelamin'];
	 $this->golongan_darah = $post['golongan_darah'];
	 $this->alamat_pasien  = $post['alamat_pasien'];
	 $this->no_telepon     = $post['no_telepon'];
	 return $this->db->update('tb_daftar_pasien', $this, 
	 	               array('sha1(id_daftar_pasien)' => $post['id']));
	}

}