document.addEventListener('DOMContentLoaded', function() {
    var populateDatabaseBtn = document.getElementById('populateDatabaseBtn');

    // Écouter l'événement de clic sur le bouton de peuplement de la base de données
    populateDatabaseBtn.addEventListener('click', function() {
        populateDatabase();
    });
});
function populateDatabase() {
    // Envoyer une requête AJAX pour peupler la base de données
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                console.log('Base de données peuplée avec succès !');
                location.reload();
            } else {
                console.error('Erreur lors du peuplement de la base de données');
            }
        }
    };
    xhr.open('GET', 'functions/populate_database.php', true);
    xhr.send();
}
