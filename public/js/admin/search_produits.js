const searchInput = document.getElementById('searchInput');
searchInput.addEventListener('keyup' , ()=>{
    let value = searchInput.value ;
    console.log(value) ;
    fetch(`produits/search?name=${value}&source=admin`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById("produits_table").innerHTML = data.output;
        if (data.total > 15) {
            document.getElementById("paginationLinks").style.display = 'block';
        } else {
            document.getElementById("paginationLinks").style.display = 'none';
        }
    })
    .catch(error => console.error('Error:', error));
});