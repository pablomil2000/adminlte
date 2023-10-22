<?php

include_once('class/crud.php');


class Pagination extends Crud
{
    protected $tabla;
    private $porPag;
    private $page;
    private $numPages;
    private $numProductos;

    public function __construct($tabla, $porPag, $page, $datos = array())
    {
        $this->tabla = $tabla;
        $this->porPag = $porPag;
        $this->page = $page;

        $this->numProductos = count($this->getById($datos));
        $this->numPages = (int) ceil(intval($this->numProductos) / intval($this->porPag));
        $this->page = $this->vlt_Page($page);
    }

    private function vlt_Page($page)
    {
        // var_dump($page);
        if ($page < 0) {
            $page = 0;
        } elseif ($page > $this->numPages) {
            $page = $this->numPages;
        }

        return $page;
    }

    public function getLimit()
    {
        $productoInicio = $this->page * $this->porPag;
        // var_dump($this->page);
        $limit = " limit $productoInicio, $this->porPag ";
        return $limit;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function previus()
    {
        if ($this->page == 0) {
            return 1;
        }

        return $this->page;
    }

    public function next()
    {
        if ($this->page + 2 > $this->numPages) {
            return $this->page + 1;
        }

        return $this->page + 2;
    }
}
