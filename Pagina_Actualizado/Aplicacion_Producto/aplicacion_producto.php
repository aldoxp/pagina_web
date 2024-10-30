<div class="products-section">
        <div class="product">
            <img src="Imagenes/infinito.jpeg" alt="Lápiz">
            <p>Lápiz infinito con diseño
                a $20 MXN
            </p>
            <button>Ver más</button>
        </div>
        <div class="product">
            <img src="Imagenes/cuaderno.jpeg" alt="Cuaderno">
            <p>Cuaderno de Rayas</p>
            <button>Ver más</button>
        </div>
        <div class="product">
            <img src="Imagenes/colores.jpeg" alt="Colores">
            <p>Colores 24 piezas</p>
            <button>Ver más</button>
        </div>
        <div class="product">
            <img src="Imagenes/mochila.jpeg" alt="Mochila">
            <p>Mochila Escolar</p>
            <button>Ver más</button>
        </div>
        <div class="product">
            <img src="Imagenes/juegodegeo.jpeg" alt="Regla">
            <p>Juego de geometria</p>
            <button>Ver más</button>
        </div>
        <div class="product">
            <img src="Imagenes/tijera.jpeg" alt="Tijeras">
            <p>Tijeras</p>
            <button>Ver más</button>
        </div>
    </div>

    <style>
    	        .products-section {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            padding: 20px;
            background-color: white;
        }

        .product {
            background-color: white;
            text-align: center;
            margin: 10px;
            padding: 10px;
            width: 150px;
        }

        .product img {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .product p {
            margin: 10px 0;
            font-size: 14px;
        }

        .product button {
            background-color: #ec297b;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .product button:hover {
            background-color: #ec297b;
        }
    </style>