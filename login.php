
<?php
session_start(); 
        include("connection/conn.php");

        if($_SERVER['REQUEST_METHOD'] == "POST"){

          $incorrectPassword = false;
          $accountNotFound = false;
          $unsuccessfulRegister = false;
          $successfulRegister = false;

          $type = $_POST['type'];

          

          if($type == "User"){

            // start sa User

                  if (isset($_POST['action']) && $_POST['action'] === 'login') {

                    $gmail = $_POST['gmail'];
                    $password = $_POST['password'];

                    if($gmail == "ejieflorida128@gmail.com" && $password == "admin"){
                        header("Location: SuperAdmin/superAdmin.php");
                    }else{
                        $checkIfExist = "SELECT * FROM sqlcommunity_main.user_account WHERE status = 'Approve'";
                        $queryIfExist = mysqli_query($conn,$checkIfExist);

                        $accoutCheck = 0;
                
                        while($getData = mysqli_fetch_assoc($queryIfExist)){
                                if($gmail == $getData['gmail']){
                                        if($password == $getData['password']){
                                                $_SESSION['id'] = $getData['id'];
                                                $_SESSION['fullname'] = $getData['fullname'];
                                                $_SESSION['gmail'] = $getData['gmail'];
                                              
                                                $_SESSION['password'] = $getData['password'];
                                                $_SESSION['number'] = $getData['number'];
                                                $_SESSION['address'] = $getData['address'];
                                                $_SESSION['profile_picture'] = $getData['profile_picture'];
                                                header("Location: User/dashboard.php");
                                        }else{  
                                              // modal for incorrect password
                                              $incorrectPassword = true;
                                            
                                        }
                                }else{
                                  $accoutCheck++;
                                }
                        }

                        if($accoutCheck > 0){
                            $accountNotFound = true;
                        
                        }
                    }


              }else if (isset($_POST['action']) && $_POST['action'] === 'register') {

                      $fullname = $_POST['fullname'];
                      $gmail = $_POST['gmail'];
                      $password = $_POST['password'];

                          $checkIfExist = "SELECT * FROM sqlcommunity_main.user_account";
                          $queryIfExist = mysqli_query($conn,$checkIfExist);

                          $ifExist = 0;

                          while($checkNow = mysqli_fetch_assoc($queryIfExist)){
                                  if($gmail == $checkNow['gmail']){
                                      $ifExist++;
                                  }   
                          }

                          if($ifExist > 0){
                            // modal for Unsuccessfull register
                            $unsuccessfulRegister = true;
                            
                          }else{
                            
                              $insertQuery = "INSERT INTO sqlcommunity_main.user_account (fullname,gmail,password,status,profile_picture) VALUES ('$fullname','$gmail','$password','Pending','../profile_pictures/default.jpg')";
                              mysqli_query($conn,$insertQuery);

                              // modal for successful register
                              $successfulRegister = true;

                            
                          }

              }

            // end sa User

          }else if($type == "Admin"){

            // start sa admin

                    if (isset($_POST['action']) && $_POST['action'] === 'login') {

                      $gmail = $_POST['gmail'];
                      $password = $_POST['password'];

                      if($gmail == "ejieflorida128@gmail.com" && $password == "admin"){
                          header("Location: SuperAdmin/approve_admin.php");
                      }else{
                          $checkIfExist = "SELECT * FROM sqlcommunity_main.admin_account WHERE status = 'Confirmed'";
                          $queryIfExist = mysqli_query($conn,$checkIfExist);

                          $accoutCheck = 0;
                  
                          while($getData = mysqli_fetch_assoc($queryIfExist)){
                                  if($gmail == $getData['gmail']){
                                          if($password == $getData['password']){
                                                  $_SESSION['id'] = $getData['id'];
                                                  $_SESSION['fullname'] = $getData['fullname'];
                                                  $_SESSION['gmail'] = $getData['gmail'];
                                              
                                                  $_SESSION['password'] = $getData['password'];
                                                  $_SESSION['number'] = $getData['number'];
                                                  $_SESSION['address'] = $getData['address'];
                                                  $_SESSION['profile_picture'] = $getData['profile_picture'];
                                                  header("Location: SuperAdmin/.php");
                                          }else{  
                                                // modal for incorrect password
                                                $incorrectPassword = true;
                                              
                                          }
                                  }else{
                                    $accoutCheck++;
                                  }
                          }

                          if($accoutCheck > 0){
                              $accountNotFound = true;
                          
                          }
                      }


                }else if (isset($_POST['action']) && $_POST['action'] === 'register') {

                        $fullname = $_POST['fullname'];
                        $gmail = $_POST['gmail'];
                        $password = $_POST['password'];

                            $checkIfExist = "SELECT * FROM sqlcommunity_main.admin_account ";
                            $queryIfExist = mysqli_query($conn,$checkIfExist);

                            $ifExist = 0;

                            while($checkNow = mysqli_fetch_assoc($queryIfExist)){
                                    if($gmail == $checkNow['gmail']){
                                        $ifExist++;
                                    }   
                            }

                            if($ifExist > 0){
                            
                              $unsuccessfulRegister = true;
                              
                            }else{
                              
                                $insertQuery = "INSERT INTO sqlcommunity_main.admin_account (fullname,gmail,password,status,profile_picture) VALUES ('$fullname','$gmail','$password','Pending','../profile_pictures/default.jpg')";
                                mysqli_query($conn,$insertQuery);

                             
                                $successfulRegister = true;

                              
                            }

                }

            // end sa admin

          }


         


        }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Library Management System</title>
    <link rel="stylesheet" href="style.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Google Font Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;

}

