<?php require '../../partials/verifySession.php';
if (empty($_GET)) {
  header('Location: index.php');
} elseif ($_GET['a!¡v02ds3ass334de$?!!'] != 1) {
  header('Location: index.php');
}
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
      <h4>Bienvenido al Asistente para la Inserción de Datos</h4>
      <span>Inserte los datos necesarios y presione 'Guardar Cambios', de lo contrario 'Cancelar':</span>
      <form action="newGrupos.php?a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" method="POST">
        <div class="fila">
          <span>Nombre Grupo de Trabajo:</span>
          <input type="text" name="nom1" tabindex="1" value="">
        </div>
        <div class="fila">
          <span>Parroquia Grupo:</span>
          <select id="lista1" tabindex="2" name="lista1">
            <option selected disabled value="0">Seleccione una Parroquia:</option>
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
        <input type="submit" name="send" value="Guardar Cambios">
      </form>

      <?php
      $send = $_POST['send'] ?? '';
      $nom1 = $_POST['nom1'] ?? '';
      $parr = $_POST['lista1'] ?? '';
      if ($send && !empty($nom1) && !empty($parr)) {
        require '../../database.php';
        $result = $conn->query("INSERT INTO grupotrabajo (nombreGrupo, Parroquia_idParroquia, estadoGrupo)
                                  VALUES ('$nom1','$parr','1');");
        echo '<script type="text/javascript">window.close();</script>';
      } elseif ($send) {
        echo '<script type="text/javascript">window.alert("POR FAVOR INGRESE TODOS LOS CAMPOS");</script>';
      }
      ?>
    </div>
  </div>
</body>

</html>