<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* Author 		: No name
   Class Name 	: Stok_obat_model*/

class Stok_obat_model extends CI_Model
{

    public function __construct()
	{
		parent::__construct();
	}

	public function get_informasi()
	{
		$this->db->select('*');
		$this->db->from('tb_informasi_klinik');
		$this->db->where('id_informasi','1');

		return $this->db->get()->row();
	}

	public function get_kategori()
	{
		$this->db->select('*');
		$this->db->from('tb_kategori');
		$this->db->where('status','0');
		$this->db->order_by('id_kategori','DESC');

		return $this->db->get()->result();
	}

	public function get_supplier()
	{
		$this->db->select('*');
		$this->db->from('tb_supplier');
		$this->db->order_by('id_supplier');
		$this->db->where('status','0');

		return $this->db->get()->result();
	}

	public function get_obat($kategori,$urutan)
	{
		if ( $kategori == 'all' ){
			$this->db->select('*');
			$this->db->from('tb_barang');
			$this->db->join('tb_kategori','tb_barang.id_kategori=tb_kategori.id_kategori');
			$this->db->join('tb_satuan','tb_barang.id_satuan=tb_satuan.id_satuan');
			$this->db->order_by('tb_barang.id_barang',$urutan);
			$this->db->where('tb_barang.status','0');
			
		}
		else{

			$this->db->select('*');
			$this->db->from('tb_barang');
			$this->db->join('tb_kategori','tb_barang.id_kategori=tb_kategori.id_kategori');
			$this->db->join('tb_satuan','tb_barang.id_satuan=tb_satuan.id_satuan');
			$this->db->where('tb_barang.id_kategori',$kategori);
			$this->db->order_by('tb_barang.id_barang',$urutan);
			$this->db->where('tb_barang.status','0');
		}

		return $this->db->get()->result();
	}

	public function check_kode_trans()
    {
      $query = $this->db->query("SELECT MAX(no_transaksi) as no_transaksi 
                               FROM tb_barang_masuk ORDER BY id_barang_masuk DESC");
      $hasil = $query->row();
      return $hasil->no_transaksi;
    }

	public function edit($id)
	{
	  if(empty($id)) show_404();
	  return $this->db->get_where('tb_barang', 
		                array('sha1(id_barang)' => $id))->row();
	}

	public function update(){

	 $post = $this->security->xss_clean($this->input->post());
     $this->harga_jual    = str_replace (',','',$post['harga_jual']);
     $this->jumlah_stok    = $post['jumlah_stok'];
     return $this->db->update('tb_barang', $this, 
     	               array('sha1(id_barang)' => $post['id']));
	}

	public function ajax_stok_masuk($bulan,$tahun)
	{
		if ( $bulan == 'all' )
		{
			$this->db->select('*');
			$this->db->from('tb_barang_masuk bm');
			$this->db->join('tb_supplier s','bm.id_supplier=s.id_supplier');
			$this->db->where('DATE_FORMAT(bm.tanggal_masuk, "%Y")=',$tahun);
			$this->db->where('bm.status','0');
			$this->db->order_by('bm.tanggal_masuk','desc');
			
		}
		else
		{
			$this->db->select('*');
			$this->db->from('tb_barang_masuk bm');
			$this->db->join('tb_supplier s','bm.id_supplier=s.id_supplier');
			$this->db->where('DATE_FORMAT(bm.tanggal_masuk, "%c")=',$bulan);
			$this->db->where('DATE_FORMAT(bm.tanggal_masuk, "%Y")=',$tahun);
			$this->db->where('bm.status','0');
			$this->db->order_by('bm.tanggal_masuk','desc');
		}

		return $this->db->get()->result();
	}

	public function get_barang_masuk($id)
	{
		$query = $this->db->query("SELECT bm.no_transaksi,s.kode_supplier,s.nama_supplier,
			                       bm.tanggal_masuk FROM tb_barang_masuk bm
			                       JOIN tb_supplier s ON bm.id_supplier=s.id_supplier
			                       WHERE sha1(bm.id_barang_masuk)='$id'");

		return $query->row();
	}

	public function get_detail_masuk($id)
	{
		$query = $this->db->query("SELECT b.kode_barang,b.nama_barang,
			                       s.nama_satuan,dm.jumlah_masuk FROM tb_detail_masuk dm
			                       JOIN tb_barang b ON dm.id_barang=b.id_barang
			                       JOIN tb_satuan s ON b.id_satuan=s.id_satuan
			                       WHERE sha1(dm.id_barang_masuk)='$id'");

		return $query->result();
	}

	public function select_side_supplier($q)
	{
		$query = $this->db->query("SELECT * FROM tb_supplier 
							       WHERE status='0' AND 
                                   ( kode_supplier LIKE '%$q%' OR nama_supplier LIKE '%$q%' ) 
                                   ORDER BY kode_supplier DESC LIMIT 30");
		$hasil = $query->result();
		$json  = [];
		foreach ( $hasil as $row ) {
			
			$json[] = ['id'  => $row->id_supplier,
			           'text'=> $row->kode_supplier.' | '.ucwords($row->nama_supplier) ];
		}

		return json_encode($json);
	}

	public function select_side_obat($q)
	{
		$query = $this->db->query("SELECT b.*,s.nama_satuan FROM tb_barang b 
							       JOIN tb_satuan s ON b.id_satuan=s.id_satuan
							       WHERE b.status='0' AND 
                                   ( b.kode_barang LIKE '%$q%' OR b.nama_barang LIKE '%$q%' ) 
                                   ORDER BY b.kode_barang DESC LIMIT 30");
		$hasil = $query->result();
		$json  = [];
		foreach ( $hasil as $row ) {
			
			$json[] = ['id'  => $row->id_barang,
			           'text'=> $row->kode_barang.' | '.strtoupper($row->nama_barang).' | '.$row->nama_satuan ];
		}

		return json_encode($json);
	}


	public function ajax_add_data($id_supplier,$tanggal_masuk)
	{
		$query = $this->db->query("SELECT t.*,b.*,s.* FROM tb_temporary_masuk t 
								   JOIN tb_barang b ON t.id_barang=b.id_barang
								   JOIN tb_satuan s ON b.id_satuan=s.id_satuan
								   WHERE t.id_supplier='$id_supplier' AND 
								   t.tanggal_masuk='$tanggal_masuk'
								   ORDER BY t.id_temporary DESC");
		return $query->result();
	}

	public function add_data($array)
	{
		return $this->db->insert('tb_temporary_masuk', $array);
	}

	public function delete()
	{
		$id = $this->security->xss_clean($this->input->post('id'));
	  if(empty($id)) show_404();
   	  return $this->db->delete('tb_temporary_masuk', 
   	  	                array('sha1(id_temporary)' => $id));
	}

	public function update_add()
	{
		$post = $this->security->xss_clean($this->input->post());
        $this->jumlah = $post['jumlah'];
        return $this->db->update('tb_temporary_masuk', $this, 
     	                  array('sha1(id_temporary)' => $post['id']));
	}

	public function truncate_temporary_table()
	{
		$query = $this->db->query("TRUNCATE TABLE tb_temporary_masuk");

		return $query;
	}
}