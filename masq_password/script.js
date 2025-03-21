const password = document.querySelector('#password');
        const togglePassword = document.querySelector('#togglePassword');
    
        const change = () => {
            // Vérifier le type actuel de l'input
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
    
            // Basculer l'icône (si vous utilisez Font Awesome, par exemple)
            if (type === 'text') {
                togglePassword.classList.add('fa-eye-slash');
                togglePassword.classList.remove('fa-eye');
            } else {
                togglePassword.classList.add('fa-eye');
                togglePassword.classList.remove('fa-eye-slash');
            }
        };
    
        togglePassword.addEventListener('click', change);