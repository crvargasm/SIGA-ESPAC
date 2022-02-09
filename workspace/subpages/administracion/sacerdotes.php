<?php require '../../partials/verifySession.php';
if(empty($_GET)) {
  header('Location: index.php');
} elseif ($_GET['a!¡v02ds3ass334de$?!!']!=1) {
  header('Location: index.php');
}
$ID = $_GET['p$b423scer34432yi$unj1232asds34da34shs!???'];    //ID Parroquia
$ver= $_GET['a!¡v02ds3ass334de$?!!'];   //Verificador Unico de Privacidad IntraWEB
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Sistema Integral de Gestión Académica</title>
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="../../images/SIGA.ico">
  <link rel="stylesheet" href="../../assets/css/stylePage.css">
</head>
<body>
  <div id="auxPage">
    <div class="headerAux">
      <div class="textname"><p>SISTEMA INTEGRAL DE GESTIÓN ACADÉMICA</p></div>
      <div class="separator"></div>
      <img src="../../images/SIGA.ico" alt="sigaEspac.ico">
    </div>
    <div id="editForm">
      <?php require '../../database.php';
      $result = $conn->query("SELECT * FROM parroco WHERE idParroco=$ID;");
      $numfilas = $result->num_rows;
      $aux = $result->fetch_object();
      mysqli_close($conn);

      require '../../database.php';
      $result = $conn->query("SELECT * FROM parrocoxperiodo WHERE Parroco_idParroco=$ID;");
      $numfilapa = $result->num_rows;

      if ($numfilapa > 0) {
        $aux1 = $result->fetch_object();
        mysqli_close($conn);

        require '../../database.php';
        $result = $conn->query("SELECT * FROM parroquia WHERE idParroquia=$aux1->Parroquia_idParroquia;");
        $numfilas = $result->num_rows;
        $aux2 = $result->fetch_object();
        mysqli_close($conn);
      }

      ?>
      <h4>Bienvenido al Asistente para la Actualización de Datos</h4>
      <span>Modifique los datos necesarios y presione 'Guardar Cambios', de lo contrario 'Cancelar':</span>
      <form action="sacerdotes.php?p$b423scer34432yi$unj1232asds34da34shs!???=<?php echo $ID; ?>&a!¡v02ds3ass334de$?!!=<?php echo $ver;?>" method="POST">
        <div class="fila">
          <span>Primer Nombre Sacerdote:</span>
          <input type="text" tabindex="1" name="nom1" value="<?php echo $aux->nombreParroco;?>">
          <span>Primer Apellido Sacerdote:</span>
          <input type="text" tabindex="3" name="ape1" value="<?php echo $aux->apellidoParroco;?>">
          <span>Autoridad Eclesial:</span>
          <select id="lista1" tabindex="5" name="autoridad">
            <option selected value="<?php echo $aux->autoridad;?>"><?php echo $aux->autoridad;?></option>
            <?php
              require '../../database.php';
              $resultado = $conn->query("SELECT * FROM autoridad ORDER BY tipoAutoridad");
              $numerofilas = $resultado->num_rows;
              for ($ir=0; $ir<$numerofilas; $ir++) {
                $auxilio = $resultado->fetch_object();
                echo '<option value="'.$auxilio->tipoAutoridad.'">'.$auxilio->tipoAutoridad.'</option>';
              }
              mysqli_close($conn);
            ?>
          </select>
        </div>
        <div class="fila">
          <span>Segundo Nombre Sacerdote:</span>
          <input type="text" tabindex="2" name="nom2" value="<?php echo $aux->nombre2Parroco;?>">
          <span>Segundo Apellido Sacerdote:</span>
          <input type="text" tabindex="4" name="ape2" value="<?php echo $aux->apellido2Parroco;?>">
          <span>Parroquia Asignada:</span>
    			<select id="lista1" tabindex="6" name="parroquia">

            <?php if ($numfilapa > 0) { ?>
                   <option selected value='<?php echo $aux2->idParroquia;?>'><?php echo $aux2->nombreParroquia;?></option>
            <?php } else { ?>
                   <option disabled selected value=''>Seleccione la Parroquia:</option>
            <?php } ?>

    				<?php
    					require '../../database.php';
    					$resultado = $conn->query("SELECT idParroquia, nombreParroquia FROM parroquia");
    					$numerofilas = $resultado->num_rows;
    					for ($ir=0; $ir<$numerofilas; $ir++) {
    						$auxilio = $resultado->fetch_object();
    						echo '<option value="'.$auxilio->idParroquia.'">'.$auxilio->nombreParroquia.'</option>';
    					}
    					mysqli_close($conn);
    				?>
    			</select>
        </div>
        <input type="button" name="rst" onclick="window.close()" value="Cancelar">
        <?php
        $estado=$aux->estadoParroco;
          if ($estado == 1) {
            ?><input type="submit" name="disable" value="Deshabilitar Sacerdote"><?php
          } elseif ($estado == 0) {
            ?><input type="submit" name="able" value="Habilitar Sacerdote"><?php
          }
        ?>
        <input type="submit" name="send" value="Guardar Cambios">
      </form>

      <?php
        //print_r($_POST);
        try {
          $disable=$_POST['disable'];
        } catch (\Exception $e) {}
        try {
          $able=$_POST['able'];
        } catch (\Exception $e) {}
        $send=$_POST['send'];
        $nom1=$_POST['nom1'];
        $nom2=$_POST['nom2'];
        $ape1=$_POST['ape1'];
        $ape2=$_POST['ape2'];
        $auto=$_POST['autoridad'];
        $parr=$_POST['parroquia'];
        if ($send && !empty($auto) && !empty($nom1) && !empty($ape1)) {
          require '../../database.php';
          $result = $conn->query("UPDATE parroco SET nombreParroco='$nom1', nombre2Parroco='$nom2', apellidoParroco='$ape1', apellido2Parroco='$ape2', autoridad='$auto' WHERE idParroco=$ID;");
          mysqli_close($conn);

          require '../../database.php';
          $resultado = $conn->query("SELECT idParroquia FROM infoParroquias WHERE idParroco=$ID;");
          $auxilio = $resultado->fetch_object();
          mysqli_close($conn);

          if ($auxilio->idParroquia != $parr) {
            require '../../partials/timestamp.php';
            require '../../database.php';
            $result = $conn->query("INSERT INTO parrocoxperiodo (Parroco_idParroco, Parroquia_idParroquia, yearParroco, semestreParroco)
                                    VALUES ($ID, $parr, $year, '$semestre');");
            mysqli_close($conn);
          }

          echo '<script type="text/javascript">window.close();</script>';
        } elseif ($send) {
          echo '<script type="text/javascript">window.alert("POR FAVOR INGRESE TODOS LOS CAMPOS");</script>';
        }
        mysqli_close();

        //Habilitar o Deshabilitar Sacerdote
        require '../../database.php';
        if ($estado == 1 && $disable) {          //Inhabilitar
          $resulta = $conn->query("UPDATE parroco
                                  SET estadoParroco='0'
                                  WHERE idParroco=$ID;");
          echo '<script type="text/javascript">window.close();</script>';
        } elseif ($estado == 0 && $able) {       //Habilitar
          $resulta = $conn->query("UPDATE parroco
                                  SET estadoParroco='1'
                                  WHERE idParroco=$ID;");
         echo '<script type="text/javascript">window.close();</script>';
        }
        mysqli_close($conn);
      ?>
    </div>
  </div>
</body>
</html>
