<?php 
    session_start();
    
    date_default_timezone_set("Asia/Dhaka");

    if(isset($_POST['cancel'])){
        header("Location:index.php");
        exit;
    }

    if(isset($_POST['email']) && isset($_POST['pass'])){
        $email=htmlspecialchars($_POST['email']);
        $pass =htmlspecialchars($_POST['pass']);

        if(empty($email)){
            $_SESSION['error']="Email and password are required";
            header('Location:login.php');
            return;
        }else{
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Email must have an at-sign (@)";
                header("Location:login.php");
                return;
            }
        }
        
        if(empty($pass)){
            $_SESSION['error']="Email and password are required";
            header('Location:login.php');
            return;
        }else{
            $salt = "BuuleThePro";
            $stored_hash = "5e69069fe4103aad1935dd5ab777c316";
            $check_pass =hash("md5",$salt.$pass);
            if($check_pass == $stored_hash){
                $_SESSION['name']=$_POST['email'];
                error_log("Login success ".$email);
                header("Location:view.php");
                return;
            }else{
                $_SESSION['error']="Wrong password";
                error_log("Login failed ".$email." ".$check_pass);
                header('Location:login.php');
                return;
                
            }
        }

    }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>18444c8a</title>
</head>
<body>
    <?php
        if ( isset($_SESSION['error']) ) {
            echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>");
            unset($_SESSION['error']);
        }else{
            echo "";
        }
        
    ?>

    <h1>Please Log In </h1>
    <form method="POST">
        <label for="email">Enter your email :</label></br>
        <input type="text" name="email"><p></p>
        <label for="pass">Enter your password :</label></br>
        <input type="password" name="pass"><p></p>
        <input type="submit" value="Log In">
        <input type="submit" value="Cancel" name="cancel">
    
    </form>
</body>
</html>


