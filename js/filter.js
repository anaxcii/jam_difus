document.addEventListener('DOMContentLoaded', function() {
    var filterForm = document.getElementById('filterForm');
    filterForm.addEventListener('submit', function(event) {
        event.preventDefault();

        // Collecter les valeurs des critères de filtrage
        var filterName = document.getElementById('filterName').value;
        var filterPrice = document.getElementById('filterPrice').value;

        // Envoyer une requête AJAX pour récupérer les éléments filtrés depuis le serveur
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status == 200) {
                    var filteredItems = JSON.parse(xhr.responseText);
                    // Mettre à jour la liste des éléments avec les résultats de la requête AJAX
                    updateItemList(filteredItems);
                } else {
                    console.error('Erreur lors de la récupération des éléments filtrés');
                }
            }
        };

        // Construire l'URL de la requête AJAX avec les paramètres de filtrage
        var url = 'functions/filter_items.php?';
        if (filterName !== '') {
            url += 'name=' + encodeURIComponent(filterName) + '&';
        }
        if (filterPrice !== '') {
            url += 'price=' + encodeURIComponent(filterPrice);
        }

        xhr.open('GET', url, true);
        xhr.send();
    });
});

// Fonction pour mettre à jour la liste des éléments dans le DOM
function updateItemList(items) {
    var itemList = document.getElementById('itemList');
    itemList.innerHTML = '';

    items.forEach(function(item) {
        var li = document.createElement('li');
        li.textContent = item.name + ' - ' + item.description + ' - ' + item.price;
        itemList.appendChild(li);
    });
}
