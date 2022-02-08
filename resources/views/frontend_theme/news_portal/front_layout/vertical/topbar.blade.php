<div id="top-bar" style="background: black;">
    <div class="container clearfix">
        <div class="row justify-content-between">
            <div class="col-2">
                <div style="text-align: right; margin-top: 6px; color: #d72924; font-weight: 700;">
                    BREAKING NEWS:
                </div>
            </div>
            <div class="col-8">
                <div class="scroll">
                    <h3>
                        <marquee style="color: white;" direction="left" scrollamount="4" onmouseover="this.stop()" onmouseout="this.start()">
                            নো মাস্ক নো সার্ভিস। করোনাভাইরাসের বিস্তার রোধে এখনই ডাউনলোড করুন Corona Tracer BD অ্যাপ। ডাউনলোড করতে ক্লিক করুন
                            <a href="https://bit.ly/coronatracerbd" target="_blank" style="color: blue;">https://bit.ly/coronatracerbd</a>। নিজে সুরক্ষিত থাকুন অন্যকেও নিরাপদ রাখুন। দেশের প্রথম ক্রাউডফান্ডিং প্ল্যাটফর্ম 'একদেশ'- এর
                            মাধ্যমে আর্থিক অনুদান পৌঁছে দিন নির্বাচিত সরকারি-বেসরকারি প্রতিষ্ঠানসমূহে। ভিজিট করুন <a href="//ekdesh.ekpay.gov.bd" target="_blank" style="color: blue;">ekdesh.ekpay.gov.bd</a> অথবা
                            <a href="//play.google.com/store/apps/details?id=com.synesis.donationapp" target="_blank" style="color: blue;">“Ek Desh”</a> অ্যাপ ডাউনলোড করুন। করোনার লক্ষণ দেখা দিলে গোপন না করে ডাক্তারের পরামর্শের জন্য
                            ফ্রি কল করুন ৩৩৩ ও ১৬২৬৩ নম্বরে। করোনাভাইরাস প্রতিরোধে নিয়ম মেনে মাস্ক ব্যবহার করুন। আতঙ্কিত না হয়ে বরং সচেতন থাকুন। ভিজিট করুন
                            <a href="//corona.gov.bd" target="_blank" style="color: blue;">corona.gov.bd</a>
                        </marquee>
                    </h3>
                </div>

                <style>
                    .scroll {
                        background: black;
                        padding: 5px 0px 0px 0px;
                        height: 30px;
                    }

                    .scroll > h3 {
                        font-weight: bold;
                        font-size: 15px;
                        line-height: 15px;
                    }

                    marquee {
                        padding: 5px 0px 5px;
                    }

                    @media (max-width: 480px) {
                        .scroll {
                            margin: 0px 0px 40px 0px;
                        }
                    }
                </style>
            </div>
            <div class="col-2" style="background: #d72924">
                <div class="date">
                    @php
                        use Carbon\Carbon;
                        $date = Carbon::now();
                    @endphp
                   {{$date->format('l, F d')}}
                </div>
                <style>
                    .date {
                        text-align: center;
                        margin-top: 5px;
                        color: #fff;
                        font-weight: 700;
                    }


                </style>
            </div>


            {{-- <div class="col-12 col-md-auto">

                <!-- Top Links
                ============================================= -->
                <div class="top-links on-click">
                    <ul class="top-links-container">
                        <li class="top-links-item"><a href="index.html">Home</a>
                            <ul class="top-links-sub-menu">
                                <li class="top-links-item"><a href="about.html">About</a></li>
                                <li class="top-links-item"><a href="faqs.html">FAQs</a></li>
                                <li class="top-links-item"><a href="contact.html">Contact</a></li>
                                <li class="top-links-item"><a href="sitemap.html">Sitemap</a></li>
                            </ul>
                        </li>
                        <li class="top-links-item"><a href="faqs.html">FAQs</a></li>
                        <li class="top-links-item"><a href="contact.html">Contact</a></li>
                        <li class="top-links-item"><a href="login-register.html">Login</a>
                            <div class="top-links-section">
                                <form id="top-login" autocomplete="off">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="email" class="form-control" placeholder="Email address">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Password" required="">
                                    </div>
                                    <div class="form-group form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="top-login-checkbox">
                                        <label class="form-check-label" for="top-login-checkbox">Remember Me</label>
                                    </div>
                                    <button class="btn btn-danger w-100" type="submit">Sign in</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div><!-- .top-links end -->

            </div>

            <div class="col-12 col-md-auto">

                <!-- Top Social
                ============================================= -->
                <ul id="top-social">
                    <li><a href="#" class="si-facebook"><span class="ts-icon"><i class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a></li>
                    <li><a href="#" class="si-twitter"><span class="ts-icon"><i class="icon-twitter"></i></span><span class="ts-text">Twitter</span></a></li>
                    <li class="d-none d-sm-flex"><a href="#" class="si-dribbble"><span class="ts-icon"><i class="icon-dribbble"></i></span><span class="ts-text">Dribbble</span></a></li>
                    <li><a href="#" class="si-github"><span class="ts-icon"><i class="icon-github-circled"></i></span><span class="ts-text">Github</span></a></li>
                    <li class="d-none d-sm-flex"><a href="#" class="si-pinterest"><span class="ts-icon"><i class="icon-pinterest"></i></span><span class="ts-text">Pinterest</span></a></li>
                    <li><a href="#" class="si-instagram"><span class="ts-icon"><i class="icon-instagram2"></i></span><span class="ts-text">Instagram</span></a></li>
                    <li><a href="tel:+1.11.85412542" class="si-call"><span class="ts-icon"><i class="icon-call"></i></span><span class="ts-text">+1.11.85412542</span></a></li>
                    <li><a href="mailto:info@canvas.com" class="si-email3"><span class="ts-icon"><i class="icon-email3"></i></span><span class="ts-text">info@canvas.com</span></a></li>
                </ul><!-- #top-social end -->

            </div> --}}

        </div>

    </div>
</div>
