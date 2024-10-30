<?php
$pag="";
$pag=@$_GET["pagina"];
switch ($pag)
{
    case "productos": include_once 'Aplicacion_Producto/aplicacion_producto.php';break;
    case "prod1": include_once 'Aplicacion_Producto/producto1.php';break;
    case "inicio": include_once 'aplicacion_inicio.php';break;
    case "categorias": include_once 'aplicacion_categorias.php';break;
    case "ofertas": include_once 'aplicacion_ofertas.php';break;
    case "MatEsc": include_once 'aplicacion_MaterialEscolar.php';break;
    case "tecnica": include_once 'aplicacion_PapeleriaTecnica.php';break;
    case "oficina": include_once 'aplicacion_MaterialOficina.php';break;
    case "logout": include_once 'aplicacion_iniciosesion.php';break;
    default : 'aplicacion_productos.php'; break;
}
?>