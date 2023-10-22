<?php

require_once('../../controllers/crud.controller.php');
require_once('../../models/crud.model.php');
require_once('../../models/conexion.model.php');

require_once('../../controllers/usuarios.controller.php');
// require_once('models/usuarios.model.php');


class AjaxUsuarrios
{
    public $idUsuario;

    public function ajaxEditarUsuario()
    {
        $campo = "id";
        $valor = $this->idUsuario;

        $editarUsuario = new UserCtrl('usuarios');


        $respuesta = $editarUsuario->getById(array($campo => $valor));

        // var_dump($respuesta);
        echo json_encode($respuesta[0]);
    }
}


if (isset($_POST['idUsuario'])) {
    $editar = new AjaxUsuarrios();
    $editar->idUsuario = $_POST['idUsuario'];

    $editar->ajaxEditarUsuario();
}
