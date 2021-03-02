<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Metode_pembayaran extends MY_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('metode_pembayaran_model','metode_model');
	}
	
	public function index()
	{
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['title_content'] = '<i class="fas fa-hand-holding-usd"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['info']  = $this->metode_model->get_informasi();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('metode-pembayaran/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('metode-pembayaran/function');
		$this->load->view('template/bottom');
	}

	public function ajax()
	{
		$urutan   = $this->input->post('urutan');
		$result   = $this->metode_model->get_metode($urutan);
		$nomor =1;
		$json = [];
		foreach ( $result as $rows ) {

			if ( $rows->status_form=='1' ){
				$status_form = '<i class="fas fa-check text-green"></i>';
			}
			else{
				$status_form = '<i class="fas fa-times text-red"></i>';
			}

			$json[] = ['nomor' => $nomor,
			            'deskripsi' => $rows->deskripsi,
			            'title_label' => $rows->title_label,
			            'status_form' => $status_form,
			            'create_date' => date('d-m-Y H:i:s',strtotime($rows->create_date)),
			            'aksi' => '<a href="#Modal-edit" data-toggle="modal" id="'.sha1($rows->id_metode).'" class="btn btn-success btn-xs edit">
	                                <i class="far fa-edit"></i>
	                                </a>
	                                <a href="#Modal-del" data-toggle="modal" id="'.sha1($rows->id_metode).'" class="btn btn-xs btn-danger delete">
	                                  <i class="far fa-trash-alt"></i>
	                                </a>'
			          ];

			$nomor++;
		}

		echo '{"data":'.json_encode($json).'}';
	}

	public function modal_add()
	{
		$this->load->view('metode-pembayaran/modal_add');
	}

	public function simpan()
	{
		$array = array(
    	  'deskripsi' => $this->security->xss_clean($this->input->post('deskripsi')),
    	  'title_label' => $this->security->xss_clean($this->input->post('title_label')),
    	  'status_form' => $this->security->xss_clean($this->input->post('status_form')),
    	  'create_date' => date('Y-m-d H:i:s')
		);

		$validation = $this->form_validation;
		$validation->set_rules('deskripsi','deskripsi','required|trim');
		$validation->set_rules('title_label','title_label','required|trim');
		$validation->set_rules('status_form','status_form','required|trim');

		if ( $validation->run() ){
			$this->metode_model->insert($array);
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function modal_edit()
	{
		$id = $this->security->xss_clean($this->input->post('id'));
		$data['edit'] = $this->metode_model->edit($id);
		$this->load->view('metode-pembayaran/modal_edit',$data);
	}

	public function perbarui()
	{
		$validation = $this->form_validation;
		$validation->set_rules('deskripsi','deskripsi','required|trim');
		$validation->set_rules('title_label','title_label','required|trim');
		$validation->set_rules('status_form','status_form','required|trim');

		if ( $validation->run() ){
			$this->metode_model->update();
		    echo 'oke';
		}
		else{
			echo 'error';
		}

	}

	public function delete()
	{
		$this->load->view('metode-pembayaran/delete');
	}

	public function hapus()
	{
		if ( $this->metode_model->delete()){
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}
}