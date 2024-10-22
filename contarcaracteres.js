function contarCaracteres() {
    var descripcion = document.getElementById('descripcion');
    var maxCaracteres = 200;
    var caracteresRestantes = maxCaracteres - descripcion.value.length;

    // Limitar el número de caracteres a 200
    if (descripcion.value.length > maxCaracteres) {
        descripcion.value = descripcion.value.substring(0, maxCaracteres);
        caracteresRestantes = 0; // Asegura que no muestre valores negativos
    }

    document.getElementById('caracteresRestantes').textContent = caracteresRestantes;
}

// Inicializar el contador cuando se carga la página
window.onload = function() {
    contarCaracteres(); // Para inicializar el contador con el texto ya cargado
    document.getElementById('descripcion').addEventListener('input', contarCaracteres);
};