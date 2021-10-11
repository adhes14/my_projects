<?php
    require '../../includes/config/database.php';

    $db = conectarDB();

    require '../../includes/funciones.php';
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Crear</h1>

        <a href="/admin" class="boton-verde">Volver</a>

        <form action="" class="formulario">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" placeholder="Título Propiedad">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" placeholder="Precio Propiedad">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción</label>
                <textarea name="" id="descripcion" cols="30" rows="10"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" placeholder="Ej: 3" min="1" max="9">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" placeholder="Ej: 2" min="1" max="9">

                <label for="estacionamiento">Estacionamientos:</label>
                <input type="number" id="estacionamiento" placeholder="Ej: 1" min="1" max="9">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="" id="">
                    <option value="1">Adhemar</option>
                    <option value="2">Roxana</option>
                </select>
            </fieldset>

            <input type="submit" name="" id="" value="Crear Propiedad" class="boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>