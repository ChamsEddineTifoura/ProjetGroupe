let search = document.getElementById('film_name');

search.addEventListener('keyup', function(){
    const filmName = search.value;

    if (filmName) {
        fetch(`https://api.themoviedb.org/3/search/movie?api_key=2630e5d421793226b64f8e6f65bcf6e8&query=${filmName}&language=fr`)
        .then(response => response.json())
        .then(data => {
            let suggestion = '';
            if (filmName != '') {
                data.results.map(film => {
                    suggestion += `<div class="suggestions">${film.title}</div>`;
                });
            }
            let suggestions = document.getElementById('suggestions');
            suggestions.innerHTML = suggestion;
        });
    }
});