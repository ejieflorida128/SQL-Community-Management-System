<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>SQL Community Management System</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <!-- <link href="template/assets/img/favicon.png" rel="icon"> -->
  <link href="template/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="template/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="template/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="template/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="template/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="template/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="template/assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
      <i class="fas fa-database" style="margin-right: 8px; font-size: 40px;"></i>
        <h1 class="sitename">SQL Community</h1>
            <style>
                    @media only screen and (max-width: 600px) {
                        .sitename {
                        display: none;
                        }
                    }
            </style>
      </a>

      <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero" class="active page-scroll">Home</a></li>
                <li><a href="#about" class="page-scroll">About</a></li>
                <li><a href="#features" class="page-scroll">Features</a></li>
                <li><a href="#services" class="page-scroll">Services</a></li>
                <li><a href="#contact" class="page-scroll">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list" onclick="toggleMobileMenu()"></i>
     </nav>

     <script>
        function toggleMobileMenu() {
            const navMenu = document.getElementById('navmenu');
            navMenu.classList.toggle('open');
        }
    </script>

                <style>
                
                .page-scroll {
                    scroll-behavior: smooth;
                }

                
                .mobile-nav-toggle {
                    font-size: 24px;
                    cursor: pointer;
                }

                
                .navmenu.open ul {
                    display: block;
                }

                
                .navmenu ul {
                    display: none;
                }

                
                @media (min-width: 992px) {
                    .navmenu ul {
                    display: flex;
                    }
                }

                
                .navmenu .active {
                    color: #4CAF50; 
                    font-weight: bold;
                }
                </style>


      <a class="btn-getstarted" href="login.php">Log in</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="hero-bg">
        <img src="template/assets/img/hero-bg-light.webp" alt="">
      </div>
      <div class="container text-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
        <h1 data-aos="fade-up">Welcome to <span>SQL Community Management</span></h1>
        <p data-aos="fade-up" data-aos-delay="100">Join us to share SQL tips, solve issues, and connect with others!</p>

          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="login.php" class="btn-get-started">Get Started</a>
            <a href="https://www.youtube.com/watch?v=zsjvFFKOm3c" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
          </div>
          <img src="template/assets/img/hero-services-img.webp" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>

    </section><!-- /Hero Section -->

   
    <section id="featured-services" class="featured-services section light-background">

        <div class="container">

        <div class="row gy-4">

            <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item d-flex">
                <div class="icon flex-shrink-0"><i class="bi bi-question-circle"></i></div>
                <div>
                <h4 class="title"><a href="login.php" class="stretched-link">Post SQL Questions</a></h4>
                <p class="description">Get help by posting your SQL questions and receive solutions from the community.</p>
                </div>
            </div>
            </div>
            <!-- End Service Item -->

            <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item d-flex">
                <div class="icon flex-shrink-0"><i class="bi bi-chat-dots"></i></div>
                <div>
                <h4 class="title"><a href="login.php" class="stretched-link">Share Solutions</a></h4>
                <p class="description">Contribute by answering questions and helping others solve SQL issues.</p>
                </div>
            </div>
            </div>
            <!-- End Service Item -->

            <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item d-flex">
                <div class="icon flex-shrink-0"><i class="bi bi-person-lines-fill"></i></div>
                <div>
                <h4 class="title"><a href="login.php" class="stretched-link">Build Your Profile</a></h4>
                <p class="description">Showcase your expertise and gain recognition in the SQL community.</p>
                </div>
            </div>
            </div>
            <!-- End Service Item -->

        </div>

        </div>

    </section>


    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4">

        <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
        <p class="who-we-are">Who We Are</p>
        <h3>Empowering SQL Users Through Community Collaboration</h3>
        <p class="fst-italic">
            We are a community-driven platform dedicated to helping SQL enthusiasts troubleshoot issues, share insights, and grow their expertise.
        </p>
        <ul>
            <li><i class="bi bi-check-circle"></i> <span>Connect with peers to resolve SQL challenges collaboratively.</span></li>
            <li><i class="bi bi-check-circle"></i> <span>Access a library of real-world solutions from experienced users.</span></li>
            <li><i class="bi bi-check-circle"></i> <span>Build your profile and gain recognition in the SQL community.</span></li>
        </ul>
        <a href="login.php" class="read-more"><span>Learn More</span><i class="bi bi-arrow-right"></i></a>
        </div>


          <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4">
              <div class="col-lg-6">
                <img src="template/assets/img/about-company-6.png" class="img-fluid" alt="" style = "height: 372px;">
              </div>
              <div class="col-lg-6">
                <div class="row gy-4">
                  <div class="col-lg-12">
                    <img src="template/assets/img/about-company-5.jpg" class="img-fluid" alt="">
                  </div>
                  <div class="col-lg-12">
                    <img src="template/assets/img/about-company-4.jpg" class="img-fluid" alt="">
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </section>

    <section id="databases" class="databases section">

    <div class="container" data-aos="fade-up">

    <div class="row gy-4">

        <div class="col-xl-2 col-md-3 col-6 database-icon text-center">
        <i class="fa-solid fa-database fa-3x" title="MySQL"></i>
        <p>MySQL</p>
        </div><!-- End Database Item -->

        <div class="col-xl-2 col-md-3 col-6 database-icon text-center">
        <i class="fa-solid fa-database fa-3x" title="PostgreSQL"></i>
        <p>PostgreSQL</p>
        </div><!-- End Database Item -->

        <div class="col-xl-2 col-md-3 col-6 database-icon text-center">
        <i class="fa-solid fa-database fa-3x" title="MongoDB"></i>
        <p>MongoDB</p>
        </div><!-- End Database Item -->

        <div class="col-xl-2 col-md-3 col-6 database-icon text-center">
        <i class="fa-solid fa-database fa-3x" title="SQLite"></i>
        <p>SQLite</p>
        </div><!-- End Database Item -->

        <div class="col-xl-2 col-md-3 col-6 database-icon text-center">
        <i class="fa-solid fa-database fa-3x" title="Oracle SQL"></i>
        <p>Oracle SQL</p>
        </div><!-- End Database Item -->

        <div class="col-xl-2 col-md-3 col-6 database-icon text-center">
        <i class="fa-solid fa-database fa-3x" title="Microsoft SQL Server"></i>
        <p>SQL Server</p>
        </div><!-- End Database Item -->

    </div>

    </div>

    </section>

    <style>
        .database-icon i {
    color: #4CAF50; /* Adjust color as needed */
    margin-bottom: 8px;
    }

    .database-icon p {
    font-size: 14px;
    margin: 0;
    }

    </style>
