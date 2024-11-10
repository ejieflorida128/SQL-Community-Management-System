<?php
    $conn = mysqli_connect("localhost","root","","sqlcommunity_main");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>