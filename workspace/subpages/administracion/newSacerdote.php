<?php require '../../partials/verifySession.php';
if(empty($_GET)) {
  header('Location: ../index.php');
} elseif ($_GET['a!¡v02ds3ass334de$?!!']!=1) {
  header('Location: ../index.php');
}
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
      <h4>Bienvenido al Asistente para la Inserción de Datos</h4>
      <span>Inserte los datos necesarios y presione 'Guardar Cambios', de lo contrario 'Cancelar':</span>
      <form action="newSacerdote.php?a!¡v02ds3ass334de$?!!=<?php echo $ver;?>" method="POST">
        <div class="fila">
          <span>Primer Nombre Sacerdote:</span>
          <input type="text" tabindex="1" name="nom1" value="">
          <span>Primer Apellido Sacerdote:</span>
          <input type="text" tabindex="3" name="ape1" value="">
          <span>Autoridad Eclesial:</span>
          <select id="lista1" tabindex="5" name="autoridad">
            <option disabled selected value="">Seleccione la Autoridad:</option>
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
          <input type="text" tabindex="2" name="nom2" value="">
          <span>Segundo Apellido Sacerdote:</span>
          <input type="text" tabindex="4" name="ape2" value="">
          <span>Parroquia Asignada:</span>
    			<select id="lista1" tabindex="6" name="parroquia">
    				<option disabled selected value=0>Seleccione la Parroquia:</option>
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
        <input type="submit" name="send" value="Guardar Cambios">
      </form>

      <?php
        //print_r($_POST);
        $send=$_POST['send'];
        $nom1=$_POST['nom1'];
        $nom2=$_POST['nom2'];
        $ape1=$_POST['ape1'];
        $ape2=$_POST['ape2'];
        $auto=$_POST['autoridad'];
        $parr=$_POST['parroquia'];
        if ($send && !empty($auto) && !empty($nom1) && !empty($ape1)) {
          require '../../database.php';
          $result = $conn->query("INSERT INTO parroco (nombreParroco, nombre2Parroco, apellidoParroco, apellido2Parroco, autoridad, estadoParroco)
                                  VALUES ('$nom1', '$nom2', '$ape1', '$ape2', '$auto', '1');");
          mysqli_close($conn);

          if (!empty($parr)) {
            require '../../database.php';
            $resultado = $conn->query("SELECT * FROM parroco WHERE idParroco= (SELECT max(idParroco) FROM parroco);");
            $auxilio = $resultado->fetch_object();
            mysqli_close($conn);

            require '../../partials/timestamp.php';
            require '../../database.php';
            $result = $conn->query("INSERT INTO parrocoxperiodo (Parroco_idParroco, Parroquia_idParroquia, yearParroco, semestreParroco)
                                    VALUES ($auxilio->idParroco, $parr, $year, '$semestre');");
            mysqli_close($conn);
          }
          echo '<script type="text/javascript">window.close();</script>';
        } elseif ($send) {
          echo '<script type="text/javascript">window.alert("POR FAVOR INGRESE LOS CAMPOS BÁSICOS");</script>';
        }

      ?>
    </div>
  </div>
</body>
</html>
