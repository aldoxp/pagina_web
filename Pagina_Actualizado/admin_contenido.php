<?php
$pag="";
$pag=@$_GET["pag"];
switch ($pag)
{
    case "inv": include_once 'Aplicacion_Administracion/admin_inventario.php';break;
    case "users": include_once 'Aplicacion_Administracion/admin_usuarios.php';break;
    case "inicio": include_once 'aplicacion_administracion.php';break;
    case "ventas": include_once 'Aplicacion_Administracion/admin_ventas.php';break;
    case "prov": include_once 'admin_proveedor.php';break;
    case "prod": include_once 'Aplicacion_Administracion/admin_productos.php';break;
    default : 'aplicacion_administracion.php'; break;
}
?>