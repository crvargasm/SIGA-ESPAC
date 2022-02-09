<?php require '../partials/verifySession.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Sistema Integral de Gestión Académica</title>
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="../images/SIGA.ico">
  <link rel="stylesheet" href="../assets/css/stylePage.css">
  <script src="../../../libraries/jquery-3.5.1.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
  <?php require '../partials/headerPA.php'; ?>
  <div id="page">
    <?php require '../partials/menulist.php'; ?>
    <div class="dashboard">
      <a href="informes.php">
        <div class="backButtom"><img src="../images/iconos/back.svg" alt=""></div>
      </a>
      <a onclick="history.go(0)">
        <div class="refreshButtom"><img src="../images/iconos/reload.svg" alt=""></div>
      </a>
      <div class="backf">
        <div id="titles">
          <p>Por favor Seleccione la Parroquia a la que pertenece el Grupo:</p>
        </div>
        <div id="formconsulta">
          <form action="informesxGrupo.php" method="POST">
            <select name="parroquia">
              <option disabled selected value=0>Seleccione la Parroquia del Grupo:</option>
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
            <button type="button" onclick="location.href='informesxGrupo.php'">Limpiar</button>
          </form>
        </div>
        <div id="consulta">
          <?php
          $boton = $_POST['send'] ?? '';    //Pulso de Boton "Send"
          if ($valueSel == 0 && $boton) {  //Verifica que NO este Vacia La Consulta
            require '../database.php';
            $result = $conn->query("SELECT * FROM infoGrupo");
            $numfilas = $result->num_rows;
          } elseif ($valueSel != 0 && $boton) {  //Verifica La parroquia
            require '../database.php';
            $result = $conn->query("SELECT * FROM infoGrupo WHERE Parroquia_idParroquia='$valueSel'");
            $numfilas = $result->num_rows;
          }
          ?>
          <div class="table">
            <?php
            if ($numfilas > 0 && $boton) {
              echo '<br>Número de Resultados: ' . $numfilas . '</br>';
              echo '
              </br>
              <center>
              <table width=\"100%\" border=\"1\">
                <tr>
                  <th><center><b>Nombre Grupo</b></center></th>
                  <th><center><b>Parroquia</b></center></th>
                  <th><center><b>Estado</b></center></th>
                  <th><center><b>Informe</b></center></th>
                  <th><center><b>Registrar Escrutinio</b></center></th>
                </tr>';
              for ($i = 0; $i < $numfilas; $i++) {
                $aux = $result->fetch_object();
                echo
                '
                  <tr>
                    <td><center>' . $aux->nombreGrupo . '</center></td>
                    <td><center>' . $aux->nombreParroquia . '</center></td>
                    <td><center>';
                if ($aux->estadoGrupo == 1) {
                  echo 'Activo';
                } else {
                  echo 'Inactivo';
                }
                echo '</center></td>';
                $IDC = $aux->idGrupo; ?>
                <td>
                  <center><a href="informes/reportexGrupo.php?p$b423scer34432yi$unj1232asds34da34shs!???=<?php echo $IDC; ?>&a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" target="_blank" onclick="window.open(this.href, this.target, 'width=1080,height=680'); return false;"><input type="radio" name="bt" value=""></a></center>
                </td>
                <td>
                  <center><a href="informes/registrarEscrutinio.php?p$b423scer34432yi$unj1232asds34da34shs!???=<?php echo $IDC; ?>&a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" target="_blank" onclick="window.open(this.href, this.target, 'width=720,height=520'); return false;"><img src="../images/plus.png" width="35" alt=""></a></center>
                </td>
                </tr>
            <?php
              }
              echo '</table></center>';
              mysqli_close($conn);
            } elseif ($boton) {
              echo '<br><b>Grupo No Encontrado</b></br>';
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