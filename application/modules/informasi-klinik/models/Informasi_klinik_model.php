<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: No name
   Class Name 	: Informasi_klinik_model*/

class Informasi_klinik_model extends CI_Model
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

	public function get_edit($id)
	{
		if(empty($id)) show_404();
	    return $this->db->get_where('tb_informasi_klinik', 
		                array('sha1(id_informasi)' => $id))->row();
	}

	public function perbarui_satu($id,$nama_klinik)
	{
		$this->nama_klinik = $nama_klinik;
        $this->db->update('tb_informasi_klinik', $this, 
        	       array('sha1(id_informasi)' => $id));
        
        $pesan = $this->session->set_flashdata('success', 'Data berhasil diperbarui');

        return $pesan;
	}

	public function perbarui_dua($id,$alamat_klinik)
	{
		$this->alamat_klinik = $alamat_klinik;
        $this->db->update('tb_informasi_klinik', $this, 
        	       array('sha1(id_informasi)' => $id));
        
        $pesan = $this->session->set_flashdata('success', 'Data berhasil diperbarui');

        return $pesan;
	}

	public function perbarui_tiga($id,$no_telpon)
	{
		$this->no_telpon = $no_telpon;
        $this->db->update('tb_informasi_klinik', $this, 
        	       array('sha1(id_informasi)' => $id));
        
        $pesan = $this->session->set_flashdata('success', 'Data berhasil diperbarui');

        return $pesan;
	}

	public function perbarui_empat($id,$logo)
	{
	    $config['upload_path']   = './vendor/img/';
	    $config['allowed_types'] = 'jpg|png|jpeg'; 
	   
	    $this->load->library('upload', $config);

	    if ( $this->upload->do_upload('logo') ){

	    	$gbr = $this->upload->data();

	    	$config['image_library']  ='gd2';
	        $config['source_image']   ='./vendor/img/'.$gbr['file_name'];
	        $config['create_thumb']   = FALSE;
	        $config['maintain_ratio'] = FALSE;
	        $config['quality']   = '100%';
	        $config['width']     = 150;
	        $config['height']     = 150;
	        $config['new_image'] = './vendor/img/'.$gbr['file_name'];
	        $this->load->library('image_lib', $config);
	        $this->image_lib->resize();

	        $row = $this->db->where('sha1(id_informasi)',$id)
	                        ->get('tb_informasi_klinik')->row();
	        unlink('./vendor/img/'.$row->logo);

	        $image_logo = $gbr['file_name'];

	        $this->logo = $image_logo;
	        $this->db->update('tb_informasi_klinik', $this, 
	        	       array('sha1(id_informasi)' => $id));
	        
	        $pesan = $this->session->set_flashdata('success', 'Data berhasil diperbarui');
	    	
	    }
	    else{

	        $pesan = $this->session->set_flashdata('warning', 'Tipe file salah');
	    }

	    return $pesan;
	}

	public function perbarui_lima($id,$favicon)
	{
		$config['upload_path']   = './vendor/img/';
        $config['allowed_types'] = 'ico'; 

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('favicon')){

        	$gbr = $this->upload->data();

        	$config['image_library']  ='gd2';
            $config['source_image']   ='./vendor/img/'.$gbr['file_name'];
            $config['create_thumb']   = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality']   = '100%';
            $config['width']     = 35;
            $config['height']    = 35;
            $config['new_image'] = './vendor/img/'.$gbr['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $row = $this->db->where('sha1(id_informasi)',$id)
                            ->get('tb_informasi_klinik')->row();
            unlink('./vendor/img/'.$row->favicon);

            $image_favicon = $gbr['file_name'];

            $this->favicon = $image_favicon;
            $this->db->update('tb_informasi_klinik', $this, 
            	       array('sha1(id_informasi)' => $id));
            
            $pesan = $this->session->set_flashdata('success', 'Data berhasil diperbarui');
        	
        }
        else{

            $pesan = $this->session->set_flashdata('warning', 'Tipe file salah');
        }

	    return $pesan;
	}

	public function perbarui_enam($id,$bg_login)
	{
	    $config['upload_path']   = './vendor/img/';
	    $config['allowed_types'] = 'jpg|png|jpeg'; 
	   
	    $this->load->library('upload', $config);

	    if ( $this->upload->do_upload('bg_login') ){

	    	$gbr = $this->upload->data();

	    	$config['image_library']  ='gd2';
	        $config['source_image']   ='./vendor/img/'.$gbr['file_name'];
	        $config['create_thumb']   = FALSE;
	        $config['maintain_ratio'] = FALSE;
	        $config['quality']   = '100%';
	        $config['width']     = 1500;
	        $config['height']     = 1000;
	        $config['new_image'] = './vendor/img/'.$gbr['file_name'];
	        $this->load->library('image_lib', $config);
	        $this->image_lib->resize();

	        $row = $this->db->where('sha1(id_informasi)',$id)
	                        ->get('tb_informasi_klinik')->row();
	        unlink('./vendor/img/'.$row->bg_login);

	        $image_logo = $gbr['file_name'];

	        $this->bg_login = $image_logo;
	        $this->db->update('tb_informasi_klinik', $this, 
	        	       array('sha1(id_informasi)' => $id));
	        
	        $pesan = $this->session->set_flashdata('success', 'Data berhasil diperbarui');
	    	
	    }
	    else{

	        $pesan = $this->session->set_flashdata('warning', 'Tipe file salah');
	    }

	    return $pesan;
	}
	
}