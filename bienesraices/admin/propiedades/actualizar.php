<?php

    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    require '../../includes/app.php';

    estaAutenticado();

    //Validar que sea un id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /admin');
    }

    //Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);

    //Consultar para obtener los vededores
    $vendedores = Vendedor::all();

    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    //Ejecutar el codigo despues de que el usuario envia el formulario

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Asignar los atributos
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);

        
        //Validacion
        $errores = $propiedad->validar();
        
        //Realiza un rezise a la imagen con intervention
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            
            //Gerar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            $propiedad->setImagen($nombreImagen);
        }

        //Revisar que el array de errores este vacio para ejecutar la insercion a la BD
        if(empty($errores)) {
            //Crear la carpeta para subir archivos
            if(!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }

            //Insertar en la base de datos
            $propiedad->guardar();
        }

    }
    
    incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Actualizar Propiedad</h1>

    <a href="/admin" class="boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>

    
    <form class="formulario" method="POST" enctype="multipart/form-data"> <!-- enctype te permite leer archivos que se carguen en el formulario -->
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" name="" id="" value="Actualizar Propiedad" class="boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>