<?php
/*****************************************************  INFO DEL ARCHIVO
 * Creado por: 	Pedro E. Arrioja M.
 * Descripción: Esta pagina brinda las funciones comunes de autenticacion y de
 *              permisos relacionados con los usuarios del sistema, la
 *              información relevante de los mismos, se almacena en variables
 *              de sesión.
 *****************************************************  FIN DE INFO
*/

/* Función que permite la validación del nombre de usuario y clave
 * proporcionada al momento de la autenticación.
 */
function validar($username,$password,$sender)
{
    $password=substr(MD5($password), 0, 200);

        $sql="select u.cedula, u.nombres, u.apellidos, u.login, u.email, u.tipo_usuario
                from usuarios u
                WHERE ((u.login = '$username') and (u.clave = '$password'))";
        $resultado=cargar_data($sql,$sender);

        if (empty($resultado) == false)
            { return $resultado; }
        else
            { return null; }
}

/* Esta funcion permite realizar el llenado de la variable usuario en forma de
 * arreglo en la session una vez que los datos de usuario y clave han sido
 * debidamente validados.
 */
function login_usuario($username,$password,$sender)
{
    $usuario_validado = validar($username,$password,$sender);
   // if (!($usuario_validado == null))
    if (empty($usuario_validado) == false)
    {
        $sesion=new THttpSession;
        $sesion->open();
        $sesion['quiniela_login']=$usuario_validado[0]['login'];
        $sesion['quiniela_cedula']=$usuario_validado[0]['cedula'];
        $sesion['quiniela_email']=$usuario_validado[0]['email'];
        $sesion['quiniela_nombre']=$usuario_validado[0]['nombres'];
        $sesion['quiniela_apellido']=$usuario_validado[0]['apellidos'];
        $sesion['quiniela_tipo_usuario']=$usuario_validado[0]['tipo_usuario'];
        $sesion->close();
        return true;
    }                                   
    else
    { return false; }
}

/* Esta función se encarga de realizar el deslogueo del usuario del sistema
 * limpia las variables que la sesion se encuentre usando y al final la
 * destruye para mayor seguridad.
 */
function logout_usuario($objeto_local)
{
    /* Se incluye el rastro en el archivo de bitácora */
//    $descripcion_log = "Salida del sistema.";
//    inserta_rastro(usuario_actual('login'),usuario_actual('cedula'),'L',$descripcion_log,"",$objeto_local);
    $sesion = new THttpSession;
    $sesion->open();
    $sesion->clear();
    $sesion->close();
    $sesion->destroy();
    $objeto_local->Response->redirect($objeto_local->Service->constructUrl('Home'));
    return true;
}

/* Esta función se encarga de brindar una comprobación genérica de que el usuario
 * haya realizado un logueo en el sistema, si no lo ha hecho, simplemente se
 * redirecciona a la pagina de login.
 */
function comprueba_sesion($this2)
{
    $sesion = new THttpSession;
    $sesion->open();
    if (!isset($sesion['quiniela_login']))
    {
        $this2->Response->redirect($this2->Service->constructUrl('admin.login'));
    }
    $this2->lbl_usuario_top->Text=$sesion['quiniela_login'];
    $sesion->close();
}

/* Esta función se encarga de retornar la información del usuario actualmente
 * logeado en el sistema para no tener que abrir extraer y cerrar sesiones cada
 * vez que se necesita en las páginas, sino que se hace siempre desde aqui.
 * Ejemplo: $login = usuario_actual('login');
 * Los valores que acepta la variable "request" están definidos en la función
 * login_usuario
 */
function usuario_actual($request)
{
    $sesion=new THttpSession;
    $sesion->open();
    $request = "quiniela_".$request;
    if (!isset($sesion['quiniela_login']))
    {
        return null;
    }
    else
    {
        $valor_a_devolver = $sesion[$request];
    }
    $sesion->close();
    return $valor_a_devolver;
}



?>
