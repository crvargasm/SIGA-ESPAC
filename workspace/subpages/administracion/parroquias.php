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
  <title>S.I.G.A. - E.S.P.A.C.</title>
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="../../images/SIGA.ico">
  <link rel="stylesheet" href="../../assets/css/stylePage.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
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
      $result = $conn->query("SELECT * FROM parroquia WHERE idParroquia=$ID;");
      $numfilas = $result->num_rows;
      $aux = $result->fetch_object();
      mysqli_close($conn);

      require '../../database.php';
      $result = $conn->query("SELECT * FROM parrocoxperiodo WHERE Parroquia_idParroquia=$ID;");
      $numfilasa = $result->num_rows;

      if ($numfilasa > 0) {
        $aux1 = $result->fetch_object();
        mysqli_close($conn);

        require '../../database.php';
        $result = $conn->query("SELECT * FROM parroco WHERE idParroco=$aux1->Parroco_idParroco;");
        $numfilas = $result->num_rows;
        $aux2 = $result->fetch_object();
        mysqli_close($conn);
      }

      ?>
      <h4>Bienvenido al Asistente para la Actualización de Datos</h4>
      <span>Modifique los datos necesarios y presione 'Guardar Cambios', de lo contrario 'Cancelar':</span>
      <form action="parroquias.php?p$b423scer34432yi$unj1232asds34da34shs!???=<?php echo $ID; ?>&a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" method="POST">
        <div class="fila">
          <span>Nombre Parroquia:</span>
          <input type="text" autofocus tabindex="1" name="nom" value="<?php echo $aux->nombreParroquia; ?>">
          <span>Dirección Parroquia:</span>
          <input type="text" tabindex="3" name="dir" value="<?php echo $aux->direccionParroquia; ?>">
          <span>Correo Parroquia:</span>
          <input type="text" tabindex="5" name="correo" value="<?php echo $aux->correoParroquia; ?>">
        </div>
        <div class="fila">
          <span>Barrio o Sector Parroquial:</span>
          <input type="text" tabindex="2" name="barr" value="<?php echo $aux->barrioParroquia; ?>">
          <span>Telefono o PBX Parroquia:</span>
          <input type="text" tabindex="4" name="tel" value="<?php echo $aux->telefonoParroquia; ?>">
          <span>Seleccione el Sacerdote Asignado a la Parroquia:</span>
          <select id="lista4" tabindex="6" name="sace">

            <?php if ($numfilasa > 0) { ?>
              <option selected value='<?php echo $aux2->idParroco; ?>'><?php echo $aux2->nombreParroco . ' ' . $aux2->nombre2Parroco . ' ' . $aux2->apellidoParroco . ' ' . $aux2->apellido2Parroco; ?></option>
            <?php } else { ?>
              <option disabled selected value=''>Seleccione un Sacerdote</option>
            <?php } ?>

            <?php
            require '../../database.php';
            $resultado = $conn->query("SELECT idParroco, nombreParroco, nombre2Parroco, apellidoParroco, apellido2Parroco FROM parroco WHERE estadoParroco =1 AND autoridad != 'Obispo' ORDER by nombreParroco");
            $numerofilas = $resultado->num_rows;
            for ($ir = 0; $ir < $numerofilas; $ir++) {
              $auxilio = $resultado->fetch_object();
              echo '<option value="' . $auxilio->idParroco . '">' . $auxilio->nombreParroco . ' ' . $auxilio->nombre2Parroco . ' ' . $auxilio->apellidoParroco . ' ' . $auxilio->apellido2Parroco . '</option>';
            }
            mysqli_close($conn);
            ?>
          </select>
        </div>
        <input type="button" name="rst" onclick="window.close()" value="Cancelar">
        <?php
        $estado = $aux->estadoParroquia;
        if ($estado == 1) {
        ?><input type="submit" name="disable" value="Deshabilitar Parroquia"><?php
                                                                            } elseif ($estado == 0) {
                                                                              ?><input type="submit" name="able" value="Habilitar Parroquia"><?php
                                                                                                                                            }
                                                                                                                                              ?>
        <input type="submit" name="send" value="Guardar Cambios">
      </form>

      <?php
      //print_r($_POST);
      try {
        $disable = $_POST['disable'] ?? '';
      } catch (\Exception $e) {
      }
      try {
        $able = $_POST['able'] ?? '';
      } catch (\Exception $e) {
      }
      $send = $_POST['send'] ?? '';
      $nom = $_POST['nom'] ?? '';
      $correo = $_POST['correo'] ?? '';
      $dir = $_POST['dir'] ?? '';
      $barr = $_POST['barr'] ?? '';
      $tel = $_POST['tel'] ?? '';
      $sace = $_POST['sace'] ?? '';
      if ($send && !empty($nom) && !empty($correo) && !empty($dir) && !empty($barr) && !empty($tel)) {
        require '../../database.php';
        $result = $conn->query("UPDATE parroquia SET nombreParroquia='$nom', barrioParroquia='$barr', direccionParroquia='$dir', telefonoParroquia='$tel', correoParroquia='$correo', estadoParroquia=1, diocesisParroquia=1 WHERE idParroquia=$ID;");
        mysqli_close($conn);

        require '../../database.php';
        $resultado = $conn->query("SELECT idParroco FROM infoParroquias WHERE idParroquia=$ID;");
        $auxilio = $resultado->fetch_object();
        mysqli_close($conn);

        if ($auxilio->idParroco != $sace) {
          require '../../partials/timestamp.php';
          require '../../database.php';
          $result = $conn->query("INSERT INTO parrocoxperiodo (Parroco_idParroco, Parroquia_idParroquia, yearParroco, semestreParroco)
                                    VALUES ($sace, $ID, $year, '$semestre');");
          mysqli_close($conn);
        }

        echo '<script type="text/javascript">window.close();</script>';
      } elseif ($send) {
        echo '<script type="text/javascript">window.alert("POR FAVOR INGRESE TODOS LOS CAMPOS");</script>';
      }

      //Habilitar o Deshabilitar Parroquia
      require '../../database.php';
      if ($estado == 1 && $disable) {          //Inhabilitar
        $resulta = $conn->query("UPDATE parroquia
                                  SET estadoParroquia='0'
                                  WHERE idParroquia=$ID;");
        echo '<script type="text/javascript">window.close();</script>';
      } elseif ($estado == 0 && $able) {       //Habilitar
        $resulta = $conn->query("UPDATE parroquia
                                  SET estadoParroquia='1'
                                  WHERE idParroquia=$ID;");
        echo '<script type="text/javascript">window.close();</script>';
      }
      mysqli_close($conn);
      ?>
    </div>
  </div>
</body>

</html>