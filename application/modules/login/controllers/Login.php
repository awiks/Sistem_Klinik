<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('login_model');
	}
	
	public function index()
	{

		$this->form_validation->set_rules('username','username','trim|required');
		$this->form_validation->set_rules('password','password','trim|required');

		if ( $this->form_validation->run() == false )
		{
			$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		    $data['info']  = $this->login_model->get_informasi();

		    $this->load->view('login/content',$data);

		}
		else{

			$this->_login();
		}

	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$query = $this->db->query("SELECT * FROM tb_admin
			                       WHERE username='$username'");

		$user = $query->row_array();

		if ( $user == null ){

			$this->session->set_flashdata('message','<div class="alert alert-danger">
	    												<i class="fas fa-info-circle"></i> Username tidak terdaftar !!
	    											 </div>');

		    redirect('login');
		}
		else{

			if ( $user['status'] == '1' ){

				$this->session->set_flashdata('message','<div class="alert alert-danger">
		        <i class="fas fa-info-circle"></i> Nama pengguna ini belum diaktifkan !</div>');

		        redirect('login');
			}
			else{

				if ( password_verify($password, $user['password']) ){


					$data = ['nama_admin' => $user['nama_admin'],
							 'jenis_kelamin' => $user['jenis_kelamin'],
							 'role'  => $user['role'],
							 'check_log' => '1'
							];
			        
			        $this->session->set_userdata($data);

					$this->session->set_flashdata('success','Login Success <br> <b>'.$user['nama_admin'].' </b> <br> Selamat datang di Sistem e-Klinik');

					redirect('dashboard');

				}
				else{

					$this->session->set_flashdata('message','<div class="alert alert-danger">
		          												<i class="fas fa-info-circle"></i> Kata sandi salah !
		          											 </div>');

		          redirect('login');
				}
			}

		}

	}

	public function logout()
	{
		$this->session->unset_userdata('nama_admin');
		$this->session->unset_userdata('jenis_kelamin');
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('check_log');
		redirect('login');
	}

}