<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router) {
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router) {
        
        $router->render('paginas/nosotros');
    }

    public static function anuncios(Router $router) {
        $propiedades = Propiedad::all();

        $router->render('paginas/anuncios', [
            'propiedades' => $propiedades
        ]);
    }

    public static function anuncio(Router $router) {
        $id = validarORedireccionar('/anuncios');
        $propiedad = Propiedad::find($id);
        
        $router->render('paginas/anuncio', [
            'id' => $id,
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router) {
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router) {
        $router->render('paginas/entrada');
    }

    public static function contacto(Router $router) {

        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $respuestas = $_POST['contacto'];

            //Crear una instancia de PHPmailer
            $mail = new PHPMailer();

            //Confiurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '3a5978b90eb666';
            $mail->Password = '1163ef3d896ca4';
            $mail->SMTPSecure = 'tls';

            //configurar el contenido del e-mail
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', $respuestas['nombre']);
            $mail->Subject = 'Tienes un nuevo mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Tipo de negocio: ' . $respuestas['opciones'] . '</p>';
            $contenido .= '<p>Presupuesto: $' . $respuestas['presupuesto'] . '</p>';
            
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['forma-contacto'] . '</p>';
            //Enviar de forma condicional algunas campos de email o telefono
            if($respuestas['forma-contacto'] === 'telefono') {
                $contenido .= '<p>Teléfono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora: ' . $respuestas['hora'] . '</p>';
            } else {
                //es email, entonces agregamos el campo de email
                $contenido .= '<p>E-mail: ' . $respuestas['email'] . '</p>';
            }
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            //Enviar el email
            if($mail->send()) {
                $mensaje = 'Mensaje enviado correctamente';
            } else {
                $mensaje = 'El mensaje no se puedo enviar';
            }
        }
        
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}