<!-- /Clients Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>Features</h2>
  <p>Explore the powerful tools and features that make SQL Community Management efficient and user-friendly</p>
</div><!-- End Section Title -->

<div class="container">
  <div class="row justify-content-between">

    <div class="col-lg-5 d-flex align-items-center">

      <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
        <li class="nav-item">
          <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
            <i class="bi bi-file-earmark-code"></i>
            <div>
              <h4 class="d-none d-lg-block">Share SQL Solutions</h4>
              <p>
                Easily share solutions to common SQL issues and gain recognition for your contributions within the community.
              </p>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
            <i class="bi bi-gear"></i>
            <div>
              <h4 class="d-none d-lg-block">Troubleshoot SQL Errors</h4>
              <p>
                Quickly troubleshoot SQL errors with help from experienced users and find solutions to complex problems.
              </p>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
            <i class="bi bi-database"></i>
            <div>
              <h4 class="d-none d-lg-block">Database Management</h4>
              <p>
                Manage your databases, create queries, and organize your solutions efficiently in one place.
              </p>
            </div>
          </a>
        </li>
      </ul><!-- End Tab Nav -->

    </div>

    <div class="col-lg-6">

      <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

        <div class="tab-pane fade active show" id="features-tab-1">
          <img src="template/assets/img/tabs-4.jpeg" alt="Sharing SQL Solutions" class="img-fluid" style = "height: 400px; margin-top: 30px;">
        </div><!-- End Tab Content Item -->

        <div class="tab-pane fade" id="features-tab-2">
          <img src="template/assets/img/tabs-5.svg" alt="Troubleshooting SQL Errors" class="img-fluid" style = "height: 400px; margin-top: 30px;">
        </div><!-- End Tab Content Item -->

        <div class="tab-pane fade" id="features-tab-3">
          <img src="template/assets/img/tabs-6.avif" alt="Database Management" class="img-fluid" style = "height: 400px; margin-top: 30px;">
        </div><!-- End Tab Content Item -->
      </div>

    </div>

  </div>

