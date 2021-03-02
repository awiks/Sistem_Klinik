<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="<?= site_url('vendor/img/'.$info->favicon.'') ?>">
	<title>Cetak antrian</title>
	<style>
		 * {
            margin: 0;
        }
        body{
        	font-size:12px;
        	font-family:Helvetica, Arial, sans-serif;
        }
		.container{
			margin:0 auto;
			width:220px;
			padding:5px;
			border: solid 1px #eeeeee66;
		}
		.header-title{
			border-bottom: dotted 1px #333;
			margin-bottom:10px;
		}
		.header-title>h1{
			font-size:1em;
			margin:2px;
			text-transform: uppercase;
		}
		.header-title>p{
			font-size:0.9em;
			margin:2px;
		}
		.content{
			margin-bottom:10px;
		}
		.content>h1{
			font-size:1.5em;
			text-align: center;
			margin-bottom:5px;
			margin-top:5px;
		}
		.content>h2{
			font-size:3em;
			text-align: center;
		}
		.content>p{
			text-transform: uppercase;
			text-align: center;
			line-height:20px;
		}
		.content>img{
            margin: 0 auto;
            display: block;
		}
		.content span{
			text-align: center;
			line-height:20px;
		}
		@media print{
			@page {size: portrait;}
		}
		@page {
		    margin: 0cm;
		}
	</style>
</head>
<!-- onload="window.print();window.close();" -->
<body>
	<div class="container">
		<div class="header-title">
			<h1><?= $info->nama_klinik ?></h1>
			<p><?= $info->alamat_klinik ?></p>
			<p><?= $info->no_telpon ?></p>
		</div>
		<div class="content">
			<h1>NO ANTRIAN</h1>
			<h2><?= $detail->no_antrian ?></h2>
			<?=
			   '<img src="' . site_url('registrasi-periksa-pasien/barcode/' . $detail->no_registrasi . '') . '">';
			?>
			<p><?= $detail->nama_poliklinik ?></p>
			<p>
				<span>Tanggal : <?= date('d/m/Y',strtotime($detail->tanggal)) ?></span>
				<span>Jam : <?= $detail->jam_daftar ?></span>
			</p>
		</div>
	</div>
</body>
</html>
