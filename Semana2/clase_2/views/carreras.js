const API = "../index.php";

const formulario = document.getElementById("formCarrera")
const nombre = document.getElementById("nombre")
const tablahtml = document.getElementById("tablaCarreras")
const mensaje = document.getElementById("mensaje")

async function todos() {
    try{
        const respuesta = await fetch(API + "?accion=todos");
        const carreras = await respuesta.json();
        if(!respuesta.ok){
            throw new Error(carreras.error || "Error al obtener los datos");
        }
        tablahtml.innerHTML ="";
        carreras.forEach(carrera => {
            const fila = document.createElement("tr");
            const celdaId = document.createElement("td");
            const nombrecelda = document.createElement("td");

            celdaId.textContent = carrera.id;
            nombrecelda.textContent = carrera.nombre;
            fila.appendChild(celdaId);
            fila.appendChild(nombrecelda);
            tablahtml.appendChild(fila)
        });
    }catch(error){
        mensaje.textContent = error.message
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

        const resultado = await respuesta.json();
        if (!respuesta.ok) {
            throw new Error(resultado.error || "Error al guardar");
        }

        if (resultado.guardado) {
            mensaje.textContent = "Carrera guardada correctamente";

            formulario.reset();

            await todos();
        } else {
            mensaje.textContent = "No se pudo guardar";
        }

    } catch (error) {
        mensaje.textContent = error.message;
    }
});

async function crearTabla() {
    try {
        const respuesta = await fetch(API + "?accion=creartabla", {
            method: "POST"
        });
        const resultado = await respuesta.json();
        if (!respuesta.ok || !resultado.tabla_creada) {
            throw new Error(resultado.error || "No se pudo crear la tabla");
        }
        mensaje.textContent = "Tabla creada correctamente. Si ya existía, se conservaron los datos.";
        await todos();
    } catch (error) {
        mensaje.textContent = error.message;
    }
}

document.getElementById("crearTabla").addEventListener("click", crearTabla);

todos();
