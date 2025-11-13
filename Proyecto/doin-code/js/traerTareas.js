document.addEventListener('DOMContentLoaded', async () => {
    try {
        const response = await fetch('/doin/Proyecto/doin-code/Tareas/traerTareas.php');
        const resultado = await response.json();
        if (resultado.success) {
            resultado.data.forEach(tarea => {
                if (tarea.estado === 'pendiente') renderTarea(tarea, '.col-12:nth-of-type(1) .card-body');
                else if (tarea.estado === 'enProgreso') renderTarea(tarea, '.col-12:nth-of-type(2) .card-body');
                else if (tarea.estado === 'terminado') renderTarea(tarea, '.col-12:nth-of-type(3) .card-body');
            });
        } else {
            alert('No se pudieron cargar las tareas.');
        }
    } catch {
        alert('Error al obtener tareas.');
    }

    const btnNuevaTareaNavbar = document.getElementById('btnNuevaTareaNavbar');
    if (btnNuevaTareaNavbar) btnNuevaTareaNavbar.addEventListener('click', () => abrirModalCrearTarea());

    document.querySelectorAll('.crear-tarea-col').forEach(btn => {
        btn.addEventListener('click', function() {
            abrirModalCrearTarea(this.getAttribute('data-estado'));
        });
    });
});

function abrirModalCrearTarea(estadoPredeterminado) {
    const modal = document.getElementById('miModal');
    if (!modal) return;
    const modalTitle = modal.querySelector('.modal-header h2');
    modalTitle.textContent = 'Nueva tarea';

    const inputTitulo = document.getElementById('titulo');
    const inputDescripcion = document.getElementById('descripcion');
    const inputFecha = document.getElementById('fecha');
    const selectEstado = document.getElementById('estado');
    const btnGuardar = modal.querySelector('.btn.btn-primary');

    inputTitulo.value = '';
    inputTitulo.readOnly = false;
    inputDescripcion.value = '';
    inputDescripcion.readOnly = false;
    inputFecha.value = '';
    inputFecha.readOnly = false;
    selectEstado.value = estadoPredeterminado || '';
    selectEstado.disabled = false;
    btnGuardar.style.display = '';

    let btnEditar = document.getElementById('btnEditarTarea');
    let btnEliminar = document.getElementById('btnEliminarTarea');
    if (btnEditar) btnEditar.remove();
    if (btnEliminar) btnEliminar.remove();

    modal.style.display = 'flex';

    const cerrarModal = document.getElementById('cerrarModal');
    const cerrarBtn = document.getElementById('cerrarBtn');
    function restaurarModal() {
        modalTitle.textContent = 'Nueva tarea';
        inputTitulo.value = '';
        inputTitulo.readOnly = false;
        inputDescripcion.value = '';
        inputDescripcion.readOnly = false;
        inputFecha.value = '';
        inputFecha.readOnly = false;
        selectEstado.value = '';
        selectEstado.disabled = false;
        btnGuardar.style.display = '';
        if (btnEditar) btnEditar.remove();
        if (btnEliminar) btnEliminar.remove();
    }
    if (cerrarModal) cerrarModal.onclick = () => { modal.style.display = 'none'; restaurarModal(); };
    if (cerrarBtn) cerrarBtn.onclick = () => { modal.style.display = 'none'; restaurarModal(); };
}

function renderTarea(tarea, selector) {
    const container = document.querySelector(selector);
    if (!container) {
        alert('Error: no se encontró la sección para mostrar tareas.');
        return;
    }

    const card = document.createElement('div');
    card.className = 'card mb-2';
    card.style.background = '#2a2a2a';
    card.style.border = '1px solid #444';
    card.style.borderRadius = '6px';
    card.style.cursor = 'pointer';

    card.innerHTML = `
        <div class="card-body p-3">
            <h6 class="card-title" style="margin: 0 0 8px 0; color: #fff;">
                ${tarea.titulo}
            </h6>
            <p class="card-text small" style="margin: 0 0 8px 0; color: #bbb;">
                ${tarea.descripcion || 'Sin descripción'}
            </p>
            <div style="display: flex; justify-content: flex-start; align-items: center; gap: 8px; color: #999;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <small style="color: #999;">
                    ${tarea.fechaFinalizacion || 'Sin fecha'}
                </small>
            </div>
        </div>
    `;

    card.addEventListener('click', () => mostrarDetalleTarea(tarea));
    container.appendChild(card);
}

