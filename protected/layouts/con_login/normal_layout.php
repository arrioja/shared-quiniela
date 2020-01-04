<?php
class normal_layout extends TTemplateControl
{

    public function onLoad($param)
    {
        parent::onLoad($param);
        if(!$page->IsPostBack)
          {
            // se llena la información del usuario logeado si es el caso.
            $sesion = new THttpSession;
            $sesion->open();
             if (isset($sesion['quiniela_login']))
            {
               $this->lbl_usuario_top->Text="Hola ".$sesion['quiniela_nombre']."!&nbsp;&nbsp;&nbsp;";
               $this->lbl_usuario_top2->Text=$sesion['quiniela_nombre'];
               $this->salir->Visible="true";
               $this->entrar->Visible="false";
               $this->salir2->Visible="true";
               $this->entrar2->Visible="false";
            }else
            {
//               $this->lbl_usuario_top->Text="No está registrado?.";
//               $this->salir->Visible="false";
//               $this->entrar->Visible="true";
               $this->Response->redirect($this->Service->constructUrl('admin.login'));
            }
            $sesion->close();
            $sql ="select SUM(p.monto) as pote from pagos p
                   where (p.status = '2')";
            $resultado=cargar_data($sql,$this);
            $pote = $resultado[0]['pote']*0.7;
            $this->lbl_pote->Text=number_format($pote, 2, ',', '.');
          }
    }


    public function inicio_click($sender,$param)
    {
      $this->Response->redirect($this->Service->constructUrl('Home'));
    }

    public function inicio_sesion_click($sender,$param)
    {
      $this->Response->redirect($this->Service->constructUrl('admin.login'));
    }

    public function registrarse_click($sender,$param)
    {
      $this->Response->redirect($this->Service->constructUrl('admin.usuarios.incluir_usuarios'));
    }

    public function acerca_de_click($sender,$param)
    {
      $this->Response->redirect($this->Service->constructUrl('acerca_de'));
    }
    public function privacidad_click($sender,$param)
    {
      $this->Response->redirect($this->Service->constructUrl('privacidad'));
    }
    public function servicios_click($sender,$param)
    {
      $this->Response->redirect($this->Service->constructUrl('servicios'));
    }
    public function contactos_click($sender,$param)
    {
      $this->Response->redirect($this->Service->constructUrl('contactos'));
    }

    public function logout_clicked($sender,$param)
    {
        logout_usuario($sender);
    }

}
?>
