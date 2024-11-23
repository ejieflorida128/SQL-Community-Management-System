
<?php
session_start();
include("../connection/conn.php");

$adminStatus = [];
$result = $conn->query("SELECT status, COUNT(*) as count FROM sqlcommunity_main.admin_account GROUP BY status");
while ($row = $result->fetch_assoc()) {
    $adminStatus[$row['status']] = $row['count'];
}


$userStatus = [];
$result = $conn->query("SELECT status, COUNT(*) as count FROM sqlcommunity_main.admin_account GROUP BY status");
while ($row = $result->fetch_assoc()) {
    $userStatus[$row['status']] = $row['count'];
}


$commentsPerPost = [];
$result = $conn->query("SELECT post_id, COUNT(*) as count FROM sqlcommunity_interaction.comments GROUP BY post_id");
while ($row = $result->fetch_assoc()) {
    $commentsPerPost[$row['post_id']] = $row['count'];
}


$postStatus = [];
$result = $conn->query("SELECT status, COUNT(*) as count FROM sqlcommunity_interaction.post GROUP BY status");
while ($row = $result->fetch_assoc()) {
    $postStatus[$row['status']] = $row['count'];
}


$adminLocations = [];
$result = $conn->query("SELECT location, COUNT(*) as count FROM sqlcommunity_main.admin_account GROUP BY location");
while ($row = $result->fetch_assoc()) {
    $adminLocations[$row['location']] = $row['count'];
}


$userLocations = [];
$result = $conn->query("SELECT location, COUNT(*) as count FROM sqlcommunity_main.admin_account GROUP BY location");
while ($row = $result->fetch_assoc()) {
    $userLocations[$row['location']] = $row['count'];
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

    
   
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  
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
                        <a href="dashboard.php" class="nav-item nav-link active">
                            <i class="fa fa-chart-line me-2"></i>Dashboard
                        </a>
                        <a href="pending.php" class="nav-item nav-link">
                            <i class="fa fa-hourglass-half me-2"></i>Pending Post
                        </a>
                        <a href="profile.php" class="nav-item nav-link">
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
                <div class="row vh-100 bg-light rounded mx-0">
              
                        <!-- First Row -->
                        <div class="col-md-4">
                            <canvas id="chart1"></canvas> <!-- Admin Status Distribution -->
                        </div>
                        <div class="col-md-4">
                            <canvas id="chart2"></canvas> <!-- User Status Distribution -->
                        </div>
                        <div class="col-md-4">
                            <canvas id="chart3"></canvas>
                        </div>
                        <!-- Second Row -->
                        <div class="col-md-4">
                            <canvas id="chart4"></canvas> <!-- Updated to Bar Chart for Posts Per Status -->
                        </div>
                        <div class="col-md-4">
                            <canvas id="chart5"></canvas> <!-- Updated to Bar Chart for Admin Location Distribution -->
                        </div>
                        <div class="col-md-4">
                            <canvas id="chart6"></canvas> <!-- Updated to Bar Chart for User Location Distribution -->
                        </div>
     
                </div>

                     <script>
                            // Data for charts
                            const adminStatus = <?php echo json_encode($adminStatus); ?>;
                            const userStatus = <?php echo json_encode($userStatus); ?>;
                            const commentsPerPost = <?php echo json_encode($commentsPerPost); ?>;
                            const postStatus = <?php echo json_encode($postStatus); ?>;
                            const adminLocations = <?php echo json_encode($adminLocations); ?>;
                            const userLocations = <?php echo json_encode($userLocations); ?>;

                            // Chart 1: Admin Age Distribution
                            new Chart(document.getElementById('chart1'), {
                                type: 'bar',
                                data: {
                                    labels: Object.keys(adminStatus),
                                    datasets: [{
                                        label: 'Admin Status Update',
                                        data: Object.values(adminStatus),
                                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    }]
                                }
                            });

                            // Chart 2: User Age Distribution
                            new Chart(document.getElementById('chart2'), {
                                type: 'bar',
                                data: {
                                    labels: Object.keys(userStatus),
                                    datasets: [{
                                        label: 'User Status Update',
                                        data: Object.values(userStatus),
                                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 1
                                    }]
                                }
                            });

                            // Chart 3: Comments Per Post
                            new Chart(document.getElementById('chart3'), {
                                type: 'line',
                                data: {
                                    labels: Object.keys(commentsPerPost),
                                    datasets: [{
                                        label: 'Comments Per Post',
                                        data: Object.values(commentsPerPost),
                                        backgroundColor: 'rgba(255, 206, 86, 0.6)',
                                        borderColor: 'rgba(255, 206, 86, 1)',
                                        borderWidth: 1
                                    }]
                                }
                            });

                            // Chart 4: Posts Per Status (Bar chart)
                            new Chart(document.getElementById('chart4'), {
                                type: 'bar',
                                data: {
                                    labels: Object.keys(postStatus),
                                    datasets: [{
                                        label: 'Posts Per Status',
                                        data: Object.values(postStatus),
                                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                                        borderColor: 'rgba(255, 99, 132, 1)',
                                        borderWidth: 1
                                    }]
                                }
                            });

                            // Chart 5: Admin Location Distribution (Bar chart)
                            new Chart(document.getElementById('chart5'), {
                                type: 'bar',
                                data: {
                                    labels: Object.keys(adminLocations),
                                    datasets: [{
                                        label: 'Admin Location Distribution',
                                        data: Object.values(adminLocations),
                                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 1
                                    }]
                                }
                            });

                            // Chart 6: User Location Distribution (Bar chart)
                            new Chart(document.getElementById('chart6'), {
                                type: 'bar',
                                data: {
                                    labels: Object.keys(userLocations),
                                    datasets: [{
                                        label: 'User Location Distribution',
                                        data: Object.values(userLocations),
                                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    }]
                                }
                            });
                        </script>
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