<?php require '../../partials/verifySession.php';
if (empty($_GET)) {
  header('Location: index.php');
} elseif ($_GET['a!¡v02ds3ass334de$?!!'] != 1) {
  header('Location: index.php');
}
$ID = $_GET['p$b423scer34432yi$unj1232asds34da34shs!???'];    //ID Parroquia
$ver = $_GET['a!¡v02ds3ass334de$?!!'];   //Verificador Unico de Privacidad IntraWEB
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
      <div class="textname">
        <p>SISTEMA INTEGRAL DE GESTIÓN ACADÉMICA</p>
      </div>
      <div class="separator"></div>
      <img src="../../images/SIGA.ico" alt="sigaEspac.ico">
    </div>
    <div id="editForm">
      <?php require '../../database.php';
      $result = $conn->query("SELECT * FROM infoDiocesis WHERE idDiocesis=$ID;");
      $numfilas = $result->num_rows;
      $aux = $result->fetch_object();
      mysqli_close($conn);
      ?>
      <h4>Bienvenido al Asistente para la Actualización de Datos</h4>
      <span>Modifique los datos necesarios y presione 'Guardar Cambios', de lo contrario 'Cancelar':</span>
      <form action="diocesis.php?p$b423scer34432yi$unj1232asds34da34shs!???=<?php echo $ID; ?>&a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" method="POST">
        <div class="fila">
          <span>Ubicación Diocesal:</span>
          <input type="text" tabindex="1" name="nomb" value="<?php echo $aux->nombreDiocesis; ?>">
          <span>Obispo Encargado:</span>
          <select id="lista1" tabindex="3" name="obispo">
            <option selected value="<?php echo $aux->obispoDiocesis; ?>"><?php echo $aux->nombreObispo . " " . $aux->nombre2Obispo . " " . $aux->apellidoObispo . " " . $aux->apellido2Obispo; ?></option>
            <?php
            require '../../database.php';
            $resultado = $conn->query("SELECT * FROM parroco WHERE estadoParroco='1' AND autoridad='Obispo' ORDER by nombreParroco;");
            $numerofilas = $resultado->num_rows;
            for ($ir = 0; $ir < $numerofilas; $ir++) {
              $auxilio = $resultado->fetch_object();
              echo '<option value="' . $auxilio->idParroco . '">' . $auxilio->nombreParroco . " " . $auxilio->nombre2Parroco . " " . $auxilio->apellidoParroco . " " . $auxilio->apellido2Parroco . '</option>';
            }
            mysqli_close($conn);
            ?>
          </select>
        </div>
        <div class="fila">
          <span>Ciudad Principal:</span>
          <select id="lista1" tabindex="2" name="ciudad">
            <option selected value="<?php echo $aux->ciudadPrincipal; ?>"><?php echo $aux->ciudadPrincipal; ?></option>
            <?php
            require '../../database.php';
            $resultado = $conn->query("SELECT * FROM ciudades WHERE estadoCiudad='1';");
            $numerofilas = $resultado->num_rows;
            for ($ir = 0; $ir < $numerofilas; $ir++) {
              $auxilio = $resultado->fetch_object();
              echo '<option value="' . $auxilio->nombreCiudad . '">' . $auxilio->nombreCiudad . '</option>';
            }
            mysqli_close($conn);
            ?>
          </select>
          <span>Delegado ESPAC:</span>
          <select id="lista1" tabindex="4" name="delegado">
            <option selected value="<?php echo $aux->encargadoESPAC; ?>"><?php echo $aux->nombreEncargado . " " . $aux->nombre2Encargado . " " . $aux->apellidoEncargado . " " . $aux->apellido2Encargado; ?></option>
            <?php
            require '../../database.php';
            $resultado = $conn->query("SELECT * FROM parroco WHERE estadoParroco='1'ORDER by nombreParroco;");
            $numerofilas = $resultado->num_rows;
            for ($ir = 0; $ir < $numerofilas; $ir++) {
              $auxilio = $resultado->fetch_object();
              echo '<option value="' . $auxilio->idParroco . '">' . $auxilio->nombreParroco . " " . $auxilio->nombre2Parroco . " " . $auxilio->apellidoParroco . " " . $auxilio->apellido2Parroco . '</option>';
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
      $send = $_POST['send'] ?? '';
      $nomb = $_POST['nomb'] ?? '';
      $obisp = $_POST['obispo'] ?? '';
      $ciudad = $_POST['ciudad'] ?? '';
      $delegado = $_POST['delegado'] ?? '';
      if ($send && !empty($nomb) && !empty($obisp) && !empty($ciudad) && !empty($delegado)) {
        require '../../database.php';
        $result = $conn->query("UPDATE diocesis SET nombreDiocesis='$nomb', obispoDiocesis='$obisp', encargadoESPAC='$delegado', ciudadPrincipal='$ciudad' WHERE idDiocesis=$ID;");
        mysqli_close($conn);

        echo '<script type="text/javascript">window.close();</script>';
      } elseif ($send) {
        echo '<script type="text/javascript">window.alert("POR FAVOR INGRESE TODOS LOS CAMPOS");</script>';
      }
      ?>
    </div>
  </div>
</body>

</html>