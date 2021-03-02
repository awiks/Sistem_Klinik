<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Administrator extends MY_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('administrator_model');
	}
	
	public function index()
	{
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['title_content'] = '<i class="fas fa-users"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['info']  = $this->administrator_model->get_informasi();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('administrator/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('administrator/function');
		$this->load->view('template/bottom');
	}

	public function ajax()
	{
		$urutan   = $this->input->post('urutan');
		$result   = $this->administrator_model->get_admin($urutan);
		$nomor =1;
		$json = [];
		foreach ( $result as $rows ) {

			$json[] = ['nomor' => $nomor,
			            'kode_admin' => $rows->kode_admin,
			            'nama_admin' => $rows->nama_admin,
			            'jenis_kelamin' => $rows->jenis_kelamin,
			            'username' => $rows->username,
			            'role' => $rows->role,
			            'create_date' => date('d-m-Y H:i:s',strtotime($rows->create_date)),
			            'aksi' => '<a href="#Modal-edit" data-toggle="modal" id="'.sha1($rows->id_admin).'" class="btn btn-success btn-xs edit">
	                                <i class="far fa-edit"></i>
	                                </a>
	                                <a href="#Modal-del" data-toggle="modal" id="'.sha1($rows->id_admin).'" class="btn btn-xs btn-danger delete">
	                                  <i class="far fa-trash-alt"></i>
	                                </a>'
			          ];

			$nomor++;
		}

		echo '{"data":'.json_encode($json).'}';
	}

	public function modal_add()
	{
		$check_kode       = $this->administrator_model->check_kode();
		$noUrut           = (int)  substr($check_kode, 4);
		$noUrut++;
        $data['kode_admin'] = 'ADM-'.sprintf("%04s", $noUrut).'';

		$this->load->view('administrator/modal_add',$data);
	}

	public function simpan()
	{
		$username = $this->security->xss_clean($this->input->post('username'));
		
		$array = array(
    	  'kode_admin' => $this->security->xss_clean($this->input->post('kode_admin')),
    	  'nama_admin' => $this->security->xss_clean($this->input->post('nama_admin')),
    	  'jenis_kelamin' => $this->security->xss_clean($this->input->post('jenis_kelamin')),
    	  'role' => $this->security->xss_clean($this->input->post('role')),
    	  'create_date' => date('Y-m-d H:i:s'),
    	  'username' => $username,
    	  'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
    	  'view_password' => $this->security->xss_clean($this->input->post('password'))
		);

		$validation = $this->form_validation;
		$validation->set_rules('kode_admin','kode_admin','required|trim');
		$validation->set_rules('nama_admin','nama_admin','required|trim');
		$validation->set_rules('jenis_kelamin','jenis_kelamin','required|trim');
		$validation->set_rules('role','role','required|trim');
		$validation->set_rules('username','username','required|trim');
		$validation->set_rules('password','password','required|trim');

		if ( $validation->run() ){

			$query = $this->db->query("SELECT * FROM tb_admin WHERE username='$username'");

			if ( $query->num_rows() > 0 ){
				echo 'ada';
			}
			else{
				$this->administrator_model->insert($array);

				echo 'oke';
			}
		}
		else{
			echo 'error';
		}
	}

	public function modal_edit()
	{
		$id = $this->security->xss_clean($this->input->post('id'));
		$data['edit'] = $this->administrator_model->edit($id);
		$this->load->view('administrator/modal_edit',$data);
	}

	public function perbarui()
	{
		$validation = $this->form_validation;
		$validation->set_rules('nama_admin','nama_admin','required|trim');
		$validation->set_rules('jenis_kelamin','jenis_kelamin','required|trim');
		$validation->set_rules('role','role','required|trim');

		if ( $validation->run() ){
			$this->administrator_model->update();
		    echo 'oke';
		}
		else{
			echo 'error';
		}

	}

	public function delete()
	{
		$this->load->view('administrator/delete');
	}

	public function hapus()
	{
		if ( $this->administrator_model->delete()){
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}
}