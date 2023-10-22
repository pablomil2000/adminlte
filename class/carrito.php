<?php

require_once('controllers/crud.controller.php');

class Carrito extends CrudCtrl
{
    protected $tabla;
    protected $carro = array();

    public function __construct($tabla)
    {
        $this->tabla = $tabla;

        if (isset($_SESSION['carrito'])) {
            $this->carro = $_SESSION['carrito'];
        } else {
            $this->carro = array();
        }
    }

    public function getCarrito($carrito)   //*Sacar todos los productos de un carrito
    {
        $claves = array_keys($carrito);
        $valores = "(" . implode(",", $claves) . ")";

        if (!empty($claves)) {
            $resultado = $this->getByField($this->tabla, $valores, 'isbn');
            return $resultado;
        }

        return array();
    }

    public function datosCarrito($carrito)
    {
        if (!empty($carrito)) {
            $carro = $this->getCarrito($carrito);
            $datos['total'] = 0;    //Importe
            $datos['NumArticulos'] = 0; //NUmero de articulos diferentes iguales o distintes
            foreach ($carro as $producto) {
                $datos['NumArticulos'] += $carrito[$producto['isbn']];
                $datos['total'] += $producto['precio'] * $carrito[$producto['isbn']];
            }
            $datos['numProducts'] = count($carrito);    //Numero de articuos diferentes
            return $datos;
        }

        return array('total' => 0, 'NumArticulos' => 0, 'numProducts' => 0);
    }

    public function __get($name)
    {
        return $this->$name;
    }
}
