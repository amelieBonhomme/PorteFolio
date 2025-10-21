let typed = '';
document.addEventListener('keydown', function(event) {
    typed += event.key.toLowerCase();

    if (typed.length > 5) {
        typed = typed.slice(-5);
    }

    if (typed === 'admin') {
        window.location.href = '/admin'; // Redirection vers la page admin
    }
});
