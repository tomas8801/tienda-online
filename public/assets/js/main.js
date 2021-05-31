import displayCarousel from "./carousel.js";
import hamburgerMenu from "./menu_hamburguesa.js";
import checkOut from "./mercadopago.js";

const d = document;


d.addEventListener('DOMContentLoaded', () => {
hamburgerMenu('.panel-btn', '.panel', '.menu a');
displayCarousel('.carousel');
checkOut();
});

