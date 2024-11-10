<?php
include('connection.php');
$query = "SELECT * from picture where picture_id = 1";
$ses_sql = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($ses_sql);


$query1 = "SELECT * from picture where picture_id = 2";
$ses_sql1 = mysqli_query($con,$query1);
$row1 = mysqli_fetch_assoc($ses_sql1);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Reporma At Tagumpay</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-c   text-uppercase fixed-top" id="mainNav" style="background-color: #2B7A0B; ">
            <div class="container">
            <a href="#page-top" style="width: 572px;"> <img width="80%"src="assets/rtforhome.png" alt="..." /></a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#portfolio">Mission & Vision</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#about">About</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="isko/personalinfo.php">Application Form</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="login.php">Login</a></li>
                        
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead text-white text-center" >
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" ></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2" class="active"></li>
 
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item ">
      <img class="d-block w-100" src="./assets/pubmatwebsite.png" alt="First slide" width="80" heigth="80">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="./assets/pubmatwebsitetwo.png"  alt="Second slide">
    </div>
    <div class="carousel-item active">
      <img class="d-block w-100" src="./assets/pubmatwebsitethree.png" alt="First slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</header>
            <div class="container d-flex align-items-center flex-column">
    
            </div>
     
        <!-- Portfolio Section-->
        <section class="page-section portfolio" >
            <div class="container">
                <!-- Portfolio Section Heading-->
             

                <img class="img-fluid" src="assets/love.build.be.png" alt="..." />
                <!-- Portfolio Grid Items-->
                <div class="row justify-content-center mt-4">
                    <!-- Portfolio Item 1-->
                    <?php
                                                       $qry = "SELECT * from picture";
                                                       $ses_sql = mysqli_query($con,$qry);
                                                      while ($row = mysqli_fetch_array($ses_sql)) {

                                        
                                        ?>

                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class=" mx-auto" >
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"></div>
                            </div>
                            <img class="img-fluid" src="assets/<?php echo $row['image']?>" alt="..." />
                            <h4 style="text-align:center;margin-top:3px;"><?php echo $row['Title']?></h4>
                        </div>
                    </div>
               <?php
                                                      }
               ?>
               
              
                  
                </div>
            </div>
        </section>
        <!-- About Section-->
        <section class="page-section bg-secondary text-white mb-0" id="portfolio">
            <div class="container">
                <!-- About Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-white">Mission & Vision</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- About Section Content-->
                <div class="row">
                    <div class="col-lg-6 ms-auto">
                        <h1>Mission</h1>
                    <p class="lead">San Miguel is committed to uphold the general welfare of San Migueleños by provides basic quality social services, empowering people, promoting eco tourism activities, sustainable management of natural resources, maintenance of peace and order and public safety, upholding community based disaster risk reduction and management and promoting spiritual, moral, social and cultural values in order to achieve a God-loving resilient and empowered community.</p>
                    <h1>Vision</h1>
                    <p class="lead">San Miguel Bulacan is the cradle of history, culture and tourism and center of sustainable agricultural and economic development, where God-loving decent resilient and empowered citizens enjoy the vibrant and globally competitive economy and live in safe, peaceful, ecologically-balanced and progressive state environment under righteous, competent and firm leaders</p></div>
                    <div class="col-lg-6 me-auto">   <img class="img-fluid" src="./assets/cityhall.jpg" alt="..." /></div>
                </div>
                <!-- About Section Button-->
            
            </div>
        </section>
        <section class="page-section bg-secondary text-white mb-0" id="about">
            <div class="container">
                <!-- About Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-white">About Us</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- About Section Content-->
                <div class="row">
                <div class="col-lg-4 ms-auto"><img class="img-fluid" src="./assets/about us.jpg" alt="..." /></div>
                    <div class="col-lg-2 ms-auto">
                    <h4>Who We Are</h4>
                        <p class="lead" style="font-size:15px;"> We, the six of us are scholars from Bulacan State University traversing through the last year of our course Bachelor of Science in Information Technology. Team Jokjoks is created through a major project in capstone meant to build a project or a system intended for a certain purpose that could possibly and hopefully offer change to make work easier or grant good assistance through utilizing the internet and our developing technology.</p></div>
                    <div class="col-lg-2 me-auto">
                    <h4>What We Do</h4>    
                    <p class="lead" style="font-size:15px;">The six of us are all majored in Web Development, its spotlight focused on behind the scenes of websites from the graphics everyone sees on their screens to the back end part where everything is planned, build, and executed.</p></div>
                    <div class="col-lg-2 me-auto">
                    <h4>Why We Do It</h4>    
                    <p class="lead" style="font-size:15px;">Team Jokjoks has planned and has worked hard in their area of expertise to produce a website that could assist the Municipality of San Miguel as well as its scholars in managing their scholarships. The project has also been carried out to fulfill the team's major requirement to pass their undergraduate degree.</p></div>
                
                </div>
              
                <!-- About Section Button-->
            
            </div>
        </section>
        <!-- Contact Section-->
        <section class="page-section" id="contact">
           
            <div class="container">
            <div class="row">
            <div class="col-4">

            <div id="map" style="height:500px; margin-top: 145px;"></div>
                </div>
