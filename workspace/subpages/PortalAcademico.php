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
  <div id="latMenu">
    <ul id="menu_list">
      <a href="PortalAcademico.php"><li>INICIO</li></a>
      <a href="administracion.php"><li>ADMINISTRACIÓN</li></a>
      <a href="informes.php"><li>INFORMES</li></a>
      <a href="calificaciones.php"><li>CALIFICACIONES</li></a>
      <a href="proyectos.php"><li>PROYECTOS</li></a>
      <a href="soporte.php"><li>SOPORTE</li></a>
    </ul>
    <div id="textbot">
      <p>SIGA - ESPAC | ©<?php echo date("Y")?></p>
    </div>
  </div>
  <div class ="dashboard">
    <div id="backd">
      <div id="imagen1">
        <img src="../images/logoespac.png" alt="logoEspac">
      </div>
      <div id="textwelcome">
        <h1>Bienvenido al SIGA - ESPAC</h1>
        <h3>Seleccione la Acción a Realizar</h3>
      </div>
    </div>
  </div>
</div>
</body>
</html>
