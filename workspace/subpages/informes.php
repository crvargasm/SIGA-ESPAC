<?php
session_start();
if (!isset($_SESSION['user']) && empty($_SESSION['user'])) {
  header('Location: logout.php');
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
      <div id="backi">
        <div id="titles">SELECCIONE EL AREA DE SU INTERÉS:</div>
        <div id="C">
          <a href="informesxGrupo.php">
            <div id="squareA"><img src="../images/iconos/informes/grupos.png" alt="Grupos">
              <spam>GRUPOS</spam>
            </div>
          </a>
          <a href="informes/gestionCoordinador.php">
            <div id="squareA"><img src="../images/iconos/informes/docentes.png" alt="Docentes">
              <spam>CATEQUISTA</spam>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>