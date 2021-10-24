<?php
    require '../../includes/app.php';

    use App\Vendedor;

    estaAutenticado();

    $vendedor = new Vendedor;

    //Arreglo con mensajes de errores
    $errores = Vendedor::getErrores();

    //Ejecutar el codigo despues de que el usuario envia el formulario

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Crea una nueva instancia de la clase Vendedor
        $vendedor = new Vendedor($_POST['vendedor']);

        //Validar
        $errores = $vendedor->validar();

        //Revisar que el array de errores este vacio para ejecutar la insercion a la BD
        if(empty($errores)) {
            //Insertar en la base de datos
            $vendedor->guardar();
        }

    }
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Registrar vendedor</h1>

        <a href="/admin" class="boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        
        <form action="/admin/vendedores/crear.php" class="formulario" method="POST">
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>

            <input type="submit" name="" id="" value="Registrar Vendedor" class="boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>