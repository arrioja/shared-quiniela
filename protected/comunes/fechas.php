<?php
/*
****************************************************  INFO DEL ARCHIVO
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Funciones principalmente relacionadas con el manejo de
 *                      fechas y horas, tengan o no que ver con base de datos,
 *                      son funciones de uso comun, pero generalmente usadas por
 *                      los modulos del sistema de asistencias.
****************************************************  FIN DE INFO
 */

/* Esta función cambia una fecha en formato normal dd/mm/aaaa a un formato que
 * sea aceptado por MySql aaaa-mm-dd.
 * Carlos Avila
 */
function cambiaf_a_mysql($fecha)
{
    ereg("([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
    return $lafecha;
}

/* Esta función cambia una fecha en formato aceptado por MySql aaaa-mm-dd a un
 * formato normal dd/mm/aaaa.
 * Carlos Avila
 */
function cambiaf_a_normal($fecha)
{
    ereg("([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
    return $lafecha;
}

?>