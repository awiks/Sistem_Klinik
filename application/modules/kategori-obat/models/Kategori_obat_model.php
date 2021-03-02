<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/* Author 		: No name
   Class Name 	: Kategori_obat_model*/

class Kategori_obat_model extends CI_Model
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

	public function get_kategori($urutan)
	{
		$this->db->select('*');
		$this->db->from('tb_kategori');
		$this->db->order_by('id_kategori',$urutan);
		$this->db->where('status','0');

		return $this->db->get()->result();
	}

	public function insert($data)
	{
       return $this->db->insert('tb_kategori', $data);
	}

	public function edit($id)
	{
	  if(empty($id)) show_404();
	  return $this->db->get_where('tb_kategori', 
		                array('sha1(id_kategori)' => $id))->row();
	}

	public function update(){

	 $post = $this->security->xss_clean($this->input->post());
     $this->nama_kategori    = $post['nama_kategori'];
     return $this->db->update('tb_kategori', $this, 
     	               array('sha1(id_kategori)' => $post['id']));
	}

	public function delete(){
	  $id = $this->security->xss_clean($this->input->post('id'));
	  if(empty($id)) show_404();
	  $this->status   = '1';
   	  return $this->db->update('tb_kategori',$this, 
   	  	                array('sha1(id_kategori)' => $id));
    }
}