<style>
    body {
        font-family: Arial, sans-serif;
    }

    /* Estilo del título principal */
    h2 {
        text-align: center;
        font-size: 24px;
        margin-top: 20px;
        color: #333;
    }

    /* Estilo para las pestañas (botones) del carrusel */
    .tabs {
        display: flex;
        justify-content: center;
        margin-bottom: 10px;
    }

    .tab {
        width: 15px;  /* Tamaño reducido de las pestañas */
        height: 15px;
        margin: 0 5px;
        border-radius: 50%;
        background-color: #ddd;
        cursor: pointer;
        transition: background-color 0.3s ease; /* Efecto de transición suave */
    }

    .tab.active {
        background-color: #4CAF50;
        color: white;
    }

    /* Contenedor de las categorías */
    .categories-container {
        display: none;
        justify-content: space-around;
        flex-wrap: wrap;
        max-width: 1200px;
        margin: 0 auto;
        opacity: 0;
        transform: translateX(-100%);
        transition: opacity 0.5s ease, transform 0.5s ease; /* Animación de barrido */
    }

    .categories-container.active {
        display: flex;
        opacity: 1;
        transform: translateX(0); /* Aparece con un barrido */
    }

    /* Estilo para las categorías individuales */
    .category {
        text-align: center;
        margin: 10px;
        width: 150px;
        padding: 10px;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 15px; /* Bordes redondeados */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra ligera */
        transition: transform 0.3s ease; /* Efecto al pasar el ratón */
    }

    .category:hover {
        transform: scale(1.05); /* Efecto de agrandado al pasar el ratón */
    }

    .category img {
        width: 60px;
        height: 60px;
        object-fit: contain;
        cursor: pointer;
    }

    .category h3 {
        font-size: 16px;
        color: #333;
        margin-top: 10px;
    }
</style>

<body>
    <!-- Título principal -->
    <h2>Explora nuestras Categorías</h2>

    <!-- Categorías del primer grupo -->
    <div class="categories-container active" id="categories-1">
        <div class="category">
            <a href="cuadernos.html">
                <img src="Imagenes_Categorias/libreta.png" alt="Cuadernos">
                <h3>Cuadernos</h3>
            </a>
        </div>
        <div class="category">
            <a href="escritura.html">
                <img src="Imagenes_Categorias/lapiz.png" alt="Escritura">
                <h3>Escritura</h3>
            </a>
        </div>
        <div class="category">
            <a href="papel.html">
                <img src="Imagenes_Categorias/papel.png" alt="Papel">
                <h3>Papel</h3>
            </a>
        </div>
        <div class="category">
            <a href="impresion.html">
                <img src="Imagenes_Categorias/impresora.png" alt="Impresión">
                <h3>Impresión</h3>
            </a>
        </div>
        <div class="category">
            <a href="arte.html">
                <img src="Imagenes_Categorias/pintura.png" alt="Pintura">
                <h3>Arte y más</h3>
            </a>
        </div>
    </div>

    <!-- Categorías del segundo grupo -->
    <div class="categories-container" id="categories-2">
        <div class="category">
            <a href="tintas.html">
                <img src="Imagenes_Categorias/gota.png" alt="Tintas y tóner">
                <h3>Tintas y tóner</h3>
            </a>
        </div>
        <div class="category">
            <a href="carpetas.html">
                <img src="Imagenes_Categorias/carpeta.png" alt="Carpetas">
                <h3>Carpetas</h3>
            </a>
        </div>
        <div class="category">
            <a href="tecnologia.html">
                <img src="Imagenes_Categorias/lap.png" alt="Tecnología">
                <h3>Tecnología</h3>
            </a>
        </div>
        <div class="category">
            <a href="oficina.html">
                <img src="Imagenes_Categorias/silla.png" alt="Accesorios de oficina">
                <h3>Oficina</h3>
            </a>
        </div>
        <div class="category">
            <a href="mas.html">
                <img src="Imagenes_Categorias/mas.png" alt="Más">
                <h3>Mucho más</h3>
            </a>
        </div>
    </div>

    <!-- Pestañas -->
    <div class="tabs">
        <div class="tab active" onclick="showTab(1)"></div>
        <div class="tab" onclick="showTab(2)"></div>
    </div>

    <script>
        let currentTab = 1;
        const totalTabs = 2;
        const tabInterval = 5000; // Tiempo entre transiciones automáticas (5 segundos)

        function showTab(tabNumber) {
            // Oculta todas las categorías
            document.querySelectorAll('.categories-container').forEach(function (container) {
                container.classList.remove('active');
            });

            // Remover la clase activa de todas las pestañas
            document.querySelectorAll('.tab').forEach(function (tab) {
                tab.classList.remove('active');
            });

            // Mostrar el grupo de categorías seleccionado
            document.getElementById('categories-' + tabNumber).classList.add('active');

            // Activar la pestaña correspondiente
            document.querySelector('.tab:nth-child(' + tabNumber + ')').classList.add('active');
        }

        function autoRotateTabs() {
            currentTab++;
            if (currentTab > totalTabs) {
                currentTab = 1;
            }
            showTab(currentTab);
        }

        // Iniciar el carrusel automático
        setInterval(autoRotateTabs, tabInterval);
    </script>
</body>

