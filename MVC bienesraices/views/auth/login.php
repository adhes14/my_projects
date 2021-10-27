<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach( $errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario" action="/login">
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