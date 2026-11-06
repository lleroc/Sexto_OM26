const API = "../index.php";

const formulario = document.getElementById("formCarrera")
const nombre = document.getElementById("nombre")
const tablahtml = document.getElementById("tablaCarreras")
const mensaje = document.getElementById("mensaje")

async function todos() {
    try{
        const respuesta = await fetch(API + "?accion=todos");
        if(!respuesta.ok){
            throw new Error("Error al obtener los datos")
        }
        const carreras = await respuesta.json();
        tablahtml.innerHTML ="";
        carreras.array.forEach(carrera => {
            const fila = document.createElement("tr");
            const celdaId = document.createElement("td");
            const nombrecelda = document.createElement("td");

            nombrecelda.textContent = carrera.nombre;
            fila.appendChild(celdaId);
            fila.appendChild(nombrecelda);
            tablahtml.appendChild(fila)
        });
    }catch(error){
        mensaje.textContent = error.mensaje
    }
}

formulario.addEventListener("submit", async function(event) {

    event.preventDefault();

    const datos = new URLSearchParams();
    datos.append("nombre", nombre.value.trim());

    try {
        const respuesta = await fetch(
            API + "?accion=guardar",
            {
                method: "POST",
                body: datos
            }
        );

        if (!respuesta.ok) {
            throw new Error("Error al guardar");
        }

        const resultado = await respuesta.json();

        if (resultado.guardado) {
            mensaje.textContent = "Carrera guardada correctamente";

            formulario.reset();

            listarCarreras();
        } else {
            mensaje.textContent = "No se pudo guardar";
        }

    } catch (error) {
        mensaje.textContent = error.message;
    }
});

// Cargar carreras al iniciar
todos();