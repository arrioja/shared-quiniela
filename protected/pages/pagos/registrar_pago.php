<?php
class registrar_pago extends TPage
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
        $sql ="select * from pagos p
               where (p.login = '$login')
               order by p.fecha desc, p.id desc";
        $pagos=cargar_data($sql,$this);
        $this->DataGrid->DataSource=$pagos;
        $this->DataGrid->dataBind();
    }


/* Para dar formato al grid.*/
    public function formatear($sender, $param)
    {
        $item=$param->Item;
        if ($item->ItemType=='Item' || $item->ItemType=='AlternatingItem')
        {
            $item->fecha->Text = cambiaf_a_normal($item->fecha->Text);
            $item->monto->Text = "BsF: ".number_format($item->monto->Text, 2, ',', '.');
            $item->detalle->estatus_img->ImageUrl = "imagenes/iconos/led_0".$item->estatus->Text.".png";
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

    /* Se incluyen los datos en la base */
	public function btn_incluir_click($sender, $param)
	{
        if ($this->IsValid)
        {
            $login = usuario_actual('login');
            $codigo = proximo_numero("pagos","cod_pago",null,$sender);
            $cod_pagos = rellena($codigo,6,"0");
            $num_pago = $this->txt_numero->Text;
            $fecha = cambiaf_a_mysql($this->txt_fecha_nac->Text);
            $monto = $this->txt_monto->Text;
            $login = usuario_actual('login');

            $sql="insert into pagos (login, cod_pago, fecha, numero, monto, status)
                  values ('$login','$cod_pagos','$fecha','$num_pago','$monto','0')";
            $resultado=modificar_data($sql,$sender);


            $sqlp ="select cod_partido from partidos";
            $partidos=cargar_data($sqlp,$sender);

            foreach ($partidos as $unpartido)
            {
                $cod_partido = $unpartido['cod_partido'];
                $sqli="insert into apuestas (login, cod_pago, cod_partido, cod_ganador, puntos)
                      values ('$login','$cod_pagos','$cod_partido','','0')";
                $resultado=modificar_data($sqli,$sender);
            }

//            $this->actualizar_grid();
//            $this->borrar_campos();
            $this->Response->redirect($this->Service->constructUrl('registrar.listado_quinielas',null));
        }
    }

}
?>
