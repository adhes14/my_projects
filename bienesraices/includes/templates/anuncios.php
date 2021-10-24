<?php
    use App\Propiedad;

    if($_SERVER['SCRIPT_NAME'] === '/build/anuncios.php') {
        $propiedades = Propiedad::all();
    } else {
        $propiedades = Propiedad::get(3);
    }
?>

<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad) { ?>
    <div class="anuncio">
        <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio" loading="lazy">

        <div class="contenido-anuncio">
            <h3><?php echo $propiedad->titulo; ?></h3>
            <p><?php echo $propiedad->descripcion; ?></p>
            <p class="precio"><?php echo $propiedad->precio; ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono-anuncio" src="img/icono_wc.svg" alt="icono wc" loading="lazy">
                    <p><?php echo $propiedad->wc; ?></p>
                </li>
                <li>
                    <img class="icono-anuncio" src="img/icono_estacionamiento.svg" alt="icono icono_estacionamiento" loading="lazy">
                    <p><?php echo $propiedad->estacionamiento; ?></p>
                </li>
                <li>
                    <img class="icono-anuncio" src="img/icono_dormitorio.svg" alt="icono icono_dormitorio" loading="lazy">
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li>
            </ul>
            <a href="anuncio.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo">Ver Propiedad</a>
        </div> <!-- Contenido anuncio -->
    </div> <!-- anuncio -->
    <?php } ?>

</div> <!-- contenedor de anuncio -->