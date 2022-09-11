<?php

include("dblogin.php");

$prekes = (isset($_POST['prekes'])) ? $_POST['prekes'] : array();

$krepselis = [];

foreach ($prekes as $preke) {

    $prekiusarasas = "SELECT * FROM todolist WHERE id=$preke";
    $result = $pdo->query($prekiusarasas);
    $preke = $result->fetchAll(PDO::FETCH_ASSOC);
 

    /* print_r($preke);
echo '<br>'; */

    $krepselis[] = $preke[0];
}

/* print_r($krepselis);
echo '<br>';  */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prekių krepšelis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header"><b>Prekių sąrašas</b></div>
                    <div class="card-body">
                        <table class="table">
                            <h4>Pasirinktos prekės</h4>
                            <thead>
                                <tr class="bg bg-info text-center">

                                    <th>Prekės pavadinimas</th>
                                    <th>Prekės kaina</th>
                                    <th>Prekės kiekis sandėlyje</th>
                                    <th>Pasirinkite prekių kiekį</th>
                                    <th>Pasirinktų prekių kaina</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="" method="POST">
                               
                                    <?php


                                    foreach ($krepselis as $krepsiukas) {
                                   //     $krepselioKaina = $krepsiukas["kiekis"]*$krepsiukas["kaina"];
                                        
                                    ?>
                                     <input type="hidden" name="action" value="update"> 
                            <input type="hidden" name="id" value="<?=$krepsiukas['id']?>" >
                                        <tr class="text-center align-middle ">
                                            <td><?= $krepsiukas['preke'] ?></td>
                                            <td id="kainaKrep"><?= $krepsiukas['kaina'] ?> EU</td>
                                            <td><?= $krepsiukas['kiekis'] ?></td>
                                            <td class="d-flex justify-content-center"><input type='number' id="krepsys" name='krepselioID' value="1" class="text-center form-control w-25"></td>
                                            <td><?php
                                                echo'<h4 id="isvedimas"></h4>';
                                               // echo $krepselioKaina;                                             
                                                ?>
                                            </td>
                                            
                                        </tr>

                                    <?php }  ?>




                            </tbody>
                                                
                        </table>
                        
                        <button class="btn btn-success">Patvirtinti krepšelį</button>
                        <div onclick="perskaiciuot()" class="btn btn-info float-end mt-5">Perskaičiuoti</div>
                        </form>
                        <a href="prekiusarasas.php" class="btn btn-info float-end">Atgal į prekių sąrašą</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
       
        function perskaiciuot() {
            let bendraKaina = 0;
           let kainele = document.querySelector('#krepsys');
          let kainuke = kainele.value;
           let kaina =  document.querySelector('#kainaKrep');
           let kainelyte = parseInt(kaina.textContent);
           let isvedimas = document.querySelector('#isvedimas');
           bendraKaina = kainuke * kainelyte;
          isvedimas.innerHTML = bendraKaina + ' EU';
   }
    </script>
</body>

</html>