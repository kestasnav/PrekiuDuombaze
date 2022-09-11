<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
    }
    include("dblogin.php");
    
    
    $error = [];
    if (isset($_POST['action']) && $_POST['action'] == 'insert') { 
      $preke = test_input($_POST["preke"]);
      $kaina = test_input($_POST["kaina"]);
      $kiekis = test_input($_POST["kiekis"]);
      $katerogija = test_input($_POST["kategorija"]);
      $statusas = test_input($_POST["statusas"]);
         
      if(empty($preke)) {
        $error['preke'] = "Prekės pavadinimas privalomas";
      } else {
        if (strlen($preke) < 3) {
            $error['preke'] = "Prekės pavadinimas privalomas";
      }
    }
  

      if(empty($kaina)) {
        $error['kaina'] = "Kaina privaloma";
      }      

      
      if(empty($kiekis)) {
        $kiekis = 0;
        $statusas = 1;
      } 
      if(empty($katerogija)) {
        $katerogija = 'Kita';
      } 
            
   
if(empty($error)){
        $sql="INSERT INTO todolist (preke, kaina, kiekis, kategorija, statusas) VALUES (?, ?, ?, ?, ?)";
        $stm=$pdo->prepare($sql);
        $stm->execute([ $_POST['preke'], $_POST['kaina'], $kiekis, $katerogija, $statusas]);
        header("location:prekiusarasas.php");
        die();
    }
  } 
    
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
                    <div class="card-header">Pridėti naują prekę</div>
                    <div class="card-body">
                        
                        <form action="" method="POST">
                            <input type="hidden" name="action" value="insert"> 
                            <div class="mb-3">
                                <label for="" class="form-label">Prekės pavadinimas</label>
                                <input name="preke" type="text" class="form-control" >
                             
                          
                                <?php if (isset($error['preke'])){ echo'<div class="alert alert-danger w-25 text-center">'. $error['preke'].'</div>';}?>
                                
                        
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Kaina</label>
                                <input name="kaina" type="text" class="form-control" >
                                <?php if (isset($error['kaina'])){ echo'<div class="alert alert-danger w-25 text-center">'. $error['kaina'].'</div>';}?>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Statusas</label>
                                <br>
                                <select name="statusas">
                                <option value="statusas">Pasirinkite statusą</option>
                                <option value='0'>Yra sandėlyje</option>
                                <option value='1'>Nėra sandėlyje</option>     
                                </select>                                
                            </div>
                            <div class="mb-3">
                            <label for="" class="form-label">Kategorija</label>
                                <br>
                                <select name="kategorija">
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
                                <input name="kiekis" type="text" class="form-control"  >
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