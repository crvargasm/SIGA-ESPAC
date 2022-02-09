<?php require '../partials/verifySession.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Sistema Integral de Gestión Académica</title>
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="../images/SIGA.ico">
  <link rel="stylesheet" href="../assets/css/stylePage.css">
</head>

<body>
  <?php require '../partials/headerPA.php'; ?>
  <div id="page">
    <?php require '../partials/menulist.php'; ?>
    <div class="dashboard">
      <a href="administracion.php">
        <div class="backButtom"><img src="../images/iconos/back.svg" alt=""></div>
      </a>
      <a onclick="history.go(0)">
        <div class="refreshButtom"><img src="../images/iconos/reload.svg" alt=""></div>
      </a>
      <div class="backz">
        <div id="titles">
          <p>Por favor Seleccione la Parroquia que desea Modificar:</p>
        </div>
        <div id="formconsulta">
          <form action="gestionParroquia.php" method="POST">
            <select name="parroquia">
              <option disabled selected value=0>Seleccione la Parroquia:</option>
              <?php
              require '../database.php';
              $ver = 1;
              $result = $conn->query("SELECT idParroquia, nombreParroquia FROM parroquia");
              $numfilas = $result->num_rows;
              for ($i = 0; $i < $numfilas; $i++) {
                $aux = $result->fetch_object();
                echo '<option value="' . $aux->idParroquia . '">Parroquia ' . $aux->nombreParroquia . '</option>';
              }
              mysqli_close($conn);
              ?>
            </select>
            <?php $valueSel = $_POST['parroquia'] ?? ''; ?>
            <input type="submit" name="send" value="Buscar">
            <button type="button" onclick="location.href='gestionParroquia.php'">Limpiar</button>
            <a target="_blank" href="administracion/newParroquias.php?a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" onclick="window.open(this.href, this.target, 'width=650,height=400'); return false;"><button type="button">Añadir</button></a>
          </form>
        </div>
        <div id="consulta">
          <?php
          $boton = $_POST['send'] ?? '';    //Pulso de Boton "Send"
          if ($valueSel == 0 && $boton) {  //Verifica que NO este Vacia La Consulta
            require '../database.php';
            $result = $conn->query("SELECT * FROM parroquia ORDER by nombreParroquia");
            $numfilas = $result->num_rows;
          } else {
            if ($valueSel != 0 && $boton) {  //Busca Por Selección
              require '../database.php';
              $result = $conn->query("SELECT * FROM parroquia WHERE idParroquia='$valueSel'");
              $numfilas = $result->num_rows;
            }
          }
          ?>
          <div class="table">
            <?php
            if ($numfilas > 0 && $boton) {
              echo '
              <br>
              <center>
              <table width=\"100%\" border=\"1\">
                <tr>
                  <th><center><b>Nombre Parroquia</b></center></th>
                  <th><center><b>Barrio</b></center></th>
                  <th><center><b>Dirección</b></center></th>
                  <th><center><b>Telefono</b></center></th>
                  <th><center><b>Correo</b></center></th>
                  <th><center><b>Estado</b></center></th>
                  <th><center><b>Modificar</b></center></th>
                </tr>';
              for ($i = 0; $i < $numfilas; $i++) {
                $aux = $result->fetch_object();
                echo
                  '
                  <tr>
                    <td><center>' . $aux->nombreParroquia . '</center></td>
                    <td><center>' . $aux->barrioParroquia . '</center></td>
                    <td><center>' . $aux->direccionParroquia . '</center></td>
                    <td><center>' . $aux->telefonoParroquia . '</center></td>
                    <td><center>' . $aux->correoParroquia . '</center></td>
                    <td><center>';
                if ($aux->estadoParroquia == 1) {
                  echo 'Activo';
                } else {
                  echo 'Inactivo';
                }
                echo '</center></td>';
                $IDC = $aux->idParroquia; ?>
                <td>
                  <center><a href="administracion/parroquias.php?p$b423scer34432yi$unj1232asds34da34shs!???=<?php echo $IDC; ?>&a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" target="_blank" onclick="window.open(this.href, this.target, 'width=650,height=400'); return false;"><input type="radio" name="bt" value=""></a></center>
                </td>
                </tr>
            <?php
              }
              echo '</table></center>';
              mysqli_close($conn);
            } elseif ($boton) {
              echo '<br><b>Parroquia No Encontrada</b></br>';
              mysqli_close($conn);
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>