</div>

</section>
<!-- /Features Section -->

 

  <section id="services" class="services section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Services</h2>
            <p>Explore the key services that help you efficiently manage SQL databases and share solutions with the community.</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row g-5">

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="service-item item-cyan position-relative">
                <i class="bi bi-search icon"></i>
                <div>
                    <h3>SQL Query Assistance</h3>
                    <p>Get help in optimizing and troubleshooting your SQL queries with the expertise of the community.</p>
                    <a href="login.php" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                </div>
                </div>
            </div><!-- End Service Item -->

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-item item-orange position-relative">
                <i class="bi bi-file-earmark-code icon"></i>
                <div>
                    <h3>SQL Code Sharing</h3>
                    <p>Share your SQL scripts with the community and access shared solutions for common database problems.</p>
                    <a href="login.php" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                </div>
                </div>
            </div><!-- End Service Item -->

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                <div class="service-item item-teal position-relative">
                <i class="bi bi-bug icon"></i>
                <div>
                    <h3>SQL Error Troubleshooting</h3>
                    <p>Diagnose and fix SQL errors with help from experienced developers and community members.</p>
                    <a href="login.php" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                </div>
                </div>
            </div><!-- End Service Item -->

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                <div class="service-item item-red position-relative">
                <i class="bi bi-shield-lock icon"></i>
                <div>
                    <h3>SQL Security Best Practices</h3>
                    <p>Learn and implement the best security practices to protect your SQL databases from threats and vulnerabilities.</p>
                    <a href="login.php" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                </div>
                </div>
            </div><!-- End Service Item -->

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
                <div class="service-item item-indigo position-relative">
                <i class="bi bi-database icon"></i>
                <div>
                    <h3>Database Design & Optimization</h3>
                    <p>Get advice and solutions for structuring your databases and optimizing their performance for scalability and speed.</p>
                    <a href="login.php" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                </div>
                </div>
            </div><!-- End Service Item -->

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
                <div class="service-item item-pink position-relative">
                <i class="bi bi-people icon"></i>
                <div>
                    <h3>Community Collaboration</h3>
                    <p>Collaborate with like-minded developers and users to solve complex SQL issues and improve your skills.</p>
                    <a href="login.php" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                </div>
                </div>
            </div><!-- End Service Item -->

            </div>

        </div>

        </section>


        <section id="contact" class="contact section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>Contact</h2>
  <p>If you have any questions or need assistance with our SQL Community Management System, feel free to reach out. We're here to help!</p>
</div><!-- End Section Title -->

<div class="container" data-aos="fade-up" data-aos-delay="100">

  <div class="row gy-4">

    <div class="col-lg-6">
      <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
        <i class="bi bi-geo-alt"></i>
        <h3>Address</h3>
        <p>Pinaskohan, Maasin City, Southern Leyte, 6600</p>
      </div>
    </div><!-- End Info Item -->

    <div class="col-lg-3 col-md-6">
      <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
        <i class="bi bi-telephone"></i>
        <h3>Call Us</h3>
        <p>+63 962 790 5690</p>
      </div>
    </div><!-- End Info Item -->

    <div class="col-lg-3 col-md-6">
      <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
        <i class="bi bi-envelope"></i>
        <h3>Email Us</h3>
        <p>ejieflorida128@gmail.com</p>
      </div>
    </div><!-- End Info Item -->

  </div>

  <div class="row gy-4 mt-1">
    <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2848.2340852353036!2d124.83776587323109!3d10.165359870171198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x330747000361715d%3A0x508c489bd179363d!2sPinaskohan!5e1!3m2!1sen!2sus!4v1731052296072!5m2!1sen!2sus" frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div><!-- End Google Maps -->

  

  </div>

</div>

</section>


  </main>

  

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="template/assets/vendor/php-email-form/validate.js"></script>
  <script src="template/assets/vendor/aos/aos.js"></script>
  <script src="template/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="template/assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="template/assets/js/main.js"></script>

</body>

</html>