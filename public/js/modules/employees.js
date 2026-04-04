// // Ejemplo: Guardar Empleado
async function saveEmployee() {
    const data = {
        id_number: document.getElementById('dni').value,
        first_name: document.getElementById('nombre').value,
        // ... otros campos
    };

    const result = await apiFetch('/employees/store', 'POST', data);
    if (result && result.success) {
        location.reload(); // O mejor: actualiza la tabla dinámicamente con JS
    }
}

async function confirmDelete(id) {
    if (!confirm('¿Estás seguro de eliminar este empleado? Esta acción se auditará.')) return;

    try {
        const response = await fetch(`/employees/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });

        const result = await response.json();

        if (response.ok) {
            // Eliminar la fila del DOM sin recargar
            document.getElementById(`row-${id}`).remove();
            alert(result.message);
        } else {
            alert(result.error || 'No tienes permisos para eliminar.');
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

function openModal(id) { document.getElementById(id).style.display = 'flex'; }
function closeModal(id) { document.getElementById(id).style.display = 'none'; }