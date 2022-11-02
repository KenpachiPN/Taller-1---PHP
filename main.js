
addEventListener("DOMContentLoaded", (e) => {
    let myForm = document.querySelector("#formulario");
    myForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        if (e.submitter.dataset.operacion == "Limpiar") {
            myForm.reset();
            document.querySelectorAll("tbody input").forEach(res => res.value="");
        } else {
            let data = Object.fromEntries(new FormData(e.target));
            let config = {
                method: myForm.method,
                body: JSON.stringify(data)
            };
            let peticion = await fetch(myForm.action, config);
            let res = await peticion.json();
            document.querySelector(`[name="codigoProducto"]`).value = res.Factura.Codigo;
            document.querySelector(`[name="producto"]`).value = res.Factura.Producto;
            document.querySelector(`[name="unidades"]`).value = res.Factura.UnidadesCompradas;
            document.querySelector(`[name="total"]`).value = `$ ${res.Factura.Total}`;
        }
    })
})  