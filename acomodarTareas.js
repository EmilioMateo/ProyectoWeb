const tareas = [
   {
        id: 1,
        titulo: 'Examen Practico',
        fechaEntrega: '29 de octubre',
        materia: 'Programación Web',
        completada: false // Podrías usar esto para el logo de completar
    },
    {
        id: 2,
        titulo: 'Estudiar para el examen',
        fechaEntrega: '29 de octubre',
        materia: 'Sistemas de Medición y Control',
        completada: false
    },
    {
        id: 3,
        titulo: 'Practica de Arduino y Nube',
        fechaEntrega: '30 de Octubre',
        materia: 'Servicio de Web y computación nube',
        completada: false
    },
    {
        id: 4,
        titulo: 'Codigo Polinomios',
        fechaEntrega: '28 de Octubre',
        materia: 'Programación Avanzada I',
        completada: true
    }
];



const container=document.getElementById("tareas");
const template=document.getElementById("tarea");


function eliminarTarea(id) {
    const elementoAEliminar = document.querySelector(`[data-tarea-id="${id}"]`);
    if(elementoAEliminar){
        elementoAEliminar.remove();
    }
}

var b=0;
if(document.getElementById("status").textContent=='D') b=1;

for(let i=0; i<tareas.length; i++){
    const elemento=tareas[i];
    if(b==1){
        if(!elemento.completada) continue;
    }
    else{
        if(elemento.completada) continue;
    }
    const Clone = template.content.cloneNode(true);
    Clone.firstElementChild.setAttribute('data-tarea-id', elemento.id);
    let textos=Clone.querySelectorAll("p");
    textos[0].textContent=elemento.titulo;
    textos[1].textContent=elemento.fechaEntrega;
    textos[2].textContent=elemento.materia;

    if(b==0){
        const botones=Clone.querySelectorAll("img");
        botones[0].addEventListener('click', ()=> {
            eliminarTarea(elemento.id);
        })
    }
    container.append(Clone);
}