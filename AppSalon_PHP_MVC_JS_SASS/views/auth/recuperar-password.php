<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación:</p>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

<?php if($error) { return; } ?>

<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password:</label>
        <input
            type="password"
            id="password"
            name="password"
            placeholder="Coloca tu nuevo password"
        >
    </div>
    <input type="submit" value="Guardar nuevo password" class="boton">
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
</div>