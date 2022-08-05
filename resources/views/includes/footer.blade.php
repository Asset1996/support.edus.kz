<footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>{{ Lang::get('Copyright © 2022 Mediana LLC. All Rights Reserved.') }} 
        </div>
      </div>
    </div>
  </footer>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
  window.onload = function() {
    setTimeout(function(){ $(".flash-messages").css('display','none'); },10000);
    $('#second_block').hide();

    $('#register_password, #register_password_confirmation').on('keyup', function () {

      $('#message').html('Отлично!').css('color', 'green');
      $("#register_submit").prop("disabled",false);
      pass_input = $('#register_password').val()
      pass_confirm_input = $('#register_password_confirmation').val()

      if (pass_input != pass_confirm_input) {
          $('#message').html('Пароли не совпадают').css('color', 'red');
          $("#register_submit").prop("disabled",true);
      }
      if (pass_input.length < 7) {
          $('#message').html('Минимальная длина пароли - 7 символов').css('color', 'red');
          $("#register_submit").prop("disabled",true);
      }
      if(!/[0-9]/.test(pass_input) || !/[a-zA-Z]/.test(pass_input)) {
          $('#message').html('Пароль должен содержать минимум 1 букву и 1 цифру').css('color', 'red');
          $("#register_submit").prop("disabled",true);
      }
    });
  }
</script>