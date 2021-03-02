<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: No name
   Class Name 	: Administrator_model*/

class Administrator_model extends CI_Model
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

	public function get_admin($urutan)
	{
		$this->db->select('*');
		$this->db->from('tb_admin');
		$this->db->order_by('id_admin',$urutan);
		$this->db->where('status','0');

		return $this->db->get()->result();
	}

	public function check_kode()
    {
        $query = $this->db->query("SELECT MAX(kode_admin) as kode_admin 
        	                       FROM tb_admin WHERE status='0'
        	                       ORDER BY id_admin DESC");
        $hasil = $query->row();
        return $hasil->kode_admin;
    }

	public function insert($data)
	{
       return $this->db->insert('tb_admin', $data);
	}

	public function edit($id)
	{
	  if(empty($id)) show_404();
	  return $this->db->get_where('tb_admin', 
		                array('sha1(id_admin)' => $id))->row();
	}

	public function update(){

	 $post = $this->security->xss_clean($this->input->post());
     $this->nama_admin    = $post['nama_admin'];
     $this->jenis_kelamin = $post['jenis_kelamin'];
     $this->role          = $post['role'];
     return $this->db->update('tb_admin', $this, 
     	               array('sha1(id_admin)' => $post['id']));
	}

	public function delete(){
	  $id = $this->security->xss_clean($this->input->post('id'));
	  if(empty($id)) show_404();
	  $this->status         = '1';
   	  return $this->db->update('tb_admin',$this,
   	  	                array('sha1(id_admin)' => $id));
    }
}