<?php

class Funciones
{

    static public function encript($str, $algor = 'sha512')
    {
        return hash($algor, $str);
    }

    static public function isLogin($name = 'user', $redirect = 'home')
    {
        if (!isset($_SESSION[$name])) {
            header('location:' . $redirect);
        }

        return true;
    }


    static public function dateFormat($fecha, $formato = 'd/m/Y')
    {
        return date($formato, strtotime($fecha));
    }

    // Funciones::sweetAlert2(array('icon' => 'error', 'title' => 'Datos Incorrectos', 'text' => 'Los datos de usuario no son correctos', 'redirect' => 'login'));
    static public function sweetAlert2($datos)
    {
?>
        <script>
            Swal.fire({
                icon: '<?= $datos['icon'] ?>',
                title: '<?= $datos['title'] ?>',
                text: '<?= $datos['text'] ?>',

            }).then((result) => {
                <?php
                if (isset($datos['redirect'])) {
                ?>
                    window.location.href = "<?= $datos['redirect'] ?>";
                <?php
                }
                ?>
            })
        </script>
    <?php
    }


    static public function esImg($img)
    {
        if (getimagesize($img)) {
            return true;
        }
        return false;
    }

    static public function subirImg($ruta, $nombre, $nombreCampo = "img")
    {
        var_dump($nombre);
        if (!empty($_FILES[$nombreCampo]['tmp_name'])) {
            if (Funciones::esImg($_FILES[$nombreCampo]['tmp_name'])) {

                $img = $nombre . '.png';

                //mover img a la carpeta que le toca
                move_uploaded_file($_FILES[$nombreCampo]['tmp_name'], $ruta . $img);

                return $img;
            }
        }
        return "default.png";
    }

    static function JsRedirect($ruta = 'home')
    {
    ?>

        <script>
            window.location.href = "<?= $ruta ?>";
        </script>


<?php
    }
}
