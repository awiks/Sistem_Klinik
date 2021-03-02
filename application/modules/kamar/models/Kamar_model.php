<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: No name
   Class Name 	: Kamar_model*/

class Kamar_model extends CI_Model
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
		$this->db->from('tb_kategori_kamar');
		$this->db->order_by('id_kategori','asc');
		$this->db->where('status','0');

		return $this->db->get()->result();
	}

	public function get_kamar($kategori,$urutan)
	{
		if ( $kategori == 'all' ){

			$query = $this->db->query("SELECT k.*,km.* FROM tb_kamar k JOIN 
			                       tb_kategori_kamar km ON k.id_kategori=km.id_kategori
			                       WHERE k.status='0' ORDER BY k.id_kamar $urutan");
		}
		else{

			$query = $this->db->query("SELECT k.*,km.* FROM tb_kamar k JOIN 
			                       tb_kategori_kamar km ON k.id_kategori=km.id_kategori
			                       WHERE k.id_kategori='$kategori' AND k.status='0' 
			                       ORDER BY k.id_kamar $urutan");
		}
		
		return $query->result();
	}

	public function check_kode()
    {
        $query = $this->db->query("SELECT MAX(kode_kamar) as kode_kamar 
        	                       FROM tb_kamar WHERE status='0'
        	                       ORDER BY id_kamar DESC");
        $hasil = $query->row();
        return $hasil->kode_kamar;
    }

	public function insert($data)
	{
       return $this->db->insert('tb_kamar', $data);
	}

	public function edit($id)
	{
	  if(empty($id)) show_404();
	  return $this->db->get_where('tb_kamar', 
		                array('sha1(id_kamar)' => $id))->row();
	}

	public function update(){

	 $post = $this->security->xss_clean($this->input->post());
     $this->id_kategori   = $post['id_kategori'];
     $this->nama_kamar    = $post['nama_kamar'];
     $this->harga_kamar   = str_replace (',','',$post['harga_kamar']); 
     return $this->db->update('tb_kamar', $this, 
     	               array('sha1(id_kamar)' => $post['id']));
	}

	public function delete(){
	  $id = $this->security->xss_clean($this->input->post('id'));
	  if(empty($id)) show_404();
	  $this->status   = '1';
   	  return $this->db->update('tb_kamar',$this, 
   	  	                array('sha1(id_kamar)' => $id));
    }

}