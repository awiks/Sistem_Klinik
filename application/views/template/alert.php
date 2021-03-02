<?php if ( $this->session->flashdata('success')): ?>
<script type="text/javascript" charset="utf-8" async defer>
  
  $(function() {

  	toastr.success('<?= $this->session->flashdata('success'); ?>')

  });
</script>
<?php endif ?>

<?php if ( $this->session->flashdata('error')): ?>
<script type="text/javascript" charset="utf-8" async defer>
  
  $(function() {

   toastr.error('<?= $this->session->flashdata('error'); ?>')
   
  });
</script>
<?php endif ?>

<?php if ( $this->session->flashdata('warning')): ?>
<script type="text/javascript" charset="utf-8" async defer>
  
  $(function() {
	
	toastr.warning('<?= $this->session->flashdata('warning'); ?>')
   
  });
</script>
<?php endif ?>