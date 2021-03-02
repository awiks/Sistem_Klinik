<script type="text/javascript" charset="utf-8" async defer>
	
	$('body').on('click', '.cetak', function(event) {
		event.preventDefault();
		/* Act on the event */

		var no_trans = $(this).data('id');

		window.open('<?= site_url('transaksi-periksa-pasien/cetak/') ?>'+no_trans+'','_blank', 'width=800, height=500');
	});
</script>