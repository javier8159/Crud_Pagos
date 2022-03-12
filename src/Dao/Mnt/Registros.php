<?php

namespace Dao\Mnt;
use Dao\Table;

class Registros extends Table
{
    public static function obtenerTodos()
    {
        $sqlstr = "select * from registros;";
        return self::obtenerRegistros(
            $sqlstr,
            array()
        );
    }
    public static function obtenerPorId($id)
    {
        $sqlstr = "select * from registros where id=:id;";
        return self::obtenerUnRegistro(
            $sqlstr,
            array("id"=>$id)
        );
    }

    public static function nuevaRegistro($identidad, $nombre, $edad)
    {
        $sqlstr= "INSERT INTO registros (identidad, nombre, edad) values (:identidad, :nombre, :edad);";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "identidad"=>$identidad,
                "nombre"=>$nombre,
                "edad"=>$edad
            )
        );
    }

    public static function actualizarRegistro( $identidad, $nombre, $edad, $id)
    {
        $sqlstr = "UPDATE registros set identidad=:identidad, nombre=:nombre, edad=:edad where id=:id";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "identidad"=> $identidad,
                "nombre"=> $nombre,
                "edad"=>$edad,
                "id"=>$id
            )
        );
    }
    public static function eliminarRegistro($id)
    {
        $sqlstr = "DELETE FROM registros where id=:id;";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "id"=>$id
            )
        );
    }
}


?>