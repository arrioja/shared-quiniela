<?php
/*   ****************************************************  INFO DEL ARCHIVO
  Creado por:   Pedro E. Arrioja M.
  Descripción:  Este archivo implementa una vía de comunicación entre los internautas y
 *              los administradores de MercadoPana.com
     ****************************************************  FIN DE INFO
*/

class contactos extends TPage
{
    public function onLoad($param)
    {
        parent::onLoad($param);
    }

    /* Se incluyen los datos del nuevo usuario en la base */
	public function btn_incluir_click($sender, $param)
	{
        if ($this->IsValid)
        {
            // configuración básica del mail en php-
            $email_to = 'parrioja@yemaya.com.ve';
            $subject = 'Comentario desde mercadopana.com';
            // receive variables from mail_form.html
            $nombre = $this->txt_nombre->Text;
            $email_dir = $this->txt_email->Text;
            $comentario = $this->txt_comentario->Text;
            $message .= "--------INICIO DEL CORREO---------\n";
            $message = "Nombre:      " . $nombre . "\n";
            $message .= "Email:      " . $email_dir . "\n\n";
            $message .= "-  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -\n";
            $message .= "Comentario:      " . $comentario . "\n";
            $message .= "--------FIN DEL CORREO---------\n";

            if ( mail($email_to , $subject , $message ) ) 
            {
//                $parent->LTB->imagen->Imageurl = "imagenes/botones/check_bien.png";
//                $parent->LTB->texto->Text = "Gracias por comunicarse con nosotros, su ".
//                                          "opinión es muy importante, si ha proporcionado ".
//                                          "su dirección de email, le responderemos a la brevedad.";
            } else {
//                $parent->LTB->imagen->Imageurl = "imagenes/botones/advertencia.png";
//                $parent->LTB->texto->Text = "Lamentablemente su mensaje no ha podido ser enviado, ".
//                                          "por favor, inténtelo mas tarde o envíelo directamente ".
//                                          "a: servicios@mercadopana.com";
            }
//            $parent->LTB->titulo->Text = "Gracias por comunicarse con Nosotros";

//            $parent->LTB->redir->Text = "Home";
//            $params = array('mensaje');
//            $this->getPage()->getCallbackClient()->callClientFunction('muestra_mensaje', $params);
        $this->Response->redirect($this->Service->constructUrl('Home',null));

        }
 	}
}

?>
