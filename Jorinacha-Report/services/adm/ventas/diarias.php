<?php


/* OBTENER NOMBRE DE LA BASE DE DATO SELECCIONADA*/


$sedes_ar = array(
    "Previa Shop",
    "Sucursal Caracas I",
    "Sucursal Caracas II",
    "Comercial Corina I",
    "Comercial Corina II",
    "Comercial Punto Fijo",
    "Comercial Matur",
    "Comercial Valena",
    "Comercial Trina",
    "Comercial Kagu",
    "Comercial Nachari",
    "Comercial Higue",
    "Comercial Apura",
    "Comercial Vallepa",
    "Comercial Ojena",
    "Comercial Puecruz",
    "Comercial Acari",
    "Comercial Catica II",
);



function Database2($sede)
{

    $bd = array(
        "Previa Shop" => 'PREVIA_A',
        "Sucursal Caracas I" => 'CARACAS1',
        "Sucursal Caracas II" => 'CARACAS2',
        "Comercial Corina I" => 'CORINA21',
        "Comercial Corina II" => 'CORI2_21',
        "Comercial Punto Fijo" => 'PUFIJO21',
        "Comercial Matur" => 'MATURA21',
        "Comercial Valena" => 'VALENA21',
        "Comercial Trina" => 'TRAINA21',
        "Comercial Kagu" => 'KAGUA21',
        "Comercial Nachari" => 'NACHAR21',
        "Comercial Higue" => 'HIGUE21',
        "Comercial Apura" => 'APURA21',
        "Comercial Vallepa" => 'VALLEP21',
        "Comercial Ojena" => 'OJENA21',
        "Comercial Puecruz" => 'PUECRU21',
        "Comercial Acari" => 'ACARI21',
        "Comercial Catica II" => 'CATICA21',
    );

    return $bd[$sede];
}
function Database($sede)
{

    $bd = array(
        "Previa Shop" => 'PREVIA_A',
        "Sucursal Caracas I" => 'CARACAS1',
        "Sucursal Caracas II" => 'CARACAS2',
        "Comercial Corina I" => 'CORINA1',
        "Comercial Corina II" => 'CORINA2',
        "Comercial Punto Fijo" => 'PUFIJO',
        "Comercial Matur" => 'MATUR',
        "Comercial Valena" => 'VALENA',
        "Comercial Trina" => 'TRINA',
        "Comercial Kagu" => 'KAGU',
        "Comercial Nachari" => 'NACHARI',
        "Comercial Higue" => 'HIGUE',
        "Comercial Apura" => 'APURA',
        "Comercial Vallepa" => 'VALLEPA',
        "Comercial Ojena" => 'OJENA',
        "Comercial Puecruz" => 'PUECRUZ',
        "Comercial Acari" => 'ACARI',
        "Comercial Catica II" => 'CATICA2',
    );

    return $bd[$sede];
}

function Cliente($sede)
{

    $bd = array(
        "Sucursal Caracas I"    =>     'S01',
        "Sucursal Caracas II"    =>     'S02',
        "Comercial Corina I"    =>     'T18',
        "Comercial Corina II"    =>     'T22',
        "Comercial Punto Fijo"    =>     'T13',
        "Comercial Matur"    =>     'T07',
        "Comercial Valena"    =>     'T10',
        "Comercial Trina"    =>     'T16',
        "Comercial Kagu"    =>     'T03',
        "Comercial Nachari"    =>     'T19',
        "Comercial Higue"    =>     'T09',
        "Comercial Apura"    =>     'T17',
        "Comercial Vallepa"    =>     'T06',
        "Comercial Ojena"    =>     'T12',
        "Comercial Puecruz"    =>     'T05',
        "Comercial Acari"    =>     'T04',
        "Comercial Catica II"    =>     'T24',

    );

    return $bd[$sede];
}







