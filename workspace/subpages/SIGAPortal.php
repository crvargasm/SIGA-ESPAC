<?php require '../partials/verifySession.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TEST - Sistema Integral de Gestión Académica</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="shortcut icon" href="../images/SIGA.ico">

    <script src="../../libraries/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="jsQueries/SIGAPortal.js"></script>
</head>

<body style="background-image: url('../images/catedral.jpg'); background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-size: cover; display: flex; flex-direction: column; height:100vh; margin: 0;">
    <div class="container-fluid d-grid gap-2">

        <!--Banner-->
        <div class="row bg-white rounded-3 mt-2 mx-0" style="--bs-bg-opacity: .8;">
            <div class="d-flex mx-4 col-1 p-0 align-items-center justify-content-center">
                <a href="SIGAPortal.php">
                    <img class="m-1 p-0" style="width:100px;" src=" ../images/SIGAshort.ico" alt="isotipoSIGA.ico" />
                </a>
            </div>
            <div class="d-flex col-8 p-0 align-items-center">
                <a href="SIGAPortal.php" style="text-decoration: none;">
                    <h1 class="text-secondary">SISTEMA INTEGRAL DE GESTIÓN ACADÉMICA </h1>
                </a>
            </div>
            <div class="d-flex col-2 p-0 align-items-center justify-content-end">
                <a href="../logout.php" style="text-decoration: none;">
                    <h5 class="text-secondary me-4">Cerrar Sesión</h5>
                </a>
            </div>
        </div>

        <!--Menu lateral y Páginas de Consulta-->
        <div class="row mx-0 gap-2 mb-1" id="panelG">
            <!--Script para cambiar el tamaño del row-->

            <!--Menú Lateral-->
            <div id="navLat" class="col-auto p-0 bg-white rounded-3" style="--bs-bg-opacity: .8;">
                <nav class="d-flex nav flex-column">
                    <a class="btn btn-outline-light nav-link p-3 mb-1 fs-6 text-center text-dark fw-semibold" href="#inicio" data-bs-parent="#panelG" data-bs-toggle="collapse" aria-controls="inicio" aria-expanded="false">Inicio</a>

                    <a class="btn btn-outline-light nav-link p-3 mb-1 fs-6 text-center text-dark fw-semibold" href="#submenuAdmin" data-bs-parent="#panelG" data-bs-toggle="collapse" aria-controls="submenuAdmin" aria-expanded="false">
                        Administración
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                            <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                        </svg>
                    </a>
                    <div class="collapse px-1" data-bs-parent="#admins" id="submenuAdmin">
                        <div class="list-group">
                            <a href="#adminCatequista" class="list-group-item list-group-item-dark text-start fw-semibold" data-bs-parent="#panelG" data-bs-toggle="collapse" aria-controls="administracion" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                                </svg>
                                <span class="mx-2">Catequistas</span>
                            </a>
                            <a href="#adminCoordinadores" class="list-group-item list-group-item-dark text-start fw-semibold" data-bs-parent="#panelG" data-bs-toggle="collapse" aria-controls="adminCoordinadores" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-video3" viewBox="0 0 16 16">
                                    <path d="M14 9.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm-6 5.7c0 .8.8.8.8.8h6.4s.8 0 .8-.8-.8-3.2-4-3.2-4 2.4-4 3.2Z" />
                                    <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h5.243c.122-.326.295-.668.526-1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v7.81c.353.23.656.496.91.783.059-.187.09-.386.09-.593V4a2 2 0 0 0-2-2H2Z" />
                                </svg>
                                <span class="mx-2">Coordinadores</span>
                            </a>
                            <a href="#adminGrupos" class="list-group-item list-group-item-dark text-start fw-semibold" data-bs-parent="#panelG" data-bs-toggle="collapse" aria-controls="adminGrupos" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
                                    <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                                </svg>
                                <span class="mx-2">Grupos</span>
                            </a>
                            <a href="#adminParroquias" class="list-group-item list-group-item-dark text-start fw-semibold" data-bs-parent="#panelG" data-bs-toggle="collapse" aria-controls="adminParroquias" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z" />
                                    <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z" />
                                </svg>
                                <span class="mx-2">Parroquias</span>
                            </a>
                            <a href="#adminSacerdotes" class="list-group-item list-group-item-dark text-start fw-semibold" data-bs-parent="#panelG" data-bs-toggle="collapse" aria-controls="adminSacerdotes" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-video2" viewBox="0 0 16 16">
                                    <path d="M10 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                    <path d="M2 1a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2ZM1 3a1 1 0 0 1 1-1h2v2H1V3Zm4 10V2h9a1 1 0 0 1 1 1v9c0 .285-.12.543-.31.725C14.15 11.494 12.822 10 10 10c-3.037 0-4.345 1.73-4.798 3H5Zm-4-2h3v2H2a1 1 0 0 1-1-1v-1Zm3-1H1V8h3v2Zm0-3H1V5h3v2Z" />
                                </svg>
                                <span class="mx-2">Sacerdotes</span>
                            </a>
                            <a href="#adminDiocesis" class="list-group-item list-group-item-dark text-start fw-semibold" data-bs-parent="#panelG" data-bs-toggle="collapse" aria-controls="adminDiocesis" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sunrise-fill" viewBox="0 0 16 16">
                                    <path d="M7.646 1.146a.5.5 0 0 1 .708 0l1.5 1.5a.5.5 0 0 1-.708.708L8.5 2.707V4.5a.5.5 0 0 1-1 0V2.707l-.646.647a.5.5 0 1 1-.708-.708l1.5-1.5zM2.343 4.343a.5.5 0 0 1 .707 0l1.414 1.414a.5.5 0 0 1-.707.707L2.343 5.05a.5.5 0 0 1 0-.707zm11.314 0a.5.5 0 0 1 0 .707l-1.414 1.414a.5.5 0 1 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zM11.709 11.5a4 4 0 1 0-7.418 0H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1h-3.79zM0 10a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 10zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                                </svg>
                                <span class="mx-2">Diócesis</span>
                            </a>
                        </div>
                    </div>

                    <a class="btn btn-outline-light nav-link p-3 mb-1 fs-6 text-center text-dark fw-semibold" href="#informes" data-bs-parent="#panelG" data-bs-toggle="collapse" aria-controls="informes" aria-expanded="false">
                        Informes
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                            <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                        </svg>
                    </a>

                    <a class="btn btn-outline-light nav-link p-3 mb-1 fs-6 text-center text-dark fw-semibold" href="#calificaciones" data-bs-parent="#panelG" data-bs-toggle="collapse" aria-controls="calificaciones" aria-expanded="false">
                        Calificaciones
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                            <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                        </svg>
                    </a>

                    <a class="btn btn-outline-light nav-link p-3 mb-1 fs-6 text-center text-dark fw-semibold" href="#proyectos" data-bs-parent="#panelG" data-bs-toggle="collapse" aria-controls="proyectos" aria-expanded="false">
                        Proyectos
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                            <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                        </svg>
                    </a>

                    <a class="btn btn-outline-light nav-link p-3 mb-1 fs-6 text-center text-dark fw-semibold" href="#ayuda" data-bs-parent="#panelG" data-bs-toggle="collapse" aria-controls="ayuda" aria-expanded="false">
                        Ayuda
                    </a>
                </nav>
            </div>

            <!--Blackboard-->
            <div class="col p-0 bg-white rounded-3" style="--bs-bg-opacity: .9;">
                <div class="row">

                    <!--Panel Bienvenida-->
                    <div class="collapse multi-collapse show" data-bs-parent="#panelG" id="inicio">
                        <div class="container">
                            <div class="row align-items-center justify-content-center my-5">
                                <div class="col-auto">
                                    <img style="width:200px;" src="../images/logoespac.png" alt="logoEspac">
                                </div>
                            </div>
                            <div class="row align-items-center justify-content-center my-2">
                                <div class="col-auto">
                                    <h1>Bienvenido al SIGA - ESPAC</h1>
                                </div>
                            </div>
                            <div class="row align-items-center justify-content-center mt-2 mb-5 pb-5">
                                <div class="col-auto">
                                    <h3>Seleccione en el panel lateral la acción a realizar</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Panel Administracion-->
                    <div data-bs-parent="#panelG">
                        <!--Panel Catequistas-->
                        <div class="collapse multi-collapse" data-bs-parent="#panelG" id="adminCatequista">
                            <div class="container">

                                <div class="row align-items-center mt-4 mb-2">
                                    <div class="col-11">
                                        <h3>Gestión de Catequistas</h3s>
                                    </div>

                                    <div class="col-auto">
                                        <button class="btn btn-outline-danger px-3 py-2" onclick="window.location.reload();">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                                <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="row align-items-center justify-content-center">
                                    <div class="col-auto">
                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle me-2" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                            </svg>
                                            A continuación, por favor, ingrese primer apellido, cédula del Catequista o seleccione la parroquia a la que pertenece el Catequista!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row align-items-center justify-content-center">
                                    <form id="getCatequistasAdmin" class="row justify-content-center">
                                        <div class="col-3">
                                            <input id="apellidoCatequista" name="apellidoCatequista" type="text" class="form-control" placeholder="Ingrese apellido">
                                        </div>
                                        <div class="col-3">
                                            <input id="cedulaCatequista" name="cedulaCatequista" type="text" class="form-control" placeholder="Ingrese C.C. del Catequista">
                                        </div>
                                        <div class="col-4">
                                            <select class="form-select" aria-label="selectParroquia" name="parroquia" id="parroquia">
                                                <option disabled selected value=0>Seleccione la Parroquia del Catequista:</option>
                                                <?php
                                                require '../database.php';
                                                $result = $conn->query("SELECT idParroquia, nombreParroquia FROM parroquia");
                                                $numfilas = $result->num_rows;
                                                for ($i = 0; $i < $numfilas; $i++) {
                                                    $aux = $result->fetch_object();
                                                    echo '<option value="' . $aux->idParroquia . '">Parroquia ' . $aux->nombreParroquia . '</option>';
                                                }
                                                mysqli_close($conn);
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-secondary" onclick="consultaCatequistasAdmin();">Buscar</button>
                                            <button type="button" class="btn btn-secondary">Añadir</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="row align-items-center justify-content-center" id="consultaCatequistasAdminPane">

                                </div>

                            </div>
                        </div>

                        <!--Panel Coordinadores-->
                        <div class="collapse multi-collapse" data-bs-parent="#panelG" id="adminCoordinadores">
                            <div class="container">
                                <div class="row align-items-center justify-content-left mt-3">
                                    <div class="col-auto">
                                        <h3>Administración de Información</h3>
                                    </div>
                                </div>
                                <div class="row align-items-center justify-content-left mt-2">
                                    <div class="col-auto">
                                        <p class="fs-5 mx-3">
                                            A continuación por favor seleccione el rol que desea administrar:
                                        </p>
                                    </div>
                                </div>
                                <div class="row align-items-center justify-content-left mt-3">
                                    <div class="col-auto mx-5">
                                        <div class="row my-5">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <img class="d-inline" src="../images/iconos/catequista.png" alt="Catequista">
                                                <p class="d-inline fs-4">Catequista</p>
                                            </button>
                                        </div>
                                        <div class="row my-5">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <img class="d-inline" src="../images/iconos/parroquia.png" alt="Catequista">
                                                <p class="d-inline fs-4">Parroquia</p>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-auto mx-5">
                                        <div class="row">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <p class="fs-4">Coordinador</p>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <p class="fs-4">Sacerdote</p>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="row">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <p class="fs-4">Grupo</p>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <p class="fs-4">Diócesis</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Panel Grupos-->
                        <div class="collapse multi-collapse" data-bs-parent="#panelG" id="adminGrupos">
                            <div class="container">
                                <div class="row align-items-center justify-content-left mt-3">
                                    <div class="col-auto">
                                        <h3>Administración de Información</h3>
                                    </div>
                                </div>
                                <div class="row align-items-center justify-content-left mt-2">
                                    <div class="col-auto">
                                        <p class="fs-5 mx-3">
                                            A continuación por favor seleccione el rol que desea administrar:
                                        </p>
                                    </div>
                                </div>
                                <div class="row align-items-center justify-content-left mt-3">
                                    <div class="col-auto mx-5">
                                        <div class="row my-5">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <img class="d-inline" src="../images/iconos/catequista.png" alt="Catequista">
                                                <p class="d-inline fs-4">Catequista</p>
                                            </button>
                                        </div>
                                        <div class="row my-5">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <img class="d-inline" src="../images/iconos/parroquia.png" alt="Catequista">
                                                <p class="d-inline fs-4">Parroquia</p>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-auto mx-5">
                                        <div class="row">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <p class="fs-4">Coordinador</p>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <p class="fs-4">Sacerdote</p>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="row">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <p class="fs-4">Grupo</p>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <p class="fs-4">Diócesis</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Panel Parroquias-->
                        <div class="collapse multi-collapse" data-bs-parent="#panelG" id="adminParroquias">
                            <div class="container">
                                <div class="row align-items-center justify-content-left mt-3">
                                    <div class="col-auto">
                                        <h3>Administración de Información</h3>
                                    </div>
                                </div>
                                <div class="row align-items-center justify-content-left mt-2">
                                    <div class="col-auto">
                                        <p class="fs-5 mx-3">
                                            A continuación por favor seleccione el rol que desea administrar:
                                        </p>
                                    </div>
                                </div>
                                <div class="row align-items-center justify-content-left mt-3">
                                    <div class="col-auto mx-5">
                                        <div class="row my-5">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <img class="d-inline" src="../images/iconos/catequista.png" alt="Catequista">
                                                <p class="d-inline fs-4">Catequista</p>
                                            </button>
                                        </div>
                                        <div class="row my-5">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <img class="d-inline" src="../images/iconos/parroquia.png" alt="Catequista">
                                                <p class="d-inline fs-4">Parroquia</p>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-auto mx-5">
                                        <div class="row">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <p class="fs-4">Coordinador</p>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <p class="fs-4">Sacerdote</p>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="row">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <p class="fs-4">Grupo</p>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <p class="fs-4">Diócesis</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Panel Diocesis-->
                        <div class="collapse multi-collapse" data-bs-parent="#panelG" id="adminDiocesis">
                            <div class="container">
                                <div class="row align-items-center justify-content-left mt-3">
                                    <div class="col-auto">
                                        <h3>Administración de Información</h3>
                                    </div>
                                </div>
                                <div class="row align-items-center justify-content-left mt-2">
                                    <div class="col-auto">
                                        <p class="fs-5 mx-3">
                                            A continuación por favor seleccione el rol que desea administrar:
                                        </p>
                                    </div>
                                </div>
                                <div class="row align-items-center justify-content-left mt-3">
                                    <div class="col-auto mx-5">
                                        <div class="row my-5">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <img class="d-inline" src="../images/iconos/catequista.png" alt="Catequista">
                                                <p class="d-inline fs-4">Catequista</p>
                                            </button>
                                        </div>
                                        <div class="row my-5">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <img class="d-inline" src="../images/iconos/parroquia.png" alt="Catequista">
                                                <p class="d-inline fs-4">Parroquia</p>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-auto mx-5">
                                        <div class="row">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <p class="fs-4">Coordinador</p>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <p class="fs-4">Sacerdote</p>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="row">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <p class="fs-4">Grupo</p>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <button type="button" class="btn btn-warning btn-lg">
                                                <p class="fs-4">Diócesis</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Panel Informes-->
                    <div class="collapse multi-collapse" data-bs-parent="#panelG" id="informes">
                        <div class="card card-body">
                            Informes Some placeholder content for the second collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.
                        </div>
                    </div>

                    <!--Panel Calificaciones-->
                    <div class="collapse multi-collapse" data-bs-parent="#panelG" id="calificaciones">
                        <div class="card card-body">
                            Calificaciones Some placeholder content for the second collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.
                        </div>
                    </div>

                    <!--Panel Proyectos-->
                    <div class="collapse multi-collapse" data-bs-parent="#panelG" id="proyectos">
                        <div class="card card-body">
                            Proyectos Some placeholder content for the second collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.
                        </div>
                    </div>

                    <!--Panel Ayuda-->
                    <div class="collapse multi-collapse" data-bs-parent="#panelG" id="ayuda">
                        <div class="card card-body">
                            Ayuda Some placeholder content for the second collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>