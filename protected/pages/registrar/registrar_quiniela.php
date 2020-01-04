<?php
class registrar_quiniela extends TPage
{
    public function onLoad($param)
    {
        parent::onLoad($param);
        if(!$this->IsPostBack)
          {
            $cod_pago = usuario_actual('quiniela');
            $this->actualizar_grid();
          }
    }

    public function actualizar_grid()
    {
        $cod_pago=usuario_actual('quiniela');
        $login = usuario_actual('login');

        $sql ="Select a.id, a.cod_partido, p.nombre_equipo_a, p.nombre_equipo_b, p.grupo, p.cod_ganador as cod_ganador_oficial,
                      p.cod_equipo_a, p.cod_equipo_b, a.cod_ganador, a.nombre_ganador, a.puntos
               from partidos p
                INNER JOIN apuestas a on p.cod_partido=a.cod_partido
                WHERE a.login='$login' and a.cod_pago='$cod_pago'";
        $pagos=cargar_data($sql,$this);
        $this->DataGrid->DataSource=$pagos;
        $this->DataGrid->dataBind();

        $sql_ptos ="select SUM(a.puntos) as puntos
                      from apuestas a
                      where (a.login = '$login') and (a.cod_pago = '$cod_pago')
                      group by a.login";
        $ptos=cargar_data($sql_ptos,$this);
        $this->DataGrid->Caption = "Listado de Partidos y sus Resultados, Ud. tiene: ".$ptos[0]['puntos']." puntos.";
    }


/* Para dar formato al grid.*/
    public function formatear($sender, $param)
    {
        $item=$param->Item;
        if ($item->ItemType=='Item' || $item->ItemType=='AlternatingItem')
        {   // si gano el primer equipo

            if ($item->cod_ganador_oficial->Text <> '')
            {
                if ($item->equipo_ganador->Text == $item->cod_ganador_oficial->Text)
                  {$item->elegir->BackColor = "#00ff84"; // ganador en verde
                  }
                  else
                  {
                   $item->elegir->BackColor = "#ff6363"; // perdedor en rojo
                  }
            }

            if ($item->equipoa->Text == $item->cod_ganador_oficial->Text)
              {$item->nombreequipoa->BackColor = "#00ff84"; // ganador en verde
               $item->nombreequipob->BackColor = "#ff6363"; // perdedor en rojo
              }
              else
              { // si gano el segundo equipo
                if ($item->equipob->Text == $item->cod_ganador_oficial->Text)
                  {$item->nombreequipob->BackColor = "#00ff84"; // ganador en verde
                   $item->nombreequipoa->BackColor = "#ff6363"; // perdedor en rojo
                  }
                else
                {
                if ($item->cod_ganador_oficial->Text == "XX")
                  {$item->nombreequipob->BackColor = "#ffee63"; // ganador en verde
                   $item->nombreequipoa->BackColor = "#ffee63"; // perdedor en rojo
                  }
                }

              }
        }
        if ($item->ItemType==='EditItem')
        {  
           $equipo1=$item->equipoa->Text;
           $nombreequipo1=$item->nombreequipoa->Text;
           $equipo2=$item->equipob->Text;
           $nombreequipo2=$item->nombreequipob->Text;
           $arreglo=array($equipo1=>$nombreequipo1,$equipo2=>$nombreequipo2,"XX"=>"EMPATE");
           $item->elegir->DropDownList->DataSource = $arreglo;
           $item->elegir->DropDownList->dataBind();
        }

    }



	 public function editItem($sender,$param)
    {
        $this->DataGrid->EditItemIndex=$param->Item->ItemIndex;
        $this->DataGrid->DataSource=$this->actualizar_grid();
        $this->DataGrid->dataBind();

    }

    public function itemCreated($sender,$param)
    {
        $item=$param->Item;
        
        if($item->ItemType==='EditItem')
            {

    //                       $item->equipo_ganador->TextBox->Columns = "2";
        }
    }

    public function cancelItem($sender,$param)
    {
        $this->DataGrid->EditItemIndex=-1;
        $this->DataGrid->DataSource=$this->actualizar_grid();
        $this->DataGrid->dataBind();
    }


    public function saveItem($sender,$param)
    {
        $item=$param->Item;
//        $cod_partido=$item->cod_partido->TextBox->Text;
//        $login = usuario_actual('login');
		$id=$this->DataGrid->DataKeys[$item->ItemIndex];
		$cod_ganador= $item->elegir->DropDownList->SelectedValue;
        $nombre_ganador= $item->elegir->DropDownList->SelectedItem->Text;
		$sql="UPDATE apuestas set cod_ganador = '$cod_ganador', nombre_ganador = '$nombre_ganador'
              where id = '$id'";
        $resultado=modificar_data($sql,$sender);

        $this->DataGrid->EditItemIndex=-1;
        $this->DataGrid->DataSource=$this->actualizar_grid();
        $this->DataGrid->dataBind();

    }



}
?>
