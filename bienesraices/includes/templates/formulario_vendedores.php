<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" placeholder="Nombre del vendedor" name="vendedor[nombre]" value="<?php echo s($vendedor->nombre); ?>">
    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" placeholder="Apellidos del vendedor" name="vendedor[apellido]" value="<?php echo s($vendedor->apellido); ?>">
    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" placeholder="Teléfono del vendedor" name="vendedor[telefono]" value="<?php echo s($vendedor->telefono); ?>">
</fieldset>