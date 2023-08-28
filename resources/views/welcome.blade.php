<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ config('app.name', 'Record System') }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/img/logo.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/boxicons/css/boxicons.min.css?v=2') }}" rel="stylesheet">
  <link href="{{ asset('assets/boostrap/css/bootstrap.min.css?v=2') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

  <!-- Template Main CSS File -->
   <link href="{{ asset('assets/css/stylish.css?v=2') }}" rel="stylesheet">

  


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container-fluid">

      <div class="logo">
        <a href="index.html"><img src="/img/logo.png" alt="" class="img-fluid"></a>
      </div>

      <button type="button" class="nav-toggle"><i class="bx bx-menu"></i></button>
      <nav class="nav-menu">
        <ul>
          <li class="active"><a href="#header" class="scrollto">Home</a></li>
          <li><a href="#about" class="scrollto">About Us</a></li>
          <li><a href="#why-us" class="scrollto">Why Us</a></li>
          <li><a href="#sabbath" class="scrollto">Sabbath Offerings</a></li>
          <li><a href="#contact" class="scrollto">Contact Us</a></li>
          <li><a href="{{ route('login') }}" class="scrollto">Login</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End #header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <h3>Obando Seventh-Day Adventist Church</h3>
      <h1>"Tapat na Katiwala, Daluyan ng Pagpapala"</h1>
  </section><!-- #hero -->

  <main id="main">

  <!-- ======= QUOTATION MARK  ======= -->
    <section>
      <div class="container">
        <div class="row justify-content-center">
          <span>
            <p class="text-center fs-4">
              "If they will be faithful in bringing to His treasury the means lent them, 
              His works will make rapid advancement.
              Many souls will be won to the truth, and the day
              of Christ's coming will be hastened."
            </p>
          </span>
             
            <p class="text-center fw-bold" style="font-style: italic;">Ellen White, Counsels on Stewardship, p. 45</p>
        
          </div>
      </div>
    </section>
    <!-- END QOUTATION -->


  <!-- ======= CHURCH TIME  ======= -->
    <section  class="section-bg">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
                <i class="bx bx-calendar"></i>&nbsp; 
                Every Saturday, 8:30 Am -  5:00 Pm
                <br>
                <span class="fs-4 fw-bold">Welcome to our Church</span>
          </div>

          <div class="col-lg-5 pt-4 pt-lg-0">
            <i class="bx bx-location-plus"></i>&nbsp; Obando Seventh-Day Adventist Church
            <br>
            <i class="bx bxl-telegram"></i>&nbsp; #132A San Pascual, Obando, Bulacan, 3021
          </div>

          <div class="col pt-3 pt-lg-0 join-button">
              <button class="text-center" onclick="location.href='https://www.facebook.com/profile.php?id=100070040359161'"  type="submit">JOIN US!</button>
          </div>
       
          </div>
      </div>
    </section>
  <!-- END CHURCH TIME --> 

  <!-- ======= ABOUT  ======= -->
    <section id="about" class="about">
      <div class="container">
        <div class="section-title">
          <h2>Our Beliefs</h2>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-5 pt-5">
            <p style="font-size: 18px;">
              <span class="fw-bold">Seventh-day Adventist</span> beliefs are meant to permeate your whole life. 
              Growing out of scriptures that paint a compelling portrait of God, you are invited to explore, 
              experience and know the One who desires to make us whole.
            </p>
            <p style="font-size: 18px;">
              In the garden of eden, God established the first family.
              After creating Adam, he said: <span class="fst-italic fw-bold">"it is not good that the man should
                be alone; I will make him a helper as his partner" (Genesis 2:18)</span>.
              Beginning with a rib from Adam, God formed Eve. Then he told them:
              <span class="fst-italic fw-bold"> "Be fruitful and multiply, and fill the earth and subdue it" (Genesis 1:28)</span>.
              Children would enhance their union and ensure the future of the human race.
            </p>
          </div>

          <div class="col-md-6 pt-4">
            <img src="{{ asset('img/Family.jpg') }}" class="img-fluid" alt="">
          </div>

          </div>
      </div>
    </section>
  <!-- END ABOUT --> 

  <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="card">
              <img src="{{ asset('img/why-us-1.jpg') }}" class="card-img-top" alt="...">
              <div class="card-icon">
                <i class="bx bx-book-reader"></i>
              </div>
              <div class="card-body">
                <h5 class="card-title"><a href="">Our Mission</a></h5>
                <p class="card-text">
                  Make disciples of Jesus Christ who live as His 
                  loving witnesses and proclaim to all people the everlasting gospel of 
                  the Three Angels’ Messages in preparation for His soon return (Matt 28:18-20, 
                  Acts 1:8, Rev 14:6-12).
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="card">
              <img src="{{ asset('img/why-us-2.jpg') }}" class="card-img-top" alt="...">
              <div class="card-icon">
                <i class="bx bx-calendar-edit"></i>
              </div>
              <div class="card-body">
                <h5 class="card-title"><a href="">Our Method</a></h5>
                <p class="card-text">
                  Guided by the Bible and the Holy Spirit, Seventh-day Adventists 
                  pursue this mission through Christ-like living, communicating, discipling, 
                  teaching, healing, and serving.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="card">
              <img src="{{ asset('img/why-us-3.jpg') }}" class="card-img-top" alt="...">
              <div class="card-icon">
                <i class="bx bx-landscape"></i>
              </div>
              <div class="card-body">
                <h5 class="card-title"><a href="">Our Vision</a></h5>
                <p class="card-text">
                  In harmony with Bible revelation, Seventh-day Adventists see as 
                  the climax of God’s plan the restoration of all His creation to full 
                  harmony with His perfect will and righteousness.
                </p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  <!-- End Why Us Section -->

  <!-- ======= TITHES ======= -->
    <section id="sabbath" class="about">
      <div class="container">

        <div class="row">
          <div class="col-lg-6 pt-2">
            <img src="{{ asset('img/rice.jpg') }}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <h3>Systematic Benevolence</h3>
            <p class="fst-italic">
  
            </p>
            <ul>
              <li><i class="bx bx-check-double"></i>
              TITHE
              <br>
              <p style="font-size: 12px;">
                "Bring ye all the tithes into the storehouse, that there may b emeat in mine
                house, and prove me now herewith, saith the LORD of hosts, if I will not open
                you the windows of heaven, and pour you out a blessing, that there shall not be room enough to recieve it."
                <span class="fst-italic" >Malachi 3:10, KJV</span>
              </p>

              <p class="text-center" style="font-size: 12px;">
                <span class="fst-italic" >"Storehouse", refers to the local conference (GCWP, 2014, p.723.2)</span>
              </p>

             
              <p style="font-size: 12px;">
                "And all the tithe of the land, whether of the seed of the land, or of the fruit of the tree, is the Lord's: it is holy unto the Lord."
                <span class="fst-italic" >Leviticus 27:30</span>
              </p>
              
              </li>
              <li><i class="bx bx-check-double"></i>
              ONE OFFERING
              <br>
              <p style="font-size: 12px;">
                - a proportionate amount from the blessings God has given us. 
                <br>&nbsp;    &nbsp;<span class="fst-italic" >(Deuteronomy 16:17, Manuscript p. 73)</span><br>
                - a planned offering in proportion to the quality of love we've develop to God.
                <br>- an offering that will support both the local church and world mission.
                <br>
                <br>&nbsp;    &nbsp;<span class="fst-italic" >(NOTE: One Offering Plan: 50% to CLC, 50% to the local church).</span>
              </p>
              
              </li>
              <li><i class="bx bx-check-double"></i>
              OTHER GIFTS
              <p style="font-size: 12px;">
                - other giving commitments each we can freely support like local projects, conference projects, union projects and other church recognized ministries.
              </p>
              </li>
            </ul>
           
          </div>
        </div>

      </div>
    </section>
  <!-- End TITHEs -->



    <!-- ======= Frequenty Asked Questions Section ======= -->
    <!--<section class="faq">
      <div class="container">

        <div class="section-title">
          <h2>Frequenty Asked Questions</h2>
        </div>

        <ul class="faq-list">

          <li>
            <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq1">Non consectetur a erat nam at lectus urna duis? <i class="bx bx-down-arrow-alt icon-show"></i><i class="bx bx-x icon-close"></i></a>
            <div id="faq1" class="collapse" data-bs-parent=".faq-list">
              <p>
                Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
              </p>
            </div>
          </li>

          <li>
            <a data-bs-toggle="collapse" data-bs-target="#faq2" class="collapsed">Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque? <i class="bx bx-down-arrow-alt icon-show"></i><i class="bx bx-x icon-close"></i></a>
            <div id="faq2" class="collapse" data-bs-parent=".faq-list">
              <p>
                Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
              </p>
            </div>
          </li>

          <li>
            <a data-bs-toggle="collapse" data-bs-target="#faq3" class="collapsed">Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi? <i class="bx bx-down-arrow-alt icon-show"></i><i class="bx bx-x icon-close"></i></a>
            <div id="faq3" class="collapse" data-bs-parent=".faq-list">
              <p>
                Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
              </p>
            </div>
          </li>

          <li>
            <a data-bs-toggle="collapse" data-bs-target="#faq4" class="collapsed">Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla? <i class="bx bx-down-arrow-alt icon-show"></i><i class="bx bx-x icon-close"></i></a>
            <div id="faq4" class="collapse" data-bs-parent=".faq-list">
              <p>
                Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
              </p>
            </div>
          </li>

          <li>
            <a data-bs-toggle="collapse" data-bs-target="#faq5" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bx bx-down-arrow-alt icon-show"></i><i class="bx bx-x icon-close"></i></a>
            <div id="faq5" class="collapse" data-bs-parent=".faq-list">
              <p>
                Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
              </p>
            </div>
          </li>

          <li>
            <a data-bs-toggle="collapse" data-bs-target="#faq6" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bx bx-down-arrow-alt icon-show"></i><i class="bx bx-x icon-close"></i></a>
            <div id="faq6" class="collapse" data-bs-parent=".faq-list">
              <p>
                Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.
              </p>
            </div>
          </li>

        </ul>

      </div>
    </section>-->
    <!-- End Frequenty Asked Questions Section -->

 <!-- ======= Maps Section ======= -->
    <section class="section-bg">
      <div class="container">
        <div class="section-title">
          <h2>Maps</h2>
        </div>
        <div class="google-map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3858.85321035151!2d120.92666967549016!3d14.72088977411952!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b36d43ed2db9%3A0x8bf99f9db2fd8a58!2sObando%20Seventh-Day%20Adventist%20Church!5e0!3m2!1sen!2sph!4v1683703424103!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
