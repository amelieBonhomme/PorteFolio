document.addEventListener("DOMContentLoaded", function () {
  const span = document.getElementById("nom");
  const fullText = "Amélie Bonhomme";
  let index = 0;

  function typeEffect() {
    if (index <= fullText.length) {
      span.textContent = fullText.slice(0, index);
      index++;
      setTimeout(typeEffect, 150); // vitesse d’écriture
    }
  }

  typeEffect();
});
