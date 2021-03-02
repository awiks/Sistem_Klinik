<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Kategori_kamar extends MY_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('kategori_kamar_model','k_model');
	}
	
	public function index()
	{
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['title_content'] = '<i class="fas fa-restroom"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['info']  = $this->k_model->get_informasi();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('kategori-kamar/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('kategori-kamar/function');
		$this->load->view('template/bottom');
	}

	public function ajax()
	{
		$urutan   = $this->input->post('urutan');
		$result   = $this->k_model->get_kategori($urutan);
		$nomor =1;
		$json = [];
		foreach ( $result as $rows ) {

			$json[] = ['nomor' => $nomor,
			            'nama_kategori' => $rows->nama_kategori,
			            'create_date' => date('d-m-Y H:i:s',strtotime($rows->create_date)),
			            'aksi' => '<a href="#Modal-edit" data-toggle="modal" id="'.sha1($rows->id_kategori).'" class="btn btn-success btn-xs edit">
	                                <i class="far fa-edit"></i>
	                                </a>
	                                <a href="#Modal-del" data-toggle="modal" id="'.sha1($rows->id_kategori).'" class="btn btn-xs btn-danger delete">
	                                  <i class="far fa-trash-alt"></i>
	                                </a>'
			          ];

			$nomor++;
		}

		echo '{"data":'.json_encode($json).'}';
	}

	public function modal_add()
	{
		$this->load->view('kategori-kamar/modal_add');
	}

	public function simpan()
	{
		$array = array(
    	  'nama_kategori' => $this->security->xss_clean($this->input->post('nama_kategori')),
		  'create_date' => date('Y-m-d H:i:s')
		);

		$validation = $this->form_validation;
		$validation->set_rules('nama_kategori','nama_kategori','required|trim');

		if ( $validation->run() ){
			$this->k_model->insert($array);
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function modal_edit()
	{
		$id = $this->security->xss_clean($this->input->post('id'));
		$data['edit'] = $this->k_model->edit($id);
		$this->load->view('kategori-kamar/modal_edit',$data);
	}

	public function perbarui()
	{
		$validation = $this->form_validation;
		$validation->set_rules('nama_kategori','nama_kategori','required|trim');

		if ( $validation->run() ){
			$this->k_model->update();
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function delete()
	{
		$this->load->view('kategori-kamar/delete');
	}

	public function hapus()
	{
		if ( $this->k_model->delete()){
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

}