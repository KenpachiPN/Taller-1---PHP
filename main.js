
addEventListener("DOMContentLoaded", (e) => {
    let myForm = document.querySelector("#formulario");
    myForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        if (e.submitter.dataset.operacion == "Limpiar") {
            // Escribir un programa que permita ingresar para los N alumnos de una universidad: 
            // SEXO (‘M’ o ‘F’), edad y carrera (‘A’,’B’,’C’). 
            // Imprimir la carrera con menor promedio de edad de sus alumnos que son varones
            myForm.reset();
            document.querySelectorAll("tbody input").forEach(res => res.value="");
        } else {
            let data = Object.fromEntries(new FormData(e.target));
            let config = {
                method: myForm.method,
                body: JSON.stringify(data)
            };
            let peticion = await fetch(myForm.action, config);
            let res = await peticion.text();
            document.querySelector("pre").innerHTML = res;
            // document.querySelector(`[name="codigoProducto"]`).value = res.Factura.Codigo;
            // document.querySelector(`[name="producto"]`).value = res.Factura.Producto;
            // document.querySelector(`[name="unidades"]`).value = res.Factura.UnidadesCompradas;
            // document.querySelector(`[name="total"]`).value = `$ ${res.Factura.Total}`;
        }
    })
})  