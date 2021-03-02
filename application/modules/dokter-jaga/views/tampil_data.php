<div class="table-responsive">
  <table class="table table-bordered" width="100%">
    <thead>
      <tr class="bg-olive">
        <th>#</th>
        <th>Hari</th>
        <th>Poliklinik</th>
        <th width="10%">Add</th>
        <th>Nama Dokter</th>
        <th>Deskripsi</th>
        <th>Jam Kunjungan</th>
        <th width="10%">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if ( $result ){
          $nomor=1;
          foreach ( $result as $rows ) {

            $hari = date('w',strtotime($rows->tanggal_praktek));

            $day = array("","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu","Minggu");
            $id_jadwal = $rows->id_jadwal;

            $query = $this->db->query("SELECT dp.*,d.* FROM tb_detail_praktek dp
                                       JOIN tb_dokter d ON dp.id_dokter=d.id_dokter
                                       WHERE dp.id_jadwal='$id_jadwal' AND dp.status='0'");

            $count = $query->num_rows();
            $count_rows = $count + 1;

            echo '<tr>
                    <td rowspan="'.$count_rows.'" class="p-2">'.$nomor.'</td>
                    <td rowspan="'.$count_rows.'" class="p-2">'.$day[$hari].'</td>
                    <td rowspan="'.$count_rows.'" class="p-2">'.$rows->nama_poliklinik.'</td>
                    <td rowspan="'.$count_rows.'" class="p-2 text-center">
                      <button type="button" 
                              data-toggle="modal" 
                              data-target="#Modal-add"
                              data-poli="'.$rows->nama_poliklinik.'"
                              data-id="'.$rows->id_jadwal.'" 
                              class="btn bg-olive btn-xs add-jadwal">
                              <i class="fas fa-plus-circle"></i> 
                               Add</button>

                      <a href="#Modal-del" 
                         data-toggle="modal" 
                         id="'.sha1($rows->id_jadwal).'" 
                         class="btn btn-xs btn-danger delete">
                        <i class="far fa-trash-alt"></i>
                      </a>
                    </td>';
              if ( $count > 0 ){
                foreach ( $query->result() as $row ) {
                  
                  echo '<tr>
                          <td>'.$row->nama_dokter.'</td>
                          <td>'.$row->deskripsi_jadwal.'</td>
                          <td>'.date('H:i',strtotime($row->jam_start)).' - '.date('H:i',strtotime($row->jam_end)).'</td>
                          <td>
                            <a href="#Modal-edit" 
                               data-toggle="modal" 
                               id="'.sha1($row->id_detail_praktek).'"
                               data-poli="'.$rows->nama_poliklinik.'" 
                               class="btn btn-success btn-xs edit_jadwal">
                            <i class="far fa-edit"></i>
                            </a>
                            <a href="#Modal-del" 
                               data-toggle="modal" 
                               id="'.sha1($row->id_detail_praktek).'" 
                               class="btn btn-xs btn-danger delete_jadwal">
                              <i class="far fa-trash-alt"></i>
                            </a>
                          </td>
                        </tr>';
                }
              }
              else{
                echo '<td colspan="4" class="text-center">Data masih kosong</td>';
              }

            echo '</tr>';

            $nomor++;
          }
        }
        else{
          echo '<tr>
                   <td colspan="8"
                       class="text-center">Data masih kosong</td>
                </tr>';
        }
      ?>
    </tbody>
  </table>
</div>