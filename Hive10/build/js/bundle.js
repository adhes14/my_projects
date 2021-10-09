let pagina=1;function iniciarApp(){graficarFondoAcciones(),graficarComposicionAcciones(),datosFondoAcciones(),mostrarSeccion(),cambiarSeccion()}async function graficarFondoAcciones(){try{const t=await fetch("https://api.coffetrading.com/vcuota2"),e=await t.json(),{response:o}=e,n=document.getElementById("cuota").getContext("2d");new Chart(n,{type:"line",data:{datasets:[{label:"Valor de cuota",data:o,fill:!0,borderColor:"#46bdc6",borderWidth:2,tension:.2,pointBackgroundColor:"rgba(0, 0, 0, 0)",pointBorderColor:"rgba(0, 0, 0, 0)"}]},options:{parsing:{xAxisKey:"fecha",yAxisKey:"valorcuota"},responsive:!1}})}catch(t){console.log(t)}}async function graficarComposicionAcciones(){try{const t=await fetch("https://api.coffetrading.com/pie2"),e=await t.json(),{response:o}=e,n=[],c=[],a=[];o.forEach(t=>{n.push(t.ticker),c.push(t.prop),a.push(obtenerColor())});const i=document.getElementById("composicion").getContext("2d");new Chart(i,{type:"doughnut",data:{labels:n,datasets:[{label:"Composición",data:c,backgroundColor:a}]},options:{plugins:{title:{display:!0,text:"Composición de activos"}},responsive:!1}})}catch(t){console.log(t)}}async function datosFondoAcciones(){try{const t=await fetch("https://api.coffetrading.com/datos2"),e=await t.json(),{response:o}=e,n=document.createElement("P");n.textContent=o.finicio;const c=document.createElement("P");c.textContent=o.fcierre;const a=document.createElement("P");a.textContent=o.vcierre;const i=document.createElement("P");i.textContent=o.vinicio;const r=document.createElement("P");r.textContent=o.vmax;const s=document.createElement("P");s.textContent=o.vmin;const d=document.querySelector(".resultados");d.appendChild(n),d.appendChild(c),d.appendChild(i),d.appendChild(r),d.appendChild(s),d.appendChild(a)}catch(t){console.log(t)}}function mostrarSeccion(){const t=document.querySelector(".mostrar-seccion");t&&t.classList.remove("mostrar-seccion");document.querySelector("#fondo-"+pagina).classList.add("mostrar-seccion");const e=document.querySelector(".tabs .actual");e&&e.classList.remove("actual");document.querySelector(`[data-fondo="${pagina}"]`).classList.add("actual")}function cambiarSeccion(){document.querySelectorAll(".tabs button").forEach(t=>{t.addEventListener("click",t=>{t.preventDefault(),pagina=parseInt(t.target.dataset.fondo),mostrarSeccion()})})}function obtenerColor(){let t="#";for(var e=0;e<3;e++)t+="0123456789ABCDEF"[Math.floor(16*Math.random())];return t}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));
//# sourceMappingURL=bundle.js.map
