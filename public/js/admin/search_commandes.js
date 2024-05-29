const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('keyup', () => {
    let value = searchInput.value;
    fetch(`commandes/search?code=${value}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById("commandes_table").innerHTML = data.output;
        if (data.total > 15) {
            document.getElementById("paginationLinks").style.display = 'block';
        } else {
            document.getElementById("paginationLinks").style.display = 'none';
        }
    })
    .catch(error => console.error('Error:', error));
});
