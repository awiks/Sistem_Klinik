<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi_klinik extends MY_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('informasi_klinik_model','m_info');
	}
	
	public function index()
	{
		$data['info']  = $this->m_info->get_informasi();
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['title_content'] = '<i class="fas fa-building"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('informasi-klinik/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('informasi-klinik/function');
		$this->load->view('template/bottom');
	}

	public function edit_satu($id)
	{
		$data['info']  = $this->m_info->get_informasi();
		$data['title'] = 'Informasi Klinik';
		$data['title_content'] = '<i class="fas fa-building"></i> Informasi Klinik';
		$data['edit']  = $this->m_info->get_edit($id);

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		if ( !$data['edit'] ){
		  $this->load->view('template/404');
		}
		else{
		  $this->load->view('informasi-klinik/edit_satu',$data);
		}
		
		$this->load->view('template/footer',$data);
		$this->load->view('template/js');
		$this->load->view('informasi-klinik/function');
		$this->load->view('template/bottom');

	}

	public function perbarui_satu()
	{
		$id            = $this->security->xss_clean($this->input->post('id'));
		$nama_klinik   = $this->security->xss_clean($this->input->post('nama_klinik'));

		$validation = $this->form_validation;
		$validation->set_rules('nama_klinik','nama_klinik','required|trim');

		if ( $validation->run() ){

			$this->m_info->perbarui_satu($id,$nama_klinik);
		}
		else{

			$this->session->set_flashdata('error', 'Data gagal diperbarui');
		}

		redirect('informasi-klinik');
	}

	public function edit_dua($id)
	{
		$data['info']  = $this->m_info->get_informasi();
		$data['title'] = 'Informasi Klinik';
		$data['title_content'] = '<i class="fas fa-building"></i> Informasi Klinik';
		$data['edit']  = $this->m_info->get_edit($id);

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		if ( !$data['edit'] ){
		  $this->load->view('template/404');
		}
		else{
		  $this->load->view('informasi-klinik/edit_dua',$data);
		}

		$this->load->view('template/footer',$data);
		$this->load->view('template/js');
		$this->load->view('informasi-klinik/function');
		
		$this->load->view('template/bottom');

	}

	public function perbarui_dua()
	{
		$id            = $this->security->xss_clean($this->input->post('id'));
		$alamat_klinik   = $this->security->xss_clean($this->input->post('alamat_klinik'));

		$validation = $this->form_validation;
		$validation->set_rules('alamat_klinik','alamat_klinik','required|trim');

		if ( $validation->run() ){

			$this->m_info->perbarui_dua($id,$alamat_klinik);
		}
		else{

			$this->session->set_flashdata('error', 'Data gagal diperbarui');
		}

		redirect('informasi-klinik');
	}

	public function edit_tiga($id)
	{
		$data['info']  = $this->m_info->get_informasi();
		$data['title'] = 'Informasi Klinik';
		$data['title_content'] = '<i class="fas fa-building"></i> Informasi Klinik';
		$data['edit']  = $this->m_info->get_edit($id);

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		if ( !$data['edit'] ){
		  $this->load->view('template/404');
		}
		else{
		  $this->load->view('informasi-klinik/edit_tiga',$data);
		}

		$this->load->view('template/footer',$data);
		$this->load->view('template/js');
		$this->load->view('informasi-klinik/function');
		
		$this->load->view('template/bottom');

	}

	public function perbarui_tiga()
	{
		$id            = $this->security->xss_clean($this->input->post('id'));
		$no_telpon   = $this->security->xss_clean($this->input->post('no_telpon'));

		$validation = $this->form_validation;
		$validation->set_rules('no_telpon','no_telpon','required|trim');

		if ( $validation->run() ){

			$this->m_info->perbarui_tiga($id,$no_telpon);
		}
		else{

			$this->session->set_flashdata('error', 'Data gagal diperbarui');
		}

		redirect('informasi-klinik');
	}

	public function edit_empat($id)
	{
		$data['info']  = $this->m_info->get_informasi();
		$data['title'] = 'Informasi Klinik';
		$data['title_content'] = '<i class="fas fa-building"></i> Informasi Klinik';
		$data['edit']  = $this->m_info->get_edit($id);

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		if ( !$data['edit'] ){
		  $this->load->view('template/404');
		}
		else{
		  $this->load->view('informasi-klinik/edit_empat',$data);
	    }

		$this->load->view('template/footer',$data);
		$this->load->view('template/js');
		$this->load->view('informasi-klinik/function');
		
		$this->load->view('template/bottom');

	}

	public function perbarui_empat()
	{
		$id            = $this->security->xss_clean($this->input->post('id'));
		$logo          = $_FILES['logo']['name'];

		$this->m_info->perbarui_empat($id,$logo);

		redirect('informasi-klinik');
	}

	public function edit_lima($id)
	{
		$data['info']  = $this->m_info->get_informasi();
		$data['title'] = 'Informasi Klinik';
		$data['title_content'] = '<i class="fas fa-building"></i> Informasi Klinik';
		$data['edit']  = $this->m_info->get_edit($id);

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		if ( !$data['edit'] ){
		  $this->load->view('template/404');
		}
		else{
		  $this->load->view('informasi-klinik/edit_lima',$data);
		}

		$this->load->view('template/footer',$data);
		$this->load->view('template/js');
		$this->load->view('informasi-klinik/function');
		
		$this->load->view('template/bottom');

	}

	public function perbarui_lima()
	{
		$id       = $this->security->xss_clean($this->input->post('id'));
		$favicon  = $_FILES['favicon']['name'];

		$this->m_info->perbarui_lima($id,$favicon);

		redirect('informasi-klinik');
	}

	public function edit_enam($id)
	{
		$data['info']  = $this->m_info->get_informasi();
		$data['title'] = 'Informasi Klinik';
		$data['title_content'] = '<i class="fas fa-building"></i> Informasi Klinik';
		$data['edit']  = $this->m_info->get_edit($id);

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		if ( !$data['edit'] ){
		  $this->load->view('template/404');
		}
		else{
		  $this->load->view('informasi-klinik/edit_enam',$data);
		}

		$this->load->view('template/footer',$data);
		$this->load->view('template/js');
		$this->load->view('informasi-klinik/function');
		
		$this->load->view('template/bottom');

	}

	public function perbarui_enam()
	{
		$id            = $this->security->xss_clean($this->input->post('id'));
		$bg_login          = $_FILES['bg_login']['name'];

		$this->m_info->perbarui_enam($id,$bg_login);

		redirect('informasi-klinik');
	}

}