<!-- End Maps Section -->
     
    </section>

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact Us</h2>
        </div>

        <div class="row justify-content-center">

          <div class="col-lg-6">
           
            <div class="social-links">
              <img src="{{ asset('img/logo.png') }}" alt="" width="160px">
              <br>
              <span class="fs-4 fw-bold">Obando Seventh-Day Adventist Church</span>
              <br>
              <br>

            </div>
          </div>

          <div class="col-lg-4 pt-5 pt-lg-6">
            <div class="info">
              <div class="address">
                <i class="bx bx-map"></i>
                 <p>#132A Brgy. San Pascual,<br>Obando, Bulacan, 3021</p>
              </div>

              <div class="email">
                <i class="bx bx-envelope"></i>
                <p>info@example.com</p>
              </div>

              <div class="phone">
                <i class="bx bx-phone-call"></i>
                <p>+63 912 1546 124</p>
              </div>

              <div class="facebook">
                <i class="bx bxl-facebook"></i><p><a href="https://www.facebook.com/profile.php?id=100070040359161" class="facebook">Facebook Page</a><p>
              </div>
            </div>
          </div>
      </div>
    </section><!-- End Contact Us Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Team Kape</span></strong>. All Rights Reserved
      </div>
  </footer><!-- End #footer -->

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/boostrap/js/bootstrap.bundle.min.js?v=1') }}"></script>


  <!-- Template Main JS File -->
  <script src="/assets/js/main.js?v=1"></script>

    

</body>

</html>