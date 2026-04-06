import { apiFetch } from '../main.js';

window.viewAuditDetails = async function(id) {
    const response = await apiFetch(`/auditoria/${id}`);
    
    if (response && response.ok) {
        const audit = await response.json();
        const modal = document.getElementById('modalAudit');
        const jsonViewer = document.getElementById('jsonViewer');

        // Formateamos el JSON para que sea legible
        const details = {
            Anterior: audit.old_values ? JSON.parse(audit.old_values) : 'N/A',
            Nuevo: audit.new_values ? JSON.parse(audit.new_values) : 'N/A',
            Navegador: audit.user_agent
        };

        jsonViewer.textContent = JSON.stringify(details, null, 4);
        modal.style.display = 'flex';
    }
};

window.closeModal = function(id) {
    document.getElementById(id).style.display = 'none';
};