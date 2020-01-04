<?php
/*   ****************************************************  INFO DEL ARCHIVO
 * Creado por:  Pedro E. Arrioja M.
 * Descripción: Se muestra un listado con los usuarios registrados en el sistema.
     ****************************************************  FIN DE INFO
*/
class listar_usuarios extends TPage
{
    public function onLoad($param)
    {
    parent::onLoad($param);
    if(!$this->IsPostBack)
      {
        $this->cargar_listado($this);
      }
    }

    public function cargar_listado($sender)
    {

        $sql="Select COUNT(u.id) as numero FROM usuarios u";
        $total_usuarios=cargar_data($sql,$sender);
        $total = $total_usuarios[0]['numero'];
        $this->DataGrid->Caption = "Total de usuarios inscritos: ".$total;

        $sql="select u.id, u.cedula, u.login, u.email, CONCAT(u.nombres,' ',u.apellidos) as nomb, telefono1, telefono2
 						FROM usuarios as u
						ORDER BY nomb";
        $resultado=cargar_data($sql,$sender);
		$this->DataGrid->DataSource=$resultado;
		$this->DataGrid->dataBind();
    }
    public function changePage($sender,$param)
	{
        $this->DataGrid->CurrentPageIndex=$param->NewPageIndex;
        $this->cargar_listado($sender);
	}

	public function pagerCreated($sender,$param)
	{
		$param->Pager->Controls->insertAt(0,'Página: ');
	}

    public function formatear($sender, $param)
    {
        $item=$param->Item;
        if ($item->ItemType=='Item' || $item->ItemType=='AlternatingItem')
        {

        }
        
    }

}

?>