<div class="col-8">
   <!-- Contact Section Heading-->
   <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Contact Us</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Contact Section Form-->
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                                <label for="name">Full name</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                                <label for="email">Email address</label>
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                                <label for="phone">Phone number</label>
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div>
                            <!-- Message input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                                <label for="message">Message</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <!-- <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a> -->
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            <!-- Submit Button-->
                            <button class="btn btn-primary btn-xl" style="background :#189700;" type="submit">Send</button>
                        </form>
                    </div>
                </div>
</div>

            </div>
             
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
               
                    <div class="col-lg-3 mb-5 mb-lg-0">
                    <img class="img-fluid" src="assets/RAT LOGO.png" alt="..." />
                        <p class="lead mb-0 mt-3" style="font-size:14px;">
                        “The Reporma at Tagumpay Scholarship Registration Program is a website that can help scholars and employees from the Municipality of San Miguel, Bulacan. This website assists college scholars and can register online with the help of the Reporma at Tagumpay system.”
                        </p>
                    </div>
              
                    <div class="col-lg-2 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Main Pages</h4>
                        <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="color: #ffff;"href="#portfolio">Mission & Vision</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="color: #ffff;"href="#about">About</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"style="color: #ffff;" href="#contact">Contact</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"  style="color: #ffff;"href="login.php">Login | Signup</a></li>
                    </ul>
            
                    </div>
                    <div class="col-lg-2 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Quick Links</h4>
                        <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="color: #ffff;"href="login.php">Login</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="color: #ffff;"href="signUp.php">Signup</a></li>
                        <?php
                                                       $qry = "SELECT * from adminform";
                                                       $ses_sql = mysqli_query($con,$qry);
                                                      while ($row = mysqli_fetch_array($ses_sql)) {

                                        
                                        ?>
                                   <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" style="color: #ffff;"href="file.php?a_id=<?php echo $row['a_id']?>">Appication Form</a></li>
                                 
									<?php }?>
                    </ul>
            
                    </div>
                    <div class="col-lg-2 mb-5 mb-lg-0" style="text-align:left;">
                        <h4 class="text-uppercase mb-4">Contacts</h4>
                        <i class="fas fa-phone mr-1"> </i><span class="align-middle"> 0917 983 1926</span></br></br>
                        <i class="fas fa-envelope mr-1"> </i><span class="align-middle"> municipalityof sanmiguel2019@gmail.com</span></br></br>
                        <i class="fas fa-map-pin mr-1"> </i><span class="align-middle">San Miguel, Bulacan</span></br>
                    </div>
                    <div class="col-lg-3 mb-5 mb-lg-0">
                        
                    <img class="img-fluid" src="assets/QR.png" alt="..." />
                    
                    </div>
                
                    
                 
                </div>
                
            </div>
        </footer>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright &copy; Group 1 Team Jokjoks  2022</small></div>
        </div>
        <!-- Portfolio Modals-->
      
        <!-- Bootstrap core JS-->

        <script type="text/javascript">

$('.carousel').carousel({
  interval: 2000
})
function initMap() {

 

  

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: new google.maps.LatLng(15.1749,120.9633),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

 

    var marker, i;
	var red_icon = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
	var green_icon = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
    
  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(15.1749,120.9633),
        map: map,
	
	
		
      });

   
    }
  </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
      
        <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDo6VqHn6BDlQ4PWMTPsHo1fDai1xQgHEQ&callback=initMap&v=weekly"
      defer
    ></script>
    </body>
</html>
