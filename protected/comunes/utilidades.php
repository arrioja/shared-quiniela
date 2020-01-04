<?php
/*****************************************************  INFO DEL ARCHIVO
 * Creado por: 	Pedro E. Arrioja M. / Carlos A. Ávila P
 * Descripción: Contiene funciones de uso común principalmente relacionadas con
 *              el tratamiento de cadenas de caracteres, fechas, etc.
 *****************************************************  FIN DE INFO
*/

/* Esta función limpia la cadena de caracteres de entrada para que solo queden
 * números en la cadena de salida.
 */
function solo_numeros($cadena)
{
    $numeros = array ('0','1','2','3','4','5','6','7','8','9');
    for ($n = 0; $n < strlen($cadena)  ; $n++)
    {
        if (in_array($cadena[$n],$numeros))
        {
            $solonumeros = $solonumeros.$cadena[$n];
        }
    }
    return $solonumeros;
}


/* Esta función permite llenar con un caracter a la izquierda la cadena o el numero
 * que le haya sido suministrado como parámetro, devuelve tantos caracteres como
 * se le indique concatenado al parámetro de entrada.
 * Pedro Arrioja.
 */
function rellena($entrada,$maximo,$caracter)
{
    $salida = $entrada;
    for ($num = strlen($entrada) ; $num < ($maximo) ; $num++)
    {
        $salida=$caracter.$salida;
    }
    return $salida;
}

/* Esta función permite llenar con un caracter a la derecha la cadena o el numero
 * que le haya sido suministrado como parámetro, devuelve tantos caracteres como
 * se le indique concatenado al parámetro de entrada.
 * Nota Adicional: Se ha realizado una nueva función en vez de modificar la anterior
 * para mantener compatibilidad con el codigo que se haya escrito antes de crear esta
 * nueva funcion.
 * Pedro Arrioja.
 */
function rellena_derecha($entrada,$maximo,$caracter)
{
    $salida = $entrada;
    for ($num = strlen($entrada) ; $num < ($maximo) ; $num++)
    {
        $salida=$salida.$caracter;
    }
    return $salida;
}


?>