function mostrarDetalleTarea(tarea) {
    const modal = document.getElementById('miModal');
    if (!modal) return;

    const modalTitle = modal.querySelector('.modal-header h2');
    modalTitle.textContent = 'Detalle de tarea';

    const inputTitulo = document.getElementById('titulo');
    const inputDescripcion = document.getElementById('descripcion');
    const inputFecha = document.getElementById('fecha');
    const selectEstado = document.getElementById('estado');

    inputTitulo.value = tarea.titulo;
    inputTitulo.readOnly = true;
    inputDescripcion.value = tarea.descripcion;
    inputDescripcion.readOnly = true;
    inputFecha.value = tarea.fechaFinalizacion || '';
    inputFecha.readOnly = true;
    selectEstado.value = tarea.estado;
    selectEstado.disabled = true;

    const btnGuardar = modal.querySelector('.btn.btn-primary');
    btnGuardar.style.display = 'none';

    let btnEditar = document.getElementById('btnEditarTarea');
    let btnEliminar = document.getElementById('btnEliminarTarea');
    const modalFooter = modal.querySelector('.modal-footer');

    if (modalFooter) {
        if (!btnEditar) {
            btnEditar = document.createElement('button');
            btnEditar.type = 'button';
            btnEditar.className = 'btn btn-secondary';
            btnEditar.id = 'btnEditarTarea';
            btnEditar.textContent = 'Editar';
            modalFooter.appendChild(btnEditar);
        }
        if (!btnEliminar) {
            btnEliminar = document.createElement('button');
            btnEliminar.type = 'button';
            btnEliminar.className = 'btn btn-danger';
            btnEliminar.id = 'btnEliminarTarea';
            btnEliminar.textContent = 'Eliminar';
            modalFooter.appendChild(btnEliminar);
        }
    }

    btnEditar.onclick = () => {
        inputTitulo.readOnly = false;
        inputDescripcion.readOnly = false;
        inputFecha.readOnly = false;
        selectEstado.disabled = false;
        btnGuardar.style.display = '';
        modalTitle.textContent = 'Editar tarea';

        btnGuardar.onclick = async (e) => {
            e.preventDefault();
            if (!inputTitulo.value.trim() || !inputDescripcion.value.trim() || !inputFecha.value || !selectEstado.value) {
                alert('Completa todos los campos.');
                return;
            }
            const payload = {
                id_tarea: tarea.id_tarea,
                titulo: inputTitulo.value.trim(),
                descripcion: inputDescripcion.value.trim(),
                fechaFinalizacion: inputFecha.value,
                estado: selectEstado.value
            };
            try {
                const res = await fetch('/doin/Proyecto/doin-code/Tareas/editarTarea.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();
                if (data.success) {
                    alert('Tarea actualizada.');
                    location.reload();
                } else {
                    alert('No se pudo actualizar la tarea.');
                }
            } catch {
                alert('Error al actualizar la tarea.');
            }
        };
    };

    btnEliminar.onclick = async () => {
        if (!confirm('¿Seguro que deseas eliminar esta tarea?')) return;
        try {
            const res = await fetch('/doin/Proyecto/doin-code/Tareas/eliminarTarea.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id_tarea: tarea.id_tarea })
            });
            const data = await res.json();
            if (data.success) {
                alert('Tarea eliminada.');
                location.reload();
            } else {
                alert('No se pudo eliminar la tarea.');
            }
        } catch {
            alert('Error al eliminar la tarea.');
        }
    };

    modal.style.display = 'flex';

    const cerrarModal = document.getElementById('cerrarModal');
    const cerrarBtn = document.getElementById('cerrarBtn');
    function restaurarModal() {
        modalTitle.textContent = 'Nueva tarea';
        inputTitulo.value = '';
        inputTitulo.readOnly = false;
        inputDescripcion.value = '';
        inputDescripcion.readOnly = false;
        inputFecha.value = '';
        inputFecha.readOnly = false;
        selectEstado.value = '';
        selectEstado.disabled = false;
        btnGuardar.style.display = '';
        if (btnEditar) btnEditar.remove();
        if (btnEliminar) btnEliminar.remove();
    }
    if (cerrarModal) cerrarModal.onclick = () => { modal.style.display = 'none'; restaurarModal(); };
    if (cerrarBtn) cerrarBtn.onclick = () => { modal.style.display = 'none'; restaurarModal(); };
}
