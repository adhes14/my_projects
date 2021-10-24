<?php
    require '../../includes/app.php';

    use App\Vendedor;

    estaAutenticado();

    //Validar que sea un Id valido

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /admin');
    }

    //Obtener arreglo del vendedor
    $vendedor = Vendedor::find($id);

    //Arreglo con mensajes de errores
    $errores = Vendedor::getErrores();

    //Ejecutar el codigo despues de que el usuario envia el formulario

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Asignar valores
        $args = $_POST['vendedor'];

        //Sincronizar objeto en memoria con lo que el usuario escribio
        $vendedor->sincronizar($args);

        //validacion
        $errores = $vendedor->validar();

        if(empty($errores)) {
            $vendedor->guardar();
        }

    }
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Actualizar vendedor</h1>

        <a href="/admin" class="boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        
        <form class="formulario" method="POST">
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>

            <input type="submit" name="" id="" value="Guardar cambios" class="boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>