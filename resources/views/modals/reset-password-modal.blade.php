<div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog fMod log modal-dialog-centered" role="document">
    <div style="padding: 30px 62px 190px 62px; border-radius: 15px;" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title lMTitle" id="exampleModalLabel">{{ Lang::get("Remind account password") }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal_items">
          <div class="row">
            <div class="col-lg-6">
              <div class="modal_item mt-4">
                <div class="modal_form">
                  <h6 class="mb-3">{{ Lang::get('Enter your email when registering:') }}</h6>
                  <form method="POST" action="{{ route('reset-password') }}">
                    @csrf
                    <div class="form-group">
                      <input placeholder="{{ Lang::get("Email") }}" type="email" name="email" class="form-control myInput" id="reset_password_email" required>
                    </div>
                    <div class="form-group form-check">
                      <input type="checkbox" class="form-check-input " id="reset_not_robot" name="not_robot" required>
                      <label class="form-check-label" for="reset_not_robot">{{ Lang::get('I\'m not robot:') }}</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Проверить аккаунт</button>
                  </form>
                  <div class="mt-43 fs-18">
                    <span>{{ Lang::get('Remembered the password?') }}</span> <a data-toggle="modal" data-target="#loginModal" data-dismiss="modal" href="">{{Lang::get("Login")}}</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="modal_item mt-4">
                <div style="max-width: 100%;" class="modal_text">
                  <p>{{ Lang::get('If an account is found, an email with a link will be sent to your email') }}.</p>
                  <p>{{ Lang::get('If the mail is not found, you will need to') }} <a data-toggle="modal" data-target="#registerModal" data-dismiss="modal" href="">{{ Lang::get('register') }}</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
