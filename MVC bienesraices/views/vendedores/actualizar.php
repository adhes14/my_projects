<main class="contenedor seccion contenido-centrado">
    <h1>Actualizar vendedor</h1>

    <a href="/admin" class="boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>

    
    <form class="formulario" method="POST">
        <?php include __DIR__ . '/formulario.php'; ?>

        <input type="submit" name="" id="" value="Guardar cambios" class="boton-verde">
    </form>
</main>