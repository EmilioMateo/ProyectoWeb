
const inputCorreo = document.getElementById("correo");
const inputContrasena = document.getElementById("contrasena");
const btnAccion = document.getElementById("btn-accion");
const botonLogin = document.getElementById("login"); 
const botonesToggle = document.querySelectorAll('.btn-toggle');
const tituloFormulario = document.getElementById("titulo-formulario"); 


botonLogin.classList.add('activo');

botonesToggle.forEach(boton => {
    boton.addEventListener('click', () => {

        botonesToggle.forEach(b => b.classList.remove('activo'));
        boton.classList.add('activo');
        inputCorreo.value = "";
        inputContrasena.value = "";


        if (boton === botonLogin) {

            tituloFormulario.textContent = "Iniciar Sesión";
            inputCorreo.setAttribute('placeholder', 'Nombre / Correo');
            btnAccion.textContent = "Entrar";
        } else {

            tituloFormulario.textContent = "Registrarse";
            inputCorreo.setAttribute('placeholder', 'Correo');
            btnAccion.textContent = "Registrar";
        }
    });
});


btnAccion.addEventListener("click", () => {
    const correo = inputCorreo.value;
    const contrasena = inputContrasena.value;


    const EstaEnLogin = botonLogin.classList.contains('activo');

    console.log("¿Está en modo Login?:", EstaEnLogin); 

    const datos = new FormData();
    datos.append('correo_electronico', correo);
    datos.append('contrasena', contrasena);

    if (EstaEnLogin) {

        console.log("Enviando a login.php...");
        fetch('login.php', {
            method: 'POST',
            body: datos
        })
        .then(respuesta => respuesta.text())
        .then(texto => {
            console.log("Respuesta servidor:", texto);
            if (texto.includes("Bienvenido")) {
                alert(texto);
                window.location.href = "TareasPendientes.php";
            } else {
                alert(texto); 
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Error de conexión en login");
        });

    } else {

        console.log("Enviando a registrar.php...");
        fetch('registrar.php', {
            method: 'POST',
            body: datos
        })
        .then(respuesta => respuesta.text())
        .then(texto => {
            alert(texto);
            if (texto.includes("Exitoso") || texto.includes("Registro Exitoso")) {

                location.reload(); 
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Error de conexión en registro");
        });
    }
});