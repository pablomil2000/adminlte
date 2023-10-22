<?php

$users = new UserCtrl('usuarios');

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $user = $users->getById(array('id' => $id));

    $estado = $user[0]['estado'];

    if ($estado) {
        $estado = 0;
    } else {
        $estado = 1;
    }

    $datos = array('estado' => $estado);
    $users->update($datos, $id);
}

Funciones::JsRedirect('usuarios');
