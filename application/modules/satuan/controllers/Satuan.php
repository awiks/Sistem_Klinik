<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Satuan extends MY_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('satuan_model');
	}
	
	public function index()
	{
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['title_content'] = '<i class="fas fa-cash-register"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['info']  = $this->satuan_model->get_informasi();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('satuan/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('satuan/function');
		$this->load->view('template/bottom');
	}
    
	public function ajax()
	{
		$urutan   = $this->input->post('urutan');
		$result   = $this->satuan_model->get_satuan($urutan);
		$nomor =1;
		$json = [];
		foreach ( $result as $rows ) {

			$json[] = ['nomor' => $nomor,
			            'nama_satuan' => $rows->nama_satuan,
			            'create_date' => date('d-m-Y H:i:s',strtotime($rows->create_date)),
			            'aksi' => '<a href="#Modal-edit" data-toggle="modal" id="'.sha1($rows->id_satuan).'" class="btn btn-success btn-xs edit">
	                                <i class="far fa-edit"></i>
	                                </a>
	                                <a href="#Modal-del" data-toggle="modal" id="'.sha1($rows->id_satuan).'" class="btn btn-xs btn-danger delete">
	                                  <i class="far fa-trash-alt"></i>
	                                </a>'
			          ];

			$nomor++;
		}

		echo '{"data":'.json_encode($json).'}';
	}

	public function modal_add()
	{
		$this->load->view('satuan/modal_add');
	}

	public function simpan()
	{
		$array = array(
    	  'nama_satuan' => $this->security->xss_clean($this->input->post('nama_satuan')),
    	  'create_date' => date('Y-m-d H:i:s')
		);

		$validation = $this->form_validation;
		$validation->set_rules('nama_satuan','nama_satuan','required|trim');

		if ( $validation->run() ){
			$this->satuan_model->insert($array);
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function modal_edit()
	{
		$id = $this->security->xss_clean($this->input->post('id'));
		$data['edit'] = $this->satuan_model->edit($id);
		$this->load->view('satuan/modal_edit',$data);
	}

	public function perbarui()
	{
		$validation = $this->form_validation;
		$validation->set_rules('nama_satuan','nama_satuan','required|trim');

		if ( $validation->run() ){
			$this->satuan_model->update();
		    echo 'oke';
		}
		else{
			echo 'error';
		}

	}

	public function delete()
	{
		$this->load->view('satuan/delete');
	}

	public function hapus()
	{
		if ( $this->satuan_model->delete()){
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

}