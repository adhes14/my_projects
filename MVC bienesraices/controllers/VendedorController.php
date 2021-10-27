<?php

namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController {
    public static function eliminar() {
        //Funcionalidad para eliminar vendedor
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //validar el id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();    
                }
            }
            
        }
    }

    public static function crear(Router $router) {
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

        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        //Validar que sea un id valido
        $id = validarORedireccionar('/admin');

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

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }
}