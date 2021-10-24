<?php
    if(!isset($_SESSION)) {
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logotipo">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="boton dark" class="dark-mode-boton">
                    <nav class="navegacion">
                        <a href="/build/nosotros.php">Nosotros</a>
                        <a href="/build/anuncios.php">Anuncios</a>
                        <a href="/build/blog.php">Blog</a>
                        <a href="/build/contacto.php">Contacto</a>
                        <?php if($auth) : ?>
                            <a href="/build/cerrar-sesion.php">Cerrar sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div> <!-- Fin de Barra -->
            <?php echo $inicio ? "<h1>Venta de casas y departamentos exclusivos de lujo</h1>" : "";?>
        </div>

    </header>