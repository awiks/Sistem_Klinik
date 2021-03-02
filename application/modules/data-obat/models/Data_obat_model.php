<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/* Author 		: No name
   Class Name 	: Data_obat_model*/

class Data_obat_model extends CI_Model
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

	public function get_kategori()
	{
		$this->db->select('*');
		$this->db->from('tb_kategori');
		$this->db->order_by('id_kategori','DESC');
		$this->db->where('status','0');

		return $this->db->get()->result();
	}

	public function get_satuan()
	{
		$this->db->select('*');
		$this->db->from('tb_satuan');
		$this->db->order_by('id_satuan','DESC');
		$this->db->where('status','0');

		return $this->db->get()->result();
	}

	public function get_obat($kategori,$urutan)
	{
		if ( $kategori == 'all' ){
			$this->db->select('*');
			$this->db->from('tb_barang');
			$this->db->join('tb_kategori','tb_barang.id_kategori=tb_kategori.id_kategori');
			$this->db->join('tb_satuan','tb_barang.id_satuan=tb_satuan.id_satuan');
			$this->db->order_by('tb_barang.id_barang',$urutan);
			$this->db->where('tb_barang.status','0');
		}
		else{

			$this->db->select('*');
			$this->db->from('tb_barang');
			$this->db->join('tb_kategori','tb_barang.id_kategori=tb_kategori.id_kategori');
			$this->db->join('tb_satuan','tb_barang.id_satuan=tb_satuan.id_satuan');
			$this->db->where('tb_barang.id_kategori',$kategori);
			$this->db->order_by('tb_barang.id_barang',$urutan);
			$this->db->where('tb_barang.status','0');
		}

		return $this->db->get()->result();
	}

	public function check_kode()
    {
        $query = $this->db->query("SELECT MAX(kode_barang) as kode_barang 
        	                       FROM tb_barang WHERE status='0'
        	                       ORDER BY id_barang DESC");
        $hasil = $query->row();
        return $hasil->kode_barang;
    }

    public function insert($data)
	{
       return $this->db->insert('tb_barang', $data);
	}

	public function edit($id)
	{
	  if(empty($id)) show_404();
	  return $this->db->get_where('tb_barang', 
		                array('sha1(id_barang)' => $id))->row();
	}

	public function update(){

	 $post = $this->security->xss_clean($this->input->post());
     $this->id_kategori  = $post['id_kategori'];
     $this->id_satuan    = $post['id_satuan'];
     $this->nama_barang  = $post['nama_barang'];
     $this->aturan_pakai = $post['aturan_pakai'];
     return $this->db->update('tb_barang', $this, 
     	               array('sha1(id_barang)' => $post['id']));
	}

	public function delete(){
	  $id = $this->security->xss_clean($this->input->post('id'));
	  if(empty($id)) show_404();
	  $this->status         = '1';
   	  return $this->db->update('tb_barang',$this,
   	  	                array('sha1(id_barang)' => $id));
    }
}