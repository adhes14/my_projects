<?php
    require '../includes/app.php';
    
    estaAutenticado();

    use App\Propiedad;
    use App\Vendedor;

    //Implementar un metodo para obtener las propiedades
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    //leyendo una URL con GET, muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null; //Verifica que la variable exista, antes de usaba isset

    //Muestra mensaje condicional
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tipo = $_POST['tipo'];
        if(validarTipoContenido($tipo)) {
            //Compara lo que vamos a eliminar
            if($tipo == 'vendedor') {
                $vendedor = Vendedor::find($_POST['id']);
                $vendedor->eliminar();    
            } elseif($tipo == 'propiedad') {
                $propiedad = Propiedad::find($_POST['id']);
                $propiedad->eliminar(); 
            }
        }
    }
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de bienes raices</h1>
        <?php $mensaje = mostrarNotificacion($resultado);
        if($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>
        <?php } ?>

        <a href="/admin/propiedades/crear.php" class="boton-verde">Nueva propiedad</a>
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

        <h2>Vendedores</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach($vendedores as $vendedor) : ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-amarillo">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

<?php
    incluirTemplate('footer');
?>