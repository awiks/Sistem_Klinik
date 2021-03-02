<script type="text/javascript" charset="utf-8" async defer>
  $(function(){

    $('[name=email]').val('');
    $('[name=password]').val('');

    $('#remember').click(function(){
      if($(this).is(':checked')){
        $('[name=password]').attr('type','text');
      }else{
        $('[name=password]').attr('type','password');
      }
    });

    $('#proses').validate({
      errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.input-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
    })
  });
</script>