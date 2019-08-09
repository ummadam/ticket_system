 <!DOCTYPE html>

<?php
include 'DB.php';
session_start();
if(isset($_REQUEST['action'])) {
    $r = $_REQUEST['action'];
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
          ':un' => $_SESSION['user'],
          ':p' => $_POST['problem']
      ]);
        echo '<span class="badge badge-success">ticket added successfully</span>';
    } else if($r == 'login') {
        $user = $_POST['login'];
        $_SESSION['user'] = $user;
    }
    else if($r == 'ok'){
      echo $_POST['username']. ' : ' . $_POST['text'];
    } else if($r == 'loadChat') {
        $stmt = $pdo->prepare("select * from chats where ticketId = :ticketId");
        $stmt->execute([':ticketId' => $_GET['ticketId']]);
        $chatHistory = $stmt->fetchAll();
        foreach($chatHistory as $h){
            $class = 'chat-in';
            if($h['sender'] == $_SESSION['user']) {
                $class = 'chat-out';
            }
            echo '<div class="'.$class.'">'.$h['body'].'</div>';
        }
        //print_r($chatHistory);
        exit();
    } else if($r == 'chatSubmit') {
        $stmt = $pdo->prepare("insert into chats (ticketId, sender, rcpt, body) values (:ticketId, :sender, :rcpt, :body)");
        $stmt -> execute([
           ':ticketId' => $_POST['ticketId'],
           ':sender' => $_SESSION['user'],
           ':rcpt' => 'admin',
           ':body' => $_POST['text']
        ]);
        exit();
    }
}
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    if($user != 'Admin') {
        $stmt = $pdo->prepare("
            SELECT *  
            FROM `tickets`
            WHERE `username` = :un");

        $stmt->execute([':un' => $user]);
    } else {
        $stmt = $pdo->prepare("
        SELECT *  
        FROM `tickets`");
        $stmt -> execute();
    }

    $tickets = $stmt->fetchALL();
} else {
    $tickets = array();
}
    //print_r($tickets);
?>

 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <title>Ticket System</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script>
         var gTicketId = 0;
       var loadChat = function(ticketId){
         gTicketId = ticketId;
         $('#chatHistory').load('?action=loadChat&ticketId=' + ticketId);
       };

       $(document).ready(function(){
         $("#chat").click(function(){
           $("#form1").toggle();
         });

         $('#chatSubmit').click(function(){
           var t = $('#chatText').val();
           $.post('?action=chatSubmit', {
             text: t,
             ticketId: gTicketId
           },function(){
             loadChat(gTicketId);
             $('#chatText').val('');
           })
         });

       });
     </script>

     <style>
         .chat-in {
             text-align: left;
         }

         .chat-out {
             text-align: right;
         }
     </style>
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

 <table class="table">
     <thead>
     <tr>
         <th scope="col">Id</th>
         <th scope="col">User Name</th>
         <th scope="col">Problem</th>
         <th scope="col">Operation</th>
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
         echo '<input type="button" id="chat" value="startChat" onClick="loadChat('.$ticket['id'].')">';
         echo '</td>';
         echo '<tr>';
     }
     ?>
     </tbody>
 </table>

 <form action="" method="post" id="form" style="display: none">
     <input type="text" name="problem">
     <input type="submit" name="action" value="addTicket">
 </form>

 <div id="chatForm" style="position: fixed; bottom:0px; right: 0px; border: 1px solid #8ac1ff; padding: 3px">
     <div id="chatHistory" style="width: 300px; padding: 3px; border: 1px solid #ccc">
     </div>
     <div id="chatMessage">
         <input type="text" id="chatText"/>
         <input type="button" id="chatSubmit" value="Отправить">
     </div>
 </div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script>
   $(document).ready(function(){
     $("#show").click(function(){
       $("#form").toggle();
     });
   });
 </script>
 <button id="show">new ticket</button>


 </body>
 </html>


<?php
if($user == 'Admin'){
  die(); 
} 
?>