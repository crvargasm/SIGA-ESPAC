<?php require '../../partials/verifySession.php';
if (empty($_GET)) {
  header('Location: index.php');
} elseif ($_GET['a!¡v02ds3ass334de$?!!'] != 1) {
  header('Location: index.php');
}
$ID = $_GET['p$b423scer34432yi$unj1232asds34da34shs!???'];    //ID Catequista
$ver = $_GET['a!¡v02ds3ass334de$?!!'];   //Verificador Unico de Privacidad IntraWEB
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>S.I.G.A. - E.S.P.A.C.</title>
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="../../images/SIGA.ico">
  <link rel="stylesheet" href="../../assets/css/stylePage.css">

<body>
  <div id="auxPage1">
    <div class="headerAux">
      <div class="textname">
        <p>SISTEMA INTEGRAL DE GESTIÓN ACADÉMICA</p>
      </div>
      <div class="separator"></div>
      <img src="../../images/SIGA.ico" alt="sigaEspac.ico">
    </div>
    <div id="editForm">
      <?php require '../../database.php';
      $result = $conn->query("SELECT * FROM infoGrupo WHERE idGrupo=$ID;");
      $numfilas = $result->num_rows;
      $aux = $result->fetch_object();
      mysqli_close($conn);
      ?>
      <h4>Bienvenido al Asistente para la Actualización de Datos</h4>
      <span>Modifique los datos necesarios y presione 'Guardar Cambios', de lo contrario 'Cancelar':</span>
      <form action="grupos.php?p$b423scer34432yi$unj1232asds34da34shs!???=<?php echo $ID; ?>&a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" method="POST">
        <div class="fila">
          <span>Nombre Grupo de Trabajo:</span>
          <input type="text" name="nom1" tabindex="1" value="<?php echo $aux->nombreGrupo; ?>">
        </div>
        <div class="fila">
          <span>Parroquia Grupo:</span>
          <select id="lista1" tabindex="2" name="lista1">
            <option selected value=<?php echo $aux->Parroquia_idParroquia; ?>><?php echo $aux->nombreParroquia; ?></option>
            <?php
            require '../../database.php';
            $resultado = $conn->query("SELECT idParroquia, nombreParroquia FROM parroquia");
            $numerofilas = $resultado->num_rows;
            for ($ir = 0; $ir < $numerofilas; $ir++) {
              $auxilio = $resultado->fetch_object();
              echo '<option value="' . $auxilio->idParroquia . '">' . $auxilio->nombreParroquia . '</option>';
            }
            mysqli_close($conn);
            ?>
          </select>
        </div>
        <input type="button" name="rst" onclick="window.close()" value="Cancelar">
        <?php
        $estado = $aux->estadoGrupo;
        if ($estado == 1) {
        ?><input type="submit" name="disable" value="Deshabilitar Grupo"><?php
                                                                            } elseif ($estado == 0) {
                                                                              ?><input type="submit" name="able" value="Habilitar Grupo"><?php
                                                                            }
                                                                        ?>
        <input type="submit" name="send" value="Guardar Cambios">
      </form>

      <?php
      try {
        $disable = $_POST['disable'] ?? '';
      } catch (\Exception $e) {
      }
      try {
        $able = $_POST['able']?? '';
      } catch (\Exception $e) {
      }
      $send = $_POST['send']?? '';
      $nom1 = $_POST['nom1']?? '';
      $parr = $_POST['lista1']?? '';
      if ($send && !empty($nom1) && !empty($parr)) {
        require '../../database.php';
        $result = $conn->query("UPDATE infoGrupo
                                  SET nombreGrupo='$nom1',
                                  Parroquia_idParroquia='$parr'
                                  WHERE idGrupo=$ID;");
        echo '<script type="text/javascript">window.close();</script>';
      } elseif ($send) {
        echo '<script type="text/javascript">window.alert("POR FAVOR INGRESE TODOS LOS CAMPOS");</script>';
      }


      //Habilitar o Deshabilitar Catequista
      require '../../database.php';
      if ($estado == 1 && $disable) {          //Inhabilitar
        $resulta = $conn->query("UPDATE infoGrupo
                                  SET estadoGrupo='0'
                                  WHERE idGrupo=$ID;");
        echo '<script type="text/javascript">window.close();</script>';
      } elseif ($estado == 0 && $able) {       //Habilitar
        $resulta = $conn->query("UPDATE infoGrupo
                                  SET estadoGrupo='1'
                                 WHERE idGrupo=$ID;");
        echo '<script type="text/javascript">window.close();</script>';
      }
      mysqli_close($conn);
      ?>
    </div>
  </div>
</body>
|
</html>