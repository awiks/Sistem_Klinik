<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Pasien_rawat_inap extends MY_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('pasien_rawat_inap_model','rawat_inap_model');
	}
	
	public function index()
	{
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['title_content'] = '<i class="fas fa-procedures"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['info']  = $this->rawat_inap_model->get_informasi();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('pasien-rawat-inap/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('pasien-rawat-inap/function');
		$this->load->view('template/bottom');
	}

}