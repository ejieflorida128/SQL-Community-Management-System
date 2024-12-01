<?php
include('../connection/conn.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $mail = new PHPMailer(true);

            $gmailTry = $_POST['gmail'];
            
            $sqlCHeck = "SELECT * FROM sqlcommunity_main.user_account WHERE gmail = ?";
            $stmt = $conn->prepare($sqlCHeck);
            $stmt->bind_param("s", $gmailTry);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();

                                        $mail->isSMTP();
                                        $mail->Host = 'smtp.gmail.com';
                                        $mail->SMTPAuth = true;
                                        $mail->Username = 'sqlcommunitymanagementsystem@gmail.com';
                                        $mail->Password = 'dpsg metu wuwf jsnr';
                                        $mail->SMTPSecure = 'ssl';
                                        $mail->Port = 465;
                        
                        
                                        $mail->setFrom('sqlcommunitymanagementsystem@gmail.com');
                                        $mail->addAddress($_POST['gmail']);
                        
                                        $mail->isHTML(true);
                        
                                      
                                                        $productName = $row['gmail'];
                                                        $userName = $row['fullname'];
                                                        $operatingSystem = 'Windows';
                                                        $browserName = 'Google Chrome';
                                                        $actionUrl = 'http://localhost/xampp/SQL-Community-Management-System/forgot_password/reset-password.php?id='.$row['id'];
                                                        $companyName = "Sql Community Management System";
                                                     

                                                     
                                                        $mail->Subject = "Password Reset Request for $productName";
                                                        $mail->Body = "
                                                     
                                                        Hi $userName, <br><br>

                                                        You recently requested to reset your password for your $productName account.<br>
                                                        <br>Reset your password: <a href='$actionUrl'>$actionUrl</a>

                                                        <br><br>For security, this request was received from a $operatingSystem device using $browserName. <br><br>If you did not request a password reset, please ignore this email or contact support if you have questions.<br><br>

                                                        Thanks,<br>
                                                        The $companyName Team<br><br>

                                                       

                                                        © 2019 $companyName. All rights reserved.<br>

                                                  
                                                   
                                                        ";

                                                 
                                                        $mail->isHTML(true);
                        
                                                        $mail->send();
                        
                        
                                        echo "
                                        
                                                <script>alert('Sent Successfully');
                                                document.location.href = 'index.php';
                                                </script>
                                        
                                        ";
    
            } else {
                
            }


          

    }

?>