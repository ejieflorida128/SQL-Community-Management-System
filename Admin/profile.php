
<?php
session_start();
include("../connection/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitChanges'])) {
    $user_id = $_SESSION['id']; 
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $gmail = mysqli_real_escape_string($conn, $_POST['gmail']);
   
    $bio = mysqli_real_escape_string($conn, $_POST['bio']);
    $profile_picture = $_FILES['profile_picture'];

 
    if (isset($profile_picture) && $profile_picture['error'] === UPLOAD_ERR_OK) {
        $targetDir = "../profile_pictures/"; 
        $fileName = $user_id . "_" . basename($profile_picture['name']);
        $targetFilePath = $targetDir . $fileName;

      
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

       
        if (move_uploaded_file($profile_picture['tmp_name'], $targetFilePath)) {
            $profilePicturePath = $targetFilePath;
        } else {
            $profilePicturePath = $_SESSION['profile_picture']; 
        }
    } else {
        $profilePicturePath = $_SESSION['profile_picture']; 
    }

   
    $updateQuery = "UPDATE sqlcommunity_main.admin_account 
                    SET fullname = '$fullname', gmail = '$gmail' , bio = '$bio', profile_picture = '$profilePicturePath'
                    WHERE id = $user_id";



    if (mysqli_query($conn, $updateQuery)) {
      
        $_SESSION['fullname'] = $fullname;
        $_SESSION['status'] = $status;
        $_SESSION['gmail'] = $gmail;
        $_SESSION['bio'] = $bio;
        $_SESSION['profile_picture'] = $profilePicturePath;

       
        header('Location: profile.php?success=Profile updated successfully.');
        exit();
    } else {
      
        header('Location: profile.php?error=Unable to update profile. Please try again.');
        exit();
    }
}

 
   

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SQL Comunity Management System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

   
    <link href="template/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="template/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

   
    <link href="template/css/bootstrap.min.css" rel="stylesheet">

   
    <link href="template/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
      
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">SQL Community</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="<?php  echo $_SESSION['profile_picture']; ?>" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php  echo $_SESSION['fullname']; ?></h6>
                        <span>User</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                <a href="dashboard.php" class="nav-item nav-link ">
                            <i class="fa fa-chart-line me-2"></i>Dashboard
                        </a>
                        <a href="pending.php" class="nav-item nav-link">
                            <i class="fa fa-hourglass-half me-2"></i>Manage Post
                        </a>
                        <a href="profile.php" class="nav-item nav-link active">
                            <i class="fa fa-user me-2"></i>Profile
                        </a>
                        <a href="notification.php" class="nav-item nav-link">
                            <i class="fa fa-bell me-2"></i>Notification
                        </a>                
                </div>
            </nav>
        </div>
  


      
        <div class="content">
          
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
              
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
               
                <div class="navbar-nav align-items-center ms-auto">
                  
                     <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notification</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">

                            <?php 

                        date_default_timezone_set('Asia/Manila');
                                      $unique_id = $_SESSION['id'];
                                      $sqlRecentNotif = "SELECT * FROM sqlcommunity_notifications.user_notification ORDER BY id DESC LIMIT 3";
                                      $Notifquery = mysqli_query($conn,$sqlRecentNotif);

                                      while($getNotif = mysqli_fetch_assoc($Notifquery)){


                                        $date_now = new DateTime(); 

                                        
                                        $date_post = new DateTime($getNotif['date']); 
                
                                    
                
                                        
                                        $interval = $date_now->diff($date_post);
                
                                    
                                        
                                        if ($interval->y > 0) {
                                            $timeString = $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
                                        } elseif ($interval->m > 0) {
                                            $timeString = $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
                                        } elseif ($interval->d > 0) {
                                            $timeString = $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
                                        } elseif ($interval->h > 0) {
                                            $timeString = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
                                        } elseif ($interval->i > 0) {
                                            $timeString = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
                                        } else {
                                            $timeString = 'Just now';
                                        }

                                      
                            ?>
                          
                            <a href="notification.php" class="dropdown-item">
                                <h6 class="fw-normal mb-0"><?php 

                                            if($getNotif['type'] == 1){
                                                    echo "Posted a Problem";
                                            }else if($getNotif['type'] == 2){
                                                    echo "Solved a Problem";
                                            }
                                        
                                ?></h6>
                                <small><?php echo $timeString; ?></small>
                            </a>
                            <hr class="dropdown-divider">

                            <?php  }  ?>

                            <a href="notification.php" class="dropdown-item text-center">See all notifications</a>
                           
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                       <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="<?php  echo $_SESSION['profile_picture']; ?>" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">Settings</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="home.php" class="dropdown-item">Home</a>
                            <a href="profile.php" class="dropdown-item">My Profile</a>
                            <a href="../index.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">

                            <!-- start -->

                        

