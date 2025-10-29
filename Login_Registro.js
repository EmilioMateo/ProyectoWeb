
const InputContrasena = document.getElementById("contrasena")
const BotonAccion = document.getElementById("btn-accion")

BotonAccion.addEventListener("click", () => {
    const correo = textBoxCorreo.value;
    const contrasena = InputContrasena.value;
    const EstaEnLogin = document.getElementById('login').classList.contains('activo')

    if(EstaEnLogin){
        const datos = new FormData();
        datos.append('correo_electronico', correo);
        datos.append('contrasena', contrasena);

        fetch('login.php', {
            method: 'POST',
            body: datos
        }) 

        .then(respuesta => respuesta.text())
        .then(texto => {
            alert(texto);
            if(texto.includes("Bienvenido")){
                window.location.href = "TareasPendientes.html"
            }
        })

        .catch(error => {
            console.error('Error',error);
            alert("Error de conexion en login");
        })


    }
    else{
        console.log("Estas en registro perro");
        const datos = new FormData();
        datos.append('correo_electronico', correo);
        datos.append('contrasena', contrasena);

        fetch('registrar.php', {
            method: 'POST',
            body: datos
        }) 

        .then(respuesta => respuesta.text())
        .then(texto => {
            alert(texto);
        })

        .catch(error => {
            console.error('Error',error);
            alert("Error de conexion");
        })
    }

})