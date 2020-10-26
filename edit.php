<?php
    require_once "pdo.php";
    session_start();

   

    if(empty($_GET['user_id'])){
        $_SESSION['error']="Bad value for id";
        header('Location:view.php');
        return;
    }

    if(isset($_POST['cancel'])){
        header('Location:view.php');
        return;
    } 

    

   if(isset($_POST['save'])){   

    $make=htmlspecialchars($_POST['make']);
    $model=htmlspecialchars($_POST['model']);
    $year=htmlspecialchars($_POST['year']);
    $mileage=htmlspecialchars($_POST['mileage']);
           
    if(empty($make) || empty($model) || empty($year) || empty($mileage)){
        $_SESSION['error']="All fields are required";
        header('Location: edit.php?user_id='.$_GET['user_id']);
        return;

    }else{
             $year=is_numeric($year) ? $year : -1;
            $mileage=is_numeric($mileage) ? $mileage : -1;
            if($mileage===-1){
            $_SESSION['error']="Mileage must be numeric";
            header('Location: edit.php?user_id='.$_GET['user_id']);
            return;
            }else if($year===-1){
                $_SESSION['error']="Year must be numeric";
                header('Location: edit.php?user_id='.$_GET['user_id']);
                return;
            }
        }
    }

        $sq = "SELECT * FROM autos WHERE autos_id=:xyz";
        $stmt=$pdo->prepare($sq);
        $stmt->execute(array(':xyz'=>$_GET['user_id']));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $make=htmlentities($row['make']);
        $model=htmlentities($row['model']);
        $year=htmlentities($row['year']);
        $mileage=htmlentities($row['mileage']);

        // update qwery
    if(isset($_POST['save'])){

    
        $sql="UPDATE autos SET make=:make,model=:model,
              year=:year,mileage=:mileage 
              WHERE autos_id=:abc;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':make'=>$_POST['make'],
            ':model'=>$_POST['model'],
            ':year'=>$_POST['year'],
            ':mileage'=>$_POST['mileage'],
            ':abc'=>$_GET['user_id']
        ));
        $_SESSION['success']="Record updated";
        header('Location: view.php ');
        return;
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
    <h1>Editing automobile</h1>
    <?php
        if ( isset($_SESSION['error']) ) {
            echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>");
            unset($_SESSION['error']);
        }else{
            echo "";
        }
    ?>
    <form method="POST">
        <input type="hidden" value="<?=$_GET['user_id']?>">
        <label for="make">Make</label><br>
        <input type="text" name="make" value="<?=$make?>"><p></p>
        <label for="model">Model</label><br>
        <input type="text" name="model" value="<?=$model?>"><p></p>
        <label for="year">Year</label><br>
        <input type="text" name="year" value="<?=$year?>"><p></p>
        <label for="mileage">Mileage</label><br>
        <input type="text" name="mileage" value="<?=$mileage?>"><p></p>
        <input type="submit" value="Save" name="save">
        <input type="submit" value="Cancel" name="cancel">
    </form>
</body>
</html>