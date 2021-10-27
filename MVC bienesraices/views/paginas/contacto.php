<main class="contenedor seccion contenido-centrado">
    <h1>Contacto</h1>

    <?php
        if($mensaje) {
            echo "<p class='alerta exito'>${mensaje}</p>";
        }
    ?>

    <picture>
        <source srcset="/build/img/destacada3.webp" type="image/webp">
        <source srcset="/build/img/destacada3.jpg" type="image/jpeg">
        <img src="/build/img/destacada3.jpg" alt="Imagen contacto" loading="lazy">
    </picture>

    <h2>Llene el formulario de contacto</h2>

    <form action="/contacto" class="formulario" method="POST">
        <fieldset>
            <legend>Información personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu nombre" id="nombre" name="contacto[nombre]" required>

            <label for="mensaje">Mensaje:</label>
            <textarea name="contacto[mensaje]" id="mensaje" cols="30" rows="10" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">Vende o Compra</label>
            <select name="contacto[opciones]" id="opciones" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" placeholder="Tu precio o presupuesto" id="presupuesto" name="contacto[presupuesto]" required>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <p>Cómo desea ser contactado</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input name="contacto[forma-contacto]" type="radio" value="telefono" id="contactar-telefono" required>

                <label for="contactar-email">E-mail</label>
                <input name="contacto[forma-contacto]" type="radio" value="email" id="contactar-email" required>
            </div>

            <div id="contacto"></div>

        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>