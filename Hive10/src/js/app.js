let pagina = 1;

document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});


function iniciarApp() {

    if(document.URL.includes('fondo.html')) {
        //Grafica del valor de cuota
        graficarFondoAcciones();
    
        //Grafica de la composicion
        graficarComposicionAcciones()
    
        //Mostrar datos del fondo
        datosFondoAcciones();
    
        //Resalta el div actual segun el tab al que se presiona
        mostrarSeccion();
    
        //Oculta o muestra una seccion segun el tab que se presiona
        cambiarSeccion();
    }

    // Fija la barra de navegacion cuando se hace scroll down
    navegacionFija();

}

async function graficarFondoAcciones() {
    try {
        //Extraer los datos de la API
        const resultado = await fetch('https://api.coffetrading.com/vcuota2');
        const db = await resultado.json();
        const { response } = db;

        //Graficar usando Chart.js
        const ctx = document.getElementById('cuota').getContext('2d');
        let myChart = new Chart(ctx, {
            type: 'line',
            data: {
                // labels: fecha,
                datasets: [{
                    label: 'Valor de cuota',
                    data: response,
                    fill: true,
                    borderColor: '#46bdc6',
                    borderWidth: 2,
                    tension: 0.2,
                    pointBackgroundColor: 'rgba(0, 0, 0, 0)',
                    pointBorderColor: 'rgba(0, 0, 0, 0)'
                }]
            },
            options: {
                parsing: {
                    xAxisKey: 'fecha',
                    yAxisKey: 'valorcuota'
                },
                responsive: false
            }
        });
    } catch (error) {
        console.log(error);
    }
    
}

async function graficarComposicionAcciones() {
    try {
        //Extraer los datos de la API
        const resultado = await fetch('https://api.coffetrading.com/pie2');
        const db = await resultado.json();
        const { response } = db;
        const ticker = [];
        const prop = [];
        const colores = [];
        response.forEach(e => {
            ticker.push(e.ticker);
            prop.push(e.prop);
            colores.push(obtenerColor());
        });

        //Graficar usando Chart.js
        const ctx = document.getElementById('composicion').getContext('2d');
        let myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ticker,
                datasets: [{
                    label: 'Composición',
                    data: prop,
                    backgroundColor: colores
                }]
            },
            options: {
                // parsing: {
                //     xAxisKey: 'ticker',
                //     yAxisKey: 'prop'
                // },
                plugins: {
                    title: {
                        display: true,
                        text: 'Composición de activos'
                    }
                },
                responsive: false
            }
        });
    } catch (error) {
        console.log(error);
    }
    
}

async function datosFondoAcciones() {
    try {
        //Extraer los datos de la API
        const resultado = await fetch('https://api.coffetrading.com/datos2');
        const db = await resultado.json();
        const { response } = db;
        const finicio = document.createElement('P');
        finicio.textContent = response.finicio;
        const fcierre = document.createElement('P');
        fcierre.textContent = response.fcierre;
        const vcierre = document.createElement('P');
        vcierre.textContent = response.vcierre;
        const vinicio = document.createElement('P');
        vinicio.textContent = response.vinicio;
        const vmax = document.createElement('P');
        vmax.textContent = response.vmax;
        const vmin = document.createElement('P');
        vmin.textContent = response.vmin;

        const resultados = document.querySelector('.resultados');
        resultados.appendChild(finicio);
        resultados.appendChild(fcierre);
        resultados.appendChild(vinicio);
        resultados.appendChild(vmax);
        resultados.appendChild(vmin);
        resultados.appendChild(vcierre);

    } catch (error) {
        console.log(error);
    }
    
}

function mostrarSeccion() {
    //Eliminar mostrar-seccion de la seccion anterior
    const seccionAnterior = document.querySelector('.mostrar-seccion');
    if( seccionAnterior ) {
        seccionAnterior.classList.remove('mostrar-seccion');
    }

    const seccionActual = document.querySelector(`#fondo-${pagina}`);
    seccionActual.classList.add('mostrar-seccion');

    //Elimina actual del tab anterior
    const tabAnterior = document.querySelector('.tabs .actual');
    if( tabAnterior ) {
        tabAnterior.classList.remove('actual');
    }

    //Resalta el tab actual
    const tab = document.querySelector(`[data-fondo="${pagina}"]`);
    tab.classList.add('actual');
}

function cambiarSeccion() {
    const enlaces = document.querySelectorAll('.tabs button');

    enlaces.forEach( enlace => {
        enlace.addEventListener('click', e => {
            e.preventDefault();

            pagina = parseInt(e.target.dataset.fondo);

            //Llamar la funcion de mostrar seccion
            mostrarSeccion();
        })
    })
}

function obtenerColor() {
    let letters = '0123456789ABCDEF';
    let color = '#';
    for (var i = 0; i < 3; i++) {
    color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function navegacionFija() {

    const barra = document.querySelector('.contenedor-barra');
    //Registrar el Intersection Observer
    const observer = new IntersectionObserver( function(entries) {
        if(entries[0].isIntersecting) {
            barra.classList.remove('fijo');
        } else {
            barra.classList.add('fijo');
        }
    });

    //Elemento a observar
    observer.observe(document.querySelector('.tradingview-widget-container'));
};