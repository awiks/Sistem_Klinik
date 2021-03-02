<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: No name
   Class Name 	: Supplier_model*/

class Supplier_model extends CI_Model
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

	public function get_supplier()
	{
		$this->db->select('*');
		$this->db->from('tb_supplier');
		$this->db->order_by('id_supplier','DESC');
		$this->db->where('status','0');

		return $this->db->get()->result();
	}

	public function check_kode()
    {
        $query = $this->db->query("SELECT MAX(kode_supplier) as kode_supplier 
        	                       FROM tb_supplier WHERE status='0' ORDER BY id_supplier DESC");
        $hasil = $query->row();
        return $hasil->kode_supplier;
    }

    public function insert($data)
	{
       return $this->db->insert('tb_supplier', $data);
	}

	public function edit($id)
	{
	  if(empty($id)) show_404();
	  return $this->db->get_where('tb_supplier', 
		                array('sha1(id_supplier)' => $id))->row();
	}

	public function update(){

	 $post = $this->security->xss_clean($this->input->post());
     $this->nama_supplier   = $post['nama_supplier'];
     $this->alamat_supplier = $post['alamat_supplier'];
     $this->telepon         = $post['telepon'];
     return $this->db->update('tb_supplier', $this, 
     	               array('sha1(id_supplier)' => $post['id']));
	}

	public function delete(){
	  $id = $this->security->xss_clean($this->input->post('id'));
	  if(empty($id)) show_404();
   	  $this->status         = '1';
   	  return $this->db->update('tb_supplier',$this,
   	                    array('sha1(id_supplier)' => $id));

    }

    
}