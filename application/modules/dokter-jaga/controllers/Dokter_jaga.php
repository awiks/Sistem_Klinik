<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Dokter_jaga extends MY_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('dokter_jaga_model','dokter_model');
	}
	
	public function index()
	{

		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));
		$data['title_content'] = '<i class="fas fa-user-md"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['info']  = $this->dokter_model->get_informasi();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('dokter-jaga/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('dokter-jaga/function');
		$this->load->view('template/bottom');
	}

	public function tampil_data()
	{
		$tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
		$data['result']  = $this->dokter_model->get_jadwal_praktek($tanggal);
		$this->load->view('dokter-jaga/tampil_data',$data);
	}

	public function modal_add()
	{
	  $urutan = 'DESC';
	  $data['poliklinik']  = $this->dokter_model->get_poliklinik($urutan);
	  $this->load->view('dokter-jaga/modal_add',$data);
	}

	public function simpan()
	{
		$tanggal_praktek = $this->security->xss_clean(date('Y-m-d',strtotime($this->input->post('tanggal_praktek'))));
		$id_poliklinik = $this->security->xss_clean($this->input->post('id_poliklinik'));
		
		$array = array(
    	  'id_poliklinik' => $id_poliklinik,
    	  'tanggal_praktek' => $tanggal_praktek,
    	  'create_date' => date('Y-m-d H:i:s')
		);

		$validation = $this->form_validation;
		$validation->set_rules('id_poliklinik','id_poliklinik','required|trim');
		$validation->set_rules('tanggal_praktek','tanggal_praktek','required|trim');

		if ( $validation->run() ){

			$query_check = $this->db->query("SELECT * FROM tb_jadwal_praktek
				                             WHERE id_poliklinik='$id_poliklinik' AND 
				                             tanggal_praktek='$tanggal_praktek'");

			if ( $query_check->num_rows() > 0 ){
			   
			   echo 'ada';
			}
			else{
				$this->dokter_model->insert($array);
				
				echo 'oke';
			}
			
		}
		else{
			echo 'error';
		}

	}

	public function delete()
	{
		$this->load->view('dokter-jaga/delete');
	}

	public function hapus()
	{
		if ( $this->dokter_model->delete()){
		  echo 'oke';
		}
		else{
		  echo 'eeror';
		}
	}

	/* BAGIAN DETAIL */

	public function modal_add_jadwal()
	{
		$urutan = 'DESC';
		$data['id_jadwal'] = $this->input->post('id_jadwal');
		$data['nama_poli'] = $this->input->post('nama_poli');
		$data['dokter']  = $this->dokter_model->get_dokter($urutan);
		$this->load->view('dokter-jaga/modal_add_jadwal',$data);
	}

	public function simpan_add_jadwal()
	{
		$array = array(
    	  'id_jadwal' => $this->security->xss_clean($this->input->post('id_jadwal')),
    	  'deskripsi_jadwal' => $this->security->xss_clean($this->input->post('deskripsi_jadwal')),
    	  'id_dokter' => $this->security->xss_clean($this->input->post('id_dokter')),
    	  'jam_start' => $this->security->xss_clean($this->input->post('jam_start')),
    	  'jam_end' => $this->security->xss_clean($this->input->post('jam_end')),
    	  'create_date' => date('Y-m-d H:i:s')
		);

		$validation = $this->form_validation;
		$validation->set_rules('id_dokter','id_dokter','required|trim');
		$validation->set_rules('deskripsi_jadwal','deskripsi_jadwal','required|trim');
		$validation->set_rules('jam_start','jam_start','required|trim');
		$validation->set_rules('jam_end','jam_end','required|trim');

		if ( $validation->run() ){
			
		  $simpan =	$this->dokter_model->insert_add_jadwal($array);

		  if ( $simpan ){ echo 'oke'; } else{ echo 'error'; }
			
		}
		else{
		   echo 'error';
		}

	}

	public function edit_jadwal()
	{
		$urutan = 'DESC';
		$id = $this->security->xss_clean($this->input->post('id'));
		$data['nama_poli'] = $this->input->post('nama_poli');
		$data['edit'] = $this->dokter_model->edit_jadwal($id);
		$data['dokter']  = $this->dokter_model->get_dokter($urutan);
		$this->load->view('dokter-jaga/modal_edit_jadwal',$data);
	}

	public function perbarui_edit_jadwal()
	{
		$validation = $this->form_validation;
		$validation->set_rules('id_dokter','id_dokter','required|trim');
		$validation->set_rules('deskripsi_jadwal','deskripsi_jadwal','required|trim');
		$validation->set_rules('jam_start','jam_start','required|trim');
		$validation->set_rules('jam_end','jam_end','required|trim');

		if ( $validation->run() ){
			$this->dokter_model->update_detail();
			
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function delete_jadwal()
	{
		$this->load->view('dokter-jaga/delete_jadwal');
	}

	public function hapus_jadwal()
	{
		if ( $this->dokter_model->delete_jadwal()){
		  echo 'oke';
		}
		else{
		  echo 'eeror';
		}
	}

	/* END DETAIL */


	/* BAGIAN DOKTER */

	public function dokter()
	{
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));
		$data['title_content'] = '<i class="fas fa-user-md"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1))).' / '.ucfirst(str_replace('-', ' ',$this->uri->segment(2)));
		$data['info']  = $this->dokter_model->get_informasi();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('dokter-jaga/dokter/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('dokter-jaga/dokter/function');
		$this->load->view('template/bottom');
	}

	public function ajax_dokter()
	{
		$urutan   = $this->input->post('urutan');
		$result   = $this->dokter_model->get_dokter($urutan);
		$nomor =1;
		$json = [];
		foreach ( $result as $rows ) {

			$json[] = ['nomor' => $nomor,
			            'nama_dokter' => $rows->nama_dokter,
			            'jenis_kelamin' => $rows->jenis_kelamin,
			            'deskripsi' => $rows->deskripsi,
			            'no_telepon' => $rows->no_telepon,
			            'create_date' => date('d-m-Y H:i:s',strtotime($rows->create_date)),
			            'aksi' => '<a href="#Modal-edit" data-toggle="modal" id="'.sha1($rows->id_dokter).'" class="btn btn-success btn-xs edit">
	                                <i class="far fa-edit"></i>
	                                </a>
	                                <a href="#Modal-del" data-toggle="modal" id="'.sha1($rows->id_dokter).'" class="btn btn-xs btn-danger delete">
	                                  <i class="far fa-trash-alt"></i>
	                                </a>'
			          ];

			$nomor++;
		}

		echo '{"data":'.json_encode($json).'}';
	}

	public function modal_add_dokter()
	{
		$this->load->view('dokter-jaga/dokter/modal_add');
	}

	public function simpan_dokter()
	{
		$array = array(
    	  'nama_dokter' => $this->security->xss_clean($this->input->post('nama_dokter')),
    	  'jenis_kelamin' => $this->security->xss_clean($this->input->post('jenis_kelamin')),
    	  'tempat_lahir' => $this->security->xss_clean($this->input->post('tempat_lahir')),
    	  'tanggal_lahir' => $this->security->xss_clean(date('Y-m-d',strtotime($this->input->post('tanggal_lahir')))),
    	  'alamat' => $this->security->xss_clean($this->input->post('alamat')),
    	  'no_telepon' => $this->security->xss_clean($this->input->post('no_telepon')),
    	  'deskripsi' => $this->security->xss_clean($this->input->post('deskripsi')),
    	  'create_date' => date('Y-m-d H:i:s')
		);

		$validation = $this->form_validation;
		$validation->set_rules('nama_dokter','nama_dokter','required|trim');
		$validation->set_rules('jenis_kelamin','jenis_kelamin','required|trim');
		$validation->set_rules('tempat_lahir','tempat_lahir','required|trim');
		$validation->set_rules('tanggal_lahir','tanggal_lahir','required|trim');
		$validation->set_rules('alamat','alamat','required|trim');
		$validation->set_rules('no_telepon','no_telepon','required|trim');
		$validation->set_rules('deskripsi','deskripsi','required|trim');

		if ( $validation->run() ){
			$this->dokter_model->insert_dokter($array);
			echo 'oke';
		}
		else{
			echo 'error';
		}

	}

	public function modal_edit_dokter()
	{
		$id = $this->security->xss_clean($this->input->post('id'));
		$data['edit'] = $this->dokter_model->edit_dokter($id);
		$this->load->view('dokter-jaga/dokter/modal_edit',$data);
	}

	public function perbarui_dokter()
	{
		$validation = $this->form_validation;
		$validation->set_rules('nama_dokter','nama_dokter','required|trim');
		$validation->set_rules('jenis_kelamin','jenis_kelamin','required|trim');
		$validation->set_rules('tempat_lahir','tempat_lahir','required|trim');
		$validation->set_rules('tanggal_lahir','tanggal_lahir','required|trim');
		$validation->set_rules('alamat','alamat','required|trim');
		$validation->set_rules('no_telepon','no_telepon','required|trim');
		$validation->set_rules('deskripsi','deskripsi','required|trim');

		if ( $validation->run() ){
			$this->dokter_model->update_dokter();
			
			echo 'oke';
		}
		else{
			echo 'error';
		}

	}

	public function delete_dokter()
	{
		$this->load->view('dokter-jaga/dokter/delete');
	}

	public function hapus_dokter()
	{
		if ( $this->dokter_model->delete_dokter()){
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	/* END DOKTER */

	/* BAGIAN POLIKLINIK */

	public function poliklinik()
	{
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));
		$data['title_content'] = '<i class="fas fa-user-md"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1))).' / '.ucfirst(str_replace('-', ' ',$this->uri->segment(2)));
		$data['info']  = $this->dokter_model->get_informasi();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('dokter-jaga/poliklinik/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('dokter-jaga/poliklinik/function');
		$this->load->view('template/bottom');
	}

	public function ajax_poliklinik()
	{
		$urutan   = $this->input->post('urutan');
		$result   = $this->dokter_model->get_poliklinik($urutan);
		$nomor =1;
		$json = [];
		foreach ( $result as $rows ) {

			$json[] = ['nomor' => $nomor,
			            'nama_poliklinik' => $rows->nama_poliklinik,
			            'create_date' => date('d-m-Y H:i:s',strtotime($rows->create_date)),
			            'aksi' => '<a href="#Modal-edit" data-toggle="modal" id="'.sha1($rows->id_poliklinik).'" class="btn btn-success btn-xs edit">
	                                <i class="far fa-edit"></i>
	                                </a>
	                                <a href="#Modal-del" data-toggle="modal" id="'.sha1($rows->id_poliklinik).'" class="btn btn-xs btn-danger delete">
	                                  <i class="far fa-trash-alt"></i>
	                                </a>'
			          ];

			$nomor++;
		}

		echo '{"data":'.json_encode($json).'}';
	}

	public function modal_add_poliklinik()
	{
		$this->load->view('dokter-jaga/poliklinik/modal_add');
	}

	public function simpan_poliklinik()
	{
		$array = array(
    	  'nama_poliklinik' => $this->security->xss_clean($this->input->post('nama_poliklinik')),
    	  'create_date' => date('Y-m-d H:i:s')
		);

		$validation = $this->form_validation;
		$validation->set_rules('nama_poliklinik','nama_poliklinik','required|trim');

		if ( $validation->run() ){
			$this->dokter_model->insert_poliklinik($array);
			echo 'oke';
		}
		else{
			echo 'error';
		}

	}

	public function modal_edit_poliklinik()
	{
		$id = $this->security->xss_clean($this->input->post('id'));
		$data['edit'] = $this->dokter_model->edit_poliklinik($id);
		$this->load->view('dokter-jaga/poliklinik/modal_edit',$data);
	}

	public function perbarui_poliklinik()
	{
		$validation = $this->form_validation;
		$validation->set_rules('nama_poliklinik','nama_poliklinik','required|trim');

		if ( $validation->run() ){
			$this->dokter_model->update_poliklinik();
			
			echo 'oke';
		}
		else{
			
			echo 'error';
		}
	}

	public function delete_poliklinik()
	{
		$this->load->view('dokter-jaga/poliklinik/delete');
	}

	public function hapus_poliklinik()
	{
		if ( $this->dokter_model->delete_poliklinik()){
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	/* END POLIKLINIK */

	/* BAGIAN LAYANAN */

	public function layanan()
	{
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));
		$data['title_content'] = '<i class="fas fa-user-md"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1))).' / '.ucfirst(str_replace('-', ' ',$this->uri->segment(2)));
		$data['info']  = $this->dokter_model->get_informasi();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('dokter-jaga/layanan/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('dokter-jaga/layanan/function');
		$this->load->view('template/bottom');
	}

	public function ajax_layanan()
	{
		$urutan   = $this->input->post('urutan');
		$result   = $this->dokter_model->get_layanan($urutan);
		$nomor =1;
		$json = [];
		foreach ( $result as $rows ) {

			$json[] = ['nomor' => $nomor,
			            'nama_poliklinik' => $rows->nama_poliklinik,
			            'deskripsi_layanan' => $rows->deskripsi_layanan,
			            'harga_layanan' => number_format($rows->harga_layanan),
			            'create_date' => date('d-m-Y H:i:s',strtotime($rows->create_date)),
			            'aksi' => '<a href="#Modal-edit" data-toggle="modal" id="'.sha1($rows->id_layanan).'" 
			                          class="btn btn-success btn-xs edit">
	                                <i class="far fa-edit"></i>
	                                </a>
	                                <a href="#Modal-del" data-toggle="modal" id="'.sha1($rows->id_layanan).'" class="btn btn-xs btn-danger delete">
	                                  <i class="far fa-trash-alt"></i>
	                                </a>'
			          ];

			$nomor++;
		}

		echo '{"data":'.json_encode($json).'}';
	}

	public function modal_add_layanan()
	{
		$urutan = 'DESC';
	    $data['poliklinik']  = $this->dokter_model->get_poliklinik($urutan);
		$this->load->view('dokter-jaga/layanan/modal_add',$data);
	}

	public function simpan_layanan()
	{
		$array = array(
    	  'id_poliklinik' => $this->security->xss_clean($this->input->post('id_poliklinik')),
    	  'deskripsi_layanan' => $this->security->xss_clean($this->input->post('deskripsi_layanan')),
    	  'harga_layanan' => $this->security->xss_clean(str_replace (',','',$this->input->post('harga_layanan'))),
    	  'create_date' => date('Y-m-d H:i:s')
		);

		$validation = $this->form_validation;
		$validation->set_rules('id_poliklinik','id_poliklinik','required|trim');
		$validation->set_rules('deskripsi_layanan','deskripsi_layanan','required|trim');
		$validation->set_rules('harga_layanan','harga_layanan','required|trim');

		if ( $validation->run() ){

			$this->dokter_model->insert_layanan($array);

			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function modal_edit_layanan()
	{
		$id = $this->security->xss_clean($this->input->post('id'));
		$urutan = 'DESC';
	    $data['poliklinik']  = $this->dokter_model->get_poliklinik($urutan);
		$data['edit'] = $this->dokter_model->edit_layanan($id);
		$this->load->view('dokter-jaga/layanan/modal_edit',$data);
	}

	public function perbarui_layanan()
	{
		$validation = $this->form_validation;
		$validation->set_rules('id_poliklinik','id_poliklinik','required|trim');
		$validation->set_rules('deskripsi_layanan','deskripsi_layanan','required|trim');
		$validation->set_rules('harga_layanan','harga_layanan','required|trim');

		if ( $validation->run() ){
			$this->dokter_model->update_layanan();
			
			echo 'oke';
		}
		else{
			
			echo 'error';
		}
	}

	public function delete_layanan()
	{
		$this->load->view('dokter-jaga/layanan/delete');
	}

	public function hapus_layanan()
	{
		if ( $this->dokter_model->delete_layanan()){
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

}