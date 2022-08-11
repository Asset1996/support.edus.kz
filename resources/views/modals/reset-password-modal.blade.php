<div class="modal fade bd-example-modal-lg" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="resetPasswordModalLabel">{{ Lang::get("Remind account password") }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm">
                    <form method="POST" action="{{ route('reset-password') }}" class="mx-1 mx-md-4">
                        @csrf
                        <div class="align-items-center">
                            <div class="form-outline flex-fill mb-0">
                                <input type="email" id="reset_password_email" name="email" class="form-control" required/>
                                <label class="form-label" for="reset_password_email">{{Lang::get("Email")}}</label>
                            </div>
                        </div>
                        <div class="justify-content-center">
                          <button type="submit" class="btn btn-primary modal-submit-button">{{Lang::get("Reset password")}}</button>
                        </div>
                        <div class="align-items-center pull-down">
                          {{ Lang::get('Remembered the password?') }}
                          <a data-toggle="modal" data-target="#loginModal" data-dismiss="modal" href="">{{Lang::get("Login")}}</a>
                      </div>
                    </form>
                </div>
                <div class="col-sm modal-info-block">
                    {{ Lang::get('If an account is found, an email with a link will be sent to your email') }}.
                    <p></p>
                    {{ Lang::get('If the mail is not found, you will need to') }} 
                    <a data-toggle="modal" data-target="#registerModal" data-dismiss="modal" href="">{{ Lang::get('register') }}</a>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>