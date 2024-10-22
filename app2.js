const formularioBusqueda = document.getElementById("form-buscar-usuario");
const resultadoDiv = document.getElementById('resultado');

formularioBusqueda.addEventListener("submit", consultar_en_tiempo_real);

function consultar_en_tiempo_real(evento) {
    // Evita que se recargue la página
    evento.preventDefault();

    // Obtener el valor del input
    const nombre_usuario = document.getElementById("usuario").value;

    // Crear un objeto FormData para enviar los valores
    const formData = new FormData();
    formData.append('usuario', nombre_usuario);
    formData.append('envio', true);

    // Llamar al endpoint para buscar el usuario
    fetch('buscar_usuario.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Convertir la respuesta a JSON
    .then(data => {    //la variable data se usa para recorrer el array asociativo del endpoint...
        resultadoDiv.innerHTML = ''; // Limpiar el contenido previo

        // Si se encuentran usuarios
        if (data.status === 1) {
            data.usuarios.forEach(user => {
                const botonTexto = user.esta_bloqueado == 1 ? 'Desbloquear' : 'Bloquear';
                resultadoDiv.innerHTML += `<p>ID: ${user.id} - Nombre: ${user.nombre} - Email: ${user.email}
                <button onclick="cambiarEstadoUsuario(event, ${user.id}, ${user.esta_bloqueado == 1 ? 0 : 1})">${botonTexto}</button>
                </p><hr>`;
            });
        } else {
            resultadoDiv.innerHTML = `<p>${data.mensaje}</p>`;
        }
    })
    .catch(error => console.error('Error:', error));
}

function cambiarEstadoUsuario(evento, userId, nuevoEstado) {
    evento.preventDefault();
    const formData = new FormData();
    formData.append('usuario_id', userId);
    formData.append('nuevo_estado', nuevoEstado);

    fetch('bloqueo_usuario.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.mensaje);
        // Recargar los datos del usuario actualizados sin enviar de nuevo el formulario
        consultar_en_tiempo_real(new Event('submit'));
    })
    .catch(error => console.error('Error:', error));
}