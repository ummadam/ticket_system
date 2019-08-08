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
        <input type="submit" name="login" value="User1"><br>
        <input type="submit" name="login" value="User2"><br>
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
      $stmt = $pdo->prepare("
        INSERT INTO 
            `tickets` (
                `username`,
                `problem`
            ) VALUES(
                :un,
                :p            
                )
    ");

      $stmt->execute([
          ':un' => $_POST['username'],
          ':p' => $_POST['problem']
      ]);
        echo '<span class="badge badge-success">ticket added successfully</span>';
    } else if($r == 'login') {
        $user = $_POST['login'];
        $_SESSION['user'] = $user;
    }
    else if($r == 'ok'){
      echo $_POST['username']. ' : ' . $_POST['text'];
    }
}
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    $stmt = $pdo->prepare("
        SELECT *  
        FROM `tickets`
        WHERE `username` = :un;
    
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
      <th scope="col">Id</th>
      <th scope="col">User Name</th>
      <th scope="col">Problem</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($tickets as $ticket){
        echo '<tr>';
        echo '<td>';
        echo $ticket['id'];
        echo '</td>';
        echo '<td>';
        echo $ticket['username'];
        echo '</td>';
        echo '<td>';
        echo $ticket['problem'];
        echo '</td>';
        echo '<td>';
        echo '<input type="submit" id="chat" value="startChat">';
        echo '</td>';
        echo '<td>';
       ?>
        <form action="" method="post" id="form1" style="display: none">
            <input type="text" name="username">
            <input type="text" name="text">
            <input type="submit" name="action" value="ok">
        </form>

       <?php
        echo '</td>';
        echo '<tr>';
    }
    ?>
  </tbody>
</table>
<?php
if($user == 'Admin'){
  die(); 
} 
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#chat").click(function(){
    $("#form1").toggle();
  });
});
</script>
<form action="" method="post" id="form" style="display: none">
    <input type="text" name="username">
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