body {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-image: url("template/assets/img/hero-bg-light.webp");
    overflow: hidden;
  padding: 30px;
}

.container {
  position: relative;
  max-width: 850px;
  width: 100%;
  background: #fff;
  padding: 40px 30px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  perspective: 2700px;
}

.container .cover {
  position: absolute;
  top: 0;
  left: 50%;
  height: 100%;
  width: 50%;
  z-index: 98;
  transition: all 1s ease;
  transform-origin: left;
  transform-style: preserve-3d;
  backface-visibility: hidden;
}

.container #flip:checked ~ .cover {
  transform: rotateY(-180deg);
}

.container #flip:checked ~ .forms .login-form {
  pointer-events: none;
}

.container .cover .front,
.container .cover .back {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
}

.cover .back {
  transform: rotateY(180deg);
}

.container .cover img {
  position: absolute;
  height: 100%;
  width: 100%;
  object-fit: cover;
  z-index: 10;
}

.container .cover .text {
  position: absolute;
  z-index: 10;
  height: 100%;
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.container .cover .text::before {
  content: '';
  position: absolute;
  height: 100%;
  width: 100%;
  opacity: 0.5;
  background: black;
}

.cover .text .text-1,
.cover .text .text-2 {
  z-index: 20;
  font-size: 26px;
  font-weight: 600;
  color: #fff;
  text-align: center;
}

.cover .text .text-2 {
  font-size: 15px;
  font-weight: 500;
}

.container .forms {
  height: 100%;
  width: 100%;
  background: #fff;
}

.container .form-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.form-content .login-form,
.form-content .signup-form {
  width: calc(100% / 2 - 25px);
}

.forms .form-content .title {
  position: relative;
  font-size: 24px;
  font-weight: 500;
  color: #333;
}

.forms .form-content .title:before {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 25px;
  background: #3189f5;
}

.forms .signup-form .title:before {
  width: 20px;
}

.forms .form-content .input-boxes {
  margin-top: 30px;
}

.forms .form-content .input-box {
  display: flex;
  align-items: center;
  height: 50px;
  width: 100%;
  margin: 10px 0;
  position: relative;
}

.form-content .input-box input {
  height: 100%;
  width: 100%;
  outline: none;
  border: none;
  padding: 0 30px;
  font-size: 16px;
  font-weight: 500;
  border-bottom: 2px solid rgba(0, 0, 0, 0.2);
  transition: all 0.3s ease;
}

.form-content .input-box input:focus,
.form-content .input-box input:valid {

}

.form-content .input-box i {
  position: absolute;
  color: #2cbaf2;
  font-size: 17px;
}

.forms .form-content .text {
  font-size: 14px;
  font-weight: 500;
  color: #333;
}

.forms .form-content .text a {
  text-decoration: none;
}

.forms .form-content .text a:hover {
  text-decoration: underline;
}

.forms .form-content .button {
  color: #fff;
  margin-top: 40px;
}

.forms .form-content .button input {
  color: #fff;
  background: #31b4f5;
  border-radius: 6px;
  padding: 0;
  cursor: pointer;
  transition: all 0.4s ease;
}

.forms .form-content .button input:hover {
  background: #1d7cab;
}

.forms .form-content label {
  color: #5b13b9;
  cursor: pointer;
}

.forms .form-content label:hover {
  text-decoration: underline;
}

.forms .form-content .login-text,
.forms .form-content .sign-up-text {
  text-align: center;
  margin-top: 25px;
}

.container #flip {
  display: none;
}

@media (max-width: 730px) {
  .container .cover {
    display: none;
  }

  .form-content .login-form,
  .form-content .signup-form {
    width: 100%;
  }

  .form-content .signup-form {
    display: none;
  }

  .container #flip:checked ~ .forms .signup-form {
    display: block;
  }

  .container #flip:checked ~ .forms .login-form {
    display: none;
  }
}

