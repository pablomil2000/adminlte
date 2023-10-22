<?php
require_once('../../controllers/crud.controller.php');
require_once('../../models/crud.model.php');
require_once('../../models/conexion.model.php');

require_once('../../controllers/usuarios.controller.php');



class AjaxUsuarrios
{
    public $idUsuario;

    public function editarEstado($vec)
    {
        $campo = "estado";
        $id = $this->idUsuario;

        $editarUsuario = new UserCtrl('usuarios');

        $estado = $vec['estado'];
        if ($estado == 1) {
            $estado = 0;
        } else {
            $estado = 1;
        }

        $respuesta = $editarUsuario->update(array('estado' => $estado), $id);
        echo json_encode($respuesta);
    }
}

if (isset($_POST['estado'])) {
    echo "<script>alert('aaaaaaaaaaa')</script>";
    $editar = new AjaxUsuarrios();
    $editar->idUsuario = $_POST['idUsuario'];
    $editar->editarEstado($_POST);
}
