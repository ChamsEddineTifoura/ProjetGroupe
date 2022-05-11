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
                    suggestion += `<li class="suggestion" onclick="select(this)" value="${film.id}">${film.title}</li>`;
                });
                search.classList.add("active"); //show autocomplete box
            }
            let suggestions = document.getElementById('suggestions');
            suggestions.innerHTML = suggestion;
        });
    } else {
        search.classList.remove("active"); //hide autocomplete box
    }
});

function select(element){
    let nomFilm = element.textContent;
    let idFilm = element.value;

    search.value = nomFilm;

    let fieldCategory = document.querySelector('#film_category');
    let fieldSynopsis = document.querySelector('#film_synopsis');
    let fieldImage = document.querySelector('#film_image');

    fieldSynopsis.value = '';
    fieldImage.value = '';
          	
    // Requete fetch pour récupérer les résultats
    fetch(`https://api.themoviedb.org/3/movie/${idFilm}?api_key=2630e5d421793226b64f8e6f65bcf6e8&language=fr`)
    .then(response => response.json()) // Transformation de la réponse en JSON
    .then(data => { // Traitement de la réponse
        console.log(data)    
        
        fieldCategory.value = data.genres[0].name;
        fieldSynopsis.value = data.overview;
        fieldImage.value = data.poster_path;
        
    })
    search.classList.remove("active");
}