<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="<?= site_url('vendor/img/'.$info->favicon.'') ?>">
	<title>Cetak Kartu Pasien</title>
	<style>
		 * {
            margin: 0;
        }
        body{
        	font-size:12px;
        	font-family:'Times New Roman';
        }
		.container{
			margin:0 auto;
			width:365px;
			padding:5px;
			background-color: #c5fff7;
			border-radius: 5px;
		}
		.header-title{
			border: solid 1px #ddd;
			padding:2px;
		}
		.header-title>h1{
			font-size:14px;
			margin:2px;
			text-transform: uppercase;
			text-align: center;
		}
		.header-title>p{
			font-size:12px;
			margin:2px;
			text-align: center;
			letter-spacing:0px;
		}
		.content-title{
			padding:4px;
			background-color:#333333e3;
			color:#fff;
			margin-top:5px;
			margin-bottom:3px;
			text-align: center;
			font-size:18px;
			font-weight:bold;
			border-radius:5px;
		}
		.content-footer{
			padding: 2px;
			text-align: center;
			margin-top:5px;
			border: solid 1px #ddd;
			font-size:14px;
			font-weight: bold;
		}
		@media print{
			@page {size: landscape;}
			/*body{
				background-color: #c5fff7;
			}*/
		}
		@page {
		    margin: 0cm;
		}
		.left{
			width: 262px;
			float: left;
		}
		.right{
			width: 100px;
			float: right;
			text-align: center;
			margin-top:5px;
		}
		.clear{
			clear: both;
		}
	</style>
</head>
<!-- onload="window.print()" -->
<body>
	<div class="container">
		<div class="header-title">
			<h1><?= $info->nama_klinik ?></h1>
			<p><?= $info->alamat_klinik ?></p>
			<p>No.Telp : <?= $info->no_telpon ?></p>
		</div>
		<div class="content-title">KARTU BEROBAT</div>
		<div class="left">
			<table width="100%" style="line-height:13px;">
			   <tbody>
				<tr>
					<td width="30%">No.Rm</td>
					<td width="2%">:</td>
					<td><?= $detail->no_rekam_medik ?></td>
				</tr>

				<tr>
					<td width="30%">Nama</td>
					<td width="2%">:</td>
					<td><?= $detail->nama_pasien ?></td>
				</tr>

				<tr>
					<td width="30%">Tanggal Lahir</td>
					<td width="2%">:</td>
					<td><?= date('d-m-Y',strtotime($detail->tanggal_lahir)) ?></td>
				</tr>

				<tr>
					<td width="30%" style="vertical-align:top">Alamat</td>
					<td width="2%" style="vertical-align:top">:</td>
					<td><?= $detail->alamat_pasien ?></td>
				</tr>

				<tr>
					<td width="30%">No Telp</td>
					<td width="2%">:</td>
					<td><?= $detail->no_telepon ?></td>
				</tr>
			   </tbody>
		    </table>
		</div>
		<div class="right">
			<img src="<?= site_url('vendor/barcode/'.$detail->no_rekam_medik.'.png') ?>" 
			    alt="barcode"
			    style="width:85px;">
		</div>
		
		<div class="clear"></div>

		<div class="content-footer">- Harus dibawa setiap berobat -</div>
	</div>
</body>
</html>