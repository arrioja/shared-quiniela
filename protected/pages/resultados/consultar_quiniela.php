<?php
class consultar_quiniela extends TPage
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

        $sql ="Select a.id, a.cod_partido, p.nombre_equipo_a, p.nombre_equipo_b, p.grupo, p.cod_ganador as cod_ganador_oficial,
                      p.cod_equipo_a, p.cod_equipo_b, a.cod_ganador, a.nombre_ganador, a.puntos
               from partidos p
                INNER JOIN apuestas a on p.cod_partido=a.cod_partido
                WHERE a.cod_pago='$cod_pago'";
        $pagos=cargar_data($sql,$this);
        $this->DataGrid->DataSource=$pagos;
        $this->DataGrid->dataBind();

        $sql_ptos ="select a.login, u.nombres, u.apellidos, SUM(a.puntos) as puntos
                      from apuestas a, usuarios u
                      where (a.cod_pago = '$cod_pago') and (a.login = u.login)
                      group by a.cod_pago";
        $ptos=cargar_data($sql_ptos,$this);
        $this->DataGrid->Caption = "Usuario: ".$ptos[0]['nombres']." ".$ptos[0]['apellidos']." tiene: ".$ptos[0]['puntos']." puntos.";
    }


/* Para dar formato al grid.*/
    public function formatear($sender, $param)
    {
        $item=$param->Item;
        if ($item->ItemType=='Item' || $item->ItemType=='AlternatingItem')
        {   // si gano el primer equipo
                
            if ($item->equipoa->Text == $item->cod_ganador_oficial->Text)
              {$item->nombreequipoa->BackColor = "#00ff84"; // ganador en verde
               $item->nombreequipob->BackColor = "#ff6363"; // perdedor en rojo
                if ($item->puntos->Text == "1")
                  {$item->puntos->BackColor = "#00ff84"; } // ganador en verde
                else
                  {$item->puntos->BackColor = "#ff6363"; } // perdedor en rojo

              }
              else
              { // si gano el segundo equipo
                if ($item->equipob->Text == $item->cod_ganador_oficial->Text)
                  {$item->nombreequipob->BackColor = "#00ff84"; // ganador en verde
                   $item->nombreequipoa->BackColor = "#ff6363"; // perdedor en rojo
                if ($item->puntos->Text == "1")
                  {$item->puntos->BackColor = "#00ff84"; } // ganador en verde
                else
                  {$item->puntos->BackColor = "#ff6363"; } // perdedor en rojo
                  }
                else
                {
                if ($item->cod_ganador_oficial->Text == "XX")
                  {$item->nombreequipob->BackColor = "#ffee63"; // ganador en verde
                   $item->nombreequipoa->BackColor = "#ffee63"; // perdedor en rojo
                if ($item->puntos->Text == "1")
                  {$item->puntos->BackColor = "#00ff84"; } // ganador en verde
                else
                  {$item->puntos->BackColor = "#ff6363"; } // perdedor en rojo
                  }
                }
              }
        }

    }


}
?>
