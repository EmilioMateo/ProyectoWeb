<?php
            
include 'conexion.php';
session_start();
$iduser=$_SESSION['id_usuario'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">

    <!-- adjuntar el css del bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- link pa adjuntar la fuente q vamos a usar -->
    <link href="https://fonts.cdnfonts.com/css/be-vietnam-pro" rel="stylesheet">

    <!-- adjuntar nuestro css -->
    <link href="style.css" rel="stylesheet">
    <title>Tareas</title>
</head>
<body style="background-color: #FCF9E6;">
    <div hidden>
        <p id="status">P</p>
    </div>

    <!-- nomas de recordatorio agregué un botón para cerrar sesión para q pls le pongan la función -->

    <div class="container w-100">
        <div class="d-flex flex-wrap justify-content-between" style="align-items: center;">
            <img src="cyncroLogo.png" class="m-2" alt="logo cyncro" style="height: 90px; width: 140px;">
            <form action="cerrarsesion.php" METHOD="POST">
            <button type="submit" class="btn-personalizado py-2 px-3" style="font-size: 20px;">Cerrar sesión</button>
            </form>
        </div>
        <div class="card mx-auto contenedor-login border-0 py-2 px-3" id="tareas">
            <div class="d-flex flex-wrap justify-content-center gap-4" style="position: relative; top: -35px">
                <button id="pendiente" class="btn-personalizado btn-toggle px-4 py-2" style="font-size: 22px">Pendientes</button>
                <button class="btn-personalizado btn-toggle px-4 py-2" style="font-size: 22px;" onclick="location.href='TareasCompletadas.php'">Completadas</button>
            </div>

            <div class="d-flex flex-wrap justify-content-between mb-2">
                <div class="d-flex flex-column align-items-center">
                    <div class="diseño-r1 py-1 px-3" style="z-index: 10;">
                        <p class="mb-0" style="font-size: 25px;">Hoy</p>
                    </div>
                    <div class="card diseño-r2 px-5 py-4" style="position: relative; top: -15px;">
                        <p class="mb-0" style="font-size: 60px;">
    <?php

    $sql=$conn->prepare("SELECT COUNT(id) AS total FROM tareas WHERE id_usuario=? AND fechaEntrega = CURDATE() 
    AND completada = 0");
    $sql->bind_param("i", $iduser);
$sql->execute();
$resultado = $sql->get_result();
$fila=$resultado->fetch_assoc();
echo $fila['total'];

    ?>

                        </p>
                    </div>
                </div>
                <div class="d-flex flex-column align-items-center">
                    <div class="diseño-r1 py-1 px-3" style="z-index: 10;">
                        <p class="mb-0" style="font-size: 25px;">Semana</p>
                    </div>
                    <div class="card diseño-r2 px-5 py-4" style="position: relative; top: -15px;">
                        <p class="mb-0" style="font-size: 60px;">

                         <?php

    $sql=$conn->prepare("SELECT COUNT(id) AS total FROM tareas WHERE id_usuario=? 
    AND WEEK(fechaEntrega, 1) = WEEK(CURDATE(), 1)
    AND completada = 0");
    $sql->bind_param("i", $iduser);
$sql->execute();
$resultado = $sql->get_result();
$fila=$resultado->fetch_assoc();
echo $fila['total'];

    ?>
                        </p>
                    </div>
                </div>
                <div class="d-flex flex-column align-items-center">
                    <div class="diseño-r1 py-1 px-3" style="z-index: 10;">
                        <p class="mb-0" style="font-size: 25px;">Total</p>
                    </div>
                    <div class="card diseño-r2 px-5 py-4" style="position: relative; top: -15px;">
                        <p class="mb-0" style="font-size: 60px;">

                        <?php

    $sql=$conn->prepare("SELECT COUNT(id) AS total FROM tareas WHERE id_usuario=? 
    AND completada = 0");
    $sql->bind_param("i", $iduser);
$sql->execute();
$resultado = $sql->get_result();
$fila=$resultado->fetch_assoc();
echo $fila['total'];

    ?>
                        </p>
                    </div>
                </div>
                <div class="d-flex flex-column align-items-center justify-content-center gap-2">
                    <button class="btn-personalizado px-5 py-2" data-bs-toggle="modal" data-bs-target="#modalAgregarPendientes" style="font-size: 25px;">Agregar</button>
                </div>
            </div>

            <div class="separador-central-tareas mb-2 mx-auto"></div>

            <!-- ahora si en template -->
            <template id="tarea">
                <div class="d-flex flex-wrap justify-content-between" style="align-items: center;">
                    <form action="tareahecha.php" method="POST">
                        <input type="hidden" name="id_tarea"  value="">
                    <button type="submit" class="btn-personalizado2 p-2 justify-content-center" style="border: 0px solid black;">
                        <img src="completarTareaLogo.png" alt="completar tarea logo" style="height: 35px; width: 35px;">
                    </button>
                    </form>
                    <div class="d-flex flex-column" style="width: 500px;">
                        <div class="diseño-r2 px-2 py-2" style="width: 100%;">
                            <p style="margin: 0;">Titulo de la tarea</p>
                        </div>
                        <div class="diseño-r1 px-2 py-1" style="border-radius: 20px;">
                            <p style="margin: 0;">Fecha entrega</p>
                        </div>
                    </div>  
                    <div class="d-flex flex-column" style="width: 400px;">
                        <div class="diseño-r1 px-2 py-2" style="width: 100%;">
                            <p style="margin: 0;">Nombre de la materia</p>
                        </div>
                    </div>
                    
                    <button class="btn-personalizado2 p-2 justify-content-center" data-bs-toggle="modal" data-bs-target="#modalEditarPendientes" data-bs-id-tarea="" style="border: 0px solid black;">
                        <img src="editarTareaLogo.png" alt="completar tarea logo" style="height: 35px; width: 35px;">
                    </button>
                    <form action="borrartarea.php" method="POST">
                        <input type="hidden" name="id_tarea2" value="">
                    <button class="btn-personalizado2 p-2 justify-content-center" style="border: 0px solid black;">
                        <img src="eliminarTareaLogo.png" alt="completar tarea logo" style="height: 35px; width: 35px;">
                    </button>
                    </form>
                </div>
            </template>
        </div>
    </div>

    <!-- modal q se muestra para cuando quieres agregar tareas nuevas -->
    <div id="modalAgregarPendientes" class="modal fade" style="position: absolute;">
        <div class="modal-dialog modal-dialog-center">
             <form action="addtarea.php" method="POST">
            <div class="modal-content contenedor-login d-flex flex-column align-items-center gap-2 px-5 py-2" style="z-index: 20">
               
                <input type="text" class="textbox-personalizado py-2 px-1 mt-4" placeholder="Nombre de Tarea" style="font-size: 25px; z-index: 22;" name="titulo" >
                <select  name="materia" class="textbox-personalizado py-2 px-1 mt-2" placeholder="Materia" style="font-size: 25px; z-index: 22;">

                    <!-- estas son las opciones de materias disponibles de momento solamente le agrego opciones con -->
                    <!-- la etiqueta <option>, ya en el código pa ver q materias tiene el morro disponible las tendran -->
                    <!-- que sacar de la BD, guardarlas en un arreglo, y luego ya en mediante un ciclo como el for each -->
                    <!-- ir creando un elemento de tipo <option> al q le ponen en su atributo "value" el elemtno actual -->
                    <!-- del arreglo y luego ese option agregarselo al select principal q es el de aquí arribita -->
                    <!-- igual si tienen dudas o algo me pregunta o hasta a gpt, acuerdense q el chiste de gpt es usarlo pa -->
                    <!-- investigar / entender algo, no para q te programe algo el -->

                    <option value="" selected disabled hidden>Materia</option>
                    <?php
                        $stmt2 = $conn->prepare("SELECT * FROM materias");
                        $stmt2->execute();
                        $res2 = $stmt2->get_result();
                        while($fila=$res2->fetch_assoc()){
                            echo "<option value='".$fila['id']."'>".$fila['nombre']."</option>";
                        }
                    ?>
                </select>
                <button type="button" class="btn-personalizado px-5 py-2" data-bs-toggle="modal" data-bs-target="#modalMateriasPendientes" data-bs-dismiss="modal" style="font-size: 20px; top: -12px; z-index: 21; position: relative;">Agregar Materias</button>

                <input type="date" class="textbox-personalizado py-2 px-1" name="fecha" placeholder="Fecha de Entrega" style="font-size: 25px;">

                <div class="d-flex flex-wrap gap-3 mt-2 mb-4 z-index: 22;">
                    <button data-bs-dismiss="modal" class="btn-personalizado px-5 py-2" style="font-size: 20px">Cancelar</button>
                    <button type="submit" class="btn-personalizado px-5 py-2" style="font-size: 20px">Guardar</button>
                </div>
               
            </div>
             </form>
        </div>
    </div>

    <!-- modal q se muestra cuando quieres agregar materias -->
    <div id="modalMateriasPendientes" class="modal fade">
        <div class="modal-dialog modal-di   alog-center">
            <form action="addmateria.php" method="POST"> 
            <div class="modal-content contenedor-login d-flex flex-column align-items-center gap-2 px-5 py-2" style="z-index: 20">
            
            <input type="text" name="nombre" class="textbox-personalizado py-2 px-1 mt-4" placeholder="Nombre de Materia" style="font-size: 25px;">
                      
                <div class="d-flex flex-wrap gap-3 mt-2">
                    <button data-bs-dismiss="modal" class="btn-personalizado px-5 py-2" style="font-size: 20px">Cancelar</button>
                    <button type="submit" class="btn-personalizado px-5 py-2" style="font-size: 20px">Guardar</button>
                </div>
           
                <div class="diseño-r1 py-2 px-1 mt-2" style="font-size: 25px;">Lista de Materias</div>

                <!-- esta es la template q pueden usar para mostrar cada elemento del listado -->
                <!-- de materias, solamente pls ponganle en el código q al último elemento del -->
                <!-- del listado le agreguen la clase "mb-4" para q quede simetrico pls se los ruego estoy en mis rodillas -->

               <div class="modal-content contenedor-login d-flex flex-column align-items-center gap-2 px-5 py-2" style="z-index: 20">
            </form> 

            <div id="lista-materias-container" style="width: 100%;">
                
                <?php
                // Asegúrate de que $conn y $iduser están disponibles al inicio del archivo.

                // 1. Prepara y ejecuta la consulta para obtener TODAS las materias del usuario
                $stmt_listado = $conn->prepare("SELECT id, nombre FROM materias");
    
                $stmt_listado->execute();
                $resultado_listado = $stmt_listado->get_result();
                $materias_count = $resultado_listado->num_rows;
                $contador = 0;

                // 2. Itera sobre los resultados
                while($fila_materia = $resultado_listado->fetch_assoc()){
                    $contador++;
                    $id_materia = $fila_materia['id'];
                    $nombre_materia = htmlspecialchars($fila_materia['nombre']);
                    
                    // 3. Imprime el HTML de la plantilla en cada iteración
                    // Agrega la clase 'mb-4' solo al último elemento si es necesario (para el padding)
                    $clase_final = ($contador === $materias_count) ? 'mb-4' : '';
                ?>
                   
                    <div class="d-flex flex-wrap justify-content-between mt-2 " > 
                         <form action="editarmateria.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id_materia?>">
                        <div class="diseño-r1 px-2 py-2">
                           <input type="text" name ="nombre" style="font-size: 15px; border: 0px solid black;" class="diseño-r1" value=" <?php echo $nombre_materia; ?>">
                        </div>

                        <button type="submit" class="btn-personalizado2 p-2" style="border: 0px solid black;">
                            <img src="editarTareaLogo.png" alt="editar materia logo" style="height: 35px; width: 35px;">
                        </button>
                         </form>
                        <form action="borrarmateria.php" method="POST">
                              <input type="hidden" name="id" value="<?php echo $id_materia?>">
                            <button  type="submit" class="btn-personalizado2 p-2" style="border: 0px solid black;">
                            <img src="eliminarTareaLogo.png" alt="eliminar materia logo" style="height: 35px; width: 35px;">
                        </button>
                        </form>
                    </div>
                   
                <?php
                } // Fin del bucle while

                // Cierra el statement
                $stmt_listado->close();
                ?>
            </div>
            </div>
              
        </div>
    </div>
    </div>

    <!-- modal q se muestra cuando quiereseditar una tarea -->
    <div id="modalEditarPendientes" class="modal fade">
        <div class="modal-dialog modal-dialog-center">
             <form action="editartarea.php" method="POST">

            <div class="modal-content contenedor-login d-flex flex-column align-items-center gap-2 px-5 py-2" style="z-index: 20">
               <input type="hidden" name="id_tarea" id="edit_id_tarea" value="">
                <input type="text" id="edit_titulo" class="textbox-personalizado py-2 px-1 mt-4" placeholder="Nombre de Tarea" style="font-size: 25px; z-index: 22;" name="titulo" >
                <select  name="materia" class="textbox-personalizado py-2 px-1 mt-2" placeholder="Materia" style="font-size: 25px; z-index: 22;" required>

                    <!-- estas son las opciones de materias disponibles de momento solamente le agrego opciones con -->
                    <!-- la etiqueta <option>, ya en el código pa ver q materias tiene el morro disponible las tendran -->
                    <!-- que sacar de la BD, guardarlas en un arreglo, y luego ya en mediante un ciclo como el for each -->
                    <!-- ir creando un elemento de tipo <option> al q le ponen en su atributo "value" el elemtno actual -->
                    <!-- del arreglo y luego ese option agregarselo al select principal q es el de aquí arribita -->
                    <!-- igual si tienen dudas o algo me pregunta o hasta a gpt, acuerdense q el chiste de gpt es usarlo pa -->
                    <!-- investigar / entender algo, no para q te programe algo el -->

                    <option value="" selected disabled hidden>Materia</option>
                    <?php
                        $stmt2 = $conn->prepare("SELECT * FROM materias");
                        $stmt2->execute();
                        $res2 = $stmt2->get_result();
                        while($fila=$res2->fetch_assoc()){
                            echo "<option value='".$fila['id']."'>".$fila['nombre']."</option>";
                        }
                    ?>
                </select>
                <button type="button" class="btn-personalizado px-5 py-2" data-bs-toggle="modal" data-bs-target="#modalMateriasPendientes" data-bs-dismiss="modal" style="font-size: 20px; top: -12px; z-index: 21; position: relative;">Agregar Materias</button>

                <input type="date" id="edit_fecha" class="textbox-personalizado py-2 px-1" name="fecha" placeholder="Fecha de Entrega" style="font-size: 25px;">

                <div class="d-flex flex-wrap gap-3 mt-2 mb-4 z-index: 22;">
                    <button data-bs-dismiss="modal" class="btn-personalizado px-5 py-2" style="font-size: 20px">Cancelar</button>
                    <button type="submit" class="btn-personalizado px-5 py-2" style="font-size: 20px">Guardar</button>
                </div>
               
            </div>
             </form>
        </div>
    </div>


    <!-- este script solo levanta el botón de completadas para q el usuario sepa q está en esa sección -->
    <script>
        let botonInicial = document.getElementById("pendiente");
        botonInicial.classList.add('on');

        const botones = document.querySelectorAll('.btn-toggle');

        botones.forEach(boton => {
            boton.addEventListener('click', () => {
                botones.forEach(b => b.classList.remove('on'));
                boton.classList.add('on');
            });
        });
    </script>
    

<?php


$stmt = $conn->prepare("SELECT tareas.id AS id, tareas.titulo AS titulo, tareas.fechaEntrega AS fechaEntrega, materias.nombre AS nombre, tareas.completada AS completada FROM tareas INNER JOIN materias on tareas.materia=materias.id WHERE id_usuario = ? ORDER BY fechaEntrega");
$stmt->bind_param("i", $iduser);
$stmt->execute();
$resultado = $stmt->get_result();

$tareas_array = []; 

while ($fila = $resultado->fetch_assoc()) {

    $nuevaTarea = [
        'id'            => (int)$fila['id'], 
        'titulo'        => $fila['titulo'],
        'fechaEntrega'  => $fila['fechaEntrega'],
        'materia' =>$fila['nombre'],
        'completada'    => (bool)$fila['completada'] 
    ];
    
    $tareas_array[] = $nuevaTarea; 
}
        ?>
    <script>
        const tareas = <?php echo json_encode($tareas_array, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;


        const container=document.getElementById("tareas");
        const template=document.getElementById("tarea");



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
             const botones=Clone.querySelectorAll("button");
            if(b==0){
               
      
                const btnEditar = botones[1];
                if (btnEditar && btnEditar.getAttribute('data-bs-target') === '#modalEditarPendientes') {

                    btnEditar.setAttribute('data-id-tarea', elemento.id);
                }
            }
            const inputHidden = Clone.querySelector('input[name="id_tarea"]');
            inputHidden.value = elemento.id;
              const inputHidden2 = Clone.querySelector('input[name="id_tarea2"]');
            inputHidden2.value = elemento.id;
            container.append(Clone);
        }

document.addEventListener('DOMContentLoaded', function () {
    const modalEditar = document.getElementById('modalEditarPendientes');
    modalEditar.addEventListener('show.bs.modal', function (event) {
       const button = event.relatedTarget;
       const tareaID = button.getAttribute('data-id-tarea');
       console.log(tareaID); 
     const tarea = tareas.find(t => t.id == tareaID);

        if (tarea) {
        document.getElementById('edit_id_tarea').value = tarea.id; // Campo Oculto
            document.getElementById('edit_titulo').value = tarea.titulo;
            document.getElementById('edit_fecha').value = tarea.fechaEntrega; 
  }
    });
});
    </script>

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>