function validarFormulario(event) {
    // Evitar el envío del formulario si hay errores
    event.preventDefault();

    // Obtener los valores de los campos
    const nombre = document.getElementById('form-nombre').value.trim();
    const marca = document.getElementById('form-marca').value.trim();
    const modelo = document.getElementById('form-modelo').value.trim();
    const descripcion = document.getElementById('form-descripcion').value.trim();
    const precio = document.getElementById('form-precio').value.trim();
    const unidad = document.getElementById('form-unidad').value.trim();
    const img = document.getElementById('form-img').value.trim();

    // Validaciones
    let errores = [];

    if (nombre === "") {
        errores.push("El nombre del producto es obligatorio.");
    }

    if (marca === "") {
        errores.push("La marca es obligatoria.");
    }

    if (modelo === "") {
        errores.push("El modelo es obligatorio.");
    }

    if (descripcion.length > 300) {
        errores.push("La descripción no puede exceder los 300 caracteres.");
    }

    // Validar precio: debe ser un número válido con hasta 10 dígitos enteros y 2 decimales
    const precioRegex = /^\d{1,10}(\.\d{0,2})?$/;
    if (!precioRegex.test(precio) || parseFloat(precio) <= 0) {
        errores.push("El precio debe ser un número positivo con hasta 10 dígitos enteros y 2 decimales.");
    }

    // Validar unidades: solo enteros
    const unidadesRegex = /^[0-9]+$/;
    if (!unidadesRegex.test(unidad) || parseInt(unidad) < 0) {
        errores.push("La cantidad de unidades debe ser un número entero positivo o cero.");
    }

    if (img === "") {
        errores.push("La ruta de la imagen es obligatoria.");
    }

    // Mostrar errores si los hay
    if (errores.length > 0) {
        alert(errores.join("\n"));
    } else {
        // Si no hay errores, se puede enviar el formulario
        document.getElementById('formularioProductos').submit();
    }
}

// Asignar la función de validación al evento submit
window.onload = function() {
    document.getElementById('formularioProductos').addEventListener('submit', validarFormulario);
};
