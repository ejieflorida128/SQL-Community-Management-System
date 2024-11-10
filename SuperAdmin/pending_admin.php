<?php
include("../connection/conn.php");

// Pagination settings
$limit = 5; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
$offset = ($page - 1) * $limit; // Offset for the SQL query

// Fetch total number of records
$sqlCount = "SELECT COUNT(*) AS total FROM sqlcommunity_main.admin_account WHERE status = 'Pending'";
$queryCount = mysqli_query($conn, $sqlCount);
$totalRecords = mysqli_fetch_assoc($queryCount)['total'];
$totalPages = ceil($totalRecords / $limit);

// Fetch records for the current page
$sqlGetSchool = "SELECT * FROM sqlcommunity_main.admin_account WHERE status = 'Pending' LIMIT $limit OFFSET $offset";
$queryGetSchool = mysqli_query($conn, $sqlGetSchool);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SQL Community Management System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="template/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="libtemplate/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="template/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="template/css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                setTimeout(function() {
                    document.getElementById("spinner").classList.remove("show");
                }, 1000);
            });

        </script>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"></i>SQL Community</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../profile_pictures//default.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Super Admin</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                  
                <a href="approve_admin.php" class="nav-item nav-link ">
                    <i class="fa fa-user-shield me-2"></i>Approve Admin 
                </a>
                <a href="approve_user.php" class="nav-item nav-link">
                    <i class="fa fa-users me-2"></i>Approve User 
                </a>
                <a href="pending_admin.php" class="nav-item nav-link active">
                <i class="fa fa-hourglass-half me-2"></i>Pending Admin 
                </a>
                <a href="pending_user.php" class="nav-item nav-link ">
                    <i class="fa fa-hourglass-half me-2"></i>Pending User 
                </a>

                   
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
              
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                <input id="searchInput" class="form-control border-0" type="search" placeholder="Search" >
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                  
                  
                <div class="nav-item dropdown">
                    <a href="../index.php" class="btn btn-danger" style="margin: 10px;">
                        <i class="fas fa-sign-out-alt"></i> <!-- Logout Icon -->
                    </a>
                    </div>

                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Pending Admin</h6>
                            <div class="table-responsive">
                            <table class="table">
                                    <thead>
                                        <tr class = "text-center">
                                            <th scope="col">Profile Picture</th>
                                            <th scope="col">Fullname</th>
                                            <th scope="col">Gmail Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date Created</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="schoolTableBody">
                            <?php
                                $sqlGetSchool = "SELECT * FROM sqlcommunity_main.admin_account WHERE status = 'Pending'";
                                $queryGetSchool = mysqli_query($conn, $sqlGetSchool);

                                $number = 0;

                                while ($getData = mysqli_fetch_assoc($queryGetSchool)) {
                                    $number++;
                                    $uniqueCheckModalId = "checkModal" . $getData['id'];
                                    $uniqueDeleteModalId = "deleteModal" . $getData['id'];
                            ?>
                            <tr class="school-row text-center">
                                
                                <td><img src="<?php echo $getData['profile_picture']; ?>" alt="school logo" style="width: 30px; height: 30px; border-radius: 50%;"></td>
                                <td class="school-name"><h6 style="color: grey; margin-top: 7px;"><?php echo $getData['fullname']; ?></h6></td>
                                <td class="school-name"><h6 style="color: grey; margin-top: 7px;"><?php echo $getData['gmail']; ?></h6></td>
                                <td class="school-name"><h6 style="color: grey; margin-top: 7px; background-color: orange; padding-top: 2px; padding-bottom: 2px; border-radius: 10px; color: white;"><?php echo $getData['status']; ?></h6></td>
                                <td class="school-name"><h6 style="color: grey; margin-top: 7px;"><?php echo $getData['date']; ?></h6></td>
                                <td class = "text-center">
                                    <div>                
                                        <!-- Check Button to open the check modal -->
                                        <button type="button" class="btn" style="background-color: green; color: white;" data-bs-toggle="modal" data-bs-target="#<?php echo $uniqueCheckModalId; ?>">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        
                                        <!-- Delete Button to open the delete modal -->
                                        <button type="button" class="btn" style="background-color: red; color: white; margin-left: 13px;" data-bs-toggle="modal" data-bs-target="#<?php echo $uniqueDeleteModalId; ?>">
                                            <i class="fa fa-times"></i>
                                        </button>

                                        <!-- Check Modal Structure -->
                                        <div class="modal fade" id="<?php echo $uniqueCheckModalId; ?>" tabindex="-1" aria-labelledby="checkModalLabel<?php echo $getData['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="checkModalLabel<?php echo $getData['id']; ?>">Approve Confirmation</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="text-align: left;">
                                                        Are you sure you want to approve this entry?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                        <a type="button" class="btn btn-success" href="action/pending_admin_A.php?id=<?php echo $getData['id']; ?>">Confirm Approve</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Modal Structure -->
                                        <div class="modal fade" id="<?php echo $uniqueDeleteModalId; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $getData['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?php echo $getData['id']; ?>">Delete Confirmation</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="text-align: left;">
                                                        Are you sure you want to delete this entry?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                        <a type="button" class="btn btn-success" href="action/pending_admin_D.php?id=<?php echo $getData['id']; ?>">Confirm Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                    <!-- Placeholder row for "No results found" -->
                    <tr id="noResultsRow" style="display: none;">
                        <td colspan="6" class="text-center" style="background-color: red; color: white; font-weight: bolder;">No results found</td>
                    </tr>
                </tbody>

                                </table>

                                <script>
                                    // Get search input, table rows, and the no-results row
                                    const searchInput = document.getElementById('searchInput');
                                    const schoolRows = document.querySelectorAll('.school-row');
                                    const noResultsRow = document.getElementById('noResultsRow');

                                    // Listen for input changes
                                    searchInput.addEventListener('input', function() {
                                        const searchText = searchInput.value.toLowerCase();
                                        let matchFound = false;

                                        schoolRows.forEach(row => {
                                            // Get the school name text
                                            const schoolName = row.querySelector('.school-name').textContent.toLowerCase();

                                            // Show or hide row based on match
                                            if (schoolName.includes(searchText)) {
                                                row.style.display = '';
                                                matchFound = true;
                                            } else {
                                                row.style.display = 'none';
                                            }
                                        });

                                        // Show or hide the no-results row based on match status
                                        noResultsRow.style.display = matchFound ? 'none' : '';
                                    });
                                </script>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4" style = "margin-bottom: 40px;">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="../index.php">SQL Community Management System</a> , All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Developed By <a href="#">@ Ejie Cabales Florida</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="template/lib/chart/chart.min.js"></script>
    <script src="template/lib/easing/easing.min.js"></script>
    <script src="template/lib/waypoints/waypoints.min.js"></script>
    <script src="template/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="template/lib/tempusdominus/js/moment.min.js"></script>
    <script src="template/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="template/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="template/js/main.js"></script>
</body>

</html>