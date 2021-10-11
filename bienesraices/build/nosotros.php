<?php

    require '../includes/funciones.php';
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Conoce sobre nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="img/nosotros.webp" type="image/webp">
                    <source srcset="img/nosotros.jpg" type="image/jpeg">
                    <img src="img/nosotros.jpg" alt="Sobre nosotros" loading="lazy">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>25 años de experiencia</blockquote>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure eaque dicta quod ad debitis veniam voluptate sit ipsa asperiores. Quod eveniet maiores ipsam, sed aspernatur sint corrupti rerum consectetur placeat. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facilis ex ratione mollitia aspernatur suscipit iure sequi, expedita sunt sapiente molestias culpa dolore temporibus totam adipisci excepturi numquam, atque vero alias?</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus corporis explicabo ut obcaecati repellendus nemo ad excepturi error aspernatur perspiciatis repellat deserunt dolor dicta iste eveniet, culpa molestiae eos dolore!</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
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
    </section>

<?php incluirTemplate('footer'); ?>