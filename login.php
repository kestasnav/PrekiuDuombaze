<?php

include ("dblogin.php");

if (isset($_POST['user'])) {
  setcookie('username',$_POST['user'], time()+60*60*24);
}

  session_start();
  $error = '';
 
  if (isset($_POST['submit'])) {
    
    $user = mysqli_real_escape_string($con, $_POST['usern']);
    $pass = mysqli_real_escape_string($con, $_POST['password']);
   // $pass = md5($pass);   
    $passHash  = password_hash($pass, PASSWORD_BCRYPT); 
   
    if (empty($user && $pass)){
     $error = 'Vartotojo vardas ir slaptažodis yra privalomas';
  }
  else{
    $sql = "SELECT * FROM login WHERE user = '$user' ";
    $result = mysqli_query($con, $sql);      
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $passHash = isset($row['pass']) ? $row['pass'] : false;
    $count = password_verify($pass, $passHash);  
   // if (password_verify($pass, $passHash)) {
   if ($count === true){
        $_SESSION['user']=$user;       
        header('location:prekiusarasas.php'); 
        die();     
    }
    else{
       $error = 'Neteisingas vartotojo vardas arba slaptažodis'; 
    }
}
} 
mysqli_close($con);		

  ?>

<!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Prisijungimas</title>
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
     <h1>Prisijungimo forma:</h1>
     <form action="" method="post">
       <div>
         <input type="text" name="usern" placeholder="Username" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>"> <br>
         <input type="password" name="password" placeholder="Password"> <br>
       </div>
       <button type="submit" name="submit">Prisijungti</button>       
     </form>
     <h1><?=$error?></h1>
   </div>
 </body>

 </html>
