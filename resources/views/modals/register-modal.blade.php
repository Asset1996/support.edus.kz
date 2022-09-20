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


                <form>


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
                                        <p class="stanDart">{{ Lang::get('To register, the system requires your name and your email address') }}</p>
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
                                    </div>



                                </div>

                                <div class="col-lg-6">
                                    <div style="line-height: 22px;" class="modal_text">
                                        <span class="stanDart">{{ Lang::get('Password must contain:') }}</span>
                                        <ul style="margin-left: 30px;">
                                            <li class="stanDart">{{ Lang::get('minimum 7 symbols') }}</li>
                                            <li class="stanDart">{{ Lang::get('minimum 1 character') }}</li>
                                            <li class="stanDart">{{ Lang::get('minimum 1 digit') }}</li>
                                        </ul>
                                    </div>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="check_form">
                                        <div style="margin-bottom: -2px;" class="form-group form-check">
                                            <input type="checkbox" class="form-check-input " id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Я не робот</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Согласен с условиями предоставления сервиса</label>
                                        </div>

                                        <button type="submit" class="btn btnColor text-white w-100">{{Lang::get("Register")}}</button>
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






















<!--


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
                    <div class="col-sm">
                        <form method="POST" action="{{ route('registration-post') }}" class="mx-1 mx-md-4">
                            @csrf
                            <div class="align-items-center">
                                <div class="form-outline flex-fill mb-0">
                                    <input type="text" id="register_name" name="name" class="form-control" required />
                                    <label class="form-label" for="register_name">{{Lang::get("Name")}}</label>
                                </div>
                            </div>
                            <div class="align-items-center">
                                <div class="form-outline flex-fill mb-0">
                                    <input type="email" id="register_email" name="email" class="form-control" required />
                                    <label class="form-label" for="register_email">{{Lang::get("Email")}}</label>
                                </div>
                            </div>
                            <div class="align-items-center">
                                <div class="form-outline flex-fill mb-0">
                                    <input type="password" id="register_password" name="password" class="form-control" required />
                                    <label class="form-label" for="register_password">{{Lang::get("Password")}}</label>
                                </div>
                            </div>
                            <div class="align-items-center">
                                <div class="form-outline flex-fill mb-0">
                                    <input type="password" id="register_password_confirmation" name="password_confirmation" class="form-control" required />
                                    <label class="form-label" for="register_password_confirmation">{{Lang::get("Repeat your password")}}</label>
                                    <p></p>
                                    <span id="message"></span>
                                </div>
                            </div>
                            <div class="justify-content-center">
                                <button type="submit" class="btn btn-primary modal-submit-button" id="register_submit">{{Lang::get("Register")}}</button>
                            </div>
                            <div class="align-items-center pull-down">
                                {{ Lang::get('Have a registration?') }}
                                <a data-toggle="modal" data-target="#loginModal" data-dismiss="modal" href="">{{Lang::get("Login")}}</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm modal-info-block">
                        <p>{{ Lang::get('To register, the system requires your name and your email address') }}</p>
                        <p>{{ Lang::get('Password must contain:') }}</p>
                        <p>- {{ Lang::get('minimum 7 symbols') }}</p>
                        <p>- {{ Lang::get('minimum 1 character') }}</p>
                        <p>- {{ Lang::get('minimum 1 digit') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->