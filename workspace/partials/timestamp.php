<?php
  $year = date("Y");
  $mes = date("n");
  if ($mes < 7) {
    $semestre = "A";
  } else {
    $semestre = "B";
  }
  //echo "Año actual es: ".$year." Semestre Actual:".$semestre;
?>
