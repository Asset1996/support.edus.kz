<div class="modal fade bd-example-modal-lg" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerModalLabel">{{ Lang::get("Sign up account") }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-6">
                    <form method="POST" action="{{ route('registration-post') }}" class="mx-1 mx-md-4">
                        @csrf
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="text" id="register_name" name="name" class="form-control" required/>
                                <label class="form-label" for="register_name">{{Lang::get("Name")}}</label>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="email" id="register_email" name="email" class="form-control" required/>
                                <label class="form-label" for="register_email">{{Lang::get("Email")}}</label>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="password" id="register_password" name="password" class="form-control" required/>
                                <label class="form-label" for="register_password">{{Lang::get("Password")}}</label>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="password" id="register_password_confirmation" name="password_confirmation" class="form-control" required/>
                                <label class="form-label" for="register_password_confirmation">{{Lang::get("Repeat your password")}}</label>
                                <p></p>
                                <span id="message"></span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button type="submit" class="btn btn-primary btn-lg" id="register_submit">{{Lang::get("Register")}}</button>
                        </div>
                        <div class="d-flex flex-row align-items-center mb-4">
                            Есть аккаунт?
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">
                                {{Lang::get("Login")}}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    {{ Lang::get('To register, the system requires your name and your email address') }}
                    <p></p>
                    {{ Lang::get('Password must contain:') }}
                    <p></p>
                    - {{ Lang::get('minimum 7 symbols ') }}
                    <p></p>
                    - {{ Lang::get('minimum 1 character ') }}
                    <p></p>
                    - {{ Lang::get('minimum 1 digit') }}
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ Lang::get('Close') }}</button>
        </div>
      </div>
    </div>
</div>