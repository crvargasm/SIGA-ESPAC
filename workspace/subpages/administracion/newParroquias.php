<?php require '../../partials/verifySession.php';
if (empty($_GET)) {
  header('Location: ../index.php');
} elseif ($_GET['a!¡v02ds3ass334de$?!!'] != 1) {
  header('Location: ../index.php');
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
      <h4>Bienvenido al Asistente para la Inserción de Datos</h4>
      <span>Inserte los datos necesarios y presione 'Guardar Cambios', de lo contrario 'Cancelar':</span>
      <form action="newParroquias.php?a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" method="POST">
        <div class="fila">
          <span>Nombre Parroquia:</span>
          <input type="text" autofocus tabindex="1" name="nom" value="">
          <span>Dirección Parroquia:</span>
          <input type="text" tabindex="3" name="dir" value="">
          <span>Correo Parroquia:</span>
          <input type="text" tabindex="5" name="correo" value="">
        </div>
        <div class="fila">
          <span>Barrio o Sector Parroquial:</span>
          <input type="text" tabindex="2" name="barr" value="">
          <span>Telefono o PBX Parroquia:</span>
          <input type="text" tabindex="4" name="tel" value="">
          <span>Seleccione el Sacerdote Asignado a la Parroquia:</span>
          <select id="lista4" tabindex="6" name="sace">
            <option disabled selected value=0>Seleccione el Parroco:</option>
            <?php
            require '../../database.php';
            $resultado = $conn->query("SELECT idParroco, nombreParroco, nombre2Parroco, apellidoParroco, apellido2Parroco FROM parroco WHERE estadoParroco =1 AND autoridad != 'Obispo'");
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
        <input type="submit" name="send" value="Guardar Cambios">
      </form>

      <?php
      //print_r($_POST);
      $send = $_POST['send'] ?? '';
      $nom = $_POST['nom'] ?? '';
      $correo = $_POST['correo'] ?? '';
      $dir = $_POST['dir'] ?? '';
      $barr = $_POST['barr'] ?? '';
      $tel = $_POST['tel'] ?? '';
      $sace = $_POST['sace'] ?? '';
      if ($send && !empty($nom) && !empty($correo) && !empty($sace) && !empty($dir) && !empty($barr) && !empty($tel)) {
        require '../../database.php';
        $result = $conn->query("INSERT INTO parroquia (nombreParroquia, barrioParroquia, direccionParroquia, telefonoParroquia, correoParroquia, estadoParroquia, diocesisParroquia)
                                  VALUES ('$nom', '$barr', '$dir', '$tel', '$correo', '1', '1');");
        mysqli_close($conn);

        //Hacer Consulta de Parroquia_idParroquia....
        require '../../database.php';
        $result = $conn->query("SELECT idParroquia FROM parroquia WHERE nombreParroquia='$nom';");
        $numfilas = $result->num_rows;
        for ($i = 0; $i < $numfilas; $i++) {
          $aux = $result->fetch_object();
          $IdParr = $aux->idParroquia;
        }
        mysqli_close($conn);


        require '../../partials/timestamp.php';
        require '../../database.php';
        $result = $conn->query("INSERT INTO parrocoxperiodo (Parroco_idParroco, Parroquia_idParroquia, yearParroco, semestreParroco)
                                  VALUES ('$sace', '$IdParr', '$year', '$semestre');");
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