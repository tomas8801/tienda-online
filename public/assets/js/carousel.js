const d = document;

export default function displayCarousel(id){
    

    let url = 'http://localhost/tienda-online/'
    let carrusel = document.querySelector(id)
    if(window.location.href !== url){
        carrusel.style.display = 'none'
    }

}