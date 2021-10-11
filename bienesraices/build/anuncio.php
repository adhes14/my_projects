<?php

    require '../includes/funciones.php';
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en venta frente al bosque</h1>

        <picture>
            <source srcset="img/destacada.webp" type="image/webp">
            <source srcset="img/destacada.jpg" type="image/jpeg">
            <img src="img/destacada.jpg" alt="imagen de la Propiedad" loading="lazy">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono-anuncio" src="img/icono_wc.svg" alt="icono wc" loading="lazy">
                    <p>4</p>
                </li>
                <li>
                    <img class="icono-anuncio" src="img/icono_estacionamiento.svg" alt="icono icono_estacionamiento" loading="lazy">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono-anuncio" src="img/icono_dormitorio.svg" alt="icono icono_dormitorio" loading="lazy">
                    <p>4</p>
                </li>
            </ul>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium velit tempora quis aliquam? Eos architecto necessitatibus provident accusantium doloremque? Dolor non voluptas fugit culpa ut reiciendis, error adipisci atque fugiat. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Adipisci iure officiis a blanditiis temporibus debitis quis? Officiis quis dignissimos, facilis ut quos perspiciatis explicabo, error et libero sint nisi. Ipsum.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed voluptas odit excepturi deserunt aliquid molestiae in velit minus sapiente, magni itaque vitae eos dolorum, eveniet iure! Numquam eveniet libero perspiciatis.</p>
        </div>
    </main>

<?php

    incluirTemplate('footer');

?>