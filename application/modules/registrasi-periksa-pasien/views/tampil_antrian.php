<div class="row">
	<?php if ( $result ){  ?>
	<?php foreach ( $result as $rows ): ?>
	<div class="col-md-6">
		<div class="card mb-2">
		  <div class="card-header bg-olive">
            <h3 class="card-title">
              <i class="fas fa-hospital-user"></i>
              <?= $rows->nama_poliklinik ?>
            </h3>
          </div>
		<div class="card-body p-2">
			<div class="row">
				<?php
					$id_jadwal = $rows->id_jadwal;
					$tanggal   = $rows->tanggal_praktek;
					
					$query = $this->db->query("SELECT dp.*,d.* FROM tb_detail_praktek dp
						                       JOIN tb_dokter d ON dp.id_dokter=d.id_dokter
						                       WHERE dp.id_jadwal='$id_jadwal'
						                       AND dp.status='0'");

					if ( $query->num_rows() > 0 ){

						foreach ( $query->result() as $row ) {

							$id_detail_praktek = $row->id_detail_praktek;
							

							$query_urutan = $this->db->query("SELECT * FROM tb_daftar_periksa
								           WHERE id_detail_praktek='$id_detail_praktek' AND 
								           tanggal='$tanggal'");
							$jumlah = $query_urutan->num_rows();

							if ( $row->jam_end < date('H:i') ){
								$bg1 ='bg-warning';
								$bg2 ='bg-green';
							}
							else{
								$bg1 = '';
								$bg2 = 'bg-info';
							}
							
							echo '<div class="col-12 col-sm-6 col-md-6">
						            <div class="info-box mb-2 '.$bg1.'">
						              <span class="info-box-icon '.$bg2.' elevation-1">
						              '.$jumlah.'
						              </span>

						              <div class="info-box-content">
						                <span class="info-box-text">
						                <i class="fas fa-user-md"></i> '.substr($row->nama_dokter,0, 20).'...</span>
						                <span class="info-box-number mt-2">
						                 <i class="far fa-clock"></i> '.date('H:i',strtotime($row->jam_start)).' - '.date('H:i',strtotime($row->jam_end)).'
						                </span>
						              </div>
						              <!-- /.info-box-content -->
						            </div>
						            <!-- /.info-box -->
						          </div>';
						}
					}
					else{

						echo 'Data kosong';
					}
				?>
		    </div>
	    </div>
	    </div>
	</div>
    <?php endforeach; ?>
    <?php }else{ ?>
    	<div class="alert bg-olive mr-2 ml-2" style="width:100%">
         <i class="fas fa-exclamation-triangle"></i> Harap buat terlebih dahulu jadwal dokter jaga
        </div>
     <?php } ?>
</div>

