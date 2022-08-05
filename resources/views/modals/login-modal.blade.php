<div class="modal fade bd-example-modal-lg" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">{{ Lang::get("Sign into the support system") }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-6">
                    {{ Lang::get('If you\'re here for the first time, you have to register to get to your personal account') }}
                </div>
                <div class="col-6">
                    <form method="POST" action="{{ route('authenticate') }}">
                        @csrf
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="email" id="login_email" name="email" class="form-control" required/>
                                <label class="form-label" for="login_email">{{Lang::get("Email")}}</label>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="password" id="login_password" name="password" class="form-control" required/>
                                <label class="form-label" for="login_password">{{Lang::get("Password")}}</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button type="submit" class="btn btn-primary btn-lg">{{Lang::get("Login")}}</button>
                        </div>
                        <div class="d-flex flex-row align-items-center mb-4">
                            Забыли пароль?
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#resetPasswordModal" data-dismiss="modal">
                                {{Lang::get("Remind password")}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ Lang::get('Close') }}</button>
        </div>
      </div>
    </div>
</div>