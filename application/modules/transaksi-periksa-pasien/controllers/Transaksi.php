<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Transaksi extends MY_Controller {

	public function __construct()
	{
		parent ::__construct();
		$this->load->model('transaksi_model');
	}
	
	public function index()
	{
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));
		$data['title_content'] = '<i class="fas fa-money-check-alt"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1)));
		$data['info']  = $this->transaksi_model->get_informasi();

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('transaksi-periksa-pasien/content',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('transaksi-periksa-pasien/function');
		$this->load->view('template/bottom');
	}

	public function ajax()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$result   = $this->transaksi_model->ajax_transaksi($bulan,$tahun);

		$json = [];
		foreach ( $result as $rows ) {

			$json[] = ['no_transaksi' => $rows->no_transaksi,
			            'pasien' => $rows->no_rekam_medik.'-'.$rows->nama_pasien,
			            'nama_dokter' => $rows->nama_dokter,
			            'biaya_layanan' => number_format($rows->biaya_layanan),
			            'biaya_obat' => number_format($rows->biaya_obat),
			            'sub_total' => number_format($rows->sub_total),
			            'aksi' => '<a href="'.site_url('transaksi-periksa-pasien/detail/'.sha1($rows->id_transaksi_periksa).'').'" class="btn btn-success btn-xs">
	                                <i class="far fa-eye"></i> Lihat
	                               </a>'
			          ];

		}

		echo '{"data":'.json_encode($json).'}';
	}

	public function add()
	{
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));
		$data['title_content'] = '<i class="fas fa-money-check-alt"></i> ' . ucfirst(str_replace('-', ' ', $this->uri->segment(1))) . ' / ' . ucfirst(str_replace('-', ' ', $this->uri->segment(2)));
		$data['info']   = $this->transaksi_model->get_informasi();
		$data['metode'] = $this->transaksi_model->get_metode();

		//$this->transaksi_model->truncate_temporary_table();

		$check_kode_trans = $this->transaksi_model->check_kode_trans();
		$noUrut_trans     = (int)  substr($check_kode_trans, 9);
		$noUrut_trans++;
        $data['no_transaksi'] = 'TRS-'.date('my').'-'.sprintf("%09s", $noUrut_trans);

		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		$this->load->view('transaksi-periksa-pasien/add',$data);

		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('transaksi-periksa-pasien/function_add');
		$this->load->view('template/bottom');
	}

	public function tampil_discount_ppn()
	{
		$result = $this->transaksi_model->tampil_discount_ppn();
		$array = array('discount' => $result->discount,
		                'ppn' => $result->ppn, );

		echo json_encode($array);
	}

	public function modal_discount()
	{
		$id = $this->input->post('id');
		$data['edit'] = $this->transaksi_model->modal_discount($id);
		$this->load->view('transaksi-periksa-pasien/modal_discount',$data);
	}

	public function perbarui_discount()
	{
		$validation = $this->form_validation;
		$validation->set_rules('discount','discount','required|trim');
		$validation->set_rules('ppn','ppn','required|trim');

		if ( $validation->run() ){
			$this->transaksi_model->perbarui_discount();
		    echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function select_regristrasi()
	{
		$q  = $this->input->get('q');
		$dt = date('Y-m-d',strtotime($this->input->get('dt')));

		$result = $this->transaksi_model->select_regristrasi($q,$dt);

		echo $result;
	}

	public function select_no_reg()
	{
		$no_reg = $this->input->post('no_reg');
		if(!$no_reg)show_404();
		$result = $this->transaksi_model->select_no_reg($no_reg);

		$array = array('no_rekam_medik' => $result->no_rekam_medik,
			           'nama_pasien' => $result->nama_pasien,
			           'nama_poliklinik' => $result->nama_poliklinik, 
			           'id_poliklinik' => $result->id_poliklinik );

		echo json_encode($array);

	}

	public function select_side_obat()
	{
		$q = $this->input->get('q');

		$result = $this->transaksi_model->select_side_obat($q);

		echo $result;
	}

	public function select_obat()
	{
		$id = $this->input->post('id');
		if(!$id)show_404();
		$result = $this->transaksi_model->select_obat($id);

		$array = array('jumlah_stok' => $result->jumlah_stok, );

		echo json_encode($array);
	}

	public function select_layanan()
	{
		$poliklinik = $this->input->post('poliklinik');
		$result = $this->transaksi_model->select_layanan($poliklinik);
		$array=[];
		foreach ( $result as $rows ) {
			
			$array[] = ['id_layanan' => $rows->id_layanan, 
						'deskripsi_layanan' => $rows->deskripsi_layanan];

		}

		echo json_encode($array);
	}

	public function select_jenis_layanan()
	{
		$layanan = $this->input->post('layanan');
		if(!$layanan)show_404();
		$result = $this->transaksi_model->select_jenis_layanan($layanan);

		$array = array('harga_layanan' => number_format($result->harga_layanan), );

		echo json_encode($array);
	}

	public function simpan_temp_obat()
	{
		$id_daftar_periksa = $this->security->xss_clean($this->input->post('no_reg'));
		$id_barang   = $this->security->xss_clean($this->input->post('id_barang'));
		$jumlah_obat = $this->security->xss_clean($this->input->post('qty'));
		$stock       = $this->security->xss_clean($this->input->post('stock'));
		
		$array = array(
    	  'id_daftar_periksa' => $id_daftar_periksa,
    	  'id_barang' => $id_barang,
    	  'jumlah_obat' => $jumlah_obat 
		);

		$validation = $this->form_validation;
		$validation->set_rules('no_reg','no_reg','required|trim');
		$validation->set_rules('id_barang','id_barang','required|trim');
		$validation->set_rules('qty','qty','required|trim');

		if ( $validation->run() ){

			$query_check = $this->db->query("SELECT * FROM tb_temporary_transaksi_periksa
				                             WHERE id_daftar_periksa='$id_daftar_periksa' AND 
				                             id_barang='$id_barang'");

			if ( $query_check->num_rows() > 0 ){

				$result = $query_check->row();
				$jumlah_obat_temp = $result->jumlah_obat + $jumlah_obat;

				if ( $stock >= $jumlah_obat_temp ){

					$update = $this->db->query("UPDATE tb_temporary_transaksi_periksa SET 
					                        jumlah_obat=jumlah_obat+$jumlah_obat
					                        WHERE id_daftar_periksa='$id_daftar_periksa'
					                        AND id_barang='$id_barang'");
					
					if ( $update ){ echo 'oke'; }else{ echo 'error'; }
				}
				else{
					echo 'stok_min';
				}
			}
			else{

				if ( $this->transaksi_model->simpan_temp_obat($array) ){
					echo 'oke';
				}
				else{
					echo 'error';
				}
			}
		}
		else{
			echo 'error';
		}
	}

	public function tampil_data_obat()
	{
		$no_reg = $this->input->post('no_reg');

		$result = $this->transaksi_model->tampil_data_obat($no_reg);

		$json = [];
		$nomor =1;
		foreach ( $result as $rows ) {

			$subtotal = $rows->jumlah_obat * $rows->harga_jual;

			$json[] = ['nomor' => $nomor,
			            'kode_barang' => $rows->kode_barang,
			            'nama_barang' => $rows->nama_barang,
			            'nama_satuan' => $rows->nama_satuan,
			            'jumlah_obat' => $rows->jumlah_obat,
			            'subtotal' => number_format($subtotal),
			            'aksi' => '<a href="#Modal-del" data-toggle="modal" 
			                          id="'.sha1($rows->id_temporary_transaksi_periksa).'"
			                         class="text-info edit">
	                                 <i class="fas fa-edit"></i>
	                               </a>

			                        <a href="#Modal-del" data-toggle="modal" id="'.sha1($rows->id_temporary_transaksi_periksa).'"
			                         class="text-red del">
	                                 <i class="fas fa-trash-alt"></i>
	                                </a>'
			          ];
		  $nomor++;
		}

		echo json_encode($json);
	}

	public function modal_edit()
	{
		$id = $this->security->xss_clean($this->input->post('id'));
		$data['edit'] = $this->transaksi_model->edit($id);
		$this->load->view('transaksi-periksa-pasien/modal_edit',$data);
	}

	public function perbarui()
	{
		$validation = $this->form_validation;
		$validation->set_rules('jumlah_obat','jumlah_obat','required|trim');

		if ( $validation->run() ){
			
		   $post = $this->security->xss_clean($this->input->post());
		   $id   = $post['id'];
		   $jumlah_obat_input = $post['jumlah_obat'];

		   $query = $this->db->query("SELECT b.jumlah_stok,ttp.* 
		   	                          FROM tb_temporary_transaksi_periksa ttp 
		   	                          JOIN tb_barang b ON ttp.id_barang=b.id_barang
		   	                          WHERE sha1(ttp.id_temporary_transaksi_periksa)='$id'");
		   $rows = $query->row();

		   if ( $rows->jumlah_stok >= $jumlah_obat_input ){

	                    $this->jumlah_obat = $jumlah_obat_input;
	          $update = $this->db->update('tb_temporary_transaksi_periksa', $this, 
	     	                       array('sha1(id_temporary_transaksi_periksa)' => $id));
		   		
		   	  if ( $update){ echo 'oke'; } else{ echo 'error'; }	
		   }
		   else{
		   	 echo 'stok_min';
		   }

		}
		else{
			echo 'error';
		}
	}

	public function modal_del()
	{
		$this->load->view('transaksi-periksa-pasien/delete');
	}

	public function hapus()
	{
		if ( $this->transaksi_model->delete()){
			echo 'oke';
		}
		else{
			echo 'error';
		}
	}

	public function biaya_obat()
	{
		$no_reg = $this->input->post('no_reg');
		$result = $this->transaksi_model->biaya_obat($no_reg);

		$array = array('by_obat' => number_format($result->harga_jual) );

		echo json_encode($array);
	}

	public function select_metode()
	{
		$id_metode = $this->input->post('metode');
		$result    = $this->transaksi_model->select_metode($id_metode);

		$array = array('title_label' => $result->title_label,
			           'status_form' => $result->status_form );

		echo json_encode($array);
	}

	public function simpan_trans()
	{
		$jam_transaksi = date('H:i:s');
		$create_date = date('Y-m-d H:i:s');
		
		$no_trans   = $this->input->post('no_trans');
		$no_reg     = $this->input->post('no_reg');
		$poliklinik = $this->input->post('poliklinik');
		$layanan    = $this->input->post('layanan');
		$tanggal_transaksi    = date('Y-m-d',strtotime($this->input->post('dt')));
		
		$by_lyan   = str_replace (',','',$this->input->post('by_lyan'));
		$by_obat   = str_replace (',','',$this->input->post('by_obat'));
		$sub_total = str_replace (',','',$this->input->post('sub_total'));
		
		$by_disc   = str_replace (',','',$this->input->post('by_disc'));
		$by_ppn    =str_replace (',','',$this->input->post('by_ppn'));
		$yg_hrus_dbyr =str_replace (',','',$this->input->post('yg_hrus_dbyr'));
		
		$metode    = $this->input->post('metode');
		$atas_nama = $this->input->post('atas_nama');
		$kasir     = $this->input->post('kasir');

		$sec_no_trans = $this->security->xss_clean($no_trans);
		$sec_no_reg   = $this->security->xss_clean($no_reg);
		$sec_poliklinik = $this->security->xss_clean($poliklinik);
		$sec_layanan  = $this->security->xss_clean($layanan);
		
		$sec_by_lyan = $this->security->xss_clean($by_lyan);
		$sec_by_obat  = $this->security->xss_clean($by_obat);
		$sec_sub_total  = $this->security->xss_clean($sub_total);
		
		$sec_by_disc  = $this->security->xss_clean($by_disc);
		$sec_by_ppn   = $this->security->xss_clean($by_ppn);
		$sec_yg_hrus_dbyr = $this->security->xss_clean($yg_hrus_dbyr);
		
		$sec_metode   = $this->security->xss_clean($metode);
		$sec_atas_nama = $this->security->xss_clean($atas_nama);
		$sec_kasir   = $this->security->xss_clean($kasir);

		$simpan_trans  = '';
		$update_daftar = '';
		$simpan_detail = '';
		$update_barang ='';
		$hapus_detail  = '';

		if ( $sec_no_trans == TRUE ){

			$query = $this->db->query("SELECT * FROM tb_transaksi_periksa 
				                       WHERE no_transaksi='$sec_no_trans'");
			if ( $query->num_rows() > 0 ){
				echo 'error';
			}
			else{

				$simpan_trans = $this->db->query("INSERT INTO tb_transaksi_periksa 
					                             (no_transaksi,id_daftar_periksa,nama_poliklinik,id_layanan,biaya_layanan,
					                             biaya_obat,sub_total,diskon,ppn,bayar,id_metode,atas_nama,nama_kasir,
					                             jam_transaksi,tanggal_transaksi,create_date)
					                             VALUES ('$sec_no_trans','$sec_no_reg','$sec_poliklinik','$sec_layanan','$sec_by_lyan',
					                             '$sec_by_obat','$sec_sub_total','$sec_by_disc',
					                             '$sec_by_ppn','$sec_yg_hrus_dbyr','$sec_metode','$sec_atas_nama','$sec_kasir',
					                             '$jam_transaksi','$tanggal_transaksi','$create_date')");

				$id_transaksi_periksa = $this->db->insert_id();

				$update_daftar = $this->db->query("UPDATE tb_daftar_periksa SET status_daftar='3' WHERE id_daftar_periksa='$sec_no_reg'");

				$query_check = $this->db->query("SELECT b.harga_jual,ttp.jumlah_obat,ttp.id_barang FROM tb_temporary_transaksi_periksa ttp 
					                             JOIN tb_barang b ON ttp.id_barang=b.id_barang 
					                             WHERE ttp.id_daftar_periksa='$sec_no_reg'");

				if ( $query_check->num_rows() > 0 ){
					
					foreach ( $query_check->result() as $rows ) {
						
						$harga_jual  = $rows->harga_jual;
					    $jumlah_obat = $rows->jumlah_obat;
					    $id_barang   = $rows->id_barang;

					    $sub_total = $harga_jual * $jumlah_obat;

					    $simpan_detail = $this->db->query("INSERT INTO tb_detail_transaksi_periksa 
					    	             (id_transaksi_periksa,id_barang,jumlah_obat,harga_satuan,sub_total,create_date) 
					    	             VALUES ('$id_transaksi_periksa','$id_barang','$jumlah_obat','$harga_jual','$sub_total',
					    	             '$create_date')");

					    $update_barang = $this->db->query("UPDATE tb_barang SET jumlah_stok=jumlah_stok-$jumlah_obat 
					    	                               WHERE id_barang='$id_barang'");
					}

					$hapus_detail = $this->db->query("DELETE FROM tb_temporary_transaksi_periksa
						                              WHERE id_daftar_periksa='$sec_no_reg'");
				}
				
				if ( ( $simpan_trans && $update_daftar ) || ( $simpan_detail && $update_barang && $hapus_detail ) ){
					$this->session->set_flashdata('success', 'Data berhasil disimpan');

					echo 'oke';
				}
				else{
					$this->session->set_flashdata('error', 'Data gagal disimpan');

					echo 'error';
				}
			}
		}
		else{

			$this->session->set_flashdata('error', 'Data gagal disimpan');
			echo 'error';
		}
	}

	public function cetak($no_transaksi)
	{
		$data['detail'] = $this->transaksi_model->cetak($no_transaksi);
		$this->load->view('transaksi-periksa-pasien/cetak',$data);
	}


	public function detail($detail)
	{
		$data['title'] = ucfirst(str_replace('-', ' ',$this->uri->segment(1)));
		$data['title_content'] = '<i class="fas fa-money-check-alt"></i> '.ucfirst(str_replace('-', ' ',$this->uri->segment(1)))  . ' / ' . ucfirst(str_replace('-', ' ', $this->uri->segment(2)));
		$data['info']  = $this->transaksi_model->get_informasi();

		$data['detail'] = $this->transaksi_model->detail($detail);
		
		$this->load->view('template/top',$data);
		$this->load->view('template/header');
		$this->load->view('template/sidebar',$data);

		if ( !$data['detail'] ){
			$this->load->view('template/404');
		}
		else{
			$this->load->view('transaksi-periksa-pasien/content_detail',$data);
		}
		
		$this->load->view('template/footer',$data);
		$this->load->view('template/modal');
		$this->load->view('template/js');
		$this->load->view('template/alert.php');
		$this->load->view('transaksi-periksa-pasien/function_detail');
		$this->load->view('template/bottom');
	}
}