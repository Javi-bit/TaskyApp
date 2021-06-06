const confirmDelete = (e) => {

    Swal.fire({
        title: '¿Seguro de eliminar?',
        text: 'Eliminara todas las tareas y subtareas de la lista',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '¡Sí, borralo!',
        cancelButtonText: 'Cancelar',
        focusConfirm: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.replace(`${e}`);                 
        }
    });
}

const buttons = document.querySelectorAll('.delete');


buttons.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        confirmDelete(e.target.href);
    });
});

const swal = () => {
    Swal.fire({
        title: 'Error',
        text: 'No se pudo concretar la acción, itenta nuevamente más tarde.',
        icon: 'error',
        confirmButtonText: 'Aceptar'
    })
}