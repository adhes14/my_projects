let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

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
        console.log(servicios);

    } catch (error) {
        console.log(error);
    }
}