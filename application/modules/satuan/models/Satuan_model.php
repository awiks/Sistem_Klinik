<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: No name
   Class Name 	: Satuan_model*/

class Satuan_model extends CI_Model
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

	public function get_satuan($urutan)
	{
		$this->db->select('*');
		$this->db->from('tb_satuan');
		$this->db->order_by('id_satuan',$urutan);
		$this->db->where('status','0');

		return $this->db->get()->result();
	}

	public function insert($data)
	{
       return $this->db->insert('tb_satuan', $data);
	}

	public function edit($id)
	{
	  if(empty($id)) show_404();
	  return $this->db->get_where('tb_satuan', 
		                array('sha1(id_satuan)' => $id))->row();
	}

	public function update(){

	 $post = $this->security->xss_clean($this->input->post());
     $this->nama_satuan    = $post['nama_satuan'];
     return $this->db->update('tb_satuan', $this, 
     	               array('sha1(id_satuan)' => $post['id']));
	}

	public function delete(){
	  $id = $this->security->xss_clean($this->input->post('id'));
	  if(empty($id)) show_404();
	  $this->status         = '1';
   	  return $this->db->update('tb_satuan',$this,
   	  	                array('sha1(id_satuan)' => $id));
    }

}