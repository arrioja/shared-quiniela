<?php
class listado_quinielas extends TPage
{
    public function onLoad($param)
    {
        parent::onLoad($param);
        if(!$this->IsPostBack)
          {
            $this->actualizar_grid();
          }
    }

    public function borrar_campos()
    {
        $this->txt_numero->Text = "";
        $this->txt_fecha_nac->Text = "";
        $this->txt_monto->Text = "0.00";

    }

    public function actualizar_grid()
    {
$login = usuario_actual('login');
        $sql2 ="select p.*, CONCAT(u.nombres,' ',u.apellidos) as nombre from pagos p, usuarios u
               where ((p.status <> '3') and (u.login = p.login))
               order by p.fecha, p.id desc";
        $pagos2=cargar_data($sql2,$this);
        $this->DataGrid2->DataSource=$pagos2;
        $this->DataGrid2->dataBind();
    }



/* Para dar formato al grid 2.*/
    public function formatear2($sender, $param)
    {
        $item=$param->Item;
        if ($item->ItemType=='Item' || $item->ItemType=='AlternatingItem')
        {

            if ($item->estatus2->Text == "3")
            {$item->acciones2->btn2_3->Visible = "False"; $item->BackColor="#ff6363";  } else {$item->acciones2->btn2_3->Visible = "True";}
            $item->fecha2->Text = cambiaf_a_normal($item->fecha2->Text);
            $item->monto2->Text = "BsF: ".number_format($item->monto2->Text, 2, ',', '.');
            $item->detalle2->estatus_img2->ImageUrl = "imagenes/iconos/led_0".$item->estatus2->Text.".png";
        }
    }

	public function pagerCreated($sender,$param)
	{
		$param->Pager->Controls->insertAt(0,'Pagina: ');
	}

	public function changePage($sender,$param)
	{
            $this->DataGrid->CurrentPageIndex=$param->NewPageIndex;
            $this->DataGrid->DataSource=$this->actualizar_grid();
            $this->DataGrid->dataBind();
	}



/* Esta función lleva a la pagina de información general del articulo al cual se le dio click*/
    public function click_btn2_3($sender, $param)
    {
        $cod_pago=$sender->CommandParameter;

        $sesion = new THttpSession;
        $sesion->open();
        $sesion['quiniela_quiniela'] = $cod_pago;
        $sesion->close();

        $this->Response->redirect($this->Service->constructUrl('resultados.consultar_quiniela',null));
    }

}
?>