#preloader {
		  position: fixed;
		  top: 0;
		  left: 0;
		  right: 0;
		  bottom: 0;
		  background-color: #fff;
		  z-index: 9999999; }
		
		.loader {
		  top: 50%;
		  width: 50px;
		  height: 50px;
		  border-radius: 100%;
		  position: relative;
		  margin: 0 auto; }
		
		#loader-1:before, #loader-1:after {
		  content: "";
		  position: absolute;
		  top: -10px;
		  left: -10px;
		  width: 100%;
		  height: 100%;
		  border-radius: 100%;
		  border: 7px solid transparent;
		  border-top-color: #3c9cfd; }
		
		#loader-1:before {
		  z-index: 100;
		  animation: spin 2s infinite; }
		
		#loader-1:after {
		  border: 7px solid #fafafa; }
		
		@keyframes spin {
		  0% {
		    -webkit-transform: rotate(0deg);
		    -ms-transform: rotate(0deg);
		    -o-transform: rotate(0deg);
		    transform: rotate(0deg); }
		  100% {
		    -webkit-transform: rotate(360deg);
		    -ms-transform: rotate(360deg);
		    -o-transform: rotate(360deg);
		    transform: rotate(360deg); } }

            

          

        
            
            input{
                color: grey;
            }


    </style>
   </head>
<body>

                    <div id="preloader">
					  <div class="loader" id="loader-1"></div>
					</div>
					
					<!-- JavaScript to hide preloader after 2 seconds -->
					<script>
					  // Hide the preloader after 2 seconds (2000 milliseconds)
					  setTimeout(function() {
					    document.getElementById("preloader").style.display = "none";
					  }, 2000);
					</script>





  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
    <div class="front">
            <img src="template/assets/img/tabs-4.jpeg" alt="no img">
            <div class="text">
               
               
            </div>
        </div>
        <div class="back">
            <img src="template/assets/img/tabs-4.jpeg" alt="no img">
            <div class="text">
              
                      
            </div>
        </div>

    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Member Login</div>
          <form action="login.php" method = "post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your email" name = "gmail" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" name = "password" required>
              </div>
              <div class="input-box">
                  <label style="display: flex;">
                    <input type="radio" name="type" value="User" required> 
                    <span style="margin-top: -5px; margin-left: 10px; text-decoration: none; color: grey; font-weight: bolder;">User</span>
                  </label>
                  <label style="display: flex; margin-left: 20px;">
                    <input type="radio" name="type" value="Admin"> 
                    <span style="margin-top: -5px; margin-left: 10px; text-decoration: none; color: grey; font-weight: bolder;">Admin</span>
                  </label>
                </div>

           
              <div class="text"><a href="forgot_password.php" style = "color: #2cbaf2;">Forgot password?</a></div>
              <div class="button input-box">
                <input type="submit" value="login" name = "action">
              </div>
              <div class="text sign-up-text">
                    Don't have an account? 
                    <label for="flip" style="color: #2cbaf2; cursor: pointer;">Signup</label>
                    <span> | </span>
                    <a href="index.php" style="color: #2cbaf2; text-decoration: none;">Home</a>
                </div>
            </div>
        </form>
      </div>
        <div class="signup-form">
          <div class="title">Member Signup</div>
        <form action="login.php" method = "post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Enter your fullname" name = "fullname" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your email" name = "gmail" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" name = "password" required>
              </div>

              <div class="input-box">
                  <label style="display: flex;">
                    <input type="radio" name="type" value="User" required> 
                    <span style="margin-top: -5px; margin-left: 10px; text-decoration: none; color: grey; font-weight: bolder;">User</span>
                  </label>
                  <label style="display: flex; margin-left: 20px;">
                    <input type="radio" name="type" value="Admin"> 
                    <span style="margin-top: -5px; margin-left: 10px; text-decoration: none; color: grey; font-weight: bolder;">Admin</span>
                  </label>
                </div>

          
              <div class="button input-box">
                <input type="submit" value="register" name = "action">
                
              </div>
              <div class="text sign-up-text">Already have an account? <label for="flip" style = "color: #2cbaf2">Login</label>
              <span> | </span>
                    <a href="index.php" style="color: #2cbaf2; text-decoration: none;">Home</a></div>
            </div>
      </form>
    </div>
    </div>
    </div>
  </div>



  <div class="modal" tabindex="-1" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style = "margin-top: 10%;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php 
                    if ($incorrectPassword) {
                        echo '<p>Incorrect password. Please try again.</p>';
                    } else if ($accountNotFound) {
                        echo '<p>No account found with that email. Please check and try again.</p>';
                    }elseif ($unsuccessfulRegister) {
                      echo '<p>Registration unsuccessful. This email is already registered. Please try a different one.</p>';
                    } elseif ($successfulRegister) {
                        echo '<p>Registration successful! Please wait for account approval.</p>';
                    }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Check if there is any message to display in the modal
    <?php if ($incorrectPassword || $accountNotFound || $unsuccessfulRegister || $successfulRegister): ?>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
                keyboard: false
            });
            myModal.show();
        });
    <?php endif; ?>
</script>




  

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

  
</body>
</html>