<?php



session_start(); 
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION);
    
  }
if (!isset($_SESSION['user']))
{    
    $message = 'Neprisijungęs vartotojas';
    $link    = 'login.php'; 
    $link2   = 'registration.php';   
    $btn     = 'Prisijungti';
    $btn2    = 'Registruotis';
    $style   = 'btn-success';
    $style2  = 'btn-primary';
}
else{
    
    $message = 'Prisijungęs vartotojas: <b>'.$_SESSION['user'].'</b>';   
    $link    = "prekiusarasas.php?logout=1";    
    $btn     = 'Atsijungti';
    $style   = 'btn-danger';
}


include("dblogin.php"); 

if (isset($_GET['action']) && $_GET['action']=='delete'){
    $sql="SELECT * FROM todolist WHERE id=?";
    $stm=$pdo->prepare($sql);
    $stm->execute([$_GET['id']]);
    $todolist=$stm->fetch(PDO::FETCH_ASSOC);

    $sql="DELETE FROM todolist WHERE id=?";
    $pstm=$pdo->prepare($sql);
    $pstm->execute([$_GET['id']]);
}

$prekiusarasas="SELECT * FROM todolist";
$result=$pdo->query($prekiusarasas);
$prekes=$result->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prekių sąrašas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>
<body>
<div class="container mt-2 d-flex justify-content-center">
        
        <span class="bg bg-secondary text-white px-2 py-2 mx-2"><?=$message?></span>
        <span> <b></b><a class='btn <?=$style?> mx-2' href=<?=$link?>><?=$btn?></a></span>
        <?php if (!isset($_SESSION['user'])) { ?>

<span> <b></b><a class='btn <?=$style2?> mx-2' href=<?=$link2?>><?=$btn2?></a></span>
<?php } ?>
        </div>

<div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5 mb-5">
                    <div class="card-header"><b>Prekių sąrašas</b></div>
                    <div class="card-body">
                    <?php   if (!isset($_SESSION['user']))
                                                {   echo ''; 
                                                } else { ?>
                    <a href="create.php" class="btn  btn-primary float-end mb-3">Pridėti naują prekę</a>
                    <?php } ?>
                    <form action="preke.php" method="POST">
                        <table class="table">
                            <thead>
                                <tr class="bg bg-info">
                                <th>Prekė</th>
                                <th>Kaina</th>
                                <th>Kiekis</th>
                                <th>Kategorija</th>
                                <th>Būsena</th>
                                <th></th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($prekes as $preke){ 
                                     $prekele = $preke["krepselio_kiekis"];
                                    ?>
                                   
                                <tr class="bg bg-light">
                                    <td><?=$preke['preke']?></td>
                                    <td><?=$preke['kaina']?></td>
                                    <td><?=$preke['kiekis']?></td>
                                    <td><?=$preke['kategorija']?></td>
                                    <td>
                                        <?php 
                                        
                                            if (  $preke['statusas'] == 0 ) {
                                            echo '<span class="bg bg-success text-white px-1 py-1">Yra sandėlyje</span>';                                         
                                        } else {
                                            echo '<span class="bg bg-danger text-white px-1 py-1">Išparduota</span>'; 
                                        }
                                        
                                            ?>
                                    </td>
                                    <td><input type="checkbox" id="scales" name="prekes[]" value=<?=$preke['id']?>  <?=($preke['statusas'] == 1) ? 'disabled' : ''?> >
                                    <label for="prekes"><?=($preke['statusas'] == 1) ? '' : '<input class="w-25" type="number" name="krepselioKiekis" value="0"><span class="mx-1 bg bg-warning">'?><?=($preke['statusas'] == 1) ? '' : 'Įdėti į krepšelį'?> </span></label>
                                    </td>
                                    <td>
                                 <?php   if (!isset($_SESSION['user']) )
                                                {   echo ''; 
                                                } else { ?>
                                      <a href="update.php?id=<?=$preke['id']?>" class="btn btn-info">Redaguoti</a>
                                        <a href="prekiusarasas.php?action=delete&id=<?=$preke['id']?>" class="btn btn-danger">Ištrinti</a>                                         <?php      } ?>
                                    </td>
                                </tr>
                               
                                        
                                
                                <?php } ?>
                            </tbody>
                        </table>
                        <a href="preke.php" class="btn btn-secondary float-end mx-5">Peržiūrėti krepšelį</a>
                        <button name="krepselisbutton" class="btn btn-success float-end mx-5">Patvirtinti krepšelį</button>
                        
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    
</body>
</html>