        let botonInicial = document.getElementById("login");
        let textBoxCorreo = document.getElementById("correo"); //obtener el textbox donde s epone el correo o username del wey q quiere entrar, lo vamos a ocupar ahorita en el listener
        botonInicial.classList.add('activo') //por default prender el botón de inciar sesión pq esa va a ser la interfáz por defecto

        const botones = document.querySelectorAll('.btn-toggle'); //agarra los botones q tengan la clase btn-toggle

        botones.forEach(boton => { //por cada boton encontrado
            boton.addEventListener('click', () => { //agregale un listener q haga lo siguiente al ser clickeado
                botones.forEach(b => b.classList.remove('activo')); //agarra cada boton otra vez pero quitale el activo a cada uno alv asi todos se apagan antes de prender el clickeado
                boton.classList.add('activo'); //ponle el activo al boton q clickeamos pa q se prenda

                if(boton != botonInicial) textBoxCorreo.setAttribute('placeholder', 'Correo'); //si el boton clickeado no es el inicial / el de login, entonces q el textbox nomás diga correo, pa q se note un cambio sabes
                else textBoxCorreo.setAttribute('placeholder', 'Nombre / Correo'); //si no ps ponlo como usualmente es´ta con nombre / correo
            });
        });