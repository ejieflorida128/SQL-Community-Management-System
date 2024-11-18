
<?php
session_start();
include("../connection/conn.php");

if (isset($_POST['EditInfo'])) {
    $id = $_SESSION['id'];

 
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $gmail = mysqli_real_escape_string($conn, $_POST['gmail']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $photo = $_FILES['photo'];

   
    $photoPath = $_SESSION['profile_picture'];

  

   
    if (isset($photo) && $photo['error'] == 0) {
        $upload_dir = "../profile_pictures/";
        $photo_name = basename($photo['name']);
        $target_file = $upload_dir . $photo_name;

      
        if (!is_writable($upload_dir)) {
            echo "Upload directory is not writable.<br>";
            exit();
        }

      
        if (move_uploaded_file($photo['tmp_name'], $target_file)) {
           
            $photoPath = $target_file;
            $_SESSION['profile_picture'] = $target_file; // Update session with new photo path
        } else {
           
            exit();
        }
    } else {
      
    }

    // Prepare SQL update query including the profile picture path
    $sqlUpdate = "UPDATE sqlcommunity_main.user_account 
                  SET fullname = ?, gmail = ?, password = ?, profile_picture = ? 
                  WHERE id = ?";

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("ssssi", $fullname, $gmail, $password, $photoPath, $id);

    if ($stmt->execute()) {
      
        $_SESSION['fullname'] = $fullname;
        $_SESSION['gmail'] = $gmail;
        $_SESSION['password'] = $password;
        $_SESSION['success'] = "Profile updated successfully.";

        header("Location: profile.php");
    } else {
        echo "Error updating profile: " . $conn->error . "<br>";
        $_SESSION['error'] = "Error updating profile: " . $conn->error;
    }

    // Close the prepared statement and connection
    $stmt->close();
    $conn->close();
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">  
    <link href="template/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="template/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />  
    
    <link href="template/css/bootstrap.min.css" rel="stylesheet">
    <link href="template/css/style.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
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
                        <a href="home.php" class="nav-item nav-link">
                            <i class="fa fa-home me-2"></i>Home
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
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
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
         
            <div class="container-fluid pt-4 px-4 bg-light">
                <div class="row vh-100  rounded align-items-center justify-content-center mx-0">
                    
                <div class="row" style = "position: absolute; left: 0px; top: 80px;">
                    <div class="col-md-12">
                        <div id="content" class="content content-full-width">
                            <!-- begin profile -->
                            <div class="profile">
                            <div class="profile-header">
                                <!-- BEGIN profile-header-cover -->
                                <div class="profile-header-cover"></div>
                               
                                <div class="profile-header-content">
                                   
                                    <div class="profile-header-img">
                                        <img src="<?php  echo $_SESSION['profile_picture']; ?>" alt="">
                                    </div>
                                  
                                    <div class="profile-header-info">
                                    <p class="m-b-10" style = "margin-top: 10px; font-size: 25px; font-weight: bolder;" ><?php  echo $_SESSION['fullname']; ?></p>
                                        <p class="m-b-10" style = "margin-top: -20px; font-size: 15px; font-weight: bolder;" ><?php  echo $_SESSION['gmail']; ?></p>
                                       
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" style = "margin-top: -5px;">
                                        Edit  Information
                                        </button>

                                        <form action="profile.php" method="post" enctype="multipart/form-data">
                                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 5%;">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Information Form</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-3" style="display: flex;">
                                                                            <div class="photo-container">
                                                                                <label for="photo">
                                                                                    <!-- Display current profile picture or a default image -->
                                                                                    <img src="<?php echo isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'default.jpg'; ?>" 
                                                                                        alt="Profile Picture" id="imagePreview" style="height: 180px; width: 170px;">
                                                                                </label>
                                                                                <input type="file" name="photo" id="photo" hidden>
                                                                            </div>
                                                                            <div class="info2" style="margin-left: 20px;">
                                                                                <?php
                                                                                    $id = $_SESSION['id'];
                                                                                    $sqlGetData = "SELECT * FROM sqlcommunity_main.user_account WHERE id = $id";
                                                                                    $queryForData = mysqli_query($conn, $sqlGetData);

                                                                                    if ($getData = mysqli_fetch_assoc($queryForData)) {
                                                                                ?>
                                                                                    <label for="fullname" class="form-label" style="color: grey;">Fullname:</label>
                                                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($getData['fullname']); ?>" name="fullname" required style="width: 140%; margin-top: -8px;">
                                                                                    
                                                                                    <label for="gmail" class="form-label" style="color: grey;">Gmail:</label>
                                                                                    <input type="email" class="form-control" value="<?php echo htmlspecialchars($getData['gmail']); ?>" name="gmail" required style="width: 140%; margin-top: -10px;">
                                                                                    
                                                                                    <label for="password" class="form-label" style="color: grey;">New Password (Optional):</label>
                                                                                    <input type="password" class="form-control" placeholder="Enter new password" name="password" value="<?php echo htmlspecialchars($getData['password']); ?>"  style="width: 140%; margin-top: -12px;">
                                                                                    
                                                                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($getData['profile_picture']); ?>" name="photo" style="width: 140%; margin-top: -8px;" hidden>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                                                        <input type="submit" value="Save Changes" class="btn btn-outline-success" name="EditInfo">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    <script>
                                                        const photoInput = document.getElementById('photo');
                                                        const imagePreview = document.getElementById('imagePreview');

                                                      
                                                        photoInput.addEventListener('change', (e) => {
                                                            const file = e.target.files[0]; 
                                                            if (file) {
                                                             
                                                                const reader = new FileReader();
                                                                reader.onload = function(event) {
                                                                  
                                                                    imagePreview.src = event.target.result;
                                                                    imagePreview.style.display = 'block';
                                                                };
                                                                reader.readAsDataURL(file); 
                                                            } else {
                                                             
                                                                imagePreview.style.display = 'none';
                                                            }
                                                        });
                                                    </script>




                                            <style>
                                                .modal.fade {
                                                    opacity: 0;
                                                    transform: translateY(-50px);
                                                    transition: opacity 0.3s, transform 0.3s;
                                                }

                                                .modal.show {
                                                    opacity: 1;
                                                    transform: translateY(0);
}
                                            </style>

                                           
                                 
                                </div>
                             
                            </div>
                            </div>
                            <!-- end profile -->
                            <!-- begin profile-content -->
                            <div class="profile-content">
                            <!-- begin tab-content -->
                            <div class="tab-content p-0">
                                <!-- begin #profile-post tab -->
                                <div class="tab-pane fade active show" id="profile-post">
                                    <!-- begin timeline -->
                                    <ul class="timeline">
                                    <?php
                                            $user_id = $_SESSION['id'];

                                            $sqlGetPostById = "SELECT * FROM sqlcommunity_interaction.post WHERE post_by = $user_id";
                                            $getDataQuery = mysqli_query($conn,$sqlGetPostById);

                                            while($getData = mysqli_fetch_assoc($getDataQuery)){
                                                $post_id = $getData['id'];

                                                $sqlGetUserInfo = "SELECT * FROM sqlcommunity_main.user_account WHERE id = $user_id";
                                                $queryGetUserInfo = mysqli_query($conn, $sqlGetUserInfo);
                                                $resultUserInfo = mysqli_fetch_assoc($queryGetUserInfo);

                                                $date_now = new DateTime(); 

                                        
                                                $date_post = new DateTime($getData['post_date']); 
    
                                            
    
                                                
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
                                     
                                     <li>
                                     <div class="timeline-time">
                                         <span class="date"><?php echo $resultUserInfo['fullname']; ?></span>
                                         <span class="time"><?php echo $timeString; ?></span>
                                     </div>
                                   
                                     <div class="timeline-icon">
                                         <a href="javascript:;">&nbsp;</a>
                                     </div>
                                    
                                     <div class="timeline-body " style = " box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.3); " >
                                         <div class="timeline-header">
                                             <span class="userimage"><img src="<?php echo $resultUserInfo['profile_picture']; ?>" alt=""></span>
                                             <span class="username"><a href="javascript:;"><?php echo $resultUserInfo['fullname']; ?></a> <small></small></span>
                                            
                                         </div>
                                         <div class="timeline-content">
                                                <pre class="code-blocks"><code><?php echo $getData['code']; ?></code></pre>
                                                <style>
                                                                             .code-blocks {
                                                                                    background: linear-gradient(135deg, #173B45, #343131);
                                                                                    color: white;
                                                                                    white-space: pre-wrap;   
                                                                                    word-wrap: break-word;  
                                                                                    overflow-x: hidden;      
                                                                                    font-family: 'Courier New', monospace; 
                                                                                    background-color: #f4f4f4;
                                                                                    padding: 10px;          
                                                                                    border-radius: 5px;    
                                                                                    text-align: left;   
                                                                                }


                                                                            </style>
                                                </div>
                                                <div class="timeline-likes">
    <div class="stats-right">

        <?php
            $selectComments = "SELECT COUNT(*) AS reply_count FROM sqlcommunity_interaction.comments WHERE post_id = '$post_id'";
            $queryComments = mysqli_query($conn, $selectComments);
            $resultComments = mysqli_fetch_assoc($queryComments);
            $commentCount = $resultComments['reply_count']; 

            $displayCount = ($commentCount > 99) ? "99+" : $commentCount;
        ?>

        <div style="position: relative; display: inline-block; top: -15px;">
            <button class="comment-button"
                    style="background-color: #62825D; color: white;" 
                    onclick="toggleComments(<?php echo $post_id; ?>)"
                    <?php echo $commentCount == 0 ? 'disabled' : ''; ?>>
                💬 Show Solutions
            </button>

            <!-- Comment Badge -->
            <span class="comment-badge"><?php echo $displayCount; ?></span>
        </div>

        <style>
            .comment-button {
                padding: 5px;
                border-radius: 10px;
                border: none;
                box-shadow: rgba(0, 0, 0, 0.5);
            }

            .comment-badge {
                position: absolute;
                top: -5px;
                right: -4px;
                background-color: red;
                color: white;
                padding: 2px 5px;
                border-radius: 50%;
                font-size: 0.8em;
                font-weight: bold;
                width: 20px;
                height: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 20;
            }
        </style>

        <script>
            function toggleComments(post_id) {
                const commentsSection = document.getElementById('comments-' + post_id);
                if (commentsSection.style.display === "none" || commentsSection.style.display === "") {
                    commentsSection.style.display = "block";
                } else {
                    commentsSection.style.display = "none";
                }
            }
        </script>
    </div>
</div>

<!-- Comments Section -->
                                            <div class="comments" id="comments-<?php echo $post_id; ?>" style="display: none; margin-top: 34px; border-top: 5px solid #78B3CE;">
                                                         <ul class="timeline">
                                                         <?php
                                                                $getCommentByThisPost = "SELECT * FROM sqlcommunity_interaction.comments WHERE post_id = $post_id ORDER BY id ASC";
                                                                $queryCommentByThisPost = mysqli_query($conn, $getCommentByThisPost);

                                                                while ($resultCommentByThisPost = mysqli_fetch_assoc($queryCommentByThisPost)) {
                                                                    $commentDateTime = new DateTime($resultCommentByThisPost['comment_date']); 
                                                                    $currentDateTime = new DateTime();
                                                                    
                                                                  
                                                                    $interval = $currentDateTime->diff($commentDateTime);

                                                                 
                                                                    if ($interval->days == 0) {
                                                                      
                                                                        $dateString = "today";
                                                                        $timeString = $commentDateTime->format("H:i"); 
                                                                    } else {
                                                                       
                                                                        $dateString = $commentDateTime->format("Y-m-d");
                                                                        $timeString = $commentDateTime->format("H:i");
                                                                    }
                                                            ?>

                                                            <li>
                                                                <div class="timeline-time">
                                                                    <span class="date" style="color: #003C43;"><?php echo $dateString; ?></span>
                                                                    <span class="time" style="color: #003C43;"><?php echo $timeString; ?></span>
                                                                </div>
                                                            </li>
                                                            
                                                                <div class="timeline-icon">
                                                                    <a href="javascript:;">&nbsp;</a>
                                                                </div>
                                                                
                                                                <div class="timeline-body" style = "width: 110%;box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.5); border-radius: 20px;">
                                                                    <div class="timeline-header">

                                                                            <?php
                                                                                $commemter_id = $resultCommentByThisPost['commenter_id'];
                                                                                    $getCommentInfo = "SELECT * FROM sqlcommunity_main.user_account WHERE id = $commemter_id";
                                                                                    $queryCommentInfo = mysqli_query($conn,$getCommentInfo);
                                                                                    $resultCommentInfo = mysqli_fetch_assoc($queryCommentInfo);
                                                                            ?>
                                                                        <span class="userimage"><img src="<?php echo $resultCommentInfo['profile_picture']; ?>" alt=""></span>
                                                                        <span class="username"><a href="javascript:;"><?php echo $resultCommentInfo['fullname']; ?></a> <small></small></span>
                                                                        
                                                                    </div>
                                                                    <div class="timeline-content" >
                                                                            <p><?php echo $resultCommentByThisPost['comment']; ?></p>
                                                        
                                                                            <pre class="code-blocks"><code><?php echo $resultCommentByThisPost['code']; ?></code></pre>
                                                                            
                                                                            <style>
                                                                             .code-blocks {
                                                                                    background: linear-gradient(135deg, #173B45, #343131);
                                                                                    color: white;
                                                                                    white-space: pre-wrap;   
                                                                                    word-wrap: break-word;  
                                                                                    overflow-x: hidden;      
                                                                                    font-family: 'Courier New', monospace; 
                                                                                    background-color: #f4f4f4;
                                                                                    padding: 10px;          
                                                                                    border-radius: 5px;    
                                                                                    text-align: left;   
                                                                                }


                                                                            </style>
                                                                            
                                                                         
                                                                     

                                                                      

                                                                        <style>
                                                                            .stats-right {
                                                                                        float: right;
                                                                                        color: #78B3CE;
                                                                                        font-weight: bolder;
                                                                                    }

                                                                        </style>

                                                                    </div>
                                                                    <div class="timeline-likes">
                                                                       
                                                                        <div class="stats">
                                                                           
                                                                        </div>
                                                                    </div>
                                                                    
                                                                   

                                                                                           
                                                                    
                                                                            </li>
                                                                        </div>
                                                        
                                                              

                                                                 <?php  } ?>

                                                                <style>
                                                                    
                                                                    .timeline {
                                                                        list-style-type: none;
                                                                        margin: 0;
                                                                        padding: 0;
                                                                        position: relative
                                                                    }

                                                                    .timeline:before {
                                                                        content: '';
                                                                        position: absolute;
                                                                        top: 5px;
                                                                        bottom: 5px;
                                                                        width: 5px;
                                                                        background: #78B3CE;
                                                                        left: 20%;
                                                                        margin-left: -2.5px
                                                                    }

                                                                    .timeline>li {
                                                                        position: relative;
                                                                        min-height: 50px;
                                                                        padding: 20px 0
                                                                    }

                                                                    .timeline .timeline-time {
                                                                        position: absolute;
                                                                        left: 0;
                                                                        width: 18%;
                                                                        text-align: right;
                                                                        top: 30px
                                                                    }

                                                                    .timeline .timeline-time .date,
                                                                    .timeline .timeline-time .time {
                                                                        display: block;
                                                                        font-weight: 600
                                                                    }

                                                                    .timeline .timeline-time .date {
                                                                        line-height: 16px;
                                                                        font-size: 12px
                                                                    }

                                                                    .timeline .timeline-time .time {
                                                                        line-height: 24px;
                                                                        font-size: 20px;
                                                                        color: #242a30
                                                                    }

                                                                    .timeline .timeline-icon {
                                                                        left: 15%;
                                                                        position: absolute;
                                                                        width: 10%;
                                                                        text-align: center;
                                                                        top: 40px
                                                                    }

                                                                    .timeline .timeline-icon a {
                                                                        text-decoration: none;
                                                                        width: 20px;
                                                                        height: 20px;
                                                                        display: inline-block;
                                                                        border-radius: 20px;
                                                                        background: #d9e0e7;
                                                                        line-height: 10px;
                                                                        color: #fff;
                                                                        font-size: 14px;
                                                                        border: 5px solid #78B3CE;
                                                                        transition: border-color .2s linear
                                                                    }

                                                                    .timeline .timeline-body {
                                                                        margin-left: 23%;
                                                                        margin-right: 17%;
                                                                        background: #fff;
                                                                        position: relative;
                                                                        padding: 20px 25px;
                                                                        border-radius: 6px
                                                                    }

                                                                    .timeline .timeline-body:before {
                                                                        content: '';
                                                                        display: block;
                                                                        position: absolute;
                                                                        border: 10px solid transparent;
                                                                        border-right-color: #fff;
                                                                        left: -20px;
                                                                        top: 20px
                                                                    }

                                                                    .timeline .timeline-body>div+div {
                                                                        margin-top: 15px
                                                                    }

                                                                    .timeline .timeline-body>div+div:last-child {
                                                                        margin-bottom: -20px;
                                                                        padding-bottom: 20px;
                                                                        border-radius: 0 0 6px 6px
                                                                    }

                                                                    .timeline-header {
                                                                        padding-bottom: 10px;
                                                                        border-bottom: 1px solid #e2e7eb;
                                                                        line-height: 30px
                                                                    }

                                                                    .timeline-header .userimage {
                                                                        float: left;
                                                                        width: 34px;
                                                                        height: 34px;
                                                                        border-radius: 40px;
                                                                        overflow: hidden;
                                                                        margin: -2px 10px -2px 0
                                                                    }

                                                                    .timeline-header .username {
                                                                        font-size: 16px;
                                                                        font-weight: 600
                                                                    }

                                                                    .timeline-header .username,
                                                                    .timeline-header .username a {
                                                                        color: #2d353c
                                                                    }

                                                                    .timeline img {
                                                                        max-width: 100%;
                                                                        display: block
                                                                    }

                                                                    .timeline-content {
                                                                        letter-spacing: .25px;
                                                                        line-height: 18px;
                                                                        font-size: 13px
                                                                    }

                                                                    .timeline-content:after,
                                                                    .timeline-content:before {
                                                                        content: '';
                                                                        display: table;
                                                                        clear: both
                                                                    }

                                                                    .timeline-title {
                                                                        margin-top: 0
                                                                    }

                                                                    .timeline-footer {
                                                                        background: #fff;
                                                                        border-top: 1px solid #e2e7ec;
                                                                        padding-top: 15px
                                                                    }

                                                                    .timeline-footer a:not(.btn) {
                                                                        color: #575d63
                                                                    }

                                                                    .timeline-footer a:not(.btn):focus,
                                                                    .timeline-footer a:not(.btn):hover {
                                                                        color: #2d353c
                                                                    }

                                                                    .timeline-likes {
                                                                        color: #6d767f;
                                                                        font-weight: 600;
                                                                        font-size: 12px
                                                                    }

                                                                    .timeline-likes .stats-right {
                                                                        float: right
                                                                    }

                                                                    .timeline-likes .stats-total {
                                                                        display: inline-block;
                                                                        line-height: 20px
                                                                    }

                                                                    .timeline-likes .stats-icon {
                                                                        float: left;
                                                                        margin-right: 5px;
                                                                        font-size: 9px
                                                                    }

                                                                    .timeline-likes .stats-icon+.stats-icon {
                                                                        margin-left: -2px
                                                                    }

                                                                    .timeline-likes .stats-text {
                                                                        line-height: 20px
                                                                    }

                                                                    .timeline-likes .stats-text+.stats-text {
                                                                        margin-left: 15px
                                                                    }

                                                                    .timeline-comment-box {
                                                                        background: #f2f3f4;
                                                                        margin-left: -25px;
                                                                        margin-right: -25px;
                                                                        padding: 20px 25px
                                                                    }

                                                                    .timeline-comment-box .user {
                                                                        float: left;
                                                                        width: 34px;
                                                                        height: 34px;
                                                                        overflow: hidden;
                                                                        border-radius: 30px
                                                                    }

                                                                    .timeline-comment-box .user img {
                                                                        max-width: 100%;
                                                                        max-height: 100%
                                                                    }

                                                                    .timeline-comment-box .user+.input {
                                                                        margin-left: 44px
                                                                    }

                                                              
                                                                </style>
                                                        </ul>
                                                    </div>
                                        
                                      
                                     </div>
                               
                                     </li>
                                     <?php  } ?>
                                       
                                 
                                       
                                      
                                    </ul>
                                    <!-- end timeline -->
                                </div>
                                <!-- end #profile-post tab -->
                            </div>
                            <!-- end tab-content -->
                            </div>
                            <!-- end profile-content -->
                        </div>
                    </div>
                </div>
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