<?php

    require '../includes/funciones.php';
    
    incluirTemplate('header', true);
?>

    <main class="contenedor seccion">
        <h1>Más sobre nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum doluam dolores, aspernatur numquam sed unde. Ipsam esse dignissimos porro optio numquam iste deleniti. Asperiores inventore nihil nam dignissimos nostrum?</p>
            </div>
            <div class="icono">
                <img src="img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum doluam dolores, aspernatur numquam sed unde. Ipsam esse dignissimos porro optio numquam iste deleniti. Asperiores inventore nihil nam dignissimos nostrum?</p>
            </div>
            <div class="icono">
                <img src="img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum doluam dolores, aspernatur numquam sed unde. Ipsam esse dignissimos porro optio numquam iste deleniti. Asperiores inventore nihil nam dignissimos nostrum?</p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y departamentos en venta</h2>

        <div class="contenedor-anuncios">
            <div class="anuncio">
                <picture>
                    <source srcset="img/anuncio1.webp" type="image/webp">
                    <source srcset="img/anuncio1.jpg" type="image/jpeg">
                    <img src="img/anuncio1.jpg" alt="anuncio" loading="lazy">
                </picture>

                <div class="contenido-anuncio">
                    <h3>Casa de lujo en el lago</h3>
                    <p>Casa en el lago con excelente vista, acabados de lujo a un excelente precio</p>
                    <p class="precio">$3,000,000</p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono-anuncio" src="img/icono_wc.svg" alt="icono wc" loading="lazy">
                            <p>3</p>
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
                    <a href="anuncio.php" class="boton-amarillo">Ver Propiedad</a>
                </div> <!-- Contenido anuncio -->
            </div> <!-- anuncio -->
            <div class="anuncio">
                <picture>
                    <source srcset="img/anuncio2.webp" type="image/webp">
                    <source srcset="img/anuncio2.jpg" type="image/jpeg">
                    <img src="img/anuncio2.jpg" alt="anuncio" loading="lazy">
                </picture>

                <div class="contenido-anuncio">
                    <h3>Casa terminados de lujo</h3>
                    <p>Casa en el lago con excelente vista, acabados de lujo a un excelente precio</p>
                    <p class="precio">$2,000,000</p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono-anuncio" src="img/icono_wc.svg" alt="icono wc" loading="lazy">
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono-anuncio" src="img/icono_estacionamiento.svg" alt="icono icono_estacionamiento" loading="lazy">
                            <p>2</p>
                        </li>
                        <li>
                            <img class="icono-anuncio" src="img/icono_dormitorio.svg" alt="icono icono_dormitorio" loading="lazy">
                            <p>4</p>
                        </li>
                    </ul>
                    <a href="anuncio.php" class="boton-amarillo">Ver Propiedad</a>
                </div> <!-- Contenido anuncio -->
            </div> <!-- anuncio -->
            <div class="anuncio">
                <picture>
                    <source srcset="img/anuncio3.webp" type="image/webp">
                    <source srcset="img/anuncio3.jpg" type="image/jpeg">
                    <img src="img/anuncio3.jpg" alt="anuncio" loading="lazy">
                </picture>

                <div class="contenido-anuncio">
                    <h3>Casa con alberca</h3>
                    <p>Casa en el lago con excelente vista, acabados de lujo a un excelente precio</p>
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
                    <a href="anuncio.php" class="boton-amarillo">Ver Propiedad</a>
                </div> <!-- Contenido anuncio -->
            </div> <!-- anuncio -->

        </div> <!-- contenedor de anuncio -->

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario y un asesor se pondrá en contacto contigo a la brevedad</p>
        <a href="contacto.php" class="boton-amarillo-inline">Contáctanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="img/blog1.webp" type="image/webp">
                        <source srcset="img/blog1.jpg" type="image/jpeg">
                        <img src="img/blog1.jpg" alt="entrada de blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>

                        <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
                    </a>
                </div>
            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="img/blog2.webp" type="image/webp">
                        <source srcset="img/blog2.jpg" type="image/jpeg">
                        <img src="img/blog2.jpg" alt="entrada de blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guía para la decoración de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>25/10/2021</span> por: <span>Admin</span></p>

                        <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio</p>
                    </a>
                </div>
            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>El personal se comportó de una excelente forma, muy buena atención y la casa que ofrecieron cumple con todas mis expectativas</blockquote>
                <p>- Adhemar D.</p>
            </div>
        </section>
    </div>

<?php incluirTemplate('footer'); ?>