<?php
class privacidad extends TPage
{
    public function onLoad($param)
    {
        parent::onLoad($param);
        if(!$this->IsPostBack)
          {
    /*        $sql="select * from paises order by nombre_pais";
            $paises=cargar_data($sql,$this);
            $this->drop_pais->DataSource=$paises;
            $this->drop_pais->dataBind();*/
          }
    }

/* Se actualiza el listado de estados de acuerdo al país que se haya seleccionado */
    public function actualiza_estados($sender,$param)
    {
        //Busqueda de Registros
/*        $cod_pais = $this->drop_pais->SelectedValue;
        $sql="Select * from estados where (cod_pais='$cod_pais' ) order by nombre_estado";
        $resultado=cargar_data($sql,$this);
		$this->drop_estado->DataSource=$resultado;
		$this->drop_estado->dataBind();*/
    }

    public function btn_buscar_click($param)
    {
      //  $this->lbl_org->Text = $this->Page->getPagePath();
      // $this->Response->redirect($this->Service->constructUrl('intranet.mensaje',array('codigo'=>'00002')));
    }

}

?>
