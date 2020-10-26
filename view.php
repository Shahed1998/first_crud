<?php
    require_once "pdo.php";
    session_start();
    

    if(! isset($_SESSION['name'])){
        die('Not logged in.');
    }else{
        $name = $_SESSION['name'];
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
    <h1>Tracking Autos for <?=$name?></h1><p></p>
    <?php
        if ( isset($_SESSION['success']) ) {
            echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
            unset($_SESSION['success']);
        }
         if ( isset($_SESSION['error']) ) {
            echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
            unset($_SESSION['error']);
        }
    ?>
    <h1>Automobiles</h1>
    <!--output-->
    <?php 
            echo('<table border="1">'."</br>");
            echo ('<tr><th>');
                echo('Make');
                echo('</th><th>');
                echo('Model');
                echo('</th><th>');
                echo('Year');
                echo('</th><th>');
                echo('Mileage');
                echo('</th><th>');
                echo('Action');
                echo('</th></tr>');
                
            $stmt = $pdo->query("SELECT autos_id,make,model,year, mileage FROM autos");
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                echo ('<tr><td>');
                echo(htmlentities($row['year']));
                echo('</td><td>');
                echo($row['model']);
                echo('</td><td>');
                echo($row['make']);
                echo('</td><td>');
                echo($row['mileage']);
                echo('</td><td>');
                echo ('<a href="edit.php?user_id='.$row['autos_id'].'">Edit</a>/');
                echo ('<a href="delete.php?user_id='.$row['autos_id'].'">Delete</a>');
                echo('</td></tr>');
                
            }
            echo('</table>');
    
?>
    
    <p></p><a href="add.php">Add New Entry</a>
    <p></p><a href="logout.php">Logout</a>

    
</body>
</html>
