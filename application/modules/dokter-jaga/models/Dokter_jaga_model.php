<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/* Author 		: No name
   Class Name 	: Dokter_jaga_model*/

class Dokter_jaga_model extends CI_Model
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

	public function get_jadwal_praktek($tanggal)
	{
		$this->db->select('*');
		$this->db->from('tb_jadwal_praktek');
		$this->db->join('tb_poliklinik','tb_jadwal_praktek.id_poliklinik=tb_poliklinik.id_poliklinik');
		$this->db->where('tb_jadwal_praktek.tanggal_praktek',$tanggal);
		$this->db->where('tb_jadwal_praktek.status','0');
		$this->db->order_by('tb_jadwal_praktek.id_jadwal','ASC');

		return $this->db->get()->result();
	}

	public function insert($data)
	{
       return $this->db->insert('tb_jadwal_praktek', $data);
	}

	public function delete()
	{
	  $id = $this->security->xss_clean($this->input->post('id'));
	  if(empty($id)) show_404();
	                  $this->status = '1';
   	  $del_jadwal =  $this->db->update('tb_jadwal_praktek',$this,
   	  	                array('sha1(id_jadwal)' => $id));
   	  				 $this->status = '1';
   	  $del_detail =  $this->db->update('tb_detail_praktek',$this,
   	  	                array('sha1(id_jadwal)' => $id));

   	  return $del_jadwal && $del_detail;
	}

	public function edit_jadwal($id)
	{
	  if(empty($id)) show_404();
	  return $this->db->get_where('tb_detail_praktek', 
		                array('sha1(id_detail_praktek)' => $id))->row();
	}

	public function update_detail()
	{
		$post = $this->security->xss_clean($this->input->post());
        $this->id_dokter    = $post['id_dokter'];
        $this->deskripsi_jadwal    = $post['deskripsi_jadwal'];
        $this->jam_start    = $post['jam_start'];
        $this->jam_end    = $post['jam_end'];
        return $this->db->update('tb_detail_praktek', $this, 
     	               array('sha1(id_detail_praktek)' => $post['id']));
	}

	/* BAGIAN DETAIL */

	public function insert_add_jadwal($data)
	{
       return $this->db->insert('tb_detail_praktek', $data);
	}

	public function delete_jadwal()
	{
	  $id = $this->security->xss_clean($this->input->post('id'));
	  if(empty($id)) show_404();
	         $this->status = '1';
   	  return $this->db->update('tb_detail_praktek',$this,
   	  	                array('sha1(id_detail_praktek)' => $id));
	}


	/* BAGIAN DOKTER */

	public function get_dokter($urutan)
	{
		$this->db->select('*');
		$this->db->from('tb_dokter');
		$this->db->order_by('id_dokter',$urutan);
		$this->db->where('status','0');

		return $this->db->get()->result();
	}

	public function insert_dokter($data)
	{
       return $this->db->insert('tb_dokter', $data);
	}

	public function edit_dokter($id)
	{
	  if(empty($id)) show_404();
	  return $this->db->get_where('tb_dokter', 
		                array('sha1(id_dokter)' => $id))->row();
	}

	public function update_dokter(){

	 $post = $this->security->xss_clean($this->input->post());
     $this->nama_dokter    = $post['nama_dokter'];
     $this->jenis_kelamin    = $post['jenis_kelamin'];
     $this->tempat_lahir    = $post['tempat_lahir'];
     $this->tanggal_lahir    = date('Y-m-d',strtotime($post['tanggal_lahir']));
     $this->alamat    = $post['alamat'];
     $this->no_telepon    = $post['no_telepon'];
     $this->deskripsi    = $post['deskripsi'];

     return $this->db->update('tb_dokter', $this, 
     	               array('sha1(id_dokter)' => $post['id']));
	}

	public function delete_dokter(){
	  $id = $this->security->xss_clean($this->input->post('id'));
	  if(empty($id)) show_404();
	  $this->status         = '1';
   	  return $this->db->update('tb_dokter',$this,
   	  	                array('sha1(id_dokter)' => $id));
    }

	/* END BAGIAN DOKTER */

	/* BAGIAN POLIKLINIK */

	public function get_poliklinik($urutan)
	{
		$this->db->select('*');
		$this->db->from('tb_poliklinik');
		$this->db->order_by('id_poliklinik',$urutan);
		$this->db->where('status','0');

		return $this->db->get()->result();
	}

	public function insert_poliklinik($data)
	{
       return $this->db->insert('tb_poliklinik', $data);
	}

	public function edit_poliklinik($id)
	{
	  if(empty($id)) show_404();
	  return $this->db->get_where('tb_poliklinik', 
		                array('sha1(id_poliklinik)' => $id))->row();
	}

	public function update_poliklinik(){

	 $post = $this->security->xss_clean($this->input->post());
     $this->nama_poliklinik    = $post['nama_poliklinik'];
     return $this->db->update('tb_poliklinik', $this, 
     	               array('sha1(id_poliklinik)' => $post['id']));
	}

	public function delete_poliklinik(){
	  $id = $this->security->xss_clean($this->input->post('id'));
	  if(empty($id)) show_404();
	  $this->status         = '1';
   	  return $this->db->update('tb_poliklinik',$this,
   	  	                array('sha1(id_poliklinik)' => $id));
    }

    /* END POLIKLINIK */

    /* BAGIAN LAYANAN */

    public function get_layanan($urutan)
    {
    	$this->db->select('p.*,l.*');
		$this->db->from('tb_layanan l');
		$this->db->join('tb_poliklinik p','l.id_poliklinik=p.id_poliklinik');
		$this->db->order_by('l.id_layanan',$urutan);
		$this->db->where('l.status','0');

		return $this->db->get()->result();
    }

    public function insert_layanan($array)
    {
    	return $this->db->insert('tb_layanan', $array);
    }

    public function edit_layanan($id)
    {
    	if(empty($id)) show_404();
	    return $this->db->get_where('tb_layanan', 
		                array('sha1(id_layanan)' => $id))->row();
    }

    public function update_layanan(){

	 $post = $this->security->xss_clean($this->input->post());
     $this->id_poliklinik    = $post['id_poliklinik'];
     $this->deskripsi_layanan= $post['deskripsi_layanan'];
     $this->harga_layanan    = str_replace (',','',$post['harga_layanan']);
     return $this->db->update('tb_layanan', $this, 
     	               array('sha1(id_layanan)' => $post['id']));
	}

	public function delete_layanan(){
	  $id = $this->security->xss_clean($this->input->post('id'));
	  if(empty($id)) show_404();
	  $this->status         = '1';
   	  return $this->db->update('tb_layanan',$this,
   	  	                array('sha1(id_layanan)' => $id));
    }
}