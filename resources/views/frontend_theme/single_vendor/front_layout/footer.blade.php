<footer class="footer bg-dark position-relative">
    <div class="footer-middle">
        <div class="container position-static">
            <div class="row">
                <div class="col-lg-2 col-sm-6 pb-2 pb-sm-0 d-flex align-items-center">
                    <div class="widget m-b-3">
                        <img src="{{ asset('single_vendor/assets/images/demoes/demo42/footer-logo.png') }}" alt="Logo" width="202"
                            height="54" class="logo-footer">
                    </div><!-- End .widget -->
                </div><!-- End .col-lg-3 -->

                <div class="col-lg-3 col-sm-6 pb-4 pb-sm-0">
                    <div class="widget mb-2">
                        <h4 class="widget-title mb-1 pb-1">Get In Touch</h4>
                        <ul class="contact-info">
                            <li>
                                <span class="contact-info-label">Address:</span>123 Street Name, City, England
                            </li>
                            <li>
                                <span class="contact-info-label">Phone:</span><a href="tel:">Toll Free (123)
                                    456-7890</a>
                            </li>
                            <li>
                                <span class="contact-info-label">Email:</span> <a
                                    href="mailto:mail@example.com">mail@example.com</a>
                            </li>
                            <li>
                                <span class="contact-info-label">Working Days/Hours:</span>
                                Mon - Sun / 9:00 AM - 8:00 PM
                            </li>
                        </ul>
                        <div class="social-icons">
                            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                                title="Facebook"></a>
                            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"
                                title="Twitter"></a>
                            <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank"
                                title="Linkedin"></a>
                        </div><!-- End .social-icons -->
                    </div><!-- End .widget -->
                </div><!-- End .col-lg-3 -->

                @isset($footer_menuitems)
                @foreach ($footer_menuitems as $footer_menuitem)

                <div class="col-lg-3 col-sm-6 pb-2 pb-sm-0">
                    <div class="widget">
                        <h4 class="widget-title pb-1">{{$footer_menuitem->title}}</h4>
                        @if(!$footer_menuitem->childs->isEmpty())
                        <ul class="links">
                            @foreach ($footer_menuitem->childs as $footer_item)
                            @if ($footer_item->slug == null)
                            <li><a href="{{$footer_item->url}}">{{$footer_item->title}}</a></li>
                            @else
                            <li><a href="{{route('page',$footer_item->slug)}}">{{$footer_item->title}}</a></li>
                            @endif
                            @endforeach
                        </ul>
                        @endif
                    </div><!-- End .widget -->
                </div><!-- End .col-lg-3 -->

                @endforeach
                @endisset
                <div class="col-lg-4 col-sm-6 pb-0">
                    <div class="widget widget-newsletter mb-1 mb-sm-3">
                        <h4 class="widget-title">Subscribe Newsletter</h4>

                        <p class="mb-2">Get all the latest information on events, sales and offers.
                            Sign up for newsletter:</p>
                        <form action="#" class="d-flex mb-0 w-100">
                            <input type="email" class="form-control mb-0" placeholder="Email address"
                                required="">

                            <input type="submit" class="btn shadow-none" value="OK">
                        </form>
                    </div>
                </div>
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .footer-middle -->

    <div class="container">
        <div class="footer-bottom d-sm-flex align-items-center bg-dark">
            <div class="footer-left">
                <span class="footer-copyright">Porto eCommerce. © 2021. All Rights Reserved</span>
            </div>

            <div class="footer-right ml-auto mt-1 mt-sm-0">
                <div class="payment-icons">
                    <span class="payment-icon visa"
                        style="background-image: url('{{ asset('single_vendor/assets/images/payments/payment-visa.svg') }}')"></span>
                    <span class="payment-icon paypal"
                        style="background-image: url('{{ asset('single_vendor/assets/images/payments/payment-paypal.svg') }}')"></span>
                    <span class="payment-icon stripe"
                        style="background-image: url('{{ asset('single_vendor/assets/images/payments/payment-stripe.png') }}')"></span>
                    <span class="payment-icon verisign"
                        style="background-image:  url('{{ asset('single_vendor/assets/images/payments/payment-verisign.svg') }}')"></span>
                </div>
            </div>
        </div>
    </div><!-- End .footer-bottom -->
</footer>
