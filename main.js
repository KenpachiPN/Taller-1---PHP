
addEventListener("DOMContentLoaded", (e) => {
    let myForm = document.querySelector("#formulario");
    myForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        let data = Object.fromEntries(new FormData(e.target));
        let MyHeader = new Headers();

        if (e.submitter.dataset.operacion == "Limpiar") {
            // Escribir un programa que permita ingresar para los N alumnos de una universidad: 
            // SEXO (‘M’ o ‘F’), edad y carrera (‘A’,’B’,’C’). 
            // Imprimir la carrera con menor promedio de edad de sus alumnos que son varones
            myForm.reset();
            document.querySelectorAll("tbody input").forEach(res => res.value = "");
        } else if (e.submitter.dataset.operacion == "Guardar") {
            MyHeader.append("accept", false);
            let config = {
                headers: MyHeader,
                method: myForm.method,
                body: JSON.stringify(data)
            };
            let peticion = await fetch(myForm.action, config);
            let res = await peticion.text();
            // document.querySelector("pre").innerHTML = res;
            myForm.reset();
        }
        else if (e.submitter.dataset.operacion == "Mostrar") {

            MyHeader.append("Accept", "Calcular");
            let config = {
                headers: MyHeader,
                method: myForm.method,
                body: JSON.stringify(data)
            };
            let peticion = await fetch(myForm.action, config);
            let res = await peticion.json();
            // document.querySelector("pre").innerHTML = res;
            //CARRERA A
            document.querySelector(`[name="CarreraA"]`).value = res.Promedios.A["Carrera"];
            document.querySelector(`[name="EdadVaronesA"]`).value = res.Promedios.A["Total de edades de los varones"];
            document.querySelector(`[name="promVaronesA"]`).value = res.Promedios.A["Promedio de varones"];
            document.querySelector(`[name="promVarAlumnA"]`).value = res.Promedios.A["Promedio de varones por el total de alumnos"];
            document.querySelector(`[name="totalAlumnA"]`).value = res.Promedios.A["Total de alumnos"];
            document.querySelector(`[name="totalAlumnVarA"]`).value = res.Promedios.A["Total de alumnos Varones"];
            //CARRERA B
            document.querySelector(`[name="CarreraB"]`).value = res.Promedios.B["Carrera"];
            document.querySelector(`[name="EdadVaronesB"]`).value = res.Promedios.B["Total de edades de los varones"];
            document.querySelector(`[name="promVaronesB"]`).value = res.Promedios.B["Promedio de varones"];
            document.querySelector(`[name="promVarAlumnB"]`).value = res.Promedios.B["Promedio de varones por el total de alumnos"];
            document.querySelector(`[name="totalAlumnB"]`).value = res.Promedios.B["Total de alumnos"];
            document.querySelector(`[name="totalAlumnVarB"]`).value = res.Promedios.B["Total de alumnos Varones"];
            //CARRERA C
            document.querySelector(`[name="CarreraC"]`).value = res.Promedios.C["Carrera"];
            document.querySelector(`[name="EdadVaronesC"]`).value = res.Promedios.C["Total de edades de los varones"];
            document.querySelector(`[name="promVaronesC"]`).value = res.Promedios.C["Promedio de varones"];
            document.querySelector(`[name="promVarAlumnC"]`).value = res.Promedios.C["Promedio de varones por el total de alumnos"];
            document.querySelector(`[name="totalAlumnC"]`).value = res.Promedios.C["Total de alumnos"];
            document.querySelector(`[name="totalAlumnVarC"]`).value = res.Promedios.C["Total de alumnos Varones"];
        }
    })
})  