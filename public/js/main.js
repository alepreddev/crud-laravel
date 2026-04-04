// Función genérica para peticiones seguras
export async function apiFetch(url, method = 'GET', body = null) {
    const headers = {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest' // Identifica la petición como AJAX
    };

    if (body) headers['Content-Type'] = 'application/json';

    const response = await fetch(url, {
        method,
        headers,
        body: body ? JSON.stringify(body) : null
    });

    if (response.status === 403) {
        alert('Acceso Denegado: No tienes permiso para esta acción.');
        return null;
    }

    if (response.status === 422) {
        const errors = await response.json();
        console.table(errors.errors); // Mostrar errores de validación
        alert('Error de validación. Revisa la consola.');
        return null;
    }

    return await response.json();
}