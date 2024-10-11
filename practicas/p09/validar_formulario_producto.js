document.getElementById('formularioProductos').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el envío del formulario por defecto

    // Obtener valores de los campos
    var nombre = document.getElementById('form-nombre').value;
    var marca = document.getElementById('form-marca').value;
    var modelo = document.getElementById('form-modelo').value;
    var precio = parseFloat(document.getElementById('form-precio').value);
    var descripcion = document.getElementById('form-descripcion').value;
    var unidades = parseInt(document.getElementById('form-unidad').value);
    var imagen = document.getElementById('form-img');
    var img = imagen.value;

    // Validaciones
    var valid = true;
    var mensajeError = '';

    // Validación del nombre
    if (!nombre) {
        mensajeError += 'El nombre es requerido.\n';
        valid = false;
    }

    if(nombre.length > 100){
        mensajeError += 'El nombre no debe exceder los 100 caracteres.\n';
        valid = false;
    }

    // Validación de la marca
    if (marca === "0") { // Asumiendo que la primera opción es una opción no válida
        mensajeError += 'La marca es requerida.\n';
        valid = false;
    }

    // Validación del modelo
    const alfanumerico = /^[a-zA-Z0-9]+$/;
    if (!modelo) {
        mensajeError += 'El modelo es requerido.\n';
        valid = false;
    }else{
        if(!alfanumerico.test(modelo)){
            mensajeError += 'El modelo debe ser alfanumerico.\n';
            valid = false;
        }
    }

    if(modelo.length > 25){
        mensajeError += 'El modelo no debe exceder los 25 caracteres.\n';
        valid = false;
    }

    // Validación del precio
    if (isNaN(precio)) {
        mensajeError += 'El precio es requerido.\n';
        valid = false;
    }

    if(precio <= 99.99){
        mensajeError += 'El precio debe ser mayor a 99.99.\n';
        valid = false;
    }

    // Validación de la descripción (opcional)
    if (descripcion.length > 250) {
        mensajeError += 'La descripción no debe tener mas 250 caracteres.\n';
        valid = false;
    }

    // Validación de las unidades
    if (isNaN(unidades)) {
        mensajeError += 'Las unidades son requeridas.\n';
        valid = false;
    }

    if(unidades < 0){
        mensajeError += 'Las unidades no pueden ser negativas.\n';
        valid = false;
    }

    // Validación de la ruta de la imagen
    if (!img) {
        imagen.value = 'img/imagen.png';
    }

    // Mostrar errores
    if (!valid) {
        alert(mensajeError);
    } else {
        // Si todas las validaciones pasan, enviar el formulario
        this.submit();
    }
});
