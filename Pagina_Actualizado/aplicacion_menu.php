<!-- Barra de navegación -->
<div class="nav">
    <a href="aplicacion.php?pagina=inicio">Inicio</a>
    <a href="aplicacion.php?pagina=productos">Novedades</a>

    <!-- Categorías con menú desplegable -->
    <div class="dropdown">
        <a href="aplicacion.php?pagina=categorias">Categorías</a>
        <div class="dropdown-content">
            <a href="aplicacion.php?pagina=MatEsc">
                <img src="iconos/material-escolar.png" alt="Material Escolar" class="icono">
                Material Escolar
            </a>
            <a href="aplicacion.php?pagina=tecnica">
                <img src="iconos/papeleria-tecnica.png" alt="Papelería Técnica" class="icono">
                Papelería Técnica
            </a>
            <a href="aplicacion.php?pagina=oficina">
                <img src="iconos/oficina.png" alt="Oficina" class="icono">
                Oficina
            </a>
        </div>


    </div>
    <a href="aplicacion.php?pagina=inicio">Inicio</a>
    <a href="aplicacion.php?pagina=productos">Novedades</a>
    <a href="aplicacion.php?pagina=inicio">Inicio</a>
    <a href="aplicacion.php?pagina=productos">Novedades</a>
    <a href="aplicacion.php?pagina=ofertas">Ofertas</a>
</div>

<style>
  /* Header */
.header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    background-color: #ffffff;
    position: fixed; /* Fija el header */
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Barra de navegación */
.nav {
    display: flex;
    justify-content: center;
    background-color: #ec297b;
    padding: 10px;
    position: fixed; /* Fija la barra de navegación */
    top: 140px; /* Se coloca justo debajo del header (ajusta este valor si el header es más alto o más bajo) */
    width: 100%;
    z-index: 999; /* Debe estar por debajo del header */
}

/* Ajustar el contenido de la página para que no quede cubierto */
body {
    padding-top: 200px; /* Ajusta según la altura combinada del header y la barra de navegación */
}

/* Links de navegación */
.nav a {
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    font-size: 14px;
}

.nav a:hover {
    background-color: #e5e5e5;
    color: #000;
}

/* Dropdown */
.dropdown {
    position: relative;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #ec297b;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1000;
}

.dropdown-content a {
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    display: flex;
    align-items: center;
    font-size: 14px;
}

.dropdown-content a:hover {
    background-color: #e5e5e5;
    color: #000;
}

.dropdown:hover .dropdown-content {
    display: block;
}

/* Estilo para los iconos */
.icono {
    width: 20px;
    height: 20px;
    margin-right: 10px;
}

</style>
