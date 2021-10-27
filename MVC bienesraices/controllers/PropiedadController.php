<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
    public static function index(Router $router) {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();

        //Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router) {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        //Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Crea una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);

            //Realiza un rezise a la imagen con intervention
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                
                //Gerar un nombre unico
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

                $propiedad->setImagen($nombreImagen);
            }

            //Valida
            $errores = $propiedad->validar();

            //Revisar que el array de errores este vacio para ejecutar la insercion a la BD
            if(empty($errores)) {
                //Crear la carpeta para subir archivos
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                
                //Subida de archivos

                $image->save(CARPETA_IMAGENES . $nombreImagen);

                //Insertar en la base de datos
                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        //Validar que sea un id valido

        $id = validarORedireccionar('/admin');

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

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo = $_POST['tipo'];
            if(validarTipoContenido($tipo)) {
                $propiedad = Propiedad::find($_POST['id']);
                $propiedad->eliminar();
            }
        }
    }
}