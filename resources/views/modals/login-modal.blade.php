<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="fMod modal-dialog log modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title lMTitle" id="loginModalLabel">{{ Lang::get("Sign into the support system") }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="modal_item mt-4">
                            <div class="modal_text">
                                <p>{{ Lang::get('If you are here for the first time, then registration is required to enter your personal account:') }}</p>
                            </div>
                            <div class="modal_link">
                                <a style="border-radius: 10px;" class="btn logBtn" data-toggle="modal" data-target="#registerModal" data-dismiss="modal" href="">Зарегистрироваться</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="modal_item mt-4">
                            <div class="modal_form">
                                <h6 class="vTitle">{{ Lang::get('Only for registered users') }}</h6>

                                <form method="POST" action="{{ route('authenticate') }}">
                                    @csrf
                                    <div class="align-items-center">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="inputColor" for="login_email">{{Lang::get("Email")}}</label>
                                            <input type="email" id="login_email" name="email" class="form-control myInput" required />

                                        </div>
                                    </div>
                                    <div class="align-items-center">
                                        <div class="form-outline flex-fill mb-0 mt-2">
                                            <label class="inputColor" for="login_password">{{Lang::get("Password")}}</label>
                                            <input type="password" id="login_password" name="password" class="form-control myInput" required />

                                        </div>
                                    </div>
                                    <div style="margin-top: 29px; margin-bottom: 0;" class="form-group form-check">
                                        <input type="checkbox" class="form-check-input " id="login_not_robot" name="not_robot" required>
                                        <label class="form-check-label" for="login_not_robot">{{ Lang::get('I\'m not robot:') }}</label>
                                    </div>
                                    <div class="justify-content-center">
                                        <button type="submit" id="login_submit_button" class="btn btnColor modal-submit-button text-white w-100 mt-29">{{Lang::get("Login")}}</button>
                                    </div>
                                </form>

                            </div>
                            <div class="mt-71 ost">
                                <span>{{ Lang::get('Forgot the password?') }}</span> <a style="margin-left: -1px;" data-toggle="modal" data-target="#resetPasswordModal" data-dismiss="modal" href="">{{Lang::get("Remind password")}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
