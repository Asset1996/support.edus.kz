<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="fMod modal-dialog log modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title lMTitle" id="exampleModalLabel">{{ Lang::get("Sign up account") }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('registration-post') }}" class="mx-1 mx-md-4">
                    @csrf
                    <div class="modal_items">
                        <div class="modal_item">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="modal_form">
                                        <div class="form-group">
                                            <input type="text" name="name" placeholder="{{Lang::get("Name")}}" class="form-control myInput" id="register_name" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="{{Lang::get("Email")}}" class="form-control myInput" id="register_email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="modal_text">
                                        <p>{{ Lang::get('To register, the system requires your name and your email address') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal_item mt-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="modal_form">
                                        <div class="form-group">
                                            <input type="password" id="register_password" name="password" placeholder="{{Lang::get("Password")}}" class="form-control myInput" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" placeholder="{{Lang::get("Repeat your password")}}" name="password_confirmation" class="form-control myInput" id="register_password_confirmation" required>
                                        </div>
                                        <span id="message"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="modal_text">
                                        <span>{{ Lang::get('Password must contain:') }}</span>
                                        <ul style="margin-left: 30px;">
                                            <li>{{ Lang::get('minimum 7 symbols') }}</li>
                                            <li>{{ Lang::get('minimum 1 character') }}</li>
                                            <li>{{ Lang::get('minimum 1 digit') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="check_form">
                                        <div style="margin-bottom: -2px;" class="form-group form-check">
                                            <input type="checkbox" class="form-check-input " id="register_not_robot" name="not_robot">
                                            <label class="form-check-label" for="register_not_robot">{{ Lang::get('I\'m not robot:') }}</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-register_agree_with_terms-input" id="exampleCheck1" name="agree_with_terms">
                                            <label class="form-check-label" for="register_agree_with_terms">{{ Lang::get('I agree with the terms of service') }}</label>
                                        </div>

                                        <button id="register_submit" type="submit" class="btn btnColor text-white w-100">{{Lang::get("Register")}}</button>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="modal_text">
                                        <div style="margin-top: 3rem;" class="ff">
                                            <span>{{ Lang::get('Have a registration?') }}</span> <a href=""><a data-toggle="modal" data-target="#loginModal" data-dismiss="modal" href="">{{Lang::get("Login")}}</a></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>