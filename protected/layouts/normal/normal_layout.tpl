<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<com:THead Title="Quiniela Mundial 2010">
<link rel=stylesheet href= <%~ st.css %> type=text/css>
<style type="text/css">
<!--
.fo{
	background-image : url(<%~ foot.gif %>);
	background-repeat : repeat-x;
	background-position: bottom;
	vertical-align: middle;
	text-align: center;
	height: 30px;
	font-weight: bold;
}

-->
</style>
</com:THead>
<script type="text/javascript" src="llamada_mensaje.js"></script>
<body leftmargin=0 topmargin=0 marginheight=0 marginwidth=0>
    <com:TForm ID="form">
        <com:MensajeDiv ID="LTB"/>

            <com:TTable Width="100%" CellPadding="0" CellSpacing="0" BorderWidth="0" GridLines="None" >
                <com:TTableRow Height="1">
                    <com:TTableCell>
                        <com:TTable Height="100%" Width="100%" CellPadding="0" CellSpacing="0" BorderWidth="0" GridLines="None" >
                            <com:TTableRow>
                                <com:TTableCell Width="2%">
                                    <com:TImage Height="104" ImageUrl=<%~ top_1.png %>/>
                                </com:TTableCell>
                                <com:TTableCell Width="98%" HorizontalAlign="Right" Attributes.Style="background-image:url('imagenes/fondos/top_pa_fill.png')" >
                                    <com:TActiveLabel ForeColor="White" Font.Bold="true" ID="lbl_usuario_top" Text=""/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                                    <com:TLinkButton ForeColor="White" Font.Bold="true" CausesValidation="false" Text="Inicio /" OnClick="inicio_click" />
                                    <com:TLinkButton ForeColor="White" Font.Bold="true" ID="entrar" CausesValidation="false" Text="Entrar /" OnClick="inicio_sesion_click" />
                                    <com:TLinkButton ForeColor="White" Font.Bold="true" ID="salir" Visible="false" CausesValidation="false" Text="Salir /" OnClick="logout_clicked" />
                                    <com:TLinkButton ForeColor="White" Font.Bold="true" CausesValidation="false" Text="Registo" OnClick="registrarse_click" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </com:TTableCell>
                            </com:TTableRow>
                        </com:TTable>
                    </com:TTableCell>
                </com:TTableRow>
            </com:TTable>


            <com:TTable Width="100%" CellPadding="0" CellSpacing="0" BorderWidth="0" GridLines="None" >
                <com:TTableRow>
                    <com:TTableCell HorizontalAlign="Center" Width="100%" BackColor="#efffc0" BorderColor="#ccc" VerticalAlign="Top">
                        <com:TImage ImageUrl="imagenes/publicidad/banner_low.gif"></com:TImage>
                    </com:TTableCell>
                </com:TTableRow>
                <com:TTableRow>
                    <com:TTableCell Height="400px">
                        <com:TTable Height="100%" Width="100%" CellPadding="0" CellSpacing="0" BorderWidth="1" GridLines="Both" >
                            <com:TTableRow>
                                <com:TTableCell HorizontalAlign="Center" Width="2%" BackColor="#efffc0" BorderColor="#ccc" VerticalAlign="Top">
                                    <com:TImage ImageUrl="imagenes/publicidad/banner1.gif"></com:TImage>
                                    <br>
                                    <com:TImage ImageUrl="imagenes/publicidad/banner2.gif"></com:TImage>
                                </com:TTableCell>
                                <com:TTableCell Width="98%">

                                    <com:TTable Height="100%" Width="100%" CellPadding="0" CellSpacing="0" BorderWidth="0" GridLines="None" >
                                        <com:TTableRow>
                                            <com:TTableCell Height="30" Width="100%" BackColor="#ffed3c" BorderColor="#ccc" HorizontalAlign="Center" CssClass="titulo_pote">
                                                <com:TTable Height="100%" Width="100%" CellPadding="0" CellSpacing="0" BorderWidth="0" GridLines="None" >
                                                    <com:TTableRow>
                                                        <com:TTableCell Height="30"  BackColor="#ffed3c" BorderColor="#ccc" HorizontalAlign="Left" CssClass="titulo_pote">
                                                            <com:TActiveLabel Font.Bold="true" ID="lbl_usuario_top2" Text=""/>, Aprovecha YA!, el pote tiene BsF: <com:TActiveLabel ForeColor="Red" Font.Bold="true" ID="lbl_pote" Text="0,00"/>
                                                        </com:TTableCell>
                                                        <com:TTableCell Height="30"  BackColor="#ffed3c" BorderColor="#ccc" HorizontalAlign="Right" >
                                                            <com:TActiveLinkButton Text="<img src='imagenes/iconos/home.png' border='0' />" OnClick="inicio_click" CausesValidation="False" />
                                                            <com:TActiveLinkButton ID="entrar2" Text="<img src='imagenes/iconos/player_play.png' border='0' />" OnClick="inicio_sesion_click" CausesValidation="False" />
                                                            <com:TActiveLinkButton Text="<img src='imagenes/iconos/add_user.png' border='0' />" OnClick="registrarse_click" CausesValidation="False" />
                                                            <com:TActiveLinkButton ID="salir2" Visible="false" Text="<img src='imagenes/iconos/logout.png' border='0' />" OnClick="logout_clicked" CausesValidation="False" />
                                                        </com:TTableCell>
                                                    </com:TTableRow>
                                                </com:TTable>
                                            </com:TTableCell>
                                        </com:TTableRow>
                                        <com:TTableRow>
                                            <com:TTableCell Width="100%" VerticalAlign="Top" HorizontalAlign="Center">
                                                <com:TContentPlaceHolder ID="cuerpo" />
                                            </com:TTableCell>
                                        </com:TTableRow>
                                    </com:TTable>

                                </com:TTableCell>
                                <com:TTableCell HorizontalAlign="Center" Width="2%" BackColor="#efffc0" BorderColor="#ccc" VerticalAlign="Top">
                                    <com:TImage ImageUrl="imagenes/publicidad/banner3.gif"></com:TImage>
                                    <com:TImage ImageUrl="imagenes/publicidad/banner4.gif"></com:TImage>
                                </com:TTableCell>
                            </com:TTableRow>
                        </com:TTable>
                    </com:TTableCell>
                </com:TTableRow>












                <com:TTableRow>
                    <com:TTableCell CssClass="fo">
                        <com:TLinkButton CausesValidation="false" Text="Inicio" OnClick="inicio_click" /> /
                        <com:TLinkButton CausesValidation="false" Text="Entrar" OnClick="inicio_sesion_click" /> /
                        <com:TLinkButton CausesValidation="false" Text="Registrarse" OnClick="registrarse_click" /> /
                        <com:TLinkButton CausesValidation="false" Text="¿Cómo participo?" OnClick="servicios_click" /> /                    
                    </com:TTableCell>
                </com:TTableRow>
            </com:TTable>
    </com:TForm>
</body>
</html>