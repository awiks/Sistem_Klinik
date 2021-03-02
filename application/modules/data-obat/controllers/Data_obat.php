<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Data_obat extends MY_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('data_obat_model','obat_model');
	}
	
	public function index()
	{

		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));
		$data['title_content'] = '<i class="fas fa-prescription-bottle-alt"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['info']  = $this->obat_model->get_informasi();
		$data['kategori']  = $this->obat_model->get_kategori();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('data-obat/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('data-obat/function');
		$this->load->view('template/bottom');
	}

	public function ajax()
	{
		$kategori = $this->input->post('kategori');
		$urutan   = $this->input->post('urutan');
		$result   = $this->obat_model->get_obat($kategori,$urutan);
		$nomor =1;
		$json = [];
		foreach ( $result as $rows ) {

			$json[] = ['nomor' => $nomor,
			            'kode_barang' => $rows->kode_barang,
			            'nama_barang' => $rows->nama_barang,
			            'nama_kategori' => $rows->nama_kategori,
			            'nama_satuan' => $rows->nama_satuan,
			            
			            'aksi' => '<a href="#Modal-edit" data-toggle="modal" id="'.sha1($rows->id_barang).'" class="btn btn-success btn-xs edit">
	                                <i class="far fa-edit"></i>
	                                </a>
	                                <a href="#Modal-del" data-toggle="modal" id="'.sha1($rows->id_barang).'" class="btn btn-xs btn-danger delete">
	                                  <i class="far fa-trash-alt"></i>
	                                </a>'
			          ];

			$nomor++;
		}

		echo '{"data":'.json_encode($json).'}';
	}

	public function modal_add()
	{
		$check_kode       = $this->obat_model->check_kode();
		$noUrut           = (int)  substr($check_kode, 4);
		$noUrut++;
        $data['no_surat'] = 'OBT-'.sprintf("%03s", $noUrut).'';

		$data['kategori']   = $this->obat_model->get_kategori();
		$data['satuan']   = $this->obat_model->get_satuan();
		$this->load->view('data-obat/modal_add',$data);
	}
    
    public function simpan()
    {
    	$kode_barang = $this->security->xss_clean($this->input->post('kode_barang'));

    	$array = array(
    	  'kode_barang' => $kode_barang,
    	  'id_kategori' => $this->security->xss_clean($this->input->post('id_kategori')),
    	  'id_satuan' => $this->security->xss_clean($this->input->post('id_satuan')),
    	  'nama_barang' => $this->security->xss_clean($this->input->post('nama_barang')),
    	  'aturan_pakai' => $this->security->xss_clean($this->input->post('aturan_pakai')),
    	  'tanggal_input' => date('Y-m-d H:i:s')
		);

		$validation = $this->form_validation;
		$validation->set_rules('id_kategori','id_kategori','required|trim');
		$validation->set_rules('nama_barang','nama_barang','required|trim');
		$validation->set_rules('id_satuan','id_satuan','required|trim');
		$validation->set_rules('aturan_pakai','aturan_pakai','required|trim');

		if ( $validation->run() ){

			$this->obat_model->insert($array);

			echo 'oke';
		}
		else{

			echo 'error';
		}
    }

    public function modal_edit()
	{
		$id = $this->security->xss_clean($this->input->post('id'));
		$data['edit'] = $this->obat_model->edit($id);
		$data['kategori']   = $this->obat_model->get_kategori();
		$data['satuan']   = $this->obat_model->get_satuan();
		$this->load->view('data-obat/modal_edit',$data);
	}

	public function perbarui()
	{
		$validation = $this->form_validation;
		$validation->set_rules('id_kategori','id_kategori','required|trim');
		$validation->set_rules('nama_barang','nama_barang','required|trim');

		if ( $validation->run() ){
			$this->obat_model->update();
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function delete()
	{
		$this->load->view('data-obat/delete');
	}

	public function hapus()
	{
		if ( $this->obat_model->delete()){
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

}