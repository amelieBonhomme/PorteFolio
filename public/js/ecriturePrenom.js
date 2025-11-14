document.addEventListener("DOMContentLoaded", function () {
  const span = document.getElementById("nom");

  // Récupère la valeur injectée par Twig
  const fullText = span.dataset.fulltext;

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
