<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cetak</title>
	<style>
		body{
			font-size:0.9em;
		}
		.container{
			width: 600px;
			margin: 0 auto;
		}
		.center{
			text-align: center;
		}
		pre{
			margin:2px;
			letter-spacing:-1px;
		}
		.table{
			border-spacing: 0;
			border-collapse: separate !important;
			margin-top:5px;
			line-height:0.7em;
		}
		.table>thead>tr>th{
			text-align: left;
			border-top: 0.1em dashed;
			border-bottom: 0.1em solid;
			
		}
	</style>
</head>
<body>
	<div class="container">
		
		<pre class="center" style="font-weight:bold;">KLINIK MEDIKA NAROM</pre>
		<pre class="center">Jl. Jegang, Jayasampurna, Kec. Serang Baru, Bekasi, Jawa Barat</pre>
		<pre class="center">(021) 89283669</pre>
		<hr style="border:0.1em dashed;">
		
		<table width="100%" style="line-height:0.5em;">
			<tbody>
				<tr>
					<td><pre>No Trans</pre></td>
					<td>:</td>
					<td><pre><?= $detail->no_transaksi ?></pre></td>
				</tr>
				<tr>
					<td><pre>Kasir</pre></td>
					<td>:</td>
					<td><pre><?= $detail->nama_kasir ?></pre></td>
				</tr>
				<tr>
					<td><pre>Tanggal</pre></td>
					<td>:</td>
					<td><pre><?= date('d-m-Y',strtotime($detail->tanggal_transaksi)) ?></pre></td>
				</tr>
				<tr>
					<td><pre>Jam</pre></td>
					<td>:</td>
					<td><pre><?= date('H:i:s',strtotime($detail->jam_transaksi)) ?></pre></td>
				</tr>
			</tbody>
		</table>

		<table class="table" width="100%">
			<thead>
				<tr>
					<th><pre>POLIKLINIK</pre></th>
					<th><pre>JENIS LAYANAN</pre></th>
					<th width="15%"><pre>BIAYA</pre></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><pre><?= $detail->nama_poliklinik ?></pre></td>
					<td><pre><?= $detail->deskripsi_layanan ?></pre></td>
					<td><pre><?= number_format($detail->biaya_layanan) ?></pre></td>
				</tr>
			</tbody>
		</table>

		<table class="table" width="100%">
			<thead>
				<tr>
					<th><pre>NAMA OBAT</pre></th>
					<th width="30%"><pre>ATURAN PAKAI</pre></th>
					<th><pre>QTY</pre></th>
					<th><pre>HARGA</pre></th>
					<th width="15%"><pre>SUBTOTAL</pre></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$id_transaksi_periksa = $detail->id_transaksi_periksa;

					$query = $this->db->query("SELECT dtp.*,b.nama_barang,b.aturan_pakai FROM tb_detail_transaksi_periksa  dtp
											   JOIN tb_barang b ON dtp.id_barang=b.id_barang
						                       WHERE dtp.id_transaksi_periksa='$id_transaksi_periksa'");

					foreach ( $query->result() as $row ) {
						
						echo '<tr>
								<td><pre>'.$row->nama_barang.'</pre></td>
								<td><pre>'.$row->aturan_pakai.'</pre></td>
								<td><pre>'.$row->jumlah_obat.'</pre></td>
								<td><pre>'.number_format($row->harga_satuan).'</pre></td>
								<td><pre>'.number_format($row->sub_total).'</pre></td>
							 </tr>';

					}

				?>

				<tr>
					<td></td>
					<td></td>
					<td colspan="2"><pre>Total biaya Obat</pre></td>
					<td><pre><?= number_format($detail->biaya_obat) ?></pre></td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td colspan="2"><pre>Sub Total</pre></td>
					<td><pre><?= number_format($detail->sub_total) ?></pre></td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td colspan="2"><pre>Diskon</pre></td>
					<td><pre><?= number_format($detail->diskon) ?></pre></td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td colspan="2"><pre>Yang dibayar</pre></td>
					<td><pre><?= number_format($detail->bayar) ?></pre></td>
				</tr>
				
			</tbody>
		</table>


	</div>
</body>
</html>