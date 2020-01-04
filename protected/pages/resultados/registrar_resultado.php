<?php
// hay cosas que hacer en esta pagina, que al colocar ganador a un equipo, se actualicen los puntajes de los participantes,
// cuando el usuario registre su pago, se le llenan sus 48 apuestas con el resultado en blanco esperando a que seleccione sus ganadores.

class registrar_resultado extends TPage
{
    public function onLoad($param)
    {
        parent::onLoad($param);
        if(!$this->IsPostBack)
          {
            $this->actualizar_grid();
          }
    }

    public function actualizar_grid()
    {
        $login = usuario_actual('login');
        $sql ="Select p.id, p.cod_partido, p.nombre_ganador, p.grupo, p.resultado, 
                    p.nombre_equipo_a, p.nombre_equipo_b,
                    p.cod_ganador, p.cod_equipo_a, p.cod_equipo_b
               from partidos p";
        $pagos=cargar_data($sql,$this);
        $this->DataGrid->DataSource=$pagos;
        $this->DataGrid->dataBind();
    }


/* Para dar formato al grid.*/
    public function formatear($sender, $param)
    {
        $item=$param->Item;
        if ($item->ItemType=='Item' || $item->ItemType=='AlternatingItem')
        {   // si gano el primer equipo
            if ($item->equipoa->Text == $item->equipo_ganador->Text)
              {$item->nombreequipoa->BackColor = "#00ff84"; // ganador en verde
               $item->nombreequipob->BackColor = "#ff6363"; // perdedor en rojo
              }
              else
              { // si gano el segundo equipo
                if ($item->equipob->Text == $item->equipo_ganador->Text)
                  {$item->nombreequipob->BackColor = "#00ff84"; // ganador en verde
                   $item->nombreequipoa->BackColor = "#ff6363"; // perdedor en rojo
                  }
                else
                {
                if ($item->equipo_ganador->Text == "XX")
                  {$item->nombreequipob->BackColor = "#ffee63"; // empate en amarillo
                   $item->nombreequipoa->BackColor = "#ffee63"; // empate en amarillo
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

           $arreglo =array($equipo1=>$nombreequipo1, $equipo2=>$nombreequipo2, "XX"=>"EMPATE", "NO"=>"NO JUGADO");
           $item->elegir->DropDownList->DataSource = $arreglo;
           $item->elegir->DropDownList->dataBind();
/*
           $arreglo = array();
           $arreglo[$pagos[0]['cod_equipo_a']] =$pagos[0]['nombre_equipo_a'];
           $arreglo[$pagos[0]['cod_equipo_b']] =$pagos[0]['nombre_equipo_b'];
           $arreglo["XX"] ="EMPATE";
           $arreglo["NO"] ="NO JUGADO";
           $item->elegir->DropDownList->DataSource = $arreglo;
           $item->elegir->DropDownList->dataBind();   */
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
            $item->resultado->TextBox->Columns = "5";
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
        $cod_partido=$item->cod_partido->Text;
        $resultado = $item->resultado->TextBox->Text;
		$id=$this->DataGrid->DataKeys[$item->ItemIndex];
		$cod_ganador= $item->elegir->DropDownList->SelectedValue;
        $nombre_ganador= $item->elegir->DropDownList->SelectedItem->Text;
        $timestamp = date("Y-m-d H:i:s");

        if ($cod_ganador == 'NO')
        {
            $sql="UPDATE partidos set cod_ganador = '', resultado = '', nombre_ganador = '', timestamp = '0000-00-00 00:00:00'
                  where id = '$id'";
            $resultado=modificar_data($sql,$sender);

            $sql2="UPDATE apuestas set puntos = '0'
                  where ((cod_partido = '$cod_partido'))";
            $resultado2=modificar_data($sql2,$sender);
        }
        else
        {
            $sql="UPDATE partidos set cod_ganador = '$cod_ganador', resultado = '$resultado', nombre_ganador = '$nombre_ganador',
                         timestamp = '$timestamp'
                  where id = '$id'";
            $resultado=modificar_data($sql,$sender);

            $sql2="UPDATE apuestas set puntos = '1'
                  where ( (cod_ganador = '$cod_ganador') and
                          (cod_partido = '$cod_partido'))";
            $resultado2=modificar_data($sql2,$sender);
        }

        $this->DataGrid->EditItemIndex=-1;
        $this->DataGrid->DataSource=$this->actualizar_grid();
        $this->DataGrid->dataBind();

    }



}
?>
