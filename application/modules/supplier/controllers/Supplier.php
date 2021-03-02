<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends MY_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('supplier_model');
	}
	
	public function index()
	{

		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['title_content'] = '<i class="fas fa-dolly"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['info']  = $this->supplier_model->get_informasi();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('supplier/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('supplier/function');
		$this->load->view('template/bottom');
	}

	public function ajax()
	{
		$result   = $this->supplier_model->get_supplier();
		$nomor =1;
		$json = [];
		foreach ( $result as $rows ) {

			$json[] = ['nomor' => $nomor,
			            'kode_supplier' => $rows->kode_supplier,
			            'nama_supplier' => $rows->nama_supplier,
			            'alamat_supplier' => $rows->alamat_supplier,
			            'telepon' => $rows->telepon,
			            'aksi' => '<a href="#Modal-edit" data-toggle="modal" id="'.sha1($rows->id_supplier).'" class="btn btn-success btn-xs edit">
	                                <i class="far fa-edit"></i>
	                                </a>
	                                <a href="#Modal-del" data-toggle="modal" id="'.sha1($rows->id_supplier).'" class="btn btn-xs btn-danger delete">
	                                  <i class="far fa-trash-alt"></i>
	                                </a>'
			          ];

			$nomor++;
		}

		echo '{"data":'.json_encode($json).'}';
	}

	public function modal_add()
	{
		$check_kode       = $this->supplier_model->check_kode();
		$noUrut           = (int)  substr($check_kode, 3);
		$noUrut++;
        $data['kode_supplier'] = 'SP-'.sprintf("%03s", $noUrut).'';

		$this->load->view('supplier/modal_add',$data);
	}

	public function simpan()
    {
    	$kode_supplier = $this->security->xss_clean($this->input->post('kode_supplier'));

    	$array = array(
    	  'kode_supplier' => $kode_supplier,
    	  'nama_supplier' => $this->security->xss_clean($this->input->post('nama_supplier')),
    	  'alamat_supplier' => $this->security->xss_clean($this->input->post('alamat_supplier')),
    	  'telepon' => $this->security->xss_clean($this->input->post('telepon')),
    	  'tanggal_input' => date('Y-m-d H:i:s')
		);

		$validation = $this->form_validation;
		$validation->set_rules('nama_supplier','nama_supplier','required|trim');
		$validation->set_rules('alamat_supplier','alamat_supplier','required|trim');
		$validation->set_rules('telepon','telepon','required|trim');

		if ( $validation->run() ){

			$this->supplier_model->insert($array);

			echo 'oke';
		}
		else{

			echo 'error';
		}

    }

    public function modal_edit()
	{
		$id = $this->security->xss_clean($this->input->post('id'));
		$data['edit'] = $this->supplier_model->edit($id);
		$this->load->view('supplier/modal_edit',$data);
	}

	public function perbarui()
	{
		$validation = $this->form_validation;
		$validation->set_rules('nama_supplier','nama_supplier','required|trim');
		$validation->set_rules('alamat_supplier','alamat_supplier','required|trim');
		$validation->set_rules('telepon','telepon','required|trim');

		if ( $validation->run() ){
			$this->supplier_model->update();
			
			echo 'oke';
		}
		else{
			echo 'error';
		}

	}

	public function delete()
	{
		$this->load->view('supplier/delete');
	}

	public function hapus()
	{
		if ( $this->supplier_model->delete()){
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

}