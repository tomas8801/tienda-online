'use strict'
// CARROUSEL
let url = 'http://localhost/proyectoTienda/'
let carrusel = document.getElementById('carousel')
if(window.location.href !== url){
	carrusel.style.display = 'none'
}