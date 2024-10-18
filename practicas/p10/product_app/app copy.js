// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 99.99,
    "unidades": 1,
    "modelo": "XX-000",
    "detalles": "NA",
    "imagen": "img/imagen.png"
  };

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"

function buscarID(e) {
    e.preventDefault();

    // SE OBTIENE EL ID A BUSCAR
    var valor = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            
            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if(Object.keys(productos).length > 0) {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let descripcion = '';
                    descripcion += '<li>precio: '+productos.precio+'</li>';
                    descripcion += '<li>unidades: '+productos.unidades+'</li>';
                    descripcion += '<li>modelo: '+productos.modelo+'</li>';
                    descripcion += '<li>marca: '+productos.marca+'</li>';
                    descripcion += '<li>detalles: '+productos.detalles+'</li>';
                
                // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                    template += `
                        <tr>
                            <td>${productos.id}</td>
                            <td>${productos.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            }
        }
    };
    client.send("search="+valor);
}


function buscarProducto(e){
    e.preventDefault();

    // SE OBTIENE EL ID A BUSCAR
    var search = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            
            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if(Array.isArray(productos) && productos.length > 0) {
                // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                productos.forEach(producto => {
                    let descripcion = '';
                    descripcion += '<li>precio: '+producto.precio+'</li>';
                    descripcion += '<li>unidades: '+producto.unidades+'</li>';
                    descripcion += '<li>modelo: '+producto.modelo+'</li>';
                    descripcion += '<li>marca: '+producto.marca+'</li>';
                    descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                });
                

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            }
        }
    };
    client.send("search="+search);
}

// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
    var productoJsonString = document.getElementById('description').value;
    // SE CONVIERTE EL JSON DE STRING A OBJETO
    var finalJSON = JSON.parse(productoJsonString);

    // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
    finalJSON['nombre'] = document.getElementById('name').value;

    //SE AGREGA AL JSON LA MARCA DEL PRODUCTO
    finalJSON['marca'] = document.getElementById('brand').value;

    // Llamada a la función de validación
    var errores = validarProducto(finalJSON);

    // Mostrar errores
    if (errores.length > 0) {
        alert(errores.join('\n'));
        return; // Detener el envío del formulario si hay errores
    }
    
    // SE OBTIENE EL STRING DEL JSON FINAL
    productoJsonString = JSON.stringify(finalJSON,null,2);
    console.log(JSON.stringify(finalJSON, null, 2));

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log(client.responseText);
            alert(client.responseText);
        }
    };
    client.send(productoJsonString);
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}

function validarProducto(producto) {
    const errores = [];

    // Validación del nombre
    if (!producto.nombre) {
        errores.push('El nombre es requerido.');
    } else if (producto.nombre.length > 100) {
        errores.push('El nombre no debe exceder los 100 caracteres.');
    }

    // Validación de la marca
    if (producto.marca === "0") {
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


