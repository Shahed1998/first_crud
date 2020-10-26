<!-- Model -->
<?php 
    require_once "pdo.php";
    date_default_timezone_set("Asia/Dhaka");
    session_start();

    

    if(!isset($_SESSION['name'])){
        die('Not logged in.');
    }else{
        $email = $_SESSION['name'];
    }
    
    if(isset($_POST['cancel'])){
        header('Location: view.php');
        error_log('return to view.php successful '.$email);
    }

    if(isset($_POST['add'])){
        $make=$_POST['make'];
        $model=$_POST['model'];
        $year = is_numeric($_POST['year']);
        $mileage = is_numeric($_POST['mileage']);


        if(empty($make) || empty($model)){
            $_SESSION['error']="Make and model are required";
            header("Location:add.php");
            return;
        }else if(empty($year) || empty($mileage)){
             $_SESSION['error']="Mileage and year must be numeric";
            header("Location:add.php");
            return;
        }

        

        if($_POST['make'] && $_POST['model'] && $year==1 && $mileage==1){

            $stmt = $pdo->prepare('INSERT INTO autos
            (make, model , year, mileage) VALUES ( :mk,:md, :yr, :mi)');
            $stmt->execute(array(
            ':mk' => htmlentities($_POST['make']),
            ':md' => htmlentities($_POST['model']),
            ':yr' => htmlentities($_POST['year']),
            ':mi' => htmlentities($_POST['mileage']))
            );
            
            $_SESSION['success']="Record added.";
            header("Location:view.php");
            return;

        }

        
    }
        
?>
<!--View-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>18444c8a</title>
    
</head>
<body>
    <h1>Tracking Autos for <?= $email ?></h1>
    <?php 
         if ( isset($_SESSION['error']) ) {
            echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>");
            unset($_SESSION['error']);
        }else{
            echo "";
        }

        
    ?>

    <form method="POST">
        <label for="make">Make : </label></br>
        <input type="text" name='make'><p></p>
        <label for="model">Model : </label></br>
        <input type="text" name='model'><p></p>
        <label for="year">Year : </label></br>
        <input type="text" name="year"><p></p>
        <label for="mileage">Mileage : </label><br>
        <input type="text" name="mileage"><p></p>
        <input type="submit" value="Add" name="add">
        <input type="submit" value="Cancel" name="cancel"><br>
    </form><p></p>
    <!--php output must be inside the html-->

</body>
</html>



