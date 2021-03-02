<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Daftar_pasien extends MY_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('daftar_pasien_model');
	}
	
	public function index()
	{
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['title_content'] = '<i class="fas fa-clipboard-list"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['info']  = $this->daftar_pasien_model->get_informasi();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('daftar-pasien/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('daftar-pasien/function');
		$this->load->view('template/bottom');
	}

	public function ajax()
	{
		$result   = $this->daftar_pasien_model->get_daftar_pasien();
		$json = [];
		foreach ( $result as $rows ) {

			$birthday = $rows->tanggal_lahir;
            $biday    = new DateTime($birthday);
            $today    = new DateTime();
            $diff     = $today->diff($biday);
            $umur     = $diff->y;

			$json[] = ['no_rekam_medik' => $rows->no_rekam_medik,
			            'nama_pasien' => $rows->nama_pasien,
			            'jenis_kelamin' => $rows->jenis_kelamin,
			            'tanggal_lahir' => date('d-m-Y',strtotime($rows->tanggal_lahir)),
			            'umur' => $umur,
			            'no_telepon' => $rows->no_telepon,
			            'aksi' => '<a href="#Modal-lg" data-toggle="modal" id="'.sha1($rows->id_daftar_pasien).'" class="btn btn-info btn-xs detail">
	                                <i class="far fa-eye"></i> Detail
	                                </a>
	                                <button type="button"  id="'.sha1($rows->id_daftar_pasien).'" class="btn bg-navy btn-xs cetak">
	                                <i class="fas fa-print"></i> Cetak
	                                </button>'
			          ];

		}

		echo '{"data":'.json_encode($json).'}';
	}

	public function cetak($id)
	{
		$data['info']   = $this->daftar_pasien_model->get_informasi();
		$detail = $this->daftar_pasien_model->get_cetak($id);
		$data['detail'] = $this->daftar_pasien_model->get_cetak($id);
		
		$this->load->library('ciqrcode'); //pemanggilan library QR CODE
		$config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './vendor/'; //string, the default is application/cache/
        $config['errorlog']     = './vendor/'; //string, the default is application/logs/
        $config['imagedir']     = './vendor/barcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $image_name=$detail->no_rekam_medik.'.png'; //buat name dari qr code sesuai dengan nim
 
        $params['data'] = $detail->no_rekam_medik; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
		

		$this->load->view('daftar-pasien/cetak',$data);
	}

	public function add()
	{
		$check_kode       = $this->daftar_pasien_model->check_kode();
		$noUrut           = (int)  substr($check_kode, 3,3);
		$noUrut++;
        $data['kode_rekam'] = 'RM-'.sprintf("%03s", $noUrut).date('my').'';

		$this->load->view('daftar-pasien/modal_add',$data);
	}

	public function simpan()
	{
		$array = array(
    	  'no_rekam_medik' => $this->security->xss_clean($this->input->post('no_rekam_medik')),
    	  'nama_pasien' => $this->security->xss_clean($this->input->post('nama_pasien')),
    	  'tanggal_lahir' => $this->security->xss_clean(date('Y-m-d',strtotime($this->input->post('tanggal_lahir')))),
    	  'jenis_kelamin' => $this->security->xss_clean($this->input->post('jenis_kelamin')),
    	  'golongan_darah' => $this->security->xss_clean($this->input->post('golongan_darah')),
    	  'alamat_pasien' => $this->security->xss_clean($this->input->post('alamat_pasien')),
    	  'no_telepon' => $this->security->xss_clean($this->input->post('no_telepon')),
    	  'tanggal_daftar' => $this->security->xss_clean(date('Y-m-d',strtotime($this->input->post('tanggal_daftar')))),
    	  'create_date' => date('Y-m-d H:i:s')
		);

		$validation = $this->form_validation;
		$validation->set_rules('no_rekam_medik','no_rekam_medik','required|trim');
		$validation->set_rules('nama_pasien','nama_pasien','required|trim');
		$validation->set_rules('tanggal_lahir','tanggal_lahir','required|trim');
		$validation->set_rules('jenis_kelamin','jenis_kelamin','required|trim');
		$validation->set_rules('golongan_darah','golongan_darah','required|trim');
		$validation->set_rules('alamat_pasien','alamat_pasien','required|trim');
		$validation->set_rules('no_telepon','no_telepon','required|trim');
		$validation->set_rules('tanggal_daftar','tanggal_daftar','required|trim');

		if ( $validation->run() ){
			$this->daftar_pasien_model->insert($array);
			
			echo 'oke';
		}
		else{
			echo 'error';
		}

	}

	public function detail()
	{
		$id = $this->security->xss_clean($this->input->post('id'));
		$data['edit'] = $this->daftar_pasien_model->detail($id);
		$this->load->view('daftar-pasien/modal_detail',$data);
	}

	public function perbarui()
	{
		$validation = $this->form_validation;
		$validation->set_rules('no_rekam_medik','no_rekam_medik','required|trim');
		$validation->set_rules('tanggal_daftar','tanggal_daftar','required|trim');
		$validation->set_rules('nama_pasien','nama_pasien','required|trim');
		$validation->set_rules('tanggal_lahir','tanggal_lahir','required|trim');
		$validation->set_rules('jenis_kelamin','jenis_kelamin','required|trim');
		$validation->set_rules('golongan_darah','golongan_darah','required|trim');
		$validation->set_rules('no_telepon','no_telepon','required|trim');
		$validation->set_rules('alamat_pasien','alamat_pasien','required|trim');

		if ( $validation->run() ){
			$this->daftar_pasien_model->update();
		    echo 'oke';
		}
		else{
			echo 'error';
		}
	}
}