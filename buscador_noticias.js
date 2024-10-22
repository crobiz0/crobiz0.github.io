function buscarNoticias() {
    var query = document.getElementById('buscar').value;

    // Crear una instancia de XMLHttpRequest
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Mostrar los resultados en el div de "resultados"
            document.getElementById('resultados').innerHTML = xhr.responseText;
        }
    };

    // Enviar la solicitud con el parámetro de búsqueda a buscar_noticias.php
    xhr.open('GET', '/buscar_noticias.php?buscar=' + encodeURIComponent(query), true);
    xhr.send();
}
