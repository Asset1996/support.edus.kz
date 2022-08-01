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
                <div class="col-6">
                    <form method="POST" action="{{ route('reset-password') }}" class="mx-1 mx-md-4">
                        @csrf
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="email" id="reset_password_email" name="email" class="form-control" required/>
                                <label class="form-label" for="reset_password_email">{{Lang::get("Email")}}</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button type="submit" class="btn btn-primary btn-lg">{{Lang::get("Reset password")}}</button>
                        </div>
                        <div class="d-flex flex-row align-items-center mb-4">
                            {{ Lang::get('Remembered the password?') }}
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">
                                {{Lang::get("Login")}}
                              </button>
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    {{ Lang::get('If an account is found, an email with a link will be sent to your email.') }}
                    <p></p>
                    {{ Lang::get('If the mail is not found, you will need to register') }}
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>