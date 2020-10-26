<?php
    require_once "pdo.php";
    session_start();

    if(isset($_POST['cancel'])){
        header("Location:view.php");
        return;
    }

    if(empty($_REQUEST['user_id'])){
        $_SESSION['error']="Missing user_id";
        header('Location:view.php');
        return;
    }else{

        $stmt=$pdo->prepare("SELECT make,autos_id FROM autos WHERE autos_id = :xyz;");
        $stmt->execute(array(":xyz"=>$_GET['user_id']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row===false) {
        $_SESSION['error'] = 'Bad value for user_id';
        header( 'Location: view.php' ) ;
        return;
    }

        if(isset($_POST['delete'])){
            $sql="DELETE FROM autos WHERE autos_id= :abc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(':abc'=>$_POST['user_id']));
            $_SESSION['success']="Record deleted";
            header('Location:view.php');
            return;
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
    <p>Confirm: Deleting <?= $row['make'] ?> </p>
    <form method="POST">
        <input type="hidden" name="user_id" value="<?=$_GET['user_id']?>">
        <input type="submit" name="delete" value="Delete">
        <input type="submit" name="cancel" value="Cancel">
    </form>
</body>
</html>
