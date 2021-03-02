<table width="100%" class="mb-3">
	<tbody>
		<tr>
			<td>No Antrian</td>
			<td>:</td>
			<td><?= $count ?></td>
		</tr>
		<tr>
			<td>No Rm</td>
			<td>:</td>
			<td><?= $code ?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?= $name ?></td>
		</tr>
		<tr>
			<td>Jam Registrasi</td>
			<td>:</td>
			<td><?= $time ?></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>:</td>
			<td><?= date('d-m-Y',strtotime($date)) ?></td>
		</tr>
		<tr>
			<td>Poliklinik</td>
			<td>:</td>
			<td><?= $poli ?></td>
		</tr>
		<tr>
			<td>Jam Praktek</td>
			<td>:</td>
			<td><?= $praktek ?></td>
		</tr>
		<tr>
			<td>Dokter</td>
			<td>:</td>
			<td><?= $doct ?></td>
		</tr>
	</tbody>
</table>

<div class="modal-footer mt-2" style="margin:-15px">

<?php if ( $status == '0' ){ ?>

<button type="button"
        data-id="<?= $id ?>" 
        class="btn btn-primary proses_btn">
 <i class="fas fa-spinner"></i> Proses</button>

<button type="button"
        data-id="<?= $id ?>" 
        class="btn btn-warning pending_btn">
<i class="fas fa-hourglass-half"></i> Pending</button>

<?php } else if ( $status == '1' ) { ?>

<button type="button"
        data-id="<?= $id ?>" 
        class="btn btn-info cancel_btn">
<i class="fas fa-times"></i> Cancel</button>

<?php } else if ( $status == '2' ) { ?>

<button type="button"
        data-id="<?= $id ?>" 
        class="btn btn-info cancel_btn">
<i class="fas fa-times"></i> Cancel</button>

<button type="button"
        data-id="<?= $id ?>" 
        class="btn btn-primary proses_btn">
 <i class="fas fa-spinner"></i> Proses</button>

<?php } else { ?>

<button type="button"
        class="btn btn-success">
<i class="fas fa-check"></i> Transaksi Selesai</button>

<?php } ?>
<button type="button" 
            class="btn btn-danger" 
            data-dismiss="modal">
       <i class="fa fa-undo"></i>
       <span>Keluar</span>
    </button>
</div>
