<?php

namespace Controllers;

use MVC\Router;

class CitaController {
    public static function index(Router $router) {

        //Verifica que solo puedan ingresar usuarios autenticados antes de mostrar la vista
        isAuth();

        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id']
        ]);
    }
}