/* CONSULTAR ARTICULOS VENDIDOS*/
function getFactura($sede, $fecha1, $fecha2, $data)
{

    $database = Database($sede);
    if ($database != null) {
        try {

            $serverName = "172.16.1.39";
            $connectionInfo = array("Database" => "$database", "UID" => "mezcla", "PWD" => "Zeus33$", "CharacterSet" => "UTF-8");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            if ($data == 'ven') {

                $sql = "SELECT   SUM(reng_fac.total_art) as total_art from reng_fac
                JOIN factura ON factura.fact_num = reng_fac.fact_num
                where anulada=0 AND fec_emis ='$fecha1'";

            }elseif ($data == 'ven2') {

                $sql = "SELECT   SUM(reng_fac.total_art) as total_art from reng_fac
                JOIN factura ON factura.fact_num = reng_fac.fact_num
                where anulada=0 AND fec_emis BETWEEN '$fecha1' AND '$fecha2'";

            }elseif ($data == 'sin') {

                $sql = "SELECT  SUM(tot_neto)  as tot_neto from factura
                where anulada=0 AND fec_emis ='$fecha1'";
            } else {

                $sql = "SELECT  SUM(tot_neto) as tot_neto from factura
                where anulada=0 AND fec_emis BETWEEN '$fecha1' AND '$fecha2'";
            }




            $consulta = sqlsrv_query($conn, $sql);

            if ($consulta != null) {
                while ($row = sqlsrv_fetch_array($consulta)) {

                    $factura['total_art'] = $row['total_art'];
                    $factura['tot_neto'] = $row['tot_neto'];
                    break;
                }

                $res = $factura;
            } else {

                $factura['total_art'] = 0;
                $factura['tot_neto'] = 0;

                $res = $factura;
            }

            return $res;
        } catch (\Throwable $th) {

            throw $th;
        }
    } else {

        return 0;
    }
}


function getDev_cli($sede, $fecha1, $fecha2, $data)
{


    $database = Database($sede);
    if ($database != null) {
        try {

            $serverName = "172.16.1.39";
            $connectionInfo = array("Database" => "$database", "UID" => "mezcla", "PWD" => "Zeus33$", "CharacterSet" => "UTF-8");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            if ($data == 'sin') {

                $sql = "SELECT SUM(dev_cli.tot_neto) as tot_neto  from dev_cli 
                WHERE fec_emis ='$fecha1' and dev_cli.anulada =0 ";

            } elseif ($data == 'ven') {

                $sql = "SELECT SUM(total_art) as total_art  from dev_cli 
                JOIN reng_dvc ON dev_cli.fact_num = reng_dvc.fact_num
                WHERE fec_emis ='$fecha1' and dev_cli.anulada =0";

             } elseif ($data == 'ven2') {

                $sql = "SELECT SUM(total_art) as total_art  from dev_cli 
                JOIN reng_dvc ON dev_cli.fact_num = reng_dvc.fact_num
                WHERE fec_emis BETWEEN '$fecha1' AND '$fecha2' and dev_cli.anulada =0";

             }else {

                $sql = "SELECT SUM(tot_neto) as tot_neto  from dev_cli 
                WHERE fec_emis BETWEEN '$fecha1' AND '$fecha2' and dev_cli.anulada =0";
            }




            $consulta = sqlsrv_query($conn, $sql);

            if ($consulta != null) {
                while ($row = sqlsrv_fetch_array($consulta)) {

                    $dev_cli['total_art'] = $row['total_art'];
                    $dev_cli['tot_neto'] = $row['tot_neto'];
                    break;
                }

                $res = $dev_cli;
            } else {

                $dev_cli['total_art'] = 0;
                $dev_cli['tot_neto'] = 0;

                $res = $dev_cli;
            }

            return $res;
        } catch (\Throwable $th) {

            throw $th;
        }
    } else {

        return 0;
    }
}



