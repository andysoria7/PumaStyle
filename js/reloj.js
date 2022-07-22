
"use strict"

const addZeros = n =>{
    if(n.toString().length < 2) return "0".concat(n);
    return n;

}

const actualizarHora = ()=>{
    const time = new Date();
    let hora = addZeros(time.getHours());
    let min = addZeros(time.getMinutes());
    let seg = addZeros(time.getSeconds());

    document.querySelector(".hora").textContent = hora;
    document.querySelector(".min").textContent = min;
    document.querySelector(".seg").textContent = seg;

}
actualizarHora()

setInterval(actualizarHora,1000)