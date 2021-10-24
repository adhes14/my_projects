<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Título:</label>
    <input type="text" id="titulo" placeholder="Título Propiedad" name="propiedad[titulo]" value="<?php echo  s($propiedad->titulo); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" placeholder="Precio Propiedad" name="propiedad[precio]" value="<?php echo s($propiedad->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

    <?php if($propiedad->imagen) { ?>
        <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen de propiedad" class="imagen-small">
    <?php } ?>

    <label for="descripcion">Descripción</label>
    <textarea name="propiedad[descripcion]" id="descripcion" cols="30" rows="10"><?php echo s($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input name="propiedad[habitaciones]" type="number" id="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->habitaciones); ?>">

    <label for="wc">Baños:</label>
    <input name="propiedad[wc]" type="number" id="wc" placeholder="Ej: 2" min="1" max="9" value="<?php echo s($propiedad->wc); ?>">

    <label for="estacionamiento">Estacionamientos:</label>
    <input name="propiedad[estacionamiento]" type="number" id="estacionamiento" placeholder="Ej: 1" min="1" max="9" value="<?php echo s($propiedad->estacionamiento); ?>">
</fieldset>

<fieldset>
    <legend>Vendedores</legend>
    
    <label for="vendedor">Vendedor:</label>
    <select name="propiedad[vendedorid]" id="vendedor">
        <option value="" disabled selected>-- Seleccione --</option>
        <?php foreach($vendedores as $vendedor) : ?>
            <option value="<?php echo s($vendedor->id); ?>" <?php echo $propiedad->vendedorid === $vendedor->id ? 'selected' : ''; ?>><?php echo s($vendedor->nombre) . ' ' . s($vendedor->apellido); ?></option>
        <?php endforeach; ?>
    </select>
</fieldset>