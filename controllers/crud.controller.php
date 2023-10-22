<?php

class CrudCtrl
{
    protected $tabla;

    public function __construct($tabla)
    {
        $this->tabla = $tabla;
    }

    public function getAll()
    {
        return CrudMdl::getAll($this->tabla);
    }

    public function getById($datos)
    {
        return CrudMdl::getById($this->tabla, $datos);
    }

    public function getByField($datos, $campo = "id") //!El cuarto parametro solo si el campo de la tabla no es id
    {
        return CrudMdl::getByField($this->tabla, $datos, $campo);
    }

    public function rawSql($where = '', $order = '', $limit = '')
    {
        return CrudMdl::rawSql($this->tabla, $where, $order, $limit);
    }

    public function insert($campos, $datos)    //!Auto Insert dos array
    {
        return CrudMdl::insert($this->tabla, $campos, $datos);
    }

    public function update($datos, $id)
    {
        return CrudMdl::update($this->tabla, $datos, $id);
    }

    function delete($datos)
    {
        return CrudMdl::delete($this->tabla, $datos);
    }
}