function getDep_caj($sede, $fecha1, $fecha2, $data)
{


    $database = Database($sede);
    if ($database != null) {
        try {

            $serverName = "172.16.1.39";
            $connectionInfo = array("Database" => "$database", "UID" => "mezcla", "PWD" => "Zeus33$", "CharacterSet" => "UTF-8");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            if ($data == 'sin') {

                $sql = "SELECT SUM(total_efec) as  total_efec , SUM(total_tarj) as total_tarj from dep_caj
                WHERE fecha ='$fecha1'";
            } else {

                $sql = "SELECT SUM(total_efec) as  total_efec , SUM(total_tarj) as total_tarj  from dep_caj
                WHERE fecha  BETWEEN '$fecha1' AND '$fecha2'";
            }




            $consulta = sqlsrv_query($conn, $sql);

            if ($consulta != null) {
                while ($row = sqlsrv_fetch_array($consulta)) {

                    $dep_caj['total_efec'] = $row['total_efec'];
                    $dep_caj['total_tarj'] = $row['total_tarj'];
                    break;
                }

                $res = $dep_caj;
            } else {

                $dep_caj['total_efec'] = 0;
                $dep_caj['total_tarj'] = 0;

                $res = $dep_caj;
            }

            return $res;
        } catch (\Throwable $th) {

            throw $th;
        }
    } else {

        return 0;
    }
}




function getMov_ban($sede, $fecha1, $fecha2, $data)
{


    $database = Database($sede);
    if ($database != null) {
        try {

            $serverName = "172.16.1.39";
            $connectionInfo = array("Database" => "$database", "UID" => "mezcla", "PWD" => "Zeus33$", "CharacterSet" => "UTF-8");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            if ($data == 'sin') {

                $sql = "SELECT SUM(monto_h) as monto_h from mov_ban
                WHERE fecha ='$fecha1' AND anulado = 0 AND origen = 'DEP' AND cta_egre='045'";
            } else {

                $sql = "SELECT SUM(monto_h) as monto_h  from mov_ban
                WHERE fecha  BETWEEN '$fecha1' AND '$fecha2' AND anulado = 0 AND origen = 'DEP' AND cta_egre='045'";
            }




            $consulta = sqlsrv_query($conn, $sql);

            if ($consulta != null) {
                while ($row = sqlsrv_fetch_array($consulta)) {

                    $mov_ban['monto_h'] = $row['monto_h'];
                    break;
                }

                $res = $mov_ban;
            } else {

                $mov_ban['monto_h'] = 0;

                $res = $mov_ban;
            }

            return $res;
        } catch (\Throwable $th) {

            throw $th;
        }
    } else {

        return 0;
    }
}




function getOrd_pago($sede, $fecha1, $fecha2, $data)
{


    $database = Database($sede);
    if ($database != null) {
        try {

            $serverName = "172.16.1.39";
            $connectionInfo = array("Database" => "$database", "UID" => "mezcla", "PWD" => "Zeus33$", "CharacterSet" => "UTF-8");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            if ($data == 'sin') {

                $sql = "SELECT SUM(monto) as monto from ord_pago
                JOIN benefici ON benefici.cod_ben = ord_pago.cod_ben
                WHERE fecha ='$fecha1' AND anulada = 0   AND ord_num < 6000000 AND cta_egre ='878'";

            }elseif ($data == 'ven') {

               $sql = "SELECT SUM(monto) as monto from ord_pago
                JOIN benefici ON benefici.cod_ben = ord_pago.cod_ben
                WHERE fecha ='$fecha1' AND anulada = 0 AND benefici.ben_des<>'PREVIA SHOP' AND cta_egre <>'878' AND ord_num < 6000000";

            }elseif ($data == 'ven2') {

                $sql = "SELECT SUM(monto) as monto from ord_pago
                 JOIN benefici ON benefici.cod_ben = ord_pago.cod_ben
                 WHERE fecha BETWEEN '$fecha1' AND '$fecha2'  AND anulada = 0 AND benefici.ben_des<>'PREVIA SHOP' AND cta_egre <>'878' AND ord_num < 6000000";

             }else {

                $sql = "SELECT SUM(monto) as monto from ord_pago
                JOIN benefici ON benefici.cod_ben = ord_pago.cod_ben
                WHERE fecha  BETWEEN '$fecha1' AND '$fecha2' AND anulada = 0  AND ord_num < 6000000 AND cta_egre ='878'";
            }




            $consulta = sqlsrv_query($conn, $sql);

            if ($consulta != null) {
                while ($row = sqlsrv_fetch_array($consulta)) {

                    $ord_pago['monto'] = $row['monto'];

                    break;
                }

                $res = $ord_pago;
            } else {

                $ord_pago['monto'] = 0;

                $res = $ord_pago;
            }

            return $res;
        } catch (\Throwable $th) {

            throw $th;
        }
    } else {

        return 0;
    }
}


