<?php
session_start();
if (!isset($_SESSION['user']) && empty($_SESSION['user'])) {
  header('Location: ../logout.php');
}
$ID = $_GET['p$b423scer34432yi$unj1232asds34da34shs!???'];    //ID Grupo Trabajo
$ver = $_GET['a!¡v02ds3ass334de$?!!'];   //Verificador Unico de Privacidad IntraWEB
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Sistema Integral de Gestión Académica</title>
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="../../images/SIGA.ico">
  <link rel="stylesheet" type="text/css" href="css/styleC.css">
  <link rel="stylesheet" type="text/css" href="../../../libraries/bootstrap/css/bootstrap.css">
  <script src="../../../libraries/jquery-3.5.1.min.js"></script>
  <script src="../../../libraries/bootstrap/js/bootstrap.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <div class="page">
    <div class="adw">
      <h1><center>ADVERTENCIA</center></h1>
      <h2><center>EN UN MOMENTO INGRESARÁ EN UN AMBIENTE DEDICADO A LA MODIFICACIÓN DE NOTAS ACADÉMICAS</br></br>
        SE RECOMIENDA GUARDAR LA INFORMACIÓN CON CONSTANTE FRECUENCIA</center></h2>
    </div>
    <div id="cr"></div>
    <?php
    require '../../database.php';
    $resultado = $conn->query("SELECT * FROM infoGrupo WHERE idGrupo='$ID';");
    $numerofilas = $resultado->num_rows;
    if ($numerofilas == 0) {
      echo '
        <script>
          alert("Error al Cargar el Grupo");
          window.close();
        </script>
      ';
    }
    $auxilio = $resultado->fetch_object();
    mysqli_close($conn);
    $moduloActual = $auxilio->moduloActual;
    if ($moduloActual == 0) {
    ?>
      <script>
        swal({
          icon: "info",
          text: `El grupo seleccionado no posee registro normativo, a continuación se procederá a Inicializar su respectiva Historia Académica`,
          buttons: ["Cancelar X", "De Acuerdo! :)"],
        }).then((value) => {
          if (value) {
            $.ajax({
              type: "POST",
              url: "partials/crearHistoriaAca.php?p$b423scer34432yi$unj123=<?php echo $ID; ?>",
              data: "",
              success: function(r) {
                if (r == 1) {
                  var container = document.getElementById('cr');
                  container.innerHTML = '<meta http-equiv="refresh" content="1;gestionadministrativanotas.php?p$b423scer34432yi$unj1232asds34da34shs!???=<?php echo $ID; ?>&a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>">';
                } else {
                  alert("Algo falló :( -- Error: advertencia.php");
                  window.close();
                }
              }
            });
          } else {
            window.close();
          }
        });
      </script>
    <?php
    } else {
      echo '<meta http-equiv="refresh" content="1;gestionadministrativanotas.php?p$b423scer34432yi$unj1232asds34da34shs!???=' . $ID . '&a!¡v02ds3ass334de$?!!=' . $ver . '">';
    }
    ?>
  </div>
  <?php require 'partials/footeer.php';?>
</body>

</html>