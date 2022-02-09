<?php
$numfilas = $_POST['numfilas'] ?? '';
$k = 0;

//Modulo actual segun la calificación individual del modulo seleccionado en curso
$idCalificacion = $_POST['idCalificacion' . 0 . ''] ?? '';
require '../../../database.php';
$r = $conn->query("SELECT * FROM calificacionesAptitudinales WHERE idCalificacion='$idCalificacion';");
$a = $r->fetch_object();
mysqli_close($conn);

//Modulo Actual según el GrupoTrabajo
require '../../../database.php';
$exis = $conn->query("SELECT moduloActual FROM grupotrabajo
                        WHERE idGrupo = (select grupotrabajo_idGrupo from catequista 
                        where idCatequista = (select catequista_idCatequista from etapaxestudiante 
                        where id_EtapaxEstudiante='$a->Etapa_id_EtapaxEstudiante'));");
$existeModulo = $exis->fetch_object();
mysqli_close($conn);

//Comparación para saber si ya fue creado el modulo n+1 segun el modulo del primer catequista
//          Grupo               >        Hoja Actual
if ($existeModulo->moduloActual > $a->Modulo_idModulo) {     //Existe el siguiente modulo
    $k = 3;                      
} else {                            //No existe el siguiente modulo       
    for ($i = 0; $i < $numfilas; $i++) {
        $A = $_POST['A' . $i . ''] ?? '';
        $A_E = $_POST['A-E' . $i . ''] ?? '';
        $P = $_POST['P' . $i . ''] ?? '';
        $L = $_POST['L' . $i . ''] ?? '';
        $C_A = $_POST['C-A' . $i . ''] ?? '';
        $idCalificacion = $_POST['idCalificacion' . $i . ''] ?? '';
        require '../../../database.php';
        $result = $conn->query("UPDATE calificacionesAptitudinales 
                                    SET asistencia = '$A', 
                                        autoevaluacion = '$A_E', 
                                        practica = '$P', 
                                        liderazgo = '$L', 
                                        compromisoApos = '$C_A' 
                                    WHERE idCalificacion = '$idCalificacion';");
    
        /* Registro Nuevo Modulo */
        //Aqui buscamos la hoja de Calificación del Estudiante del modulo actual 
        require '../../../database.php';
        $r = $conn->query("SELECT * FROM calificacionesAptitudinales WHERE idCalificacion='$idCalificacion';");
        $a = $r->fetch_object();
        mysqli_close($conn);
    
        //Aqui buscamos el número del último modulo (idModulo) de la Etapa en curso y lo almacenamos en  $auxilio
        require '../../../database.php';
        $resultado = $conn->query("SELECT max(idModulo) as maxi FROM modulo WHERE Etapa_idEtapa=(SELECT Etapa_idEtapa FROM modulo WHERE idModulo='$a->Modulo_idModulo;');");
        $auxilio = $resultado->fetch_object();
        mysqli_close($conn);
        
        //Si el módulo actual del estudiante es menor al último modulo de la Etapa; entonces cree una nueva etapa.
        if ($a->Modulo_idModulo < $auxilio->maxi) {
            $n = $a->Modulo_idModulo + 1;
    
            require '../../../database.php';
            $ins = $conn->query("INSERT INTO calificacionesAptitudinales (`Etapa_id_EtapaxEstudiante`, `Modulo_idModulo`) 
                                        VALUES ('$a->Etapa_id_EtapaxEstudiante', '$n');");
            mysqli_close($conn);
    
            require '../../../database.php';
            $result = $conn->query("UPDATE grupotrabajo SET moduloActual = '$n' 
                                    WHERE (idGrupo = (select idGrupo from grupotrabajo where idGrupo=
                                    (select grupotrabajo_idGrupo from catequista where idCatequista = 
                                    (select catequista_idCAtequista from etapaxestudiante where id_EtapaxEstudiante='$a->Etapa_id_EtapaxEstudiante'))));");
            mysqli_close($conn);
    
            $k = 1;
            //Si el módulo actual es el mismo que el último de la Etapa 
        } else if ($a->Modulo_idModulo == $auxilio->maxi) {
            $k = 2;
            //default
        } else {
            $k = 9;
        }
    }
}

echo $k;
