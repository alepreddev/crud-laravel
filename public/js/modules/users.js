import { apiFetch } from '../main.js';

document.getElementById('userForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());

    const response = await apiFetch('/users/store', 'POST', data);

    if (response && response.ok) {
        const result = await response.json();
        alert(result.message);
        location.reload(); 
    } else {
        alert("Error al crear el usuario. Revisa los datos o permisos.");
    }
});

function openModal(id) { document.getElementById(id).style.display = 'flex'; }
function closeModal(id) { document.getElementById(id).style.display = 'none'; }