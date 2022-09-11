<?php
 include ("dblogin.php");
  if (isset($_POST['action']) && $_POST['action']=='update'){
    $kiekis = $_POST["kiekis"];
    $statusas = $_POST["statusas"];  
    if(empty($kiekis)) {
        $kiekis = 0;
        $statusas = 1;
      }
    $sql="UPDATE todolist SET preke=?, kaina=?, kiekis=?, kategorija=?, statusas=? WHERE id=?";
    $stm=$pdo->prepare($sql);
    $stm->execute([ $_POST['preke'], $_POST['kaina'],$kiekis, $_POST['kategorija'], $statusas, $_POST['id']]);
    header("location:prekiusarasas.php");
    die();
 
  }
  $preke=[];
  if (isset($_GET['id'])){
    $sql="SELECT * FROM todolist WHERE id=?";
    $stm=$pdo->prepare($sql);
    $stm->execute([$_GET['id']]);
    $preke=$stm->fetch(PDO::FETCH_ASSOC);
  }else{
    header("location:prekiusarasas.php");
    die();
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naujos prekės įvedimas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5 mb-5">
                    <div class="card-header">Redaguoti prekę</div>
                    <div class="card-body">
                        
                        <form action="" method="POST">
                        <input type="hidden" name="action" value="update"> 
                            <input type="hidden" name="id" value="<?=$preke['id']?>" >
                            <div class="mb-3">
                                <label for="" class="form-label">Prekės pavadinimas</label>
                                <input name="preke" type="text" class="form-control" value="<?=$preke['preke']?>">                             
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Kaina</label>
                                <input name="kaina" type="text" class="form-control" value="<?=$preke['kaina']?>">                               
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Statusas</label>
                                <br>
                                <select name="statusas" value="<?=$preke['statusas']?>">
                                <option value="statusas">Pasirinkite statusą</option>
                                <option value='0'>Yra sandėlyje</option>
                                <option value='1'>Nėra sandėlyje</option>     
                                </select>                                
                            </div>
                            <div class="mb-3">
                            <label for="" class="form-label">Kategorija</label>
                                <br>
                                <select name="kategorija" value="<?=$preke['kategorija']?>">
                                <option value="kategorija">Pasirinkite kategoriją</option>
                                <option value="Duonos gaminiai">Duonos gaminiai</option>
                                <option value="Pieno produktai">Pieno produktai</option>
                                <option value="Greitai Gendantys">Greitai Gendantys</option>
                                <option value="Daržovės">Daržovės</option>  
                                <option value="Vaisiai">Vaisiai</option>
                                <option value="Kita">Kita</option>       
                                </select>        
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Kiekis</label>
                                <input name="kiekis" type="text" class="form-control" value="<?=$preke['kiekis']?>" >
                            </div>
                           
                            <button class="btn btn-success">Pridėti</button>
                            <a href="prekiusarasas.php" class="btn btn-info float-end">Atgal</a>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>