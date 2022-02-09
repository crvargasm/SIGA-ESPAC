<?php
  session_start();
  if (isset($_SESSION['user']) && !empty($_SESSION['user'])){
    //echo "<br/>Sesión Iniciada!!! ";?>
    <meta http-equiv="refresh" content="1;workspace/subpages/PortalAcademico.php">
  <?php } ?>
<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title>S.I.G.A. - E.S.P.A.C.</title>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="workspace/images/SIGA.ico">
    <link rel="stylesheet" href="workspace/assets/css/style.css">
    <meta http-equiv="refresh" content="1.5;workspace/login.php">
  </head>
  <body id="backindex">
    <div id="index">
        <img src="/workspace/images/SIGA.ico" width="220" alt="SIGALogo">
        <h3>S.I.G.A. - E.S.P.A.C. v1.0Alpha</h3></a>
        <h2>BIENVENIDO AL S.I.G.A. - ESPAC</h2>
    </div>
  </body>
</html>
