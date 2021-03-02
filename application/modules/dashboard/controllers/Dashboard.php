<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('dashboard_model');
	}
	
	public function index()
	{
		if ( $this->session->userdata('check_log') == '1' ){

		$data['title'] = 'Dashboard';
		$data['title_content'] = '<i class="fas fa-clinic-medical"></i> Dashboard';
		$data['info']  = $this->dashboard_model->get_informasi();
		$data['jml_registrasi']  = $this->dashboard_model->jml_registrasi();
		$data['jml_pasien']  = $this->dashboard_model->jml_pasien();
		$data['kapasitas_database']  = $this->dashboard_model->kapasitas_database();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('dashboard/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/js');
		$this->load->view('template/alert');
		$this->load->view('template/bottom');

		}
	    else{
	   	 redirect('login');
	    }
	}

}
