import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

function toggleOrderDetails(id) {
    const element = document.getElementById(id);
    element.classList.toggle("active");
}
