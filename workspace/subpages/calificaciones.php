<?php
session_start();
if (!isset($_SESSION['user']) && empty($_SESSION['user'])) {
  header('Location: ../logout.php');
} ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

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
      <div id="backq">
        <h3>Bienvenido al Gestor de Calificaciones</h3>
        <span>Para continuar el proceso de registro académico de notas, por favor busque y seleccione el grupo a calificar:</br>
          Recuerde que para visualizar los grupos estos deben estar activos desde el apartado "Administración".</span>
        <div id="buscarCalificar">
          <div id="formconsulta">
            <form action="calificaciones.php" method="POST">
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
              <?php if (isset($_POST['parroquia'])) {
                $valueSel = $_POST['parroquia'];
              } else {
                $valueSel = 0;
              } ?>
              <input type="submit" name="send" value="Buscar">
              <button type="button" onclick="location.href='calificaciones.php'">Limpiar</button>
              <a target="_blank" href="administracion/newGrupos.php?a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" onclick="window.open(this.href, this.target, 'width=650,height=280'); return false;"><button type="button">Añadir</button></a>
            </form>
          </div>
          <div id="consulta">
            <?php
            if (isset($_POST['send'])) {
              $boton = $_POST['send'];
            } else {
              $boton = false;
            }    //Pulso de Boton "Send"
            if ($valueSel == 0 && $boton) {  //Verifica que NO este Vacia La Consulta
              $numfilas = -1;
              echo '<br><b>Por favor Seleccione la Parroquia a la que el Grupo esta Asignado</b></br>';
            } elseif ($valueSel != 0 && $boton) {  //Verifica La parroquia
              require '../database.php';
              $result = $conn->query("SELECT * FROM infoGrupo WHERE Parroquia_idParroquia='$valueSel' AND estadoGrupo!='0'");
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
                    <th><center><b>Modificar</b></center></th>
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
                    <center><a href="calificaciones/advertencia.php?p$b423scer34432yi$unj1232asds34da34shs!???=<?php echo $IDC; ?>&a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" target="_blank" onclick="window.open(this.href, this.target, 'width=1100,height=650'); return false;"><input type="radio" name="bt" value=""></a></center>
                  </td>
                  </tr>
              <?php
                }
                echo '</table></center>';
                mysqli_close($conn);
              } elseif ($numfilas == 0 && $boton) {
                echo '<br><b>Parroquia sin Grupos Asignados</b></br>';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>