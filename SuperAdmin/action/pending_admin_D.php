<?php
         include("../../connection/conn.php");

         $id = $_GET['id'];

         $delete = "DELETE FROM sqlcommunity_main.admin_account WHERE id = $id";
         mysqli_query($conn,$delete);

         header("Location: ../pending_admin.php");
?>