function getOrd_pago_inf($sede, $fecha1, $fecha2)
{


    $database = Database($sede);
    if ($database != null) {
        try {

            $serverName = "172.16.1.39";
            $connectionInfo = array("Database" => "$database", "UID" => "mezcla", "PWD" => "Zeus33$", "CharacterSet" => "UTF-8");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            $sql = "SELECT fecha,ord_num,descrip,monto  from ord_pago
            WHERE fecha BETWEEN '$fecha1' AND '$fecha2' AND anulada = 0   AND ord_num < 6000000 AND cta_egre ='878'";

            $consulta = sqlsrv_query($conn, $sql);

            if ($consulta != null) {
                while ($row = sqlsrv_fetch_array($consulta)) {

                    $ord_pago[] = $row;


                }

                $res = $ord_pago;
            } else {

                $ord_pago = 0;

                $res = $ord_pago;
            }

            return $res;
        } catch (\Throwable $th) {

            throw $th;
        }
    } else {

        return 0;
    }
}





function getTasas($sede, $fecha1)
{


    $database = Database($sede);
    if ($database != null) {
        try {

            $serverName = "172.16.1.39";
            $connectionInfo = array("Database" => "$database", "UID" => "mezcla", "PWD" => "Zeus33$", "CharacterSet" => "UTF-8");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            $sql = "SELECT TOP 1 tasa_v from tasas 
            where Convert(char(10), fecha, 111) BETWEEN '$fecha1' AND  '$fecha1'
            ORDER BY fecha DESC";
            
            #$sql = "SELECT TOP 1 tasa_v from tasas 
            #where Convert(char(10), fecha, 111) <= '$fecha1'
            #ORDER BY fecha DESC";

            #$sql = "SELECT TOP 1 tasa_v from tasas 
            #where fecha >= CAST('$fecha1' AS datetime) ";


            $consulta = sqlsrv_query($conn, $sql);

            if ($consulta != null) {
                while ($row = sqlsrv_fetch_array($consulta)) {

                    $tasas['tasa_v'] = $row['tasa_v'];
                    break;
                }

                $res = $tasas;
            } else {

                $tasas['tasa_v'] = 0;

                $res = $tasas;
            }

            return $res;
        } catch (\Throwable $th) {

            throw $th;
        }
    } else {

        return 0;
    }
}





function getFacturaDetalles($sede, $fecha1,$fecha2)
{


    $database = Database($sede);
    if ($database != null) {
        try {

            $serverName = "172.16.1.39";
            $connectionInfo = array("Database" => "$database", "UID" => "mezcla", "PWD" => "Zeus33$", "CharacterSet" => "UTF-8");
            $conn = sqlsrv_connect($serverName, $connectionInfo);

            $sql = "SELECT

            reng_cob.tp_doc_cob,
            reng_cob.doc_num as FACTURA,
            reng_cob.neto,
             
            cobros.cob_num as COBROS,
            cobros.fec_cob,
            
            reng_tip.tip_cob,
            reng_tip.mont_doc,
            reng_tip.cod_caja,
            reng_tip.des_caja
            

            FROM 
            cobros
            JOIN reng_tip ON cobros.cob_num = reng_tip.cob_num
            JOIN reng_cob ON cobros.cob_num = reng_cob.cob_num
            WHERE cobros.anulado=0  AND cobros.fec_cob BETWEEN'$fecha1' AND '$fecha2'";


            $consulta = sqlsrv_query($conn, $sql);

            if ($consulta != null) {
                while ($row = sqlsrv_fetch_array($consulta)) {

                    $cobros[] = $row;


                }

                $res = $cobros;
            } else {

                $cobros = 0;

                $res = $cobros;
            }

            return $res;
        } catch (\Throwable $th) {

            throw $th;
        }
    } else {

        return 0;
    }
}