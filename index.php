<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Ticket System</title>
</head>
<body>
    <div class="container">
       <form action="" method="POST">
        <input type="hidden" name="action" value="login"><br>
        <input type="submit" name="login" value="Admin"><br>
        <input type="submit" name="login" value="baukaman"><br>
        <input type="submit" name="login" value="diko"><br>
       </form>
    </div>
</body>
</html>
<?php

include 'DB.php';
session_start();

if(isset($_POST['action'])) {
    $r = $_POST['action'];

    if($r == 'addTicket') {
        echo '<span class="badge badge-success">ticket added successfully</span>';
    } else if($r == 'login') {
        $user = $_POST['login'];
        $_SESSION['user'] = $user;
    }
}


if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];

    $stmt = $pdo->prepare("
        SELECT *  
        FROM `tickets`
        LEFT JOIN `users`
        ON `tickets`.`id_user`=`users`.`id`
        WHERE `users`.`name` = :un;
    
");

    $stmt->execute([
        ':un' => $user
    ]);
    $tickets = $stmt->fetchALL();
} else {
    $tickets = array();
}
    //print_r($tickets);
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">From</th>
      <th scope="col">To</th>
      <th scope="col">Problem</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($tickets as $ticket){
        echo '<tr>';
        echo '<td>';
        echo $ticket['fromuser'];
        echo '</td>';
        echo '<td>';
        echo $ticket['touser'];
        echo '</td>';
        echo '<td>';
        echo $ticket['problem'];
        echo '</td>';
        echo '<tr>';

    }
    ?>
  </tbody>
</table>
<?php
//if($_POST['user'] != 'Admin'){
  
  
//}

?>
<form action="" method="post" id="form" style="display: none">
    <input type="text" name="name">
    <input type="text" name="touser" >
    <input type="text" name="fromuser">
    <input type="text" name="problem">
    <input type="submit" name="action" value="addTicket">
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#show").click(function(){
    $("#form").toggle();
  });
});
</script>
<button id="show">new ticket</button>






