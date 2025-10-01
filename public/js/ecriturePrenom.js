document.addEventListener("DOMContentLoaded", function () {
const span = document.getElementById("nom");
const fullText = "Amélie Bonhomme";
let index = 0;
let isDeleting = false;

function typeEffect() {
    if (!isDeleting) {
    span.textContent = fullText.slice(0, index);
    index++;
    if (index > fullText.length) {
        isDeleting = true;
        setTimeout(typeEffect, 1000); // pause avant suppression
        return;
    }
    } else {
    span.textContent = fullText.slice(0, index);
    index--;
    if (index < 0) {
        isDeleting = false;
        setTimeout(typeEffect, 500); // pause avant réécriture
        return;
    }
    }
    setTimeout(typeEffect, 200); // vitesse d’écriture
}

typeEffect();
});

