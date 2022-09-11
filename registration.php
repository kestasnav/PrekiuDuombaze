<?php

include ("dblogin.php");

if (isset($_POST['action']) && $_POST['action']=='insert'){
    $user = mysqli_real_escape_string($con, $_POST['usern']);
    $pass = mysqli_real_escape_string($con, $_POST['password']);
   // $pass = md5($pass);
    $pass = password_hash($pass, PASSWORD_BCRYPT);
    $sql = "INSERT INTO login ( user , pass ) VALUES ( ?, ? )";
    $stm=$pdo->prepare($sql);
        $stm->execute([ $user, $pass ]);
        header("location:login.php");
        die();
    }
   
 
  ?>

<!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registracija</title>
   <style>
     .container {
       display: flex;
       flex-direction: column;
       align-items: center;
       max-width: 800px;
       margin: 100px auto;
     }

     body {
       background-color: lightskyblue;
     }

     input {
       margin: 20px;
     }

     form {
       display: flex;
       flex-direction: column;
       align-items: center;
       border: solid black 1px;
       padding: 15px;
       border-radius: 20px;
     }

     button {
       align-self: center;
     }
   </style>

 </head>

 <body>
   <div class="container">
     <h1>Registracijos forma:</h1>
     <form action="" method="post">
       <div>
       <input type="hidden" name="action" value="insert"> 
         <input type="text" name="usern" placeholder="Username" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>"> <br>
         <input type="password" name="password" placeholder="Password"> <br>
       </div>
       <button type="submit" name="submit">Registruotis</button>       
     </form>
    
   </div>
 </body>

 </html>
