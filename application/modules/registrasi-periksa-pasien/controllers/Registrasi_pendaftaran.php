<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Registrasi_pendaftaran extends MY_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('registrasi_pendaftaran_model','registrasi_model');
	}
	
	public function index()
	{

		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['title_content'] = '<i class="fas fa-list-alt"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['info']  = $this->registrasi_model->get_informasi();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('registrasi-periksa-pasien/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('registrasi-periksa-pasien/function');
		$this->load->view('template/bottom');
	}

	public function tampil_antrian()
	{
		$tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
		$data['result']  = $this->registrasi_model->get_jadwal($tanggal)->result();
		$this->load->view('registrasi-periksa-pasien/tampil_antrian',$data);
	}

	public function check_jadwal()
	{
	  $tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
	  $check   = $this->registrasi_model->get_jadwal($tanggal)->num_rows();
	  
	  if ( $check > 0 ){ echo false; } else{ echo true; }
	}

	public function select_jadwal()
	{
		$tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
		$result  = $this->registrasi_model->select_jadwal($tanggal);

		$json = [];
		foreach ($result as $rows ) {
			$json[] =['id_detail' => $rows->id_detail_praktek,
	                    'nama_poliklinik' => $rows->nama_poliklinik,
	                    'nama_dokter' => $rows->nama_dokter,
	                    'deskripsi_jadwal' => $rows->deskripsi_jadwal,
	                    'jam_kunjungan' => '('.date('H:i',strtotime($rows->jam_start)).'-'.date('H:i',strtotime($rows->jam_end)).')'];
		}

		echo json_encode($json);
	}

	public function add_lama()
	{
		$data['tanggal'] = $this->input->post('tanggal');
		$tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
		$data['jadwal']  = $this->registrasi_model->get_jadwal($tanggal)->result();
		
		$check_kode_reg = $this->registrasi_model->check_kode_reg();
		$noUrut_reg     = (int)  substr($check_kode_reg, 9);
		$noUrut_reg++;
        $data['no_registrasi'] = 'REG-'.date('my').'-'.sprintf("%04s", $noUrut_reg);

		$this->load->view('registrasi-periksa-pasien/modal_add_lama',$data);
	}

	public function select_side_pasien()
	{
		$q = $this->input->get('q');

		$result = $this->registrasi_model->select_side_pasien($q);

		echo $result;
	}

	public function simpan_lama()
	{
		$jam_daftar = date('H:i:s');
		$no_registrasi = $this->security->xss_clean($this->input->post('no_registrasi'));
		$tanggal    = $this->security->xss_clean(date('Y-m-d',strtotime($this->input->post('tanggal'))));
		$id_daftar_pasien = $this->security->xss_clean($this->input->post('id_daftar_pasien'));
		$id_detail_praktek = $this->security->xss_clean($this->input->post('id_detail_praktek'));
		
		$validation = $this->form_validation;
		$validation->set_rules('no_registrasi','no_registrasi','required|trim');
		$validation->set_rules('tanggal','tanggal','required|trim');
		$validation->set_rules('id_daftar_pasien','id_daftar_pasien','required|trim');
		$validation->set_rules('id_detail_praktek','id_detail_praktek','required|trim');
		
		if ( $validation->run() ){

			$query_check = $this->db->query("SELECT * FROM tb_daftar_periksa 
				                             WHERE id_daftar_pasien='$id_daftar_pasien' 
				                             AND tanggal='$tanggal'");

			if ( $query_check->num_rows() > 0 ){
				echo 'ada';
			}
			else{

				$query_max = $this->db->query("SELECT MAX(no_antrian) as no_antrian FROM tb_daftar_periksa 
				                       WHERE id_detail_praktek='$id_detail_praktek'
				                       AND tanggal='$tanggal'");
				$rows = $query_max->row();
				$no_antrian = (int) $rows->no_antrian;
				$no_antrian++;

				$this->db->query("INSERT INTO tb_daftar_periksa (no_registrasi,id_daftar_pasien,id_detail_praktek,jam_daftar,
					              no_antrian,tanggal) VALUES ('$no_registrasi','$id_daftar_pasien','$id_detail_praktek',
					             '$jam_daftar','$no_antrian','$tanggal')");
				
				echo 'oke';
			}
		}
		else{
			echo 'error';
		}
	}

	public function add_baru()
	{
		$data['tanggal'] = $this->input->post('tanggal');
		$tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
		$data['jadwal']  = $this->registrasi_model->get_jadwal($tanggal)->result();
		
		$check_kode       = $this->registrasi_model->check_kode();
		$noUrut           = (int)  substr($check_kode, 7);
		$noUrut++;
        $data['no_rekam_medik'] = 'RM-'.sprintf("%03s", $noUrut).date('my').'';

        $check_kode_reg = $this->registrasi_model->check_kode_reg();
		$noUrut_reg     = (int)  substr($check_kode_reg, 9);
		$noUrut_reg++;
        $data['no_registrasi'] = 'REG-'.date('my').'-'.sprintf("%04s", $noUrut_reg);

		$this->load->view('registrasi-periksa-pasien/modal_add_baru',$data);
	}

	public function selected_poli()
	{
		$id_jadwal = $this->input->post('id_jadwal');
		$result  = $this->registrasi_model->selected_poli($id_jadwal);

		$json = [];
		foreach ($result as $rows ) {
			$json[] =['id_detail' => $rows->id_detail_praktek,
	                    'nama_dokter' => $rows->nama_dokter,
	                    'deskripsi_jadwal' => $rows->deskripsi_jadwal,
	                    'jam_kunjungan' => '('.date('H:i',strtotime($rows->jam_start)).'-'.date('H:i',strtotime($rows->jam_end)).')'];
		}

		echo json_encode($json);
	}

	public function simpan_baru()
	{
		$id_detail_praktek = $this->security->xss_clean($this->input->post('id_detail_praktek'));
		$tanggal = $this->security->xss_clean(date('Y-m-d',strtotime($this->input->post('tanggal'))));
        $jam_daftar = date('H:i:s');

		$array = array(
    	  'no_rekam_medik' => $this->security->xss_clean($this->input->post('no_rekam_medik')),
    	  'nama_pasien' => $this->security->xss_clean($this->input->post('nama_pasien')),
    	  'tanggal_lahir' => $this->security->xss_clean(date('Y-m-d',strtotime($this->input->post('tanggal_lahir')))),
    	  'jenis_kelamin' => $this->security->xss_clean($this->input->post('jenis_kelamin')),
    	  'golongan_darah' => $this->security->xss_clean($this->input->post('golongan_darah')),
    	  'alamat_pasien' => $this->security->xss_clean($this->input->post('alamat_pasien')),
    	  'no_telepon' => $this->security->xss_clean($this->input->post('no_telepon')),
    	  'tanggal_daftar' => $tanggal,
    	  'create_date' => date('Y-m-d H:i:s')
		);

		$validation = $this->form_validation;
		$validation->set_rules('no_rekam_medik','no_rekam_medik','required|trim');
		$validation->set_rules('tanggal','tanggal','required|trim');
		$validation->set_rules('nama_pasien','nama_pasien','required|trim');
		$validation->set_rules('golongan_darah','golongan_darah','required|trim');
		$validation->set_rules('no_telepon','no_telepon','required|trim');
		$validation->set_rules('alamat_pasien','alamat_pasien','required|trim');
		$validation->set_rules('id_jadwal','id_jadwal','required|trim');
		$validation->set_rules('id_detail_praktek','id_detail_praktek','required|trim');

		if ( $validation->run() ){
			
			$this->registrasi_model->insert_daftar_baru($array);

			$id_daftar_pasien = $this->db->insert_id();

			$query = $this->db->query("SELECT MAX(no_antrian) as no_antrian FROM tb_daftar_periksa 
				                       WHERE id_detail_praktek='$id_detail_praktek'
				                       AND tanggal='$tanggal'");
			$rows = $query->row();
			$no_antrian = (int) $rows->no_antrian;
			$no_antrian++;

			$this->db->query("INSERT INTO tb_daftar_periksa (id_daftar_pasien,id_detail_praktek,jam_daftar,
				              no_antrian,tanggal) VALUES ('$id_daftar_pasien','$id_detail_praktek',
				             '$jam_daftar','$no_antrian','$tanggal')");
			
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function ajax_jadwal()
	{
		$tanggal   = date('Y-m-d',strtotime($this->input->post('tanggal')));
		$jadwal    = $this->input->post('jadwal');	
		$result   = $this->registrasi_model->ajax_jadwal($tanggal,$jadwal);
		$nomor =1;
		$json = [];
		foreach ( $result as $rows ) {

			if ( $rows->status_daftar == '0' ){
				$status_daftar = '<span class="badge badge-danger p-1">Menunggu</span>';
			}
			elseif ( $rows->status_daftar == '1' ) {
				$status_daftar = '<span class="badge badge-info p-1">Proses</span>';
			}
			elseif ( $rows->status_daftar == '2' ) {
				$status_daftar = '<span class="badge badge-warning p-1">Pending</span>';
			}
			else{
				$status_daftar = '<span class="badge badge-success">Selesai</span>';

			}

			$json[] = ['nomor' => $nomor,
			            'no_registrasi' => $rows->no_registrasi,
			            'no_rekam_medik' => $rows->no_rekam_medik,
			            'nama_pasien' => $rows->nama_pasien,
			            'jam_daftar' => $rows->jam_daftar,
			            'no_antrian' => $rows->no_antrian,
			            'status' => $status_daftar,
			            'aksi' => '<button type="button"  
				                       id="'.sha1($rows->id_daftar_periksa).'"
				                       data-code="'.$rows->no_rekam_medik.'"
				                       data-name="'.$rows->nama_pasien.'"
				                       data-count="'.$rows->no_antrian.'"
				                       data-time="'.$rows->jam_daftar.'"
				                       data-date="'.$rows->tanggal.'"
				                       data-poli="'.$rows->nama_poliklinik.'"
				                       data-doct="'.$rows->nama_dokter.'"
				                       data-praktek="'.date('H:i',strtotime($rows->jam_start)).'-'.date('H:i',strtotime($rows->jam_end)).'"
				                       data-status="'.$rows->status_daftar.'"
				                       data-toggle="modal"
				                       data-target="#Modal-add" 
				                       class="btn bg-olive btn-xs proses">
	                                <i class="fas fa-check"></i> Proses
	                                </button>
	                            <button type="button"  id="'.sha1($rows->id_daftar_periksa).'" class="btn bg-navy btn-xs cetak">
	                                <i class="fas fa-print"></i> Cetak
	                                </button>'
			          ];

			$nomor++;
		}

		echo '{"data":'.json_encode($json).'}';
	}

	public function modal_proses()
	{
		$data['id']   = $this->input->post('id');
		$data['code'] = $this->input->post('code');
		$data['name'] = $this->input->post('name');
		$data['count'] = $this->input->post('count');
		$data['time'] = $this->input->post('time');
		$data['date'] = $this->input->post('date');
		$data['poli'] = $this->input->post('poli');
		$data['doct'] = $this->input->post('doct');
		$data['praktek'] = $this->input->post('praktek');
		$data['status'] = $this->input->post('status');

		$this->load->view('registrasi-periksa-pasien/modal_proses',$data);
	}

	public function proses_btn()
	{
		$id  = $this->input->post('id');

		if ( $this->registrasi_model->proses_btn($id) ){
		    echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function pending_btn()
	{
		$id  = $this->input->post('id');

		if ( $this->registrasi_model->pending_btn($id) ){
		    echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function cancel_btn()
	{
		$id  = $this->input->post('id');

		if ( $this->registrasi_model->cancel_btn($id) ){
		    echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function cetak($id)
	{
		$data['info']  = $this->registrasi_model->get_informasi();
		$data['detail']= $this->registrasi_model->cetak($id);
		$this->load->view('registrasi-periksa-pasien/cetak',$data);
	}

	public function barcode($no_registrasi)
    {
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
        Zend_Barcode::render('Code128', 'image', array(
            'text' => $no_registrasi,
            'fontSize' => 14,
            'barHeight' => 40,
            'barThickWidth' => 5,
            'barThinWidth' => 1
        ), array());
    }

}