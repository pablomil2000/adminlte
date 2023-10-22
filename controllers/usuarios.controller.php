<?php

class UserCtrl extends CrudCtrl
{
    public function login()
    {
        $usuario = Validar::vlt_String($_POST['usuario']);
        $password = Funciones::encript($_POST['password']);
        // $password = $_POST['password'];

        if ($usuario != '' && $password != '') {
            $resultado = $this->getById(array('usuario' => $usuario));
            if (!empty($resultado)) {
                $resultado = $this->getById(array('usuario' => $usuario, 'password' => $password));
            }

            // var_dump($resultado);

            if (!empty($resultado)) {

                if ($resultado[0]['estado']) {
                    $_SESSION['admin'] = $resultado['0']['perfil'];
                    header('location:inicio');
                    return $resultado[0]['id'];
                }
            }
            return false;
        }
    }

    public function newUsuario()
    {
        $nombre = Validar::vlt_String($_POST['nuevoNombre']);
        $usuario = Validar::vlt_String($_POST['nuevoUsuario']);
        $password = Funciones::encript($_POST['nuevoPassword']);
        $perfil = $_POST['nuevoPerfil'];

        $user = $this->getById(array('usuario' => $usuario));   //*Usuarios repetidos?
        // var_dump($user);

        if (empty($user)) {
            if ($nombre != '' && $usuario != '' && $perfil != '' && $password != '') {
                $img = "default.png";


                $ruta = '';
                // var_dump($_FILES);
                if (isset($_FILES['nuevaFoto']['tmp_name']) && $_FILES['nuevaFoto']['tmp_name'] != '') {
                    list($ancho, $alto) = getimagesize($_FILES['nuevaFoto']['tmp_name']);

                    $nuevoAncho = 350;
                    $nuevoAlto = 350;

                    $directorio = "views/dist/img/users/" . $usuario;
                    // var_dump($directorio);
                    mkdir($directorio, 0755);

                    if ($_FILES['nuevaFoto']['type'] == 'image/jpeg') {
                        $ruta = $directorio . "/" . $_POST["nuevoUsuario"] . ".jpg";
                        $img = $_POST["nuevoUsuario"] . "/" . $_POST["nuevoUsuario"] . ".jpg";

                        // var_dump($ruta);

                        $origen = imagecreatefromjpeg($_FILES['nuevaFoto']['tmp_name']);    //!para que funcion tienes que descomentar "extension=gd" en php.ini
                        $destino = imagecreatetrueColor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destino, $ruta);
                    } else {
                        $ruta = $directorio . "/" . $_POST["nuevoUsuario"] . ".png";
                        $img = $_POST["nuevoUsuario"] . "/" . $_POST["nuevoUsuario"] . ".png";

                        // var_dump($ruta);

                        $origen = imagecreatefrompng($_FILES['nuevaFoto']['tmp_name']);    //!para que funcion tienes que descomentar "extension=gd" en php.ini
                        $destino = imagecreatetrueColor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destino, $ruta);
                    }
                }


                // $ruta = "views/dist/img/users/";
                // $img = "default.png";
                // if (isset($_FILES["nuevaFoto"]["tmp_name"])) {       //* Con estas 3 lineas puedo guardar la foto pero sin resize
                //     $img = Funciones::subirImg($ruta, $usuario, 'nuevaFoto');
                // }

                $this->insert(array('nombre', 'usuario', 'password', 'perfil', 'foto'), array('nombre' => $nombre, 'usuario' => $usuario, 'password' => $password, 'perfil' => $perfil, 'foto' => $img));    //!Esta comentado porque no quiero 2385284 usuarios
                Funciones::sweetAlert2(array('icon' => 'success', 'title' => 'Usuario guardado', 'text' => 'todos los datos del usuario se han guardado'));
            } else {
                Funciones::sweetAlert2(array('icon' => 'error', 'title' => 'Datos incompletos', 'text' => 'rellena todos los campos'));
            }
        } else {
            Funciones::sweetAlert2(array('icon' => 'error', 'title' => 'Usuario repetido', 'text' => 'Este usuario ya existe'));
        }
    }

    public function editUsuario()
    {
        $id['key'] = 'usuario';
        $id['value'] = Validar::vlt_String($_POST['editUsuario']);

        $datos = array();
        //["editUsuario"]=> string(5) "pablo" ["fotoActual"]=> string(15) "pablo/pablo.jpg"

        if (!empty($_POST['editNombre']) && Validar::vlt_String($_POST['hideNombre']) != Validar::vlt_String($_POST['editNombre'])) {
            $datos['nombre'] = Validar::vlt_String($_POST['editNombre']);
        }

        if (!empty($_POST['editPassword'])) {
            $datos['password'] = Funciones::encript(Validar::vlt_String($_POST['editPassword']));
        }

        if (!empty($_POST['editPerfil'])) {
            $datos['Perfil'] = Validar::vlt_String($_POST['editPerfil']);
        }

        if (!empty($datos)) {
            $this->update($datos, $id);
            return true;
        } else {
            return false;
        }
    }
}
