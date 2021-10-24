<?php
    //Incluye el header
    require '../includes/app.php';
    $db = conectarDB();

    $errores = [];

    //Autenticar el usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email) {
            $errores[] = 'El email es obligatorio o no es válido';
        }

        if(!$password) {
            $errores[] = 'El password es obligatorio';
        }

        if(empty($errores)) {
            //Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '${email}';";
            $resultado = mysqli_query($db, $query);

            if( $resultado->num_rows) {
                //Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                $auth = password_verify($password, $usuario['password']);

                // var_dump($auth);

                if($auth) {
                    //El usuario esta autenticado
                    session_start();

                    //Llenar el arreglo de la sesión
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');
                    
                } else {
                    $errores[] = 'El password es incorrecto';
                }
            } else {
                $errores[] = 'El usuario no existe';
            }
        }
    }
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach( $errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Email y password</legend>
                
                <label for="email">Tu E-mail</label>
                <input name="email" type="email" placeholder="Tu E-mail" id="email" required>

                <label for="password">Password</label>
                <input name="password" type="password" placeholder="Tu password" id="password" required>
            </fieldset>

            <input type="submit" value="Iniciar sesión" class="boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>