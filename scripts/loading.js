function showLoading(callback){
    const div = document.createElement("div");
    div.classList.add("loading");

    const rings = document.createElement("div");
    rings.classList.add("loader");

    div.appendChild(rings);

    document.body.append(div);
    setTimeout(function() {
        // Simulando a conclusão do carregamento após 2 segundos
        console.log("Loading complete");
        callback();
        hideLoading(); // Chama a função de callback
    }, 1500);
}

function hideLoading(){
    const loadings = document.getElementsByClassName("loading");
    if(loadings.length){
        loadings[0].remove();
    }
}