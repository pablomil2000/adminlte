<?php

class CrudMdl
{
    static public function getAll($tabla)
    {
        $sql = "SELECT * FROM " . $tabla;
        $c = Conexion::conectar();

        $resultado = $c->query($sql);

        return $resultado->fetchAll();
    }

    static public function getById($tabla, $datos)
    {
        if (empty($datos)) {
            $datos = array('id' => '%');
        }

        $sql = "SELECT * FROM $tabla WHERE ";
        $c = Conexion::conectar();

        foreach ($datos as $key => $value) {
            $sql .= " $key LIKE :$key AND ";
            $datos2[':' . $key] = $value;
        }
        $sql = substr($sql, 0, -4);

        // var_dump($sql);

        $stmt = $c->prepare($sql);
        $stmt->execute($datos2);

        return $stmt->fetchAll();
    }

    static public function getByField($tabla, $datos, $campo)
    {
        $sql = "SELECT * FROM $tabla WHERE $campo in $datos";
        $c = Conexion::conectar();

        // var_dump($sql);
        $stmt = $c->query($sql);

        return $stmt->fetchAll();
    }

    static public function rawSql($tabla, $where = '', $order = '', $limit = '')
    {
        $c = Conexion::conectar();
        $sql = "SELECT * FROM $tabla " . $where . ' ' . $order . ' ' . $limit;
        // var_dump($sql);
        $query = $c->query($sql);
        return $query->fetchAll();
    }

    static public function insert($tabla, $campos, $datos)
    {
        $c = Conexion::conectar();
        $tabla = $tabla;

        $sql = "INSERT INTO $tabla ";
        $fields = implode(', ', $campos);
        $str = implode("', '", $datos);

        $datos = "'" . $str . "'";  //Ajusto la cadena para que sea correcta

        $sql .= "($fields)";
        $sql .= " VALUES ($datos)";

        if ($c->exec($sql)) {
            return $c->lastInsertId();
        }

        return false;
    }

    static public function update($tabla, $datos, $id)
    {

        $c = Conexion::conectar();
        $sql = "UPDATE $tabla SET ";


        foreach ($datos as $campo => $value) {
            $sql .= "$campo = '$value', ";
        }

        $sql = rtrim($sql, ", ") . " ";

        if (is_array($id)) {
            $sql .= "WHERE " . $id['key'] . " = '" . $id['value'] . "'";
        } else {
            $sql .= "WHERE id = '$id'";
        }

        return $c->exec($sql);
    }

    static public function delete($tabla, $datos)
    {
        $c = Conexion::conectar();
        $sql = "DELETE FROM $tabla WHERE id in ($datos)";     //? PDO no me deja pasarlo los parametros entre parentesis?
        // var_dump($datos);
        $stmt = $c->prepare($sql);
        // var_dump($sql);
        // var_dump($datos);
        // $stmt->bindValue(':datos', $datos);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
