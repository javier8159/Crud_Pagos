<?php

namespace Dao\Mnt;
use Dao\Table;

class Pagos extends Table
{
    public static function obtenerTodos()
    {
        $sqlstr = "select * from intentopagos;";
        return self::obtenerRegistros(
            $sqlstr,
            array()
        );
    }
    public static function obtenerPoripId($ipid)
    {
        $sqlstr = "select * from intentopagos where ipid=:ipid;";
        return self::obtenerUnRegistro(
            $sqlstr,
            array("ipid"=>$ipid)
        );
    }

    public static function nuevoPago($cliente, $monto,$fecha_vencimiento,$estado)
    {
        $sqlstr= "INSERT INTO intentopagos (cliente, monto,fecha_vencimiento,estado) 
        values (:cliente,:monto,:fecha_vencimiento,:estado);";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "cliente"=>$cliente,
                "monto"=>$monto,
                "fecha_vencimiento"=>$fecha_vencimiento,
                "estado"=>$estado
            )
        );
    }

    public static function actualizarPago($ipid,$cliente, $monto,$fecha_vencimiento,$estado)
    {
        $sqlstr = "UPDATE intentopagos set cliente=:cliente, monto=:monto,fecha_vencimiento=:fecha_vencimiento,estado = :estado where ipid=:ipid";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "cliente"=>$cliente,
                "monto"=>$monto,
                "fecha_vencimiento"=>$fecha_vencimiento,
                "estado"=>$estado,
                "ipid"=>$ipid
            )
        );
    }
    public static function eliminarPago($ipid)
    {
        $sqlstr = "DELETE FROM intentospagos where ipid=:ipid;";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "ipid"=>$ipid
            )
        );
    }
}


?>