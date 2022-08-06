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

    $('#new_password, #new_password_confirmation').on('keyup', function () {
    
        $('#reset_message').html('Отлично!').css('color', 'green');
        $("#set_new_password_submit").prop("disabled",false);
        pass_input = $('#new_password').val()
        pass_confirm_input = $('#new_password_confirmation').val()

        if (pass_input != pass_confirm_input) {
            $('#reset_message').html('Пароли не совпадают').css('color', 'red');
            $("#set_new_password_submit").prop("disabled",true);
        }
        if (pass_input.length < 7) {
            $('#reset_message').html('Минимальная длина пароли - 7 символов').css('color', 'red');
            $("#set_new_password_submit").prop("disabled",true);
        }
        if(!/[0-9]/.test(pass_input) || !/[a-zA-Z]/.test(pass_input)) {
            $('#reset_message').html('Пароль должен содержать минимум 1 букву и 1 цифру').css('color', 'red');
            $("#set_new_password_submit").prop("disabled",true);
        }
    });
  }