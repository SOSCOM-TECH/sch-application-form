<!DOCTYPE html>
<html lang="en">

<head>
  <!--====== Required meta tags ======-->
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="description" content="Digital school application form platform for Tanzania. Create, publish, and sell online application forms with secure mobile money payments (M-Pesa, Airtel Money, Tigo Pesa). Streamline admissions for private schools, colleges, and vocational training centers." />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!--====== Title ======-->
  <title>Shule Chap | Digital Admissions Made Easy</title>

  <!--====== Favicon Icon ======-->
  <link rel="shortcut icon" href="{{ asset('images/iconWhite.png') }}" type="image/svg" />

  <!--====== Bootstrap css ======-->
  <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}" />

  <!--====== Line Icons css ======-->
  <link rel="stylesheet" href="{{ asset('landing/css/lineicons.css') }}" />

  <!--====== Tiny Slider css ======-->
  <link rel="stylesheet" href="{{ asset('landing/css/tiny-slider.css') }}" />

  <!--====== gLightBox css ======-->
  <link rel="stylesheet" href="{{ asset('landing/css/glightbox.min.css') }}" />

  <link rel="stylesheet" href="{{ asset('style.css') }}" />
</head>

<body>

  <!--====== NAVBAR NINE PART START ======-->

  <section class="navbar-area navbar-nine">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ route('welcome') }}">
              <img src="{{ asset('images/logo-text.png') }}" alt="SOSCOM Technologies" style="height: 30px;" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNine"
              aria-controls="navbarNine" aria-expanded="false" aria-label="Toggle navigation">
              <span class="toggler-icon"></span>
              <span class="toggler-icon"></span>
              <span class="toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse sub-menu-bar" id="navbarNine">
              <ul class="navbar-nav me-auto">
                <li class="nav-item">
                  <a class="page-scroll active" href="#hero-area">Home</a>
                </li>
                <li class="nav-item">
                  <a class="page-scroll" href="#services">Features</a>
                </li>
                <li class="nav-item">
                  <a class="page-scroll" href="#pricing">Pricing</a>
                </li>
                <li class="nav-item">
                  <a class="page-scroll" href="#contact">Contact</a>
                </li>
              </ul>

            </div>

            <div class="navbar-btn d-none d-lg-inline-block">
              <a class="menu-bar" href="#side-menu-left"><i class="lni lni-menu"></i></a>
            </div>
          </nav>
          <!-- navbar -->
        </div>
      </div>
      <!-- row -->
    </div>
    <!-- container -->
  </section>

  <!--====== NAVBAR NINE PART ENDS ======-->

  <!--====== SIDEBAR PART START ======-->

  <div class="sidebar-left">
    <div class="sidebar-close">
      <a class="close" href="#close"><i class="lni lni-close"></i></a>
    </div>
    <div class="sidebar-content">
      <div class="sidebar-logo">
        <a href="{{ route('welcome') }}"><img src="{{ asset('images/soscom.png') }}" alt="Logo" style="height: 40px;" /></a>
      </div>
      <p class="text">Transform your school's admission process with our digital application form platform. Streamline applications, secure payments, and manage applicants effortlessly.</p>
      <!-- logo -->
      <div class="sidebar-menu">
        <h5 class="menu-title">Quick Links</h5>
        <ul>
          <li><a href="{{ route('login') }}">School Login</a></li>
          <li><a href="{{ route('register') }}">Register School</a></li>
          <li><a href="#services">Features</a></li>
          <li><a href="#contact">Contact Us</a></li>
        </ul>
      </div>
      <!-- menu -->
      <div class="sidebar-social align-items-center justify-content-center">
        <h5 class="social-title">Follow Us On</h5>
        <ul>
          <li>
            <a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
          </li>
          <li>
            <a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
          </li>
          <li>
            <a href="javascript:void(0)"><i class="lni lni-linkedin-original"></i></a>
          </li>
          <li>
            <a href="javascript:void(0)"><i class="lni lni-youtube"></i></a>
          </li>
        </ul>
      </div>
      <!-- sidebar social -->
    </div>
    <!-- content -->
  </div>
  <div class="overlay-left"></div>

  <!--====== SIDEBAR PART ENDS ======-->

  <!-- Start header Area -->
  <section id="hero-area" class="header-area header-eight">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-12 col-12">
          <div class="header-content">
            <h1>Digital School Application Forms Made Simple</h1>
            <p>
              Transform your school's admission process with our all-in-one platform.
              Create, publish, and sell online application forms with secure payments,
              automated management, and professional branding. Say goodbye to paper forms
              and manual cash handling.
            </p>
            <div class="button">
              <a href="{{ route('register') }}" class="btn primary-btn">Start Free Trial</a>
              <a href="{{ route('login') }}" class="btn primary-btn-outline">School Login</a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-12">
          <div class="header-image">
            <img src="landing/images/header/hero-image.jpg" alt="#" />
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End header Area -->

  <!--====== ABOUT FIVE PART START ======-->

  <section class="about-area about-five">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-12">
          <div class="about-image-five">
            <svg class="shape" width="106" height="134" viewBox="0 0 106 134" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <circle cx="1.66654" cy="1.66679" r="1.66667" fill="#DADADA" />
              <circle cx="1.66654" cy="16.3335" r="1.66667" fill="#DADADA" />
              <circle cx="1.66654" cy="31.0001" r="1.66667" fill="#DADADA" />
              <circle cx="1.66654" cy="45.6668" r="1.66667" fill="#DADADA" />
              <circle cx="1.66654" cy="60.3335" r="1.66667" fill="#DADADA" />
              <circle cx="1.66654" cy="88.6668" r="1.66667" fill="#DADADA" />
              <circle cx="1.66654" cy="117.667" r="1.66667" fill="#DADADA" />
              <circle cx="1.66654" cy="74.6668" r="1.66667" fill="#DADADA" />
              <circle cx="1.66654" cy="103" r="1.66667" fill="#DADADA" />
              <circle cx="1.66654" cy="132" r="1.66667" fill="#DADADA" />
              <circle cx="16.3333" cy="1.66679" r="1.66667" fill="#DADADA" />
              <circle cx="16.3333" cy="16.3335" r="1.66667" fill="#DADADA" />
              <circle cx="16.3333" cy="31.0001" r="1.66667" fill="#DADADA" />
              <circle cx="16.3333" cy="45.6668" r="1.66667" fill="#DADADA" />
              <circle cx="16.333" cy="60.3335" r="1.66667" fill="#DADADA" />
              <circle cx="16.333" cy="88.6668" r="1.66667" fill="#DADADA" />
              <circle cx="16.333" cy="117.667" r="1.66667" fill="#DADADA" />
              <circle cx="16.333" cy="74.6668" r="1.66667" fill="#DADADA" />
              <circle cx="16.333" cy="103" r="1.66667" fill="#DADADA" />
              <circle cx="16.333" cy="132" r="1.66667" fill="#DADADA" />
              <circle cx="30.9998" cy="1.66679" r="1.66667" fill="#DADADA" />
              <circle cx="74.6665" cy="1.66679" r="1.66667" fill="#DADADA" />
              <circle cx="30.9998" cy="16.3335" r="1.66667" fill="#DADADA" />
              <circle cx="74.6665" cy="16.3335" r="1.66667" fill="#DADADA" />
              <circle cx="30.9998" cy="31.0001" r="1.66667" fill="#DADADA" />
              <circle cx="74.6665" cy="31.0001" r="1.66667" fill="#DADADA" />
              <circle cx="30.9998" cy="45.6668" r="1.66667" fill="#DADADA" />
              <circle cx="74.6665" cy="45.6668" r="1.66667" fill="#DADADA" />
              <circle cx="31" cy="60.3335" r="1.66667" fill="#DADADA" />
              <circle cx="74.6668" cy="60.3335" r="1.66667" fill="#DADADA" />
              <circle cx="31" cy="88.6668" r="1.66667" fill="#DADADA" />
              <circle cx="74.6668" cy="88.6668" r="1.66667" fill="#DADADA" />
              <circle cx="31" cy="117.667" r="1.66667" fill="#DADADA" />
              <circle cx="74.6668" cy="117.667" r="1.66667" fill="#DADADA" />
              <circle cx="31" cy="74.6668" r="1.66667" fill="#DADADA" />
              <circle cx="74.6668" cy="74.6668" r="1.66667" fill="#DADADA" />
              <circle cx="31" cy="103" r="1.66667" fill="#DADADA" />
              <circle cx="74.6668" cy="103" r="1.66667" fill="#DADADA" />
              <circle cx="31" cy="132" r="1.66667" fill="#DADADA" />
              <circle cx="74.6668" cy="132" r="1.66667" fill="#DADADA" />
              <circle cx="45.6665" cy="1.66679" r="1.66667" fill="#DADADA" />
              <circle cx="89.3333" cy="1.66679" r="1.66667" fill="#DADADA" />
              <circle cx="45.6665" cy="16.3335" r="1.66667" fill="#DADADA" />
              <circle cx="89.3333" cy="16.3335" r="1.66667" fill="#DADADA" />
              <circle cx="45.6665" cy="31.0001" r="1.66667" fill="#DADADA" />
              <circle cx="89.3333" cy="31.0001" r="1.66667" fill="#DADADA" />
              <circle cx="45.6665" cy="45.6668" r="1.66667" fill="#DADADA" />
              <circle cx="89.3333" cy="45.6668" r="1.66667" fill="#DADADA" />
              <circle cx="45.6665" cy="60.3335" r="1.66667" fill="#DADADA" />
              <circle cx="89.3333" cy="60.3335" r="1.66667" fill="#DADADA" />
              <circle cx="45.6665" cy="88.6668" r="1.66667" fill="#DADADA" />
              <circle cx="89.3333" cy="88.6668" r="1.66667" fill="#DADADA" />
              <circle cx="45.6665" cy="117.667" r="1.66667" fill="#DADADA" />
              <circle cx="89.3333" cy="117.667" r="1.66667" fill="#DADADA" />
              <circle cx="45.6665" cy="74.6668" r="1.66667" fill="#DADADA" />
              <circle cx="89.3333" cy="74.6668" r="1.66667" fill="#DADADA" />
              <circle cx="45.6665" cy="103" r="1.66667" fill="#DADADA" />
              <circle cx="89.3333" cy="103" r="1.66667" fill="#DADADA" />
              <circle cx="45.6665" cy="132" r="1.66667" fill="#DADADA" />
              <circle cx="89.3333" cy="132" r="1.66667" fill="#DADADA" />
              <circle cx="60.3333" cy="1.66679" r="1.66667" fill="#DADADA" />
              <circle cx="104" cy="1.66679" r="1.66667" fill="#DADADA" />
              <circle cx="60.3333" cy="16.3335" r="1.66667" fill="#DADADA" />
              <circle cx="104" cy="16.3335" r="1.66667" fill="#DADADA" />
              <circle cx="60.3333" cy="31.0001" r="1.66667" fill="#DADADA" />
              <circle cx="104" cy="31.0001" r="1.66667" fill="#DADADA" />
              <circle cx="60.3333" cy="45.6668" r="1.66667" fill="#DADADA" />
              <circle cx="104" cy="45.6668" r="1.66667" fill="#DADADA" />
              <circle cx="60.333" cy="60.3335" r="1.66667" fill="#DADADA" />
              <circle cx="104" cy="60.3335" r="1.66667" fill="#DADADA" />
              <circle cx="60.333" cy="88.6668" r="1.66667" fill="#DADADA" />
              <circle cx="104" cy="88.6668" r="1.66667" fill="#DADADA" />
              <circle cx="60.333" cy="117.667" r="1.66667" fill="#DADADA" />
              <circle cx="104" cy="117.667" r="1.66667" fill="#DADADA" />
              <circle cx="60.333" cy="74.6668" r="1.66667" fill="#DADADA" />
              <circle cx="104" cy="74.6668" r="1.66667" fill="#DADADA" />
              <circle cx="60.333" cy="103" r="1.66667" fill="#DADADA" />
              <circle cx="104" cy="103" r="1.66667" fill="#DADADA" />
              <circle cx="60.333" cy="132" r="1.66667" fill="#DADADA" />
              <circle cx="104" cy="132" r="1.66667" fill="#DADADA" />
            </svg>
            <img src="landing/images/about/about-img1.jpg" alt="about" />
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="about-five-content">
            <h6 class="small-title text-lg">THE PROBLEM WE SOLVE</h6>
            <h2 class="main-title fw-bold">Modernize Your School's Admission Process</h2>
            <div class="about-five-tab">
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link active" id="nav-who-tab" data-bs-toggle="tab" data-bs-target="#nav-who"
                    type="button" role="tab" aria-controls="nav-who" aria-selected="true">The Challenge</button>
                  <button class="nav-link" id="nav-vision-tab" data-bs-toggle="tab" data-bs-target="#nav-vision"
                    type="button" role="tab" aria-controls="nav-vision" aria-selected="false">Our Solution</button>
                  <button class="nav-link" id="nav-history-tab" data-bs-toggle="tab" data-bs-target="#nav-history"
                    type="button" role="tab" aria-controls="nav-history" aria-selected="false">Who Benefits</button>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-who" role="tabpanel" aria-labelledby="nav-who-tab">
                  <p>Schools currently struggle with manual processes - printing physical forms, distributing them,
                    collecting cash payments (fraud risk), and managing stacks of paperwork. This creates administrative
                    burden, delays, and potential security issues.</p>
                  <p>Time-consuming manual work takes away from focusing on what matters most - educating students.</p>
                </div>
                <div class="tab-pane fade" id="nav-vision" role="tabpanel" aria-labelledby="nav-vision-tab">
                  <p>Our platform provides digital distribution, automated payments via mobile money (M-Pesa, Airtel Money, Tigo Pesa),
                    organized submissions, and reduced admin overhead. Schools get a branded form builder, secure payment processing,
                    applicant management dashboard, and automated data export.</p>
                  <p>Everything you need in one place, accessible anytime, anywhere.</p>
                </div>
                <div class="tab-pane fade" id="nav-history" role="tabpanel" aria-labelledby="nav-history-tab">
                  <p>Perfect for private secondary schools, colleges, vocational training centers, international schools,
                    and nursery & primary schools with competitive enrollment.</p>
                  <p>Whether you're processing 50 or 5,000 applicants, our platform scales with your needs and helps you
                    manage admissions efficiently.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- container -->
  </section>

  <!--====== ABOUT FIVE PART ENDS ======-->

  <!-- ===== service-area start ===== -->
  <section id="services" class="services-area services-eight">
    <!--======  Start Section Title Five ======-->
    <div class="section-title-five">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="content">
              <h6>Features</h6>
              <h2 class="fw-bold">Everything You Need for Digital Admissions</h2>
              <p>
                Powerful features designed to streamline your school's application process
                and reduce administrative burden while improving applicant experience.
              </p>
            </div>
          </div>
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </div>
    <!--======  End Section Title Five ======-->
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="single-services">
            <div class="service-icon">
              <i class="lni lni-layout"></i>
            </div>
            <div class="service-content">
              <h4>Self-Service Form Builder</h4>
              <p>
                Create custom application forms with drag-and-drop simplicity.
                Add fields for student information, documents, and more - no coding required.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="single-services">
            <div class="service-icon">
              <i class="lni lni-heart"></i>
            </div>
            <div class="service-content">
              <h4>School Branding</h4>
              <p>
                Customize forms with your school logo, name, contacts, and intake year.
                Create a professional, branded experience for applicants.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="single-services">
            <div class="service-icon">
              <i class="lni lni-wallet"></i>
            </div>
            <div class="service-content">
              <h4>Secure Payment Integration</h4>
              <p>
                Accept payments via M-Pesa, Airtel Money, and Tigo Pesa.
                Secure, automated processing with instant verification and receipts.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="single-services">
            <div class="service-icon">
              <i class="lni lni-users"></i>
            </div>
            <div class="service-content">
              <h4>Applicant Management</h4>
              <p>
                Track all submissions in one dashboard. View applicant details,
                payment status, documents, and manage the entire admission process.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="single-services">
            <div class="service-icon">
              <i class="lni lni-link"></i>
            </div>
            <div class="service-content">
              <h4>Shareable Public Links</h4>
              <p>
                System automatically generates unique public URLs for your forms.
                Share via website, social media, WhatsApp, or email instantly.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="single-services">
            <div class="service-icon">
              <i class="lni lni-download"></i>
            </div>
            <div class="service-content">
              <h4>Data Export & Reports</h4>
              <p>
                Export applicant data in Excel, CSV, or PDF formats.
                Generate reports on payments, conversions, and applicant statistics.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ===== service-area end ===== -->


  <!-- Start Pricing  Area -->
  <section id="pricing" class="pricing-area pricing-fourteen">
    <!--======  Start Section Title Five ======-->
    <div class="section-title-five">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="content">
              <h6>Pricing</h6>
              <h2 class="fw-bold">Pay Only When You Earn</h2>
              <p>
                No upfront costs. Schools pay nothing until they start receiving applications.
                We only take a small commission from successful form sales.
              </p>
            </div>
          </div>
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </div>
    <!--======  End Section Title Five ======-->
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-12">
          <div class="pricing-style-fourteen">
            <div class="table-head">
              <h6 class="title">Standard Commission</h6>
              <p>Perfect for schools starting their digital journey</p>
              <div class="price">
                <h2 class="amount">
                  <span class="currency">15%</span><span class="duration"> commission</span>
                </h2>
                <p class="mt-2">Platform fee per application</p>
              </div>
            </div>

            <div class="light-rounded-buttons">
              <a href="{{ route('register') }}" class="btn primary-btn-outline">
                Get Started
              </a>
            </div>

            <div class="table-content">
              <ul class="table-list">
                <li> <i class="lni lni-checkmark-circle"></i> Form builder & customization</li>
                <li> <i class="lni lni-checkmark-circle"></i> Payment integration (M-Pesa, Airtel, Tigo)</li>
                <li> <i class="lni lni-checkmark-circle"></i> Applicant management dashboard</li>
                <li> <i class="lni lni-checkmark-circle"></i> Data export (Excel/CSV/PDF)</li>
                <li> <i class="lni lni-checkmark-circle"></i> Shareable public links</li>
                <li> <i class="lni lni-checkmark-circle"></i> Receipt generation with QR codes</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
          <div class="pricing-style-fourteen middle">
            <div class="table-head">
              <h6 class="title">Premium Commission</h6>
              <p>Best value for high-volume schools</p>
              <div class="price">
                <h2 class="amount">
                  <span class="currency">10%</span><span class="duration"> commission</span>
                </h2>
                <p class="mt-2">Lower platform fee</p>
              </div>
            </div>

            <div class="light-rounded-buttons">
              <a href="{{ route('register') }}" class="btn primary-btn">
                Get Started
              </a>
            </div>

            <div class="table-content">
              <ul class="table-list">
                <li> <i class="lni lni-checkmark-circle"></i> Everything in Standard</li>
                <li> <i class="lni lni-checkmark-circle"></i> Priority support</li>
                <li> <i class="lni lni-checkmark-circle"></i> SMS notifications</li>
                <li> <i class="lni lni-checkmark-circle"></i> Advanced analytics</li>
                <li> <i class="lni lni-checkmark-circle"></i> Bulk import/export</li>
                <li> <i class="lni lni-checkmark-circle"></i> Custom branding options</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
          <div class="pricing-style-fourteen">
            <div class="table-head">
              <h6 class="title">Example Calculation</h6>
              <p>See how it works</p>
              <div class="price">
                <h2 class="amount">
                  <span class="currency">30,000</span><span class="duration"> TZS</span>
                </h2>
                <p class="mt-2">Per application fee</p>
              </div>
            </div>

            <div class="light-rounded-buttons">
              <a href="{{ route('register') }}" class="btn primary-btn-outline">
                Try It Now
              </a>
            </div>

            <div class="table-content">
              <ul class="table-list">
                <li> <i class="lni lni-checkmark-circle"></i> Student pays: <strong>30,000 TZS</strong></li>
                <li> <i class="lni lni-checkmark-circle"></i> Platform fee (15%): <strong>4,500 TZS</strong></li>
                <li> <i class="lni lni-checkmark-circle"></i> <strong>School receives: 25,500 TZS</strong></li>
                <li> <i class="lni lni-checkmark-circle"></i> No upfront costs</li>
                <li> <i class="lni lni-checkmark-circle"></i> Automated payouts</li>
                <li> <i class="lni lni-checkmark-circle"></i> Transparent reporting</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ End Pricing  Area -->



  <!-- Start Cta Area -->
  <section id="call-action" class="call-action">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-9">
          <div class="inner-content">
            <h2>Ready to Transform Your <br />School's Admission Process?</h2>
            <p>
              Join hundreds of schools already using our platform to streamline admissions,
              reduce administrative burden, and provide a better experience for applicants.<br />
              Get started in minutes - no upfront costs, no credit card required.
            </p>
          
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Cta Area -->



  <!-- Start Latest News Area -->
  <div id="blog" class="latest-news-area section">
    <!--======  Start Section Title Five ======-->
    <div class="section-title-five">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="content">
              <h6>Success Stories</h6>
              <h2 class="fw-bold">Schools Trust Our Platform</h2>
              <p>
                See how schools are transforming their admission process and
                saving time while improving applicant experience.
              </p>
            </div>
          </div>
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </div>
    <!--======  End Section Title Five ======-->
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-12">
          <!-- Single News -->
          <div class="single-news">
            <div class="image">
              <a href="javascript:void(0)"><img class="thumb" src="landing/images/blog/1.jpg" alt="Blog" /></a>
              <div class="meta-details">
                <img class="thumb" src="landing/images/blog/b6.jpg" alt="Author" />
                <span>BY TIM NORTON</span>
              </div>
            </div>
            <div class="content-body">
              <h4 class="title">
                <a href="javascript:void(0)"> Streamlined Admissions Process </a>
              </h4>
              <p>
                Private secondary schools are processing hundreds of applications
                faster than ever before, with automated payments and organized data.
              </p>
            </div>
          </div>
          <!-- End Single News -->
        </div>
        <div class="col-lg-4 col-md-6 col-12">
          <!-- Single News -->
          <div class="single-news">
            <div class="image">
              <a href="javascript:void(0)"><img class="thumb" src="landing/images/blog/2.jpg" alt="Blog" /></a>
              <div class="meta-details">
                <img class="thumb" src="landing/images/blog/b6.jpg" alt="Author" />
                <span>BY TIM NORTON</span>
              </div>
            </div>
            <div class="content-body">
              <h4 class="title">
                <a href="javascript:void(0)">
                  Secure Payment Processing
                </a>
              </h4>
              <p>
                International schools benefit from integrated mobile money payments
                (M-Pesa, Airtel Money, Tigo Pesa) with instant verification and receipts.
              </p>
            </div>
          </div>
          <!-- End Single News -->
        </div>
        <div class="col-lg-4 col-md-6 col-12">
          <!-- Single News -->
          <div class="single-news">
            <div class="image">
              <a href="javascript:void(0)"><img class="thumb" src="landing/images/blog/3.jpg" alt="Blog" /></a>
              <div class="meta-details">
                <img class="thumb" src="landing/images/blog/b6.jpg" alt="Author" />
                <span>BY TIM NORTON</span>
              </div>
            </div>
            <div class="content-body">
              <h4 class="title">
                <a href="javascript:void(0)">
                  Reduced Administrative Overhead
                </a>
              </h4>
              <p>
                Vocational training centers are saving hours of manual work
                with automated form submissions, payment tracking, and data exports.
              </p>
            </div>
          </div>
          <!-- End Single News -->
        </div>
      </div>
    </div>
  </div>
  <!-- End Latest News Area -->

  <!-- Start Brand Area -->
  <div id="clients" class="brand-area section">
    <!--======  Start Section Title Five ======-->
    <div class="section-title-five">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="content">
              <h6>Trusted By</h6>
              <h2 class="fw-bold">Schools Across Tanzania</h2>
              <p>
                Our platform is trusted by private secondary schools, colleges,
                vocational training centers, international schools, and primary schools.
              </p>
            </div>
          </div>
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </div>
    <!--======  End Section Title Five ======-->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2 col-12">
          <div class="clients-logos">
            <div class="single-image">
              <img src="landing/images/client-logo/graygrids.svg" alt="Brand Logo Images" />
            </div>
            <div class="single-image">
              <img src="landing/images/client-logo/uideck.svg" alt="Brand Logo Images" />
            </div>
            <div class="single-image">
              <img src="landing/images/client-logo/ayroui.svg" alt="Brand Logo Images" />
            </div>
            <div class="single-image">
              <img src="landing/images/client-logo/lineicons.svg" alt="Brand Logo Images" />
            </div>
            <div class="single-image">
                <img src="landing/images/client-logo/tailwindtemplates.svg" alt="Brand Logo Images" />
            </div>
            <div class="single-image">
              <img src="landing/images/client-logo/ecomhtml.svg" alt="Brand Logo Images" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Brand Area -->

  <!-- ========================= contact-section start ========================= -->
  <section id="contact" class="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-xl-4">
          <div class="contact-item-wrapper">
            <div class="row">
              <div class="col-12 col-md-6 col-xl-12">
                <div class="contact-item">
                  <div class="contact-icon">
                    <i class="lni lni-phone"></i>
                  </div>
                  <div class="contact-content">
                    <h4>Contact</h4>
                    <p>+255 XXX XXX XXX</p>
                    <p>support@soscomtech.com</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-xl-12">
                <div class="contact-item">
                  <div class="contact-icon">
                    <i class="lni lni-map-marker"></i>
                  </div>
                  <div class="contact-content">
                    <h4>Address</h4>
                    <p>Dar es Salaam, Tanzania</p>
                    <p>East Africa</p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-xl-12">
                <div class="contact-item">
                  <div class="contact-icon">
                    <i class="lni lni-alarm-clock"></i>
                  </div>
                  <div class="contact-content">
                    <h4>Support</h4>
                    <p>24/7 Platform Access</p>
                    <p>Office hours: Mon-Fri 9 AM - 5 PM EAT</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8">
          <div class="contact-form-wrapper">
            <div class="row">
              <div class="col-xl-10 col-lg-8 mx-auto">
                <div class="section-title text-center">
                  <span> Get in Touch </span>
                  <h2>
                    Have Questions? We're Here to Help
                  </h2>
                  <p>
                    Contact us for more information about our platform, pricing,
                    or to schedule a demo for your school.
                  </p>
                </div>
              </div>
            </div>
            <form action="#" class="contact-form">
              <div class="row">
                <div class="col-md-6">
                  <input type="text" name="name" id="name" placeholder="Name" required />
                </div>
                <div class="col-md-6">
                  <input type="email" name="email" id="email" placeholder="Email" required />
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <input type="text" name="phone" id="phone" placeholder="Phone" required />
                </div>
                <div class="col-md-6">
                  <input type="text" name="subject" id="email" placeholder="Subject" required />
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <textarea name="message" id="message" placeholder="Type Message" rows="5"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="button text-center rounded-buttons">
                    <button type="submit" class="btn primary-btn rounded-full">
                      Send Message
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ========================= contact-section end ========================= -->

  <!-- ========================= map-section end ========================= -->
  <section class="map-section map-style-9">
    <div class="map-container">
      <object style="border:0; height: 500px; width: 100%;"
        data="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3102.7887109309127!2d-77.44196278417968!3d38.95165507956235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzjCsDU3JzA2LjAiTiA3N8KwMjYnMjMuMiJX!5e0!3m2!1sen!2sbd!4v1545420879707"></object>
    </div>
    </div>
  </section>
  <!-- ========================= map-section end ========================= -->

  <!-- Start Footer Area -->
  <footer class="footer-area footer-eleven">
    <!-- Start Footer Top -->
    <div class="footer-top">
      <div class="container">
        <div class="inner-content">
          <div class="row">
            <div class="col-lg-4 col-md-6 col-12">
              <!-- Single Widget -->
              <div class="footer-widget f-about">
                <div class="logo">
                  <a href="{{ route('welcome') }}">
                    <img src="{{ asset('images/soscom.png') }}" alt="SOSCOM Technologies" class="img-fluid" style="height: 40px;" />
                  </a>
                </div>
                <p>
                  Empowering schools with digital solutions for modern admission processes.
                  Transform your administrative workflow and focus on what matters - education.
                </p>
                <p class="copyright-text">
                  <span>© {{ date('Y') }} SOSCOM Technologies.</span> All rights reserved.
                </p>
              </div>
              <!-- End Single Widget -->
            </div>
            <div class="col-lg-2 col-md-6 col-12">
              <!-- Single Widget -->
              <div class="footer-widget f-link">
                <h5>Platform</h5>
                <ul>
                  <li><a href="#services">Features</a></li>
                  <li><a href="#pricing">Pricing</a></li>
                  <li><a href="{{ route('register') }}">Get Started</a></li>
                  <li><a href="{{ route('login') }}">Login</a></li>
                </ul>
              </div>
              <!-- End Single Widget -->
            </div>
            <div class="col-lg-2 col-md-6 col-12">
              <!-- Single Widget -->
              <div class="footer-widget f-link">
                <h5>Resources</h5>
                <ul>
                  <li><a href="#contact">Contact Us</a></li>
                  <li><a href="javascript:void(0)">Documentation</a></li>
                  <li><a href="javascript:void(0)">FAQs</a></li>
                  <li><a href="javascript:void(0)">Support</a></li>
                </ul>
              </div>
              <!-- End Single Widget -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
              <!-- Single Widget -->
              <div class="footer-widget newsletter">
                <h5>Stay Updated</h5>
                <p>Get latest features and updates delivered to your inbox</p>
                <form action="#" method="get" target="_blank" class="newsletter-form">
                  <input name="EMAIL" placeholder="Your email address" required="required" type="email" />
                  <div class="button">
                    <button class="sub-btn">
                      <i class="lni lni-envelope"></i>
                    </button>
                  </div>
                </form>
              </div>
              <!-- End Single Widget -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ End Footer Top -->
  </footer>
  <!--/ End Footer Area -->



  <a href="#" class="scroll-top btn-hover">
    <i class="lni lni-chevron-up"></i>
  </a>

  <!--====== js ======-->
  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>

  <script>

    //===== close navbar-collapse when a  clicked
    let navbarTogglerNine = document.querySelector(
      ".navbar-nine .navbar-toggler"
    );
    navbarTogglerNine.addEventListener("click", function () {
      navbarTogglerNine.classList.toggle("active");
    });

    // ==== left sidebar toggle
    let sidebarLeft = document.querySelector(".sidebar-left");
    let overlayLeft = document.querySelector(".overlay-left");
    let sidebarClose = document.querySelector(".sidebar-close .close");

    overlayLeft.addEventListener("click", function () {
      sidebarLeft.classList.toggle("open");
      overlayLeft.classList.toggle("open");
    });
    sidebarClose.addEventListener("click", function () {
      sidebarLeft.classList.remove("open");
      overlayLeft.classList.remove("open");
    });

    // ===== navbar nine sideMenu
    let sideMenuLeftNine = document.querySelector(".navbar-nine .menu-bar");

    sideMenuLeftNine.addEventListener("click", function () {
      sidebarLeft.classList.add("open");
      overlayLeft.classList.add("open");
    });

    //========= glightbox (removed - no video needed)
    // GLightbox can be added here if needed for future features

  </script>
</body>

</html>
