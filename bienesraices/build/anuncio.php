<?php
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /');
    }

    //Importar la conexion
    require __DIR__ . '/../includes/config/database.php';
    $db = conectarDB();

    //consultar
    $query = "SELECT * FROM propiedades WHERE id = ${id}";

    //obtener el resultado
    $resultado = mysqli_query($db, $query);

    if(!$resultado->num_rows) {
        header('Location: /');
    }

    $propiedad = mysqli_fetch_assoc($resultado);

    require '../includes/funciones.php';
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>

        <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen de la Propiedad" loading="lazy">

        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad['precio']; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono-anuncio" src="img/icono_wc.svg" alt="icono wc" loading="lazy">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img class="icono-anuncio" src="img/icono_estacionamiento.svg" alt="icono icono_estacionamiento" loading="lazy">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img class="icono-anuncio" src="img/icono_dormitorio.svg" alt="icono icono_dormitorio" loading="lazy">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>

            <p><?php echo $propiedad['descripcion']; ?></p>
        </div>
    </main>

<?php

    mysqli_close($db);

    incluirTemplate('footer');

?>