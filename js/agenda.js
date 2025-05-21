// script.js
document.getElementById("form-agenda").addEventListener("submit", function (e) {
    e.preventDefault();
  
    const nombre = document.getElementById("nombre").value;
    const fecha = document.getElementById("fecha").value;
    const hora = document.getElementById("hora").value;
    const duracion = document.getElementById("duracion").value;
    const asignatura = document.getElementById("asignatura").value;
    const tema = document.getElementById("tema").value;
  
    const nuevaClase = document.createElement("li");
    nuevaClase.textContent = `${nombre} - ${asignatura} - ${fecha} ${hora} (${duracion}h): ${tema}`;
  
    document.getElementById("lista-clases").appendChild(nuevaClase);
  
    this.reset();
  });
  