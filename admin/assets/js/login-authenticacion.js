document.getElementById("formulario").addEventListener("submit", acceder);

function acceder(e) {
    e.preventDefault();

    // const formulario = document.getElementById("formulario");
    const usuario = document.getElementById("usuario");
    const password = document.getElementById("password");

    // Primero validamos que no hayan campos vacíos
    if (
        usuario.value.trim() === "" || password.value.trim() === "") {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Debes llenar todos los campos',
        })
        return; 
    }
    // Ahora si validamos las credenciales
    else if 
        (usuario.value === "admin" && password.value === "Alex-Games30") {

            Swal.fire({
            icon: 'success',
            title: 'Bienvenido',
            timer: 750,
            showConfirmButton: false,
            }).then(() => {

                // Redirigir al dashboard después de cerrar la alerta
                const pageTransition = document.getElementById("page-transition");
                pageTransition.classList.add("active");
            
                setTimeout(() => {
                    window.location.href ="/mi_tienda/admin/dashboard.php";
                }, 1100);
        });
        }
    // Por último en caso de ser incorrectas
     else { 
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Credenciales incorrectas',
        });
    }
    }

// Para el ojito de la contraseña
const passwordInput = document.getElementById("password");
const icono = document.getElementById("togglePassword");
 
let passwordVisible = false;

icono.addEventListener("click", function () {
    if (passwordVisible){
        passwordInput.type = "password"; //Muestra la contraseña
        icono.classList.remove("fa-eye");
        icono.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "text" ; //Oculta la contraseña
    }    
        this.classList.toggle("fa-eye-slash", passwordVisible);
        this.classList.toggle("fa-eye", !passwordVisible);
        passwordVisible = !passwordVisible;
});