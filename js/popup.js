function showItemDetails(itemId) {
    // Envoyer une requête AJAX pour récupérer les détails de l'élément
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                var itemDetails = JSON.parse(xhr.responseText);
                // Afficher les détails de l'élément dans le popup
                var popup = document.getElementById('popup');
                popup.innerHTML = '<h2>Détails</h2>';
                popup.innerHTML += '<p>Nom: ' + itemDetails.name + '</p>';
                popup.innerHTML += '<p>Description: ' + itemDetails.description + '</p>';
                popup.innerHTML += '<p>Prix: ' + itemDetails.price + '</p>';
                popup.innerHTML += '<a href="#" id="closePopup">Fermer</a>';
                popup.style.display = 'block';

                document.getElementById('closePopup').addEventListener('click', function() {
                    popup.style.display = 'none';
                });
            } else {
                console.error('Erreur lors de la récupération des détails de l\'élément');
            }
        }
    };
    xhr.open('GET', 'functions/get_item_details.php?id=' + itemId, true);
    xhr.send();
}

// Écouter les clics sur les liens
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('item-details-link')) {
        var itemId = event.target.getAttribute('data-id');
        showItemDetails(itemId);
        event.preventDefault();
    }
});
