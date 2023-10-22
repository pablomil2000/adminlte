<?php
session_start();

// $_SESSION['user'] = 1;

//? Clases
require_once('class/carrito.php');
require_once('class/funciones.php');
// require_once('class/pagination.php');
require_once('class/validar.php');


//? controllers
require_once('controllers/crud.controller.php');
require_once('controllers/usuarios.controller.php');
require_once('controllers/plantilla.controller.php');

//? Modelos
require_once('models/conexion.model.php');
require_once('models/crud.model.php');
require_once('models/usuarios.model.php');


PlantillaCtr::load();
