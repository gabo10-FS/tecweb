// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/imagen.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    //document.getElementById("description").value = JsonString;
    $('#description').val(JsonString);

    // SE LISTAN TODOS LOS PRODUCTOS
    //listarProductos();
}

$(document).ready(function(){
    $('#product-result').hide();
    listarProductos();
    let edit = false;

    $('#search').keyup(function(e){
        if($('#search').val()){
            let search = $('#search').val();
            $.ajax({
                url: 'backend/product-search.php',
                type: 'GET',
                //data: {search: search} es lo mismo que
                data: { search },
                success: function(response){
                    let productos = JSON.parse(response);
                    let template = '';
                    let template_bar = '';
                    productos.forEach(producto => {
                        // SE COMPRUEBA QUE SE OBTIENE UN OBJETO POR ITERACIÓN
                        //console.log(producto);
    
                        // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                        let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td>${producto.nombre}</td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
    
                        template_bar += `
                            <li>${producto.nombre}</il>
                        `;
                    });
                    // SE HACE VISIBLE LA BARRA DE ESTADO
                    //$('#product-result').addClass('card my-4 d-block');
                    $('#product-result').show();
                    // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                    $('#container').html(template_bar);
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#products').html(template); 
                }
            });
        }
    });

    $('#product-form').submit(function(e){
        e.preventDefault();

        var productoJsonString = $('#description').val();
        var finalJSON = JSON.parse(productoJsonString);
        finalJSON['nombre'] = $('#name').val();
        finalJSON['id'] = $('#productId').val();
        // Llamada a la función de validación
        var errores = validarProducto(finalJSON);

        // Mostrar errores
        if (errores.length > 0) {
            alert(errores.join('\n'));
            return; // Detener el envío del formulario si hay errores
        }
        productoJsonString = JSON.stringify(finalJSON,null,2);
        //console.log(productoJsonString);
        let url = edit === false ? 'backend/product-add.php' : 'backend/product-edit.php';
        $.post(url, productoJsonString, function(response) {
            let respuesta = JSON.parse(response);
            if(respuesta.status === 'success'){
                listarProductos();
                $('#product-form').trigger('reset');
                init();
            }
            // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
            // SE HACE VISIBLE LA BARRA DE ESTADO
            $('#product-result').show();
            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
            $('#container').html(template_bar);
        });
    });

    function listarProductos(){
        $.ajax({
            url: 'backend/product-list.php',
            type: 'GET',    
            success: function(response){
                let productos = JSON.parse(response);
                let template = '';
    
                productos.forEach(producto => {
                    // SE COMPRUEBA QUE SE OBTIENE UN OBJETO POR ITERACIÓN
                    //console.log(producto);
    
                    // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                    let descripcion = '';
                    descripcion += '<li>precio: '+producto.precio+'</li>';
                    descripcion += '<li>unidades: '+producto.unidades+'</li>';
                    descripcion += '<li>modelo: '+producto.modelo+'</li>';
                    descripcion += '<li>marca: '+producto.marca+'</li>';
                    descripcion += '<li>detalles: '+producto.detalles+'</li>';
                
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>
                                <a href="#" class="product-item">${producto.nombre}</a>
                            </td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
                });
                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                $('#products').html(template);
            }
        });
    }

    $(document).on('click','.product-delete', function(){
        if(confirm('¿Estás seguro de querer eliminar el producto?')){
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('productId');
            $.ajax({
                url: 'backend/product-delete.php',
                type: 'GET',
                data: { id },
                success: function(response){
                    let respuesta = JSON.parse(response);
                    // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
                    let template_bar = '';
                    template_bar += `
                                <li style="list-style: none;">status: ${respuesta.status}</li>
                                <li style="list-style: none;">message: ${respuesta.message}</li>
                            `;

                    // SE HACE VISIBLE LA BARRA DE ESTADO
                    $('#product-result').show();
                    // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                    $('#container').html(template_bar);
                    // SE LISTAN TODOS LOS PRODUCTOS
                    listarProductos();
                }
            });
        }
    });

    $(document).on('click', '.product-item', function(){
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');
        $.post('backend/product-single.php', {id}, function(response){
            let product = JSON.parse(response);
            $('#name').val(product.nombre);
            $('#productId').val(product.id);
            console.log(product);
            //var JsonString = JSON.stringify(baseJSON,null,2);
            delete product.id;
            delete product.nombre;
            let JSONProduct = JSON.stringify(product,null,2);
            $('#description').val(JSONProduct);
            edit = true;
        });
    });
});

function validarProducto(producto) {
    const errores = [];

    // Validación del nombre
    if (!producto.nombre) {
        errores.push('El nombre es requerido.');
    } else if (producto.nombre.length > 100) {
        errores.push('El nombre no debe exceder los 100 caracteres.');
    }

    // Validación de la marca
    if (!producto.marca) {
        errores.push('La marca es requerida.');
    }

    // Validación del modelo
    const alfanumerico = /^[a-zA-Z0-9-]+$/; // permite guiones
    if (!producto.modelo) {
        errores.push('El modelo es requerido.');
    } else if (!alfanumerico.test(producto.modelo)) {
        errores.push('El modelo debe ser alfanumérico.');
    } else if (producto.modelo.length > 25) {
        errores.push('El modelo no debe exceder los 25 caracteres.');
    }

    // Validación del precio
    if (isNaN(producto.precio) || producto.precio <= 99.99) {
        errores.push('El precio es requerido y debe ser mayor a 99.99.');
    }

    // Validación de los detalles (opcional)
    if (producto.detalles && producto.detalles.length > 250) {
        errores.push('Los detalles no deben tener más de 250 caracteres.');
    }

    // Validación de las unidades
    if (isNaN(producto.unidades) || producto.unidades < 0) {
        errores.push('Las unidades son requeridas y deben ser mayores o iguales a 0.');
    }

    // Validación de la ruta de la imagen (opcional)
    if (!producto.imagen) {
        producto.imagen = 'img/imagen.png'; // Establecer imagen por defecto si no se proporciona
    }

    return errores;
}
