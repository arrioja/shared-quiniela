<?php
/*   ****************************************************  INFO DEL ARCHIVO
  Creado por:   Pedro E. Arrioja M.
  Descripción:  Este archivo implementa la inclusión de usuarios en el sistema.
     ****************************************************  FIN DE INFO
*/

class incluir_usuarios extends TPage
{
    public function onLoad($param)
    {
        parent::onLoad($param);
        if(!$this->IsPostBack)
          {

          }
    }


    /* Comprueba que la cedula introducida no exista en la base de datos. */
    public function validar_cedula($sender, $param)
    {
        $param->isValid = true;
        $cedula=$this->txt_cedula->Text;
        $sql="select cedula from usuarios where cedula='$cedula'";
        $datos=cargar_data($sql,$sender);
        $param->isValid = empty($datos);
    }

    /* Comprueba que la cedula introducida no exista en la base de datos. */
    public function validar_login($sender, $param)
    {
        $param->isValid = true;
        $login=$this->txt_login->Text;
        $sql="select login from usuarios where login='$login'";
        $datos=cargar_data($sql,$sender);
        $param->isValid = empty($datos);
    }

    /* Se incluyen los datos del nuevo usuario en la base */
	public function btn_incluir_click($sender, $param)
	{
        if ($this->IsValid)
        {
            // Se capturan los datos provenientes de los Controles
            $cedula = $this->txt_cedula->Text;
            $nombre = $this->txt_nombre->Text;
            $apellido = $this->txt_apellido->Text;
            $telefono1 = $this->txt_telefono_hab->Text;
            $telefono2 = $this->txt_telefono_cel->Text;
            $login = $this->txt_login->Text;
            $login_referido = $this->txt_login_referido->Text;
            $clave=substr(MD5($this->txt_clave->Text), 0, 200);
            $email = $this->txt_email->Text;
            
            /* Se guardan los datos del usuario. */
            $sql="insert into usuarios (login, clave, cedula, nombres, apellidos, email, telefono1, telefono2, login_referido)
                  values ('$login','$clave','$cedula','$nombre','$apellido','$email','$telefono1','$telefono2','$login_referido')";
            $resultado=modificar_data($sql,$sender);

            $this->Response->redirect($this->Service->constructUrl('admin.login'));
        }
 	}
}

?>
