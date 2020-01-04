<?php
// hay cosas que hacer en esta pagina, que al colocar ganador a un equipo, se actualicen los puntajes de los participantes,
// cuando el usuario registre su pago, se le llenan sus 48 apuestas con el resultado en blanco esperando a que seleccione sus ganadores.

class listar_resultados extends TPage
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
        $sql ="Select p.id, p.cod_partido, p.grupo, p.resultado, p.nombre_equipo_a,
                      p.nombre_equipo_b,
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
                  {$item->nombreequipob->BackColor = "#ffee63"; // ganador en verde
                   $item->nombreequipoa->BackColor = "#ffee63"; // perdedor en rojo
                  }
                }

              }
        }
    }

}
?>
