$(document).ready(function(){
    $('#product-result').hide();
    listarProductos();
    let edit = false;
    botonAddEdit();
    function botonAddEdit(){
        if(edit){
            $('#add-edit').text('Editar producto');
        }else{
            $('#add-edit').text('Agregar producto');
        }
    }

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
                                <td>
                                    <a href="#" class="product-item">${producto.nombre}</a>
                                </td>
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

        let finalJSON = 
            {
                id: $('#productId').val(),
                nombre: $('#name').val(),
                marca: $('#form-marca').val(),
                modelo: $('#form-modelo').val(),
                descripcion: $('#form-descripcion').val(),
                precio: parseFloat($('#form-precio').val()),
                unidades: parseInt($('#form-unidad').val()),
                img: $('#form-img').val()
            }; 
        
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
                edit = false;
                botonAddEdit();
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
            // verificamos si la marca conincide con un valor del select
            if ($('#form-marca option[value="' + product.marca + '"]').length === 0) {
                $('#form-marca').val('0');  // Opción predeterminada
            } else {
                $('#form-marca').val(product.marca);  // Valor devuelto válido
            }
            $('#form-modelo').val(product.modelo);
            $('#form-descripcion').val(product.detalles);
            $('#form-precio').val(product.precio);
            $('#form-unidad').val(product.unidades);
            $('#form-img').val(product.imagen);
            console.log(product);
            //var JsonString = JSON.stringify(baseJSON,null,2);
            delete product.id;
            delete product.nombre;
            let JSONProduct = JSON.stringify(product,null,2);
            $('#description').val(JSONProduct);
            edit = true;
            botonAddEdit();
        });
    });

    $('#name').on('focus keyup',function(){
        let element = $('#name').val().trim();
        $('#product-result').show();
        if(!element){
            $('#container').html('El nombre es requerido');
            $('#name').css('border', '2px solid red');
        }else if(element.length>100){
            $('#container').html('El nombre no más de 100');
            $('#name').css('border', '2px solid orange');
            }else{
                $.ajax({
                    url: 'backend/product-singleByName.php',
                    type: 'GET',
                    //data: {element: element} es lo mismo que
                    data: { element },
                    success: function(response){
                        let respuesta = JSON.parse(response);
                        // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
                        let template_bar = '';
                        template_bar += `
                                    <li style="list-style: none;">status: ${respuesta.status}</li>
                                    <li style="list-style: none;">message: ${respuesta.message}</li>
                                `;
                        // SE HACE VISIBLE LA BARRA DE ESTADO
                        if(respuesta.status === 'error'){
                            $('#name').css('border', '2px solid orange');
                        }else{
                            $('#name').css('border', '2px solid green');
                        }
                        $('#container').html(template_bar);
                        console.log(template_bar);
                    }
                });
            }
    });
    $('#form-marca').on('click',function(){
        validarMarca();
    });
    function validarMarca(){
        let element = $('#form-marca').val();
        $('#product-result').show();
        if(element === '0'){
            $('#container').html('La marca es requerida');
            $('#form-marca').css('border', '2px solid red');
        }else{
            $('#container').html('La opción es válida');
            $('#form-marca').css('border', '2px solid green');
            }
    }
    $('#form-modelo').on('focus keyup',function(){
        validarModelo();
    });
    function validarModelo(){
        let element = $('#form-modelo').val().trim();
        const alfanumerico = /^[a-zA-Z0-9-]+$/;
        $('#product-result').show();
        if(!element){
            $('#container').html('El modelo es requerido');
            $('#form-modelo').css('border', '2px solid red');
        }else if(!alfanumerico.test(element)){
            $('#container').html('Solo caracteres alfanumericos');
            $('#form-modelo').css('border', '2px solid orange');
            }else{
                $('#container').html('El campo es válido');
                $('#form-modelo').css('border', '2px solid green');
            }
    }
    $('#form-descripcion').on('focus keyup',function(){
        validarDetalles();
    });
    function validarDetalles(){
        let element = $('#form-descripcion').val().trim();
        $('#product-result').show();
        if(element.length>300){
            $('#container').html('El nombre no más de 300');
            $('#form-descripcion').css('border', '2px solid orange');
            }else{
                $('#container').html('El campo es válido');
                $('#form-descripcion').css('border', '2px solid green');
            }
    }
    $('#form-precio').on('focus keyup',function(){
        validarPrecio();
    });
    function validarPrecio(){
        let element = parseFloat($('#form-precio').val().trim());
        $('#product-result').show();
        if(isNaN(element)){
            $('#container').html('El precio es requerido');
            $('#form-precio').css('border', '2px solid red');
        }else if(element<=99.99){
            $('#container').html('El debe ser mayor a 99.99');
            $('#form-precio').css('border', '2px solid orange');
            }else{
                $('#container').html('El campo es válido');
                $('#form-precio').css('border', '2px solid green');
            }
    }
    $('#form-unidad').on('focus keyup',function(){
        validarUnidad();
    });
    function validarUnidad(){
        let element = $('#form-unidad').val();
        $('#product-result').show();
        if(!element){
            $('#container').html('Las unidades son requeridas');
            $('#form-unidad').css('border', '2px solid red');
        }else if(parseInt(element)<0){
            $('#container').html('Las unidades deben ser positivas');
            $('#form-unidad').css('border', '2px solid orange');
            }else if(element%1 !== 0){
                $('#container').html('Ingresa un número entero');
                $('#form-unidad').css('border', '2px solid orange');
                }else{
                    $('#container').html('El campo es válido');
                    $('#form-unidad').css('border', '2px solid green');
                }
    }
    $('#form-img').on('focus keyup',function(){
        validarImg();
    });
    function validarImg(){
        let element = $('#form-img').val().trim();
        $('#product-result').show();
        $('#container').html('Sin restricciones');
        $('#form-img').css('border', '2px solid green');
            
    }
    
});

function validarProducto(producto) {
    
        var errores = [];
    
        // Validación del nombre
        if (!producto.nombre) {
            errores.push('El nombre es requerido.');
        }
    
        if(producto.nombre.length > 100){
            errores.push('El nombre no debe exceder los 100 caracteres.');
        }
    
        // Validación de la marca
        if (producto.marca === "0") { // Asumiendo que la primera opción es una opción no válida
            errores.push('La marca es requerida.');
        }
    
        // Validación del modelo
        const alfanumerico = /^[a-zA-Z0-9-]+$/;
        if (!producto.modelo) {
            errores.push('El modelo es requerido.');
        }else{
            if(!alfanumerico.test(producto.modelo)){
                errores.push('El modelo debe ser alfanumerico.');
            }
        }
    
        if(producto.modelo.length > 25){
            errores.push('El modelo no debe exceder los 25 caracteres.');
        }
    
        // Validación del precio
        if (isNaN(producto.precio)) {
            errores.push('El precio es requerido.');
        }
    
        if(producto.precio <= 99.99){
            errores.push('El precio debe ser mayor a 99.99.');
        }
    
        // Validación de la descripción (opcional)
        if (producto.descripcion.length > 250) {
            errores.push('La descripción no debe tener mas 250 caracteres.');
        }
    
        // Validación de las unidades
        if (isNaN(producto.unidades)) {
            errores.push('Las unidades son requeridas.');
        }
    
        if(producto.unidades < 0){
            errores.push('Las unidades no pueden ser negativas.');
        }
    
        // Validación de la ruta de la imagen
        if (!producto.img) {
            $('#form-img').val('img/imagen.png');
            producto.img = 'img/imagen.png';
        }
        
        return errores;
}
