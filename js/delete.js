function confirmDelete(itemId) {
    var confirmation = confirm("Voulez vous vraiment supprimer cet élément ?");
    if (confirmation) {
        // Envoyer une requête AJAX pour supprimer l'élément de la liste
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status == 200) {
                    // Si la suppression est réussie, supprimer l'élément de la liste
                    var item = document.getElementById('item_' + itemId);
                    item.parentNode.removeChild(item);
                } else {
                    console.error('Erreur lors de la suppression de l\'élément');
                }
            }
        };
        xhr.open('GET', 'functions/delete_item.php?id=' + itemId, true);
        xhr.send();
    }
}
