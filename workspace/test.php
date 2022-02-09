<?php
  session_start();
  if (isset($_SESSION['user']) && !empty($_SESSION['user'])){
    //echo "<br/>Sesión Iniciada!!! ";
    header('Location: subpages/PortalAcademico.php');
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Sistema Integral de Gestión Académica</title>
  <link rel="stylesheet" href="assets/css/styleA.css">
  <link rel="shortcut icon" href="images/SIGA.ico">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Orbitron&display=swap">
</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="container">
    <div class="left">
      <div class="logo"><img src="images/SIGA.ico" width="150" alt="SIGALogo"></div>
      <div class="login">SIGA - ESPAC</div>
      <div class="eula">BIENVENIDO AL SIGA - ESPAC v.1.2Alpha</div>
    </div>
    <div class="right">
      <svg viewBox="0 0 320 300">
        <defs>
          <linearGradient
                          inkscape:collect="always"
                          id="linearGradient"
                          x1="13"
                          y1="193.49992"
                          x2="307"
                          y2="193.49992"
                          gradientUnits="userSpaceOnUse">
            <stop
                  style="stop-color:#ff0000;"
                  offset="0"
                  id="stop876" />
            <stop
                  style="stop-color:#52c8fa;"
                  offset="1"
                  id="stop878" />
          </linearGradient>
        </defs>
        <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
      </svg>
      <form class="form" action="test.php" method="POST" autocomplete="off">
        <label for="email">Ingrese su Usuario</label>
        <input type="text" id="user" name="username" value="">
        <label for="password">Ingrese su Contraseña</label>
        <input type="password" id="password" name="password" value="">
        <input type="submit" id="submit" name="send" value="Ingresar" onclick="cambiarboton();<?php sleep(2);?>">
      </form>
    </div>
  </div>
  <div class="foot">
    <div id="copy">Iglesia de Nuestra Señora de la Candelaria | ©2020</div>
    <div id="textfoot" title="adthos">adthos</div>
    <div id="separator"></div>
    <div id="imagefoot" title="adthos"><img src="/workspace/images/adthos.png"  width="30" alt="SIGALogo"></div>
  </div>
</div>

<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.min.js' crossorigin="anonymous"></script>
  <script>
  var current = null;
  document.querySelector('#user').addEventListener('focus', function(e) {
    if (current) current.pause();
    current = anime({
      targets: 'path',
      strokeDashoffset: {
        value: 0,
        duration: 700,
        easing: 'easeOutQuart'
      },
      strokeDasharray: {
        value: '240 1386',
        duration: 700,
        easing: 'easeOutQuart'
      }
    });
  });
  document.querySelector('#password').addEventListener('focus', function(e) {
    if (current) current.pause();
    current = anime({
      targets: 'path',
      strokeDashoffset: {
        value: -336,
        duration: 700,
        easing: 'easeOutQuart'
      },
      strokeDasharray: {
        value: '240 1386',
        duration: 700,
        easing: 'easeOutQuart'
      }
    });
  });
  document.querySelector('#submit').addEventListener('focus', function(e) {
    if (current) current.pause();
    current = anime({
      targets: 'path',
      strokeDashoffset: {
        value: -730,
        duration: 700,
        easing: 'easeOutQuart'
      },
      strokeDasharray: {
        value: '530 1386',
        duration: 700,
        easing: 'easeOutQuart'
      }
    });
  });
  </script>
  <script>
    function cambiarboton(){
      var i=document.getElementById("submit").value = "Bienvenido";
    }
  </script>
</body>
</html>
