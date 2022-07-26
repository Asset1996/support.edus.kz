<div class="container">
    <div class="mmyFoot">
        <div class="row">
            <!-- Single Widget-->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="single-footer-widget section_padding_0_130">
                    <!-- Footer Logo-->
                    <div class="footer-logo mb-3"></div>
                    <p class="text-white">{{ Lang::get("Copyright © 2022 Mediana LLC. All Rights Reserved") }}</p>
                    <!-- Copywrite Text-->
                    <!-- Footer Social Area-->
                </div>
            </div>
            <!-- Single Widget-->
            <div class=" col-sm-6 col-lg-4">
                <div class="single-footer-widget section_padding_0_130">
                    <!-- Widget Title-->
                    <h5 class="widget-title">{{ Lang::get("ABOUT SERVICE") }}</h5>
                    <!-- Footer Menu-->
                    <div class="footer_menu">
                        <ul>
                            <li><a href="{{ route('about-platform') }}">{{ Lang::get("About platform") }}</a></li>
                            <li><a href="{{ route('cooperation-proposal') }}">{{ Lang::get("Proposal for cooperation") }}</a></li>
                            <li><a href="{{ route('legal-details') }}">{{ Lang::get("Legal details") }}</a></li>
                            <li><a href="{{ route('terms-of-use') }}">{{ Lang::get("Terms of use") }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Single Widget-->
            <div class=" col-sm-6 col-lg-4">
                <div class="single-footer-widget section_padding_0_130">
                    <!-- Widget Title-->
                    <h5 class="widget-title">{{ Lang::get("DIRECTORY") }}</h5>
                    <!-- Footer Menu-->
                    <div class="footer_menu">
                        <ul>
                            <li><a href="{{ route('help') }}">{{ Lang::get("Help") }}</a></li>
                            <li><a href="{{ route('support') }}">{{ Lang::get("Support") }}</a></li>
                            <li><a href="{{ route('privacy-policy') }}">{{ Lang::get("Privacy Policy") }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Single Widget-->

        </div>
    </div>


</div>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap-filestyle.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