<form action="profile.php" method = "post" enctype="multipart/form-data">
<div class="container">
<div class="row flex-lg-nowrap">


        <?php 

        $user_id = $_SESSION['id'];

        $SelectProfileInfo = "SELECT * FROM sqlcommunity_main.admin_account WHERE id = $user_id";
        $queryForProfileInfo = mysqli_query($conn,$SelectProfileInfo);
        $resultForProfileInfo = mysqli_fetch_assoc($queryForProfileInfo);


        ?>


  <div class="col">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <div class="e-profile">
              <div class="row">
                <div class="col-12 col-sm-auto mb-3">
                  <div class="mx-auto" style="width: 140px;">
                    <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                    <img id="profilePicturePreview" 
                    src="<?php echo $resultForProfileInfo['profile_picture']; ?>" 
                    alt="Profile Picture" 
                    style="width: 140px; height: 140px;">

                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                  <div class="text-sm-left mb-2 mb-sm-0">
                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo $resultForProfileInfo['fullname']; ?></h4>
                    <p class="mb-0"><?php echo $resultForProfileInfo['gmail']; ?></p>
                    <div class="text-muted" style="background-color: #28a745; color: white; padding: 2px 6px; border-radius: 10px; display: inline-block;">
                            <small style = "color: white;">Active Now</small>
                        </div>

                    <div class="mt-2">
                    <button class="btn btn-primary" type="button" id="changePhotoButton">
                        <i class="fa fa-fw fa-camera"></i>
                        <span>Change Photo</span>
                    </button>


                    <input type="file" name="profile_picture" id="profilePictureInput" hidden>


                    <script>
                        document.getElementById('changePhotoButton').addEventListener('click', function() {
                            document.getElementById('profilePictureInput').click();
                        });

                        document.getElementById('profilePictureInput').addEventListener('change', function(event) {
                            const file = event.target.files[0]; 
                            if (file) {
                                const reader = new FileReader(); 
                                reader.onload = function(e) {
                                   
                                    document.getElementById('profilePicturePreview').src = e.target.result;
                                };
                                reader.readAsDataURL(file); 
                            }
                        });
                    </script>
                      
                    </div>
                  </div>
                  <div class="text-center text-sm-right">
                  
                    <div class="text-muted" style = "font-size:14px; font-weight: bolder;"><small>Joined <?php echo date('F j, Y', strtotime($resultForProfileInfo['date'])); ?></small></div>
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs">
                <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
              </ul>
              <div class="tab-content pt-3">
                <div class="tab-pane active">
                
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Full Name</label>
                              <input class="form-control" type="text" name="fullname"  value="<?php echo $resultForProfileInfo['fullname']; ?>">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Status</label>
                              <input class="form-control" type="text" name="status"  value="<?php echo $resultForProfileInfo['status']; ?>" readonly>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Email</label>
                              <input class="form-control" name = "gmail" type="text" placeholder="<?php echo $resultForProfileInfo['gmail']; ?>" value = "<?php echo $resultForProfileInfo['gmail']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label>About</label>
                              <textarea class="form-control" name = "bio" rows="5" ><?php if (empty($resultForProfileInfo['bio'])) {
                                        echo "This user seems to be a bit too lazy to fill out their bio. Maybe they’re still thinking about how to describe themselves, or perhaps they believe their actions speak louder than words. We hope they’ll share something interesting here soon!";
                                    } else {
                                        echo $resultForProfileInfo['bio'];
                                    } 
                                    ?>
                                    </textarea>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                  
                
                    </div>
                    <div class="row">
                      <div class="col d-flex justify-content-center">
                        <input type="submit" name = "submitChanges" class = "btn btn-success" value = "Save Changes" style = "width: 100%;">
                       
                      </div>
                    </div>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  
    </div>

  </div>
</div>
</div>

</form>

                            <!-- end -->
                    </div>
            </div>
         
         
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">SQL Community Management System</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                      
                            Designed By: <a href="#">Ejie C. Florida</a>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
      
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="template/lib/chart/chart.min.js"></script>
    <script src="template/lib/easing/easing.min.js"></script>
    <script src="template/lib/waypoints/waypoints.min.js"></script>
    <script src="template/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="template/lib/tempusdominus/js/moment.min.js"></script>
    <script src="template/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="template/template/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

   
    <script src="template/js/main.js"></script>
</body>

</html>