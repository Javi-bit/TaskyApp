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

const swal = (icon, title, text) => {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: 'Aceptar'
    })
}

const msg = document.querySelector('.alert');

if(msg) {
    setTimeout(() => {
        let fade = setInterval(() => {
            if (!msg.style.opacity) {
                msg.style.opacity = 1;
            }
            if (msg.style.opacity > 0) {
                msg.style.opacity -= 0.1;
            } else {
                msg.remove();
                clearInterval(fade);
            }
        }, 10);
    }, 3500); 
}