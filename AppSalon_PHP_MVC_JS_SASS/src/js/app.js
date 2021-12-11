let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
    tabs(); //Cambia la accion cuando se presionan los tabs
    mostrarSeccion(); //La primera vez que carga la pagina carga el fondo predeterminado
    botonesPaginador(); //Agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();

    consultarAPI(); //Consulta la API en el backend

    idCliente();
    nombreCliente();
    seleccionarFecha();
    seleccionarHora(); //Agrega la hora en el objeto
    mostrarResumen();
}

function tabs() {
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach(boton => {
        boton.addEventListener('click', function(e) {
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();
            botonesPaginador();
        });
    });
}

function mostrarSeccion() {
    //Ocultar la seccion que tenga la clase de mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }
    
    //Seleccionar la seccion con el paso
    const seccion = document.querySelector(`#paso-${paso}`);
    seccion.classList.add('mostrar');

    //Quita actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior) {
        tabAnterior.classList.remove('actual');
    }

    //Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function botonesPaginador() {
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    switch(paso) {
        case 1:
            paginaAnterior.classList.add('ocultar');
            paginaSiguiente.classList.remove('ocultar');
            break;
        case 3:
            paginaSiguiente.classList.add('ocultar');
            paginaAnterior.classList.remove('ocultar');
            mostrarResumen();
            break;
        default:
            paginaAnterior.classList.remove('ocultar');
            paginaSiguiente.classList.remove('ocultar');
            break;
    }
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function() {
        if(paso <= pasoInicial) return;

        paso--;

        botonesPaginador();
        mostrarSeccion();
    });
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function() {
        if(paso >= pasoFinal) return;

        paso++;

        botonesPaginador();
        mostrarSeccion();
    });
}

async function consultarAPI() {
    try {
        const url = 'http://localhost:8000/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);

    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios) {
    servicios.forEach( servicio => {
        const {id, nombre, precio} = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `$ ${precio}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;

        servicioDiv.onclick = function() {
            seleccionarServicio(servicio);
        } //Se hace de esta manera con elementos que fueron creados con JS
        //si se llama directamente a la funcion se ejecuta incluso sin hacer click, saldra bien si no tiene parentesis

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);

        // console.log(servicioDiv);
    });
}

function seleccionarServicio(servicio) {
    const { id } = servicio;
    const { servicios } = cita;

    //Comprobar si un servicio ya fue agregado
    if( servicios.some( agregado => agregado.id === id)) {
        //Eliminarlo
        cita.servicios = servicios.filter( agregado => agregado.id !== id);
    } else {
        //Agregarlo
        cita.servicios = [...servicios, servicio];
    }

    //Selecciona o deselecciona el elemento visualmente
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);
    divServicio.classList.toggle('seleccionado');
}

function idCliente() {
    cita.id = document.querySelector('#id').value;
}
function nombreCliente() {
    cita.nombre = document.querySelector('#nombre').value;
}

function seleccionarFecha() {
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(e) {
        const dia = new Date(e.target.value).getUTCDay();
        
        if([0, 6].includes(dia)) {
            e.target.value = ''; //Provoca que se imprima el error 2 veces
            mostrarAlerta('Fines de semana no permitidos', 'error', '.formulario');
        } else {
            cita.fecha = e.target.value;
        }
    });
}

function seleccionarHora() {
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function(e) {
        const horaCita = e.target.value;
        hora = horaCita.split(":")[0];
        if(hora < 10 || hora > 18) {
            mostrarAlerta('Hora no válida', 'error', '.formulario');
            e.target.value = '';
        } else {
            cita.hora = e.target.value;
        }
    });
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {
    //Previene que se generen mas de una alerta
    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia) {
        alertaPrevia.remove();
    }

    alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);
    if(desaparece) {
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }
}

function mostrarResumen() {
    const resumen = document.querySelector('.contenido-resumen');

    //Limpiar el contenido del resumen
    while(resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }
    
    if(Object.values(cita).includes('') || cita.servicios.length === 0) {
        mostrarAlerta('Faltan llenar datos', 'error', '.contenido-resumen', false);
        return;
    }

    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Resumen de Servicios';
    resumen.appendChild(headingServicios);

    //Formatear el DIV de resumen
    const {nombre, fecha, hora, servicios} = cita;

    servicios.forEach(servicio => {
        const {id, nombre, precio} = servicio;
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;
        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio: </span> $${precio}`;

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        resumen.appendChild(contenedorServicio);
    });

    //Formatear la fecha en español
    const fechaObj = new Date(fecha + ' 00:00');
    const opciones = {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'}
    const fechaFormateada = fechaObj.toLocaleDateString('es-MX', opciones);

    const headingCita = document.createElement('H3');
    headingCita.textContent = 'Resumen de Cita';
    resumen.appendChild(headingCita);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre: </span> ${nombre}`;
    const fechaCliente = document.createElement('P');
    fechaCliente.innerHTML = `<span>Fecha: </span> ${fechaFormateada}`;
    const horaCliente = document.createElement('P');
    horaCliente.innerHTML = `<span>Hora: </span> ${hora}`;

    //Boton para crear una cita
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent = 'Reservar cita';
    botonReservar.onclick = reservarCita; //Si se pone los () llama a la funcion sin hacer click

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCliente);
    resumen.appendChild(horaCliente);
    resumen.appendChild(botonReservar);

}

async function reservarCita() {
    const {nombre, fecha, hora, servicios, id} = cita;
    const idServicios = servicios.map(servicio => servicio.id);
    
    const datos = new FormData();
    datos.append('usuarioId', id);
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('servicios', idServicios);

    // console.log([...datos]); //es una forma de ver los datos que se estan enviado
    try {
        //peticion hacia la API
        const url = 'http://localhost:8000/api/citas';
    
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });
    
        const resultado = await respuesta.json();
        if(resultado.resultado) {
            Swal.fire({
                icon: 'success',
                title: 'Cita Creada',
                text: 'Tu cita fue creada correctamente',
                button: 'OK'
            }).then(() => {
                window.location.reload();
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error al guardar la cita'
        })
    }
}