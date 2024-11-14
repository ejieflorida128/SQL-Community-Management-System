<?php
    session_start();
    include("../connection/conn.php");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SQL Comunity Management System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    
    <link href="img/favicon.ico" rel="icon">

  
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
                        <a href="home.php" class="nav-item nav-link active">
                            <i class="fa fa-home me-2"></i>Home
                        </a>
                        <a href="profile.php" class="nav-item nav-link ">
                            <i class="fa fa-user me-2"></i>Profile
                        </a>
                        <a href="notification.php" class="nav-item nav-link ">
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
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
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
         
            <div class="container-fluid pt-4 px-4">
    


            <!-- Button to trigger the modal -->
            <div class="container mt-5">
                <!-- Button to trigger the modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sqlModal" style = "margin-top: -60px;">
                    Ask a SQL Question
                </button>
            </div>

                    
                       <!-- Modal Structure -->
                    <div class="modal fade" id="sqlModal" tabindex="-1" aria-labelledby="sqlModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="sqlModalLabel">Ask a SQL Question</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- SQL Question Form Inside the Modal -->
                                    <form action="post_sql_question.php" method="POST" enctype="multipart/form-data">
                                        <!-- SQL Title Input -->
                                        <div class="mb-3">
                                            <label for="sqlTitle" class="form-label">SQL Question Title</label>
                                            <input type="text" name="sqlTitle" id="sqlTitle" placeholder="Enter the SQL question title" class="form-control" required>
                                        </div>

                                        <!-- SQL Description Textarea -->
                                        <div class="mb-3">
                                            <label for="sqlDescription" class="form-label">Describe Your Issue</label>
                                            <textarea name="sqlDescription" id="sqlDescription" placeholder="Provide details about your SQL issue..." rows="3" class="form-control" required></textarea>
                                        </div>

                                        <!-- SQL Code Block Section -->
                                        <div class="mb-3">
                                            <label for="sqlCode" class="form-label">SQL Code (optional)</label>
                                            <textarea name="sqlCode" id="sqlCode" placeholder="Paste your SQL code here..." rows="3" class="form-control"></textarea>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="submit-container mt-3">
                                            <button type="submit" class="btn btn-success w-100">Submit Question</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Custom CSS for Modal Animation -->
                    <style>
                        /* Adding fade-in animation */
                        .modal.fade .modal-dialog {
                            transform: translateY(-50px);
                            opacity: 0;
                            transition: transform 0.3s ease, opacity 0.3s ease;
                        }

                        .modal.show .modal-dialog {
                            transform: translateY(0);
                            opacity: 1;
                        }

                        /* Optional: Fade-out animation when closing the modal */
                        .modal.fade .modal-dialog {
                            transform: translateY(-50px);
                            opacity: 0;
                            transition: transform 0.3s ease, opacity 0.3s ease;
                        }

                        .modal-backdrop.show {
                            opacity: 0.5; /* Optional: Adjust backdrop opacity */
                        }

                        /* Optional: Apply animation to modal content */
                        .modal-content {
                            animation: slideIn 0.3s ease-in-out;
                        }

                        /* Keyframes for sliding in */
                        @keyframes slideIn {
                            0% {
                                transform: translateY(50px);
                                opacity: 0;
                            }
                            100% {
                                transform: translateY(0);
                                opacity: 1;
                            }
                        }
                    </style>






                        <style>
                            /* Modal Styling */
                            .modal-header {
                                background-color: #f8f9fa;
                                border-bottom: 1px solid #ddd;
                            }

                            .modal-body {
                                background-color: #f9f9f9;
                            }

                            .modal-footer {
                                background-color: #f8f9fa;
                                border-top: 1px solid #ddd;
                            }

                            .submit-container {
                                display: flex;
                                justify-content: flex-end;
                                margin-top: 20px;
                            }

                            .btn-primary {
                                width: 100%;
                                text-align: center;
                                font-size: 18px;
                                padding: 12px 15px;
                            }

                            /* Button Styling for Modal Trigger */
                            .btn-primary {
                                width: 100%;
                                text-align: center;
                                font-size: 18px;
                                padding: 12px 15px;
                            }

                            /* Mobile Responsiveness */
                            @media (max-width: 600px) {
                                .modal-dialog {
                                    max-width: 100%;
                                }

                                .btn-primary {
                                    font-size: 16px;
                                }

                                .form-control {
                                    font-size: 14px;
                                }
                            }
                        </style>




                        <section style = "margin-top: 40px;">
                        <div class="post-list">
                                        <!-- A single post -->
                                        <div class="post-item">
                                            <div class="post-header">
                                                <div class="user-info">
                                                    <img src="user-profile-pic.jpg" alt="User Profile Picture" class="user-profile-pic">
                                                    <div class="user-name">
                                                        <strong>John Doe</strong>
                                                        <span class="post-time">• 2 hours ago</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="post-content">
                                                <h2 class="post-title">How do I handle SQL injection in PHP?</h2>
                                                <p>This is a question about preventing SQL injection attacks in PHP. Below is the code I tried, but I am unsure if it's safe.</p>
                                                
                                                <!-- Code Block -->
                                                <pre class="code-block">
                                    <code>
                                    $sql = "SELECT * FROM users WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "'";
                                    // This is vulnerable to SQL injection
                                    </code>
                                    </pre>

                                                <p>Can anyone suggest how to fix this securely?</p>
                                            </div>
                                            
                                            <div class="post-actions">
                                                <button class="like-button">Like</button>
                                                <button class="comment-button">Comment</button>
                                                <button class="share-button">Share</button>
                                            </div>
                                        </div>

                                        <!-- Another Post -->
                                        <div class="post-item">
                                            <div class="post-header">
                                                <div class="user-info">
                                                    <img src="user-profile-pic2.jpg" alt="User Profile Picture" class="user-profile-pic">
                                                    <div class="user-name">
                                                        <strong>Jane Smith</strong>
                                                        <span class="post-time">• 5 hours ago</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-content">
                                                <h2 class="post-title">How to use prepared statements in PHP?</h2>
                                                <p>Here is how you can protect against SQL injection using prepared statements.</p>
                                                
                                                <!-- Code Block -->
                                                <pre class="code-block">
                                    <code>
                                    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
                                    $stmt->bind_param("ss", $_POST['username'], $_POST['password']);
                                    $stmt->execute();
                                    </code>
                                    </pre>

                                                <p>Is this the right way to prevent SQL injection?</p>
                                            </div>
                                            
                                            <div class="post-actions">
                                                <button class="like-button">Like</button>
                                                <button class="comment-button">Comment</button>
                                                <button class="share-button">Share</button>
                                            </div>
                                        </div>

                                    </div>

                                    <style>
                                    /* Ensure the container takes up the full width */
                                    body, html {
                                        margin: 0;
                                        padding: 0;
                                        width: 100%;
                                        height: 100%;
                                        background-color: #f4f4f4;
                                    }

                                    /* Container for all posts */
                                    .post-list {
                                        width: 100%;
                                        max-width: 100%;  /* Make sure it can take up the whole width */
                                        margin: 0 auto;  /* Center the content horizontally */
                                        padding: 10px;
                                    }

                                    /* Individual post container */
                                    .post-item {
                                        background-color: #fff;
                                        border-radius: 8px;
                                        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                                        margin-bottom: 20px;
                                        padding: 15px;
                                        width: 100%;  /* Ensure posts take full width of the parent */
                                    }

                                    /* Header with user info */
                                    .post-header {
                                        display: flex;
                                        justify-content: space-between;
                                        margin-bottom: 15px;
                                    }

                                    .user-info {
                                        display: flex;
                                        align-items: center;
                                    }

                                    .user-profile-pic {
                                        width: 50px;  /* Slightly bigger profile picture */
                                        height: 50px;
                                        border-radius: 50%;
                                        margin-right: 10px;
                                    }

                                    .user-name {
                                        display: flex;
                                        flex-direction: column;
                                    }

                                    .user-name strong {
                                        font-size: 16px;
                                        color: #333;
                                    }

                                    .user-name .post-time {
                                        font-size: 12px;
                                        color: grey;
                                    }

                                    /* Content of the post (text and code) */
                                    .post-content {
                                        margin-bottom: 15px;
                                    }

                                    .post-title {
                                        font-size: 20px;
                                        font-weight: bold;
                                        color: #333;
                                        margin-bottom: 10px;
                                    }

                                    .post-content p {
                                        font-size: 14px;
                                        color: #333;
                                        margin-bottom: 10px;
                                    }

                                    /* Code block styling */
                                    .code-block {
                                        background-color: #f4f4f4;
                                        border: 1px solid #ddd;
                                        padding: 10px;
                                        border-radius: 5px;
                                        overflow-x: auto;
                                        white-space: pre-wrap;
                                        word-wrap: break-word;
                                        margin: 10px 0;
                                        font-family: "Courier New", monospace;
                                        font-size: 14px;
                                        color: #333;
                                    }

                                    .code-block code {
                                        display: block;
                                        white-space: pre;
                                        font-size: 14px;
                                    }

                                    /* Buttons for actions (Like, Comment, Share) */
                                    .post-actions {
                                        display: flex;
                                        justify-content: space-around;
                                        margin-top: 15px;
                                    }

                                    .post-actions button {
                                        background-color: #f0f0f0;
                                        padding: 8px 16px;
                                        border: none;
                                        border-radius: 25px;
                                        cursor: pointer;
                                        font-size: 14px;
                                        color: #555;
                                        transition: background-color 0.3s ease;
                                    }

                                    .post-actions button:hover {
                                        background-color: #e0e0e0;
                                    }

                                    .like-button {
                                        color: #3b5998;
                                    }

                                    .comment-button {
                                        color: #8b9dc3;
                                    }

                                    .share-button {
                                        color: #45b3e0;
                                    }

                                    </style>

                     </section>

                                  


           
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
      
        <a href="#" class="btn btn-primary back-to-top">
    <i class="bi bi-arrow-up"></i>
</a>

<style>
    /* Back to Top Button Style (Circle) */
    .back-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #007bff; /* Blue background */
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 24px;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s;
    }

    /* Hover Effect */
    .back-to-top:hover {
        background-color: #0056b3; /* Darker blue */
    }
</style>
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