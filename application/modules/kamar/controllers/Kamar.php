<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Kamar extends MY_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('kamar_model');
	}
	
	public function index()
	{
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['title_content'] = '<i class="fas fa-person-booth"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['info']  = $this->kamar_model->get_informasi();
		$data['kategori']  = $this->kamar_model->get_kategori();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('kamar/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('kamar/function');
		$this->load->view('template/bottom');
	}

	public function ajax()
	{
		$kategori = $this->input->post('kategori');
		$urutan   = $this->input->post('urutan');
		$result   = $this->kamar_model->get_kamar($kategori,$urutan);
		$nomor =1;
		$json = [];
		foreach ( $result as $rows ) {

			if($rows->status_ready == '1'){
				$status_ready='<span class="badge badge-success">Ready</span>';
			}
			elseif($rows->status_ready == '2'){
				$status_ready='<span class="badge badge-info">Booked</span>';
			}
			else{
				$status_ready='<span class="badge badge-danger">Unready</span>';
			}

			$json[] = ['nomor' => $nomor,
			            'kode_kamar' => $rows->kode_kamar,
			            'nama_kamar' => $rows->nama_kamar,
			            'harga_kamar' => number_format($rows->harga_kamar),
			            'nama_kategori' => $rows->nama_kategori,
			            'status_ready' => $status_ready,
			            'create_date' => date('d-m-Y H:i:s',strtotime($rows->create_date)),
			            'aksi' => '<a href="#Modal-edit" data-toggle="modal" id="'.sha1($rows->id_kamar).'" class="btn btn-success btn-xs edit">
	                                <i class="far fa-edit"></i>
	                                </a>
	                                <a href="#Modal-del" data-toggle="modal" id="'.sha1($rows->id_kamar).'" class="btn btn-xs btn-danger delete">
	                                  <i class="far fa-trash-alt"></i>
	                                </a>'
			          ];

			$nomor++;
		}

		echo '{"data":'.json_encode($json).'}';
	}

	public function modal_add()
	{
		$check_kode       = $this->kamar_model->check_kode();
		$noUrut           = (int)  substr($check_kode, 3);
		$noUrut++;
        $data['kode_kamar'] = 'KM-'.sprintf("%03s", $noUrut).'';

		$data['kategori']   = $this->kamar_model->get_kategori();

		$this->load->view('kamar/modal_add',$data);
	}

	public function simpan()
	{
		$array = array(
    	  'id_kategori' => $this->security->xss_clean($this->input->post('id_kategori')),
    	  'kode_kamar' => $this->security->xss_clean($this->input->post('kode_kamar')),
    	  'nama_kamar' => $this->security->xss_clean($this->input->post('nama_kamar')),
    	  'harga_kamar' => $this->security->xss_clean(str_replace (',','',$this->input->post('harga_kamar'))),
		  'create_date' => date('Y-m-d H:i:s')
		);

		$validation = $this->form_validation;
		$validation->set_rules('id_kategori','id_kategori','required|trim');
		$validation->set_rules('kode_kamar','kode_kamar','required|trim');
		$validation->set_rules('nama_kamar','nama_kamar','required|trim');
		$validation->set_rules('harga_kamar','harga_kamar','required|trim');

		if ( $validation->run() ){
			$this->kamar_model->insert($array);
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function modal_edit()
	{
		$id = $this->security->xss_clean($this->input->post('id'));
		$data['edit'] = $this->kamar_model->edit($id);
		$data['kategori']   = $this->kamar_model->get_kategori();
		$this->load->view('kamar/modal_edit',$data);
	}

	public function perbarui()
	{
		$validation = $this->form_validation;
		$validation->set_rules('id_kategori','id_kategori','required|trim');
		$validation->set_rules('nama_kamar','nama_kamar','required|trim');
		$validation->set_rules('harga_kamar','harga_kamar','required|trim');

		if ( $validation->run() ){
			$this->kamar_model->update();
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function delete()
	{
		$this->load->view('kamar/delete');
	}

	public function hapus()
	{
		if ( $this->kamar_model->delete()){
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

}