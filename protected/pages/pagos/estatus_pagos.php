<?php
class estatus_pagos extends TPage
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
    //    $cod_usuario = usuario_actual('cod_usuario');
        $sql ="select p.*, u.login from pagos p, usuarios u
               where (((p.status = '0') or (p.status = '1')) and
                      (p.login = u.login))
               order by p.fecha, p.id";
        $pagos=cargar_data($sql,$this);
        $this->DataGrid->DataSource=$pagos;
        $this->DataGrid->dataBind();

        $sql2 ="select p.*, u.login from pagos p, usuarios u
               where (((p.status = '2') or (p.status = '3')) and
                      (p.login = u.login))
               order by p.fecha, p.id desc";
        $pagos2=cargar_data($sql2,$this);
        $this->DataGrid2->DataSource=$pagos2;
        $this->DataGrid2->dataBind();
    }


/* Para dar formato al grid.*/
    public function formatear($sender, $param)
    {
        $item=$param->Item;
        if ($item->ItemType=='Item' || $item->ItemType=='AlternatingItem')
        {
            $item->fecha->Text = cambiaf_a_normal($item->fecha->Text);
            $item->monto->Text = "BsF: ".number_format($item->monto->Text, 2, ',', '.');
            if ($item->estatus->Text == "1")
            {$item->acciones->btn_1->Visible = "False"; $item->BackColor="#ffee63";} else {$item->acciones->btn_1->Visible = "True";}
            if ($item->estatus->Text == "0")
            {$item->acciones->btn_0->Visible = "False";} else {$item->acciones->btn_0->Visible = "True";}
            $item->detalle->estatus_img->ImageUrl = "imagenes/iconos/led_0".$item->estatus->Text.".png";
        }
    }

/* Para dar formato al grid 2.*/
    public function formatear2($sender, $param)
    {
        $item=$param->Item;
        if ($item->ItemType=='Item' || $item->ItemType=='AlternatingItem')
        {
            if ($item->estatus2->Text == "2")
            {$item->acciones2->btn2_2->Visible = "False";} else {$item->acciones2->btn2_2->Visible = "True";}
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
    public function click_btn_0($sender, $param)
    {
        $cod_pago=$sender->CommandParameter;
        $sql2="UPDATE pagos set status = '0' where cod_pago = '$cod_pago'";
        $resultado=modificar_data($sql2,$sender);
        $this->actualizar_grid();
    }

/* Esta función lleva a la pagina de información general del articulo al cual se le dio click*/
    public function click_btn_1($sender, $param)
    {
        $cod_pago=$sender->CommandParameter;
        $sql2="UPDATE pagos set status = '1' where cod_pago = '$cod_pago'";
        $resultado=modificar_data($sql2,$sender);
        $this->actualizar_grid();
    }


    public function click_btn_2($sender, $param)
    {
        $cod_pago=$sender->CommandParameter;
        $sql2="UPDATE pagos set status = '2' where cod_pago = '$cod_pago'";
        $resultado=modificar_data($sql2,$sender);
        $this->actualizar_grid();
    }

/* Esta función lleva a la pagina de información general del articulo al cual se le dio click*/
    public function click_btn_3($sender, $param)
    {
        $cod_pago=$sender->CommandParameter;
        $sql2="UPDATE pagos set status = '3' where cod_pago = '$cod_pago'";
        $resultado=modificar_data($sql2,$sender);
        $this->actualizar_grid();
    }


/* Esta función lleva a la pagina de información general del articulo al cual se le dio click*/
    public function click_btn2_0($sender, $param)
    {
        $cod_pago=$sender->CommandParameter;
        $sql2="UPDATE pagos set status = '0' where cod_pago = '$cod_pago'";
        $resultado=modificar_data($sql2,$sender);
        $this->actualizar_grid();
    }


/* Esta función lleva a la pagina de información general del articulo al cual se le dio click*/
    public function click_btn2_1($sender, $param)
    {
        $cod_pago=$sender->CommandParameter;
        $sql2="UPDATE pagos set status = '1' where cod_pago = '$cod_pago'";
        $resultado=modificar_data($sql2,$sender);
        $this->actualizar_grid();
    }

/* Esta función lleva a la pagina de información general del articulo al cual se le dio click*/
    public function click_btn2_2($sender, $param)
    {
        $cod_pago=$sender->CommandParameter;
        $sql2="UPDATE pagos set status = '2' where cod_pago = '$cod_pago'";
        $resultado=modificar_data($sql2,$sender);
        $this->actualizar_grid();
    }

/* Esta función lleva a la pagina de información general del articulo al cual se le dio click*/
    public function click_btn2_3($sender, $param)
    {
        $cod_pago=$sender->CommandParameter;
        $sql2="UPDATE pagos set status = '3' where cod_pago = '$cod_pago'";
        $resultado=modificar_data($sql2,$sender);
        $this->actualizar_grid();
    }

}
?>
