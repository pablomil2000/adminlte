<?php

class PlantillaCtr
{
    static public function load()
    {
        require_once('views/template.view.php');
    }

    static public function whiteList(...$validas)
    {
        $validas[] = 'inicio';

        $ruta = 'inicio';

        if (isset($_GET['ruta'])) {
            $ruta = Validar::vlt_String($_GET['ruta']);

            // var_dump($ruta);


            if (!in_array($ruta, $validas)) {
                $ruta = '404';
            }
        }

        // var_dump($ruta);

        require_once('views/modules/' . $ruta . '.php');
        return $ruta;
    }
}
