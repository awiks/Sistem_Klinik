<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: No name
   Class Name 	: Metode_pembayaran_model*/

class Metode_pembayaran_model extends CI_Model
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

	public function get_metode($urutan)
	{
		$this->db->select('*');
		$this->db->from('tb_metode_bayar');
		$this->db->order_by('id_metode',$urutan);
		$this->db->where('status','0');

		return $this->db->get()->result();
	}

	public function insert($data)
	{
       return $this->db->insert('tb_metode_bayar', $data);
	}

	public function edit($id)
	{
	  if(empty($id)) show_404();
	  return $this->db->get_where('tb_metode_bayar', 
		                array('sha1(id_metode)' => $id))->row();
	}

	public function update(){

	 $post = $this->security->xss_clean($this->input->post());
     $this->deskripsi   = $post['deskripsi'];
     $this->title_label   = $post['title_label'];
     $this->status_form = $post['status_form'];
     return $this->db->update('tb_metode_bayar', $this, 
     	               array('sha1(id_metode)' => $post['id']));
	}

	public function delete(){
	  $id = $this->security->xss_clean($this->input->post('id'));
	  if(empty($id)) show_404();
	  $this->status         = '1';
   	  return $this->db->update('tb_metode_bayar',$this,
   	  	                array('sha1(id_metode)' => $id));
    }
}