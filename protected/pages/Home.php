<?php
class Home extends TPage
{
    public function onLoad($param)
    {
        parent::onLoad($param);
        if(!$this->IsPostBack)
          {
            $sesion = new THttpSession;
            $sesion->open();
            $this->row_menu->Visible=isset($sesion['quiniela_login']);
            $this->row_menu2->Visible=isset($sesion['quiniela_login']);
            if ($sesion['quiniela_tipo_usuario'] == 'ADMINISTRADOR')
            {
                $this->row_menu_admon->Visible=true;
                $this->row_menu_admon2->Visible=true;
            }
            else
            {
                $this->row_menu_admon->Visible=false;
                $this->row_menu_admon2->Visible=false;
            }
            $sesion->close();

            $sql_top_10 ="select u.cedula, a.cod_pago, CONCAT(u.nombres,' ',u.apellidos) as nombres, SUM(a.puntos) as puntos
                          from apuestas a, usuarios u, pagos p
                          where (u.login = a.login) and (a.cod_pago = p.cod_pago) and (p.status <> '3')
                          group by a.login, a.cod_pago
                          order by puntos desc, nombres asc
                          Limit 10";
            $top_10=cargar_data($sql_top_10,$this);
            $this->DataGrid_top_10->DataSource=$top_10;
            $this->DataGrid_top_10->dataBind();

            $sql_resultado ="Select p.id, p.cod_partido, p.grupo, p.resultado, p.nombre_equipo_a,
                                p.nombre_equipo_b,
                                p.cod_ganador, p.cod_equipo_a, p.cod_equipo_b
                             from partidos p
                             where (timestamp <> '0000-00-00 00:00:00')
                             order by p.timestamp desc, p.grupo asc
                             Limit 15";
            $pagos=cargar_data($sql_resultado,$this);
            $this->DataGrid_resultado->DataSource=$pagos;
            $this->DataGrid_resultado->dataBind();


          }
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
    
    // función que lleva al listado de pagos del usuario y a la opción de registrar uno nuevo
    public function ver_pagos($sender, $param)
    {
        $this->Response->redirect($this->Service->constructUrl('pagos.registrar_pago',null));
    }
    public function ver_quinielas($sender, $param)
    {
        $this->Response->redirect($this->Service->constructUrl('registrar.listado_quinielas',null));
    }

    public function ver_todas_quinielas($sender, $param)
    {
        $this->Response->redirect($this->Service->constructUrl('resultados.listado_quinielas',null));
    }


    public function ver_resultados($sender, $param)
    {
        $this->Response->redirect($this->Service->constructUrl('resultados.listar_resultados',null));
    }
    
    public function ver_clasificacion($sender, $param)
    {
        $this->Response->redirect($this->Service->constructUrl('resultados.clasificacion',null));
    }

    public function ver_usuarios($sender, $param)
    {
        $this->Response->redirect($this->Service->constructUrl('admin.usuarios2.listar_usuarios',null));
    }

    public function registrar_resultado($sender, $param)
    {
        $this->Response->redirect($this->Service->constructUrl('resultados.registrar_resultado',null));
    }


    // función que lleva al listado de pagos del usuario y a la opción de registrar uno nuevo
    public function revisar_pagos($sender, $param)
    {
        $this->Response->redirect($this->Service->constructUrl('pagos.estatus_pagos',null));
    }

    public function ver_articulo($sender, $param)
    {
//        $cod_articulo=$sender->CommandParameter;
//        $this->Response->redirect($this->Service->constructUrl('articulos.info_articulo',array('codigo'=>$cod_articulo)));
    }

}

?>
