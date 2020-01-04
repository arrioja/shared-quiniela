<?php
// hay cosas que hacer en esta pagina, que al colocar ganador a un equipo, se actualicen los puntajes de los participantes,
// cuando el usuario registre su pago, se le llenan sus 48 apuestas con el resultado en blanco esperando a que seleccione sus ganadores.

class clasificacion extends TPage
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
        $sql_top_10 ="select u.cedula, a.cod_pago, CONCAT(u.nombres,' ',u.apellidos) as nombres, SUM(a.puntos) as puntos
                          from apuestas a, usuarios u, pagos p
                          where (u.login = a.login) and (a.cod_pago = p.cod_pago) and (p.status <> '3')
                          group by a.login, a.cod_pago
                          order by puntos desc, nombres asc";
        $top_10=cargar_data($sql_top_10,$this);
        $this->DataGrid_top_10->DataSource=$top_10;
        $this->DataGrid_top_10->dataBind();
    }


/* Para dar formato al grid.*/
    public function formatear($sender, $param)
    {
        $item=$param->Item;
        if ($item->ItemType=='Item' || $item->ItemType=='AlternatingItem')
        {   // si gano el primer equipo
            if ($item->cedula->Text == usuario_actual('cedula'))
              {$item->BackColor = "#00ff84"; // ganador en verde  
              }
        }
    }

}
?>
