<?php
/* Creado por:  Pedro E. Arrioja M.  pedroarrioja@gmail.com
 * Descripcion: Este Control muestra un mensaje que puede ser enviado desde el 
 *              servidor y disparado desde el cliente mediante AJAX.
 */
class cuadro_imagen_div extends TTemplateControl
{
	public function redireccion($sender, $param)
    {  
        $redirec = $this->imagen_popup_redir->Text;
        if (!empty($redirec))
            { // si hay que redireccionar se lleva a la pagina en cuestión.
                $this->Response->redirect($this->Service->constructUrl($redirec));
            }
        else
            { // si no hay que redireccionar, se limpian los campos por si se
              // necesita de nuevo el control en la misma pagina
                $this->imagen_popup_titulo->Text = "Imágen ampliada del producto";
                $this->imagen_popup_imagen->Imageurl = "imagenes/iconos/loadinfo.gif";
            }
  	}
}

?>
