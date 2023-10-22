<?php
Funciones::isLogin('admin', 'login');

$Usuarios = new UserCtrl('usuarios');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // var_dump($_POST);
    if (isset($_POST['editUsuario'])) {

        if ($Usuarios->editUsuario()) {
            Funciones::sweetAlert2(array('icon' => 'success', 'title' => 'Datos Actualizados', 'text' => ''));
        } else {
            Funciones::sweetAlert2(array('icon' => 'error', 'title' => 'No se a actializado el usuario', 'text' => ''));
        }
    } elseif (isset($_POST['nuevoUsuario'])) {
        $Usuarios->newUsuario();
    }
}

$users = $Usuarios->getAll();

include('views/partials/usuarios.view.php');
