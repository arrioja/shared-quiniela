<link href=<%~ cuadro_imagen_div.css %> rel="stylesheet" type="text/css" />
<div id="imagen_popup" style="display: none; border: none; z-index: 100; width: 600px;
height: 600px; position: absolute; left: 20%; top: 10%;">
    <com:TTable ID="tabla" BorderStyle="1" BackColor="White" BorderWidth="1" GridLines="Horizontal" Width="600px">
        <com:TTableRow BorderWidth="0">
            <com:TTableCell CssClass="color_titulo"  HorizontalAlign="Center">
                <com:TActiveLabel  Font.Bold="true" ID="imagen_popup_titulo" Text="Vista Ampliada de la imágen"/>
            </com:TTableCell>
        </com:TTableRow>
        <com:TTableRow BorderWidth="0">
            <com:TTableCell HorizontalAlign="Center">
                <com:TActiveImage ID="imagen_popup_imagen" ImageUrl="imagenes/iconos/loadinfo.gif"></com:TActiveImage>
            </com:TTableCell>
        </com:TTableRow>
        <com:TTableRow BorderWidth="0">
            <com:TTableCell HorizontalAlign="Right" ColumnSpan = "2">
                <com:TActiveLabel Text="" ID="imagen_popup_redir" Visible = "False"/>
                <com:TActiveButton CausesValidation="False" ID="imagen_popup_boton" Text="OK" OnCallback="redireccion">
                    <prop:ClientSide OnComplete="$('imagen_popup').hide()"/>
                </com:TActiveButton>
            </com:TTableCell>
        </com:TTableRow>
    </com:TTable>
</div>