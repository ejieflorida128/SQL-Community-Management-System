<?php
         include("../../connection/conn.php");

         $id = $_GET['id'];

         $update = "UPDATE sqlcommunity_main.user_account SET status = 'Approve' WHERE id = $id";
         mysqli_query($conn,$update);

         header("Location: ../approve_user.php");
?>