<?php $id = $this->input->post('id'); ?>
<div class="del" id="<?= $id ?>">
  <p>Yakin anda akan menghapus data ini ?</p>
</div>

<div class="modal-footer mt-2" style="margin:-15px">
    <button type="button" 
            class="btn btn-danger" 
            data-dismiss="modal">
       <i class="fa fa-undo"></i>
       <span>Batal</span>
    </button>
    <button type="button" 
            class="btn btn-primary hapus_data">
     <i class="fas fa-trash-alt"></i>
     <span>Hapus</span>
    </button>
</div>