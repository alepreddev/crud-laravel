import { apiFetch } from "../main.js";

document.getElementById('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const btn = e.target.querySelector('button');
    btn.disabled = true;
    btn.innerText = 'Verificando...';

    try {

        const dataform = {
            email: document.querySelector('input[name="email"]').value,
            password: document.querySelector('input[name="password"]').value
        };
        
        const response = await apiFetch('/login', 'POST', dataform);

        const data = response;

        console.log(response);
        console.log(data);

        if (data.success) {
            window.location.href = data.redirect;
        } else {
            alert(data.message);
            btn.disabled = false;
            btn.innerText = 'Entrar';
        }
    } catch (error) {
        console.error('Error:', error);
        btn.disabled = false;
    }
});