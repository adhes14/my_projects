<main class="contenedor seccion">
        <h1>Administrador de bienes raices</h1>

        <?php
            if($resultado) {
                $mensaje = mostrarNotificacion($resultado);
                if($mensaje) { ?>
                    <p class="alerta exito"><?php echo s($mensaje); ?></p>
            <?php }
            }
        ?>

        <a href="/propiedades/crear" class="boton-verde">Nueva propiedad</a>
        <a href="/admin/vendedores/crear.php" class="boton-amarillo-inline">Nuev@ vendedor</a>

        <h2>Propiedades</h2>
        
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach($propiedades as $propiedad) : ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen" class="imagen-tabla"></td>
                    <td>$<?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</main>