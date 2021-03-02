<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Stok_obat extends MY_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('stok_obat_model');
	}
	
	public function index()
	{
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));
		$data['title_content'] = '<i class="fas fa-truck"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1)));;
		$data['info']  = $this->stok_obat_model->get_informasi();
		$data['kategori']  = $this->stok_obat_model->get_kategori();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('stok-obat/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('stok-obat/function');
		$this->load->view('template/bottom');
	}

	public function ajax()
	{
		$kategori = $this->input->post('kategori');
		$urutan   = $this->input->post('urutan');
		$result   = $this->stok_obat_model->get_obat($kategori,$urutan);
		$nomor =1;
		$json = [];
		foreach ( $result as $rows ) {

			$total_harga = $rows->jumlah_stok * $rows->harga_jual;

			$json[] = ['nomor' => $nomor,
			            'kode_barang' => $rows->kode_barang,
			            'nama_barang' => $rows->nama_barang,
			            'harga_jual' => 'Rp. '.number_format($rows->harga_jual),
			            'jumlah_stok' => $rows->jumlah_stok,
			            'nama_satuan' => $rows->nama_satuan,
			            'total_harga' => 'Rp. '.number_format($total_harga),
			            
			            'aksi' => '<a href="#Modal-edit" data-toggle="modal" id="'.sha1($rows->id_barang).'" class="btn btn-success btn-xs edit">
	                                <i class="far fa-edit"></i>
	                                </a>'
			          ];

			$nomor++;
		}

		echo '{"data":'.json_encode($json).'}';
	}

	public function modal_edit()
	{
		$id = $this->security->xss_clean($this->input->post('id'));
		$data['edit'] = $this->stok_obat_model->edit($id);
		$this->load->view('stok-obat/modal_edit',$data);
	}

	public function perbarui()
	{
		$validation = $this->form_validation;
		$validation->set_rules('harga_jual','harga_jual','required|trim');
		$validation->set_rules('jumlah_stok','jumlah_stok','required|trim');

		if ( $validation->run() ){
			$this->stok_obat_model->update();
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function stok_masuk()
	{
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));
		$data['title_content'] = '<i class="fas fa-truck"></i> ' . ucfirst(str_replace('-', ' ', $this->uri->segment(1))) . ' / ' . ucfirst(str_replace('-', ' ', $this->uri->segment(2)));
		$data['info']  = $this->stok_obat_model->get_informasi();
		$data['kategori']  = $this->stok_obat_model->get_kategori();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('stok-obat/content_stok_masuk',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('stok-obat/function_stok_masuk');
		$this->load->view('template/bottom');
	}

	public function ajax_stok_masuk()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$result   = $this->stok_obat_model->ajax_stok_masuk($bulan,$tahun);
		$nomor =1;
		$json = [];
		foreach ( $result as $rows ) {

			$id_barang_masuk = $rows->id_barang_masuk;
			$query_total = $this->db->query("SELECT * FROM tb_detail_masuk WHERE 
				                             id_barang_masuk='$id_barang_masuk'");
			$total_data = $query_total->num_rows();

			$tanggal_masuk = date('d-m-Y',strtotime($rows->tanggal_masuk));
			$create_date = date('d-m-Y H:i:s',strtotime($rows->create_date));

			$json[] = ['nomor' => $nomor,
			            'no_transaksi' => $rows->no_transaksi,
			            'nama_supplier' => $rows->nama_supplier,
			            'tanggal_masuk' => $tanggal_masuk,
			            'total_data' => $total_data,
			            'create_date' => $create_date,
			            'aksi' => '<a href="'.site_url('stok-obat/det-stok/'.sha1($rows->id_barang_masuk).'').'" class="btn btn-success btn-xs">
	                                <i class="far fa-eye"></i> Lihat Detail
	                               </a>'
			          ];

			$nomor++;
		}

		echo '{"data":'.json_encode($json).'}';
	}

	public function det_stok($id)
	{
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));
		$data['title_content'] = '<i class="fas fa-truck"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1))).' / '.ucfirst(str_replace('-', ' ',$this->uri->segment(2)));
		$data['info']      = $this->stok_obat_model->get_informasi();
		$data['data_masuk'] = $this->stok_obat_model->get_barang_masuk($id); 
		$data['detail_masuk'] = $this->stok_obat_model->get_detail_masuk($id); 

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('stok-obat/content_det_stok',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/bottom');
	}


	public function add_obat_masuk()
	{
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));
		$data['title_content'] = '<i class="fas fa-truck"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1))).' / '.ucfirst(str_replace('-', ' ',$this->uri->segment(2)));
		$data['info']      = $this->stok_obat_model->get_informasi();
		$data['kategori']  = $this->stok_obat_model->get_kategori();

		$check_kode_trans = $this->stok_obat_model->check_kode_trans();
		$noUrut_trans     = (int)  substr($check_kode_trans, 8);
		$noUrut_trans++;
        $data['no_transaksi'] = 'BM-'.date('my').'-'.sprintf("%05s", $noUrut_trans);

        //$this->stok_obat_model->truncate_temporary_table();
		
		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('stok-obat/add_stok_masuk',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('stok-obat/function_add_stok_masuk');
		$this->load->view('template/bottom');
	}

	public function select_side_supplier()
	{
		$q = $this->input->get('q');

		$result = $this->stok_obat_model->select_side_supplier($q);

		echo $result;
	}

	public function select_side_obat()
	{
		$q = $this->input->get('q');

		$result = $this->stok_obat_model->select_side_obat($q);

		echo $result;
	}

	public function ajax_add_data()
	{
		$id_supplier = $this->input->post('id_supplier');
		$tanggal_masuk = date('Y-m-d',strtotime($this->input->post('tanggal_masuk')));

		$result = $this->stok_obat_model->ajax_add_data($id_supplier,$tanggal_masuk);

		$json = [];
		foreach ( $result as $rows ) {

			$json[] = ['kode_barang' => $rows->kode_barang,
			            'nama_barang' => $rows->nama_barang,
			            'jumlah' => $rows->jumlah,
			            'nama_satuan' => $rows->nama_satuan,
			            'aksi' => '<a href="#Modal-edit" data-toggle="modal" 
			                          id="'.$rows->id_temporary.'"
			                          data-qty="'.$rows->jumlah.'"
			                         class="btn btn-info btn-xs edit">
	                                <i class="fas fa-edit"></i>
	                               </a>

			                       <a href="#Modal-del" data-toggle="modal" id="'.sha1($rows->id_temporary).'"
			                          data-barang="'.$rows->kode_barang.' - '.$rows->nama_barang.'" 
			                         class="btn btn-danger btn-xs del">
	                                <i class="fas fa-trash-alt"></i>
	                                </a>'
			          ];

		}

		echo json_encode($json);
	}

	public function modal_edit_add()
	{
		$data['id']  = $this->security->xss_clean($this->input->post('id'));
		$data['qty'] = $this->security->xss_clean($this->input->post('qty'));
		$this->load->view('stok-obat/modal_edit_add',$data);
	}

	public function perbarui_add()
	{
		$validation = $this->form_validation;
		$validation->set_rules('jumlah','jumlah','required|trim');

		if ( $validation->run() ){
			
			$this->stok_obat_model->update_add();
			
			echo 'oke';
		}
		else{
			
			echo 'error';
		}
	}

	public function delete(){
		$this->load->view('stok-obat/delete');
	}

	public function hapus()
	{
		if ( $this->stok_obat_model->delete()){
		  echo 'oke';
		}
		else{
		  echo 'error';
		}
	}

	public function add_data()
	{
		$id_supplier = $this->input->post('id_supplier');
		$tanggal_masuk = date('Y-m-d',strtotime($this->input->post('tanggal_masuk')));
		$id_barang = $this->input->post('id_barang');
		$jumlah_masuk = $this->input->post('jumlah_masuk');

		$array = array('id_supplier' => $id_supplier,
	                   'tanggal_masuk' => $tanggal_masuk,
	                   'id_barang' => $id_barang,
	                   'jumlah' => $jumlah_masuk);

		$query_check = $this->db->query("SELECT * FROM tb_temporary_masuk
			                             WHERE id_supplier='$id_supplier' AND 
			                             tanggal_masuk='$tanggal_masuk'
			                             AND id_barang='$id_barang'");

		if ( $query_check->num_rows() > 0 ){

			$update = $this->db->query("UPDATE tb_temporary_masuk 
				                        SET jumlah=jumlah+'$jumlah_masuk'
				                        WHERE id_supplier='$id_supplier' AND 
				                        tanggal_masuk='$tanggal_masuk' AND
				                        id_barang='$id_barang'");

			if ( $update ){ echo 'oke'; }else{ echo 'error'; }
		}
		else{

		   if ( $this->stok_obat_model->add_data($array) ){ echo 'oke'; }else{ echo 'error'; }

		}
	}

	public function simpan_add_data()
	{
		$id_supplier   = $this->input->post('id_supplier');
		$no_transaksi  = $this->input->post('no_transaksi');
		$tanggal_masuk = date('Y-m-d',strtotime($this->input->post('tanggal_masuk')));
		$create_date   = date('Y-m-d H:i:s');

		$validation = $this->form_validation;
		$validation->set_rules('id_supplier','id_supplier','required|trim');
		$validation->set_rules('tanggal_masuk','tanggal_masuk','required|trim');
		$validation->set_rules('no_transaksi','no_transaksi','required|trim');

		if ( $validation->run() ){

			$insert_barang = $this->db->query("INSERT INTO tb_barang_masuk (no_transaksi,id_supplier,tanggal_masuk,create_date) 
				                              VALUES ('$no_transaksi','$id_supplier','$tanggal_masuk','$create_date')");

			$id_barang_masuk = $this->db->insert_id();

			$query_detail = $this->db->query("SELECT * FROM tb_temporary_masuk WHERE 
				                              id_supplier='$id_supplier' AND tanggal_masuk='$tanggal_masuk'");

			foreach ( $query_detail->result() as $rows ) {
				
				$jumlah_masuk = $rows->jumlah;
				$id_barang    = $rows->id_barang;

				$insert = $this->db->query("INSERT INTO tb_detail_masuk(id_barang_masuk,id_barang,jumlah_masuk) 
					                        VALUES ('$id_barang_masuk','$id_barang','$jumlah_masuk')");

				$update = $this->db->query("UPDATE tb_barang SET jumlah_stok=jumlah_stok+$jumlah_masuk 
					                        WHERE id_barang='$id_barang'");

			}

			$delete = $this->db->query("DELETE FROM tb_temporary_masuk WHERE 
				                        id_supplier='$id_supplier' AND tanggal_masuk='$tanggal_masuk'");

			if ( $insert_barang && $insert && $update && $delete ){

				$this->session->set_flashdata('success', 'Data berhasil disimpan');

			}
			else{

				$this->session->set_flashdata('error', 'Data gagal disimpan');
			}
		}
		else{

			$this->session->set_flashdata('error', 'Data gagal disimpan');
		}

	}

	
	

}