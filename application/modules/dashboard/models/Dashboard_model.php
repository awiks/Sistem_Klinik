<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: No name
   Class Name 	: Dashboard_model*/

class Dashboard_model extends CI_Model
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

	public function jml_registrasi()
	{
		$query = $this->db->query("SELECT * FROM tb_daftar_periksa");
		return $query->num_rows();
	}

	public function jml_pasien()
	{
		$query = $this->db->query("SELECT * FROM tb_daftar_pasien");
		return $query->num_rows();
	}

	public function kapasitas_database()
	{
		
		$query = $this->db->query("SELECT table_schema 'dbklinikmedika', 
			                       SUM( data_length + index_length) 'size'
			                       FROM information_schema.TABLES
			                       WHERE table_schema='dbklinikmedika'");
		$rows = $query->row();
		$bytes = $rows->size;
		return $this->formatSize($bytes);
	}

	private function formatSize($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

}