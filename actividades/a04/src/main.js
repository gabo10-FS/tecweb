function getDatos(){
    var nombre = prompt('Nombre: ','');
    var edad = prompt('Edad: ',0);

    var div1 = document.getElementById('nombre');
    div1.innerHTML = '<h3>Nombre: ' + nombre + '</h3>';
    var div2 = document.getElementById('edad');
    div2.innerHTML = '<h3>Edad: ' + edad + '</h3>';
}

function ejemplo01(){
    var div = document.getElementById('ejemplo01');
    div.innerHTML = '<h3>Hola Mundo</h3>';
}

function ejemplo02(){
    var nombre = 'Angel';
    var edad = 20;
    var altura = 1.72;
    var casado = false;
    var div = document.getElementById('ejemplo02');
    div.innerHTML = '<h3>Nombre: ' + nombre + '</h3>'
    + '<h3>Edad: ' + edad + '</h3>'
    + '<h3>Altura: ' + altura + '</h3>'
    + '<h3>Casado: ' + casado + '</h3>';
}
function ejemplo03(){
    var nombre;
    var edad;
    nombre = prompt('Ingresa tu nombre:', '');
    edad = prompt('Ingresa tu edad:', '');
    var div = document.getElementById('ejemplo03');
    div.innerHTML = '<h3>Hola ' + nombre + ' así que tienes ' + edad + ' años';
}

function ejemplo04(){
    var valor1;
    var valor2;
    valor1 = prompt('Introducir primer número:', '');
    valor2 = prompt('Introducir segundo número', '');
    var suma = parseInt(valor1)+parseInt(valor2);
    var producto = parseInt(valor1)*parseInt(valor2);
    var div = document.getElementById('ejemplo04');
    div.innerHTML = '<h3>La suma es ' + suma + '</h3>'
    + '<h3>El producto es ' + producto + '</h3>';   
}

function ejemplo05(){
    var nombre;
    var nota;
    nombre = prompt('Ingresa tu nombre:', '');
    nota = prompt('Ingresa tu nota:', '');
    var div = document.getElementById('ejemplo05');
    if (nota>=4) {
        div.innerHTML = '<h3>' + nombre + ' está aprobado con un ' + nota + '</h3>';
    }
}

function ejemplo06(){
    var num1,num2;
    num1 = prompt('Ingresa el primer número:', '');
    num2 = prompt('Ingresa el segundo número:', '');
    num1 = parseInt(num1);
    num2 = parseInt(num2);
    var div = document.getElementById('ejemplo06');
    if (num1>num2) {
        div.innerHTML = '<h3>El mayor es ' + num1 + '</h3>';
    }
    else {
        div.innerHTML = '<h3>El mayor es ' + num2 + '</h3>';
    }
}

function ejemplo07(){
    var nota1,nota2,nota3;
    nota1 = prompt('Ingresa 1ra. nota:', '');
    nota2 = prompt('Ingresa 2da. nota:', '');
    nota3 = prompt('Ingresa 3ra. nota:', '');

    //Convertimos los 3 string en enteros
    nota1 = parseInt(nota1);
    nota2 = parseInt(nota2);
    nota3 = parseInt(nota3);
    var pro;
    pro = (nota1+nota2+nota3)/3;
    var div = document.getElementById('ejemplo07');
    if (pro>=7) {
        div.innerHTML = '<h3>Aprobado</h3>';
    }
    else {
        if (pro>=4) {
            div.innerHTML = '<h3>Regular</h3>';
        }
        else {
            div.innerHTML = '<h3>Reprobado</h3>';
        }
    }
}

function ejemplo08(){
    var valor;
    valor = prompt('Ingresar un valor comprendido entre 1 y 5:', '' );
    //Convertimos a entero
    valor = parseInt(valor);
    var div = document.getElementById('ejemplo08');
    switch (valor) {
        case 1: div.innerHTML = '<h3>Uno</h3>';
        break;
        case 2: div.innerHTML = '<h3>Dos</h3>';
        break;
        case 3: div.innerHTML = '<h3>Tres</h3>';
        break;
        case 4: div.innerHTML = '<h3>Cuatro</h3>';
        break;
        case 5: div.innerHTML = '<h3>Cinco</h3>';
        break;
        default: div.innerHTML = '<h3>Debe ingresar un valor comprendido entre 1 y 5.</h3>';
    }
}

function ejemplo09(){
    var col;
    col = prompt('Ingresa el color con que quierar pintar el fondo de la ventana (rojo, verde, azul)' , '' );
    var div = document.getElementById('ejemplo09');
    div.style.width = '200px'; 
    div.style.height = '200px';
    div.style.border = '2px solid black';
    div.style.marginBottom = '20px';
    switch (col) {
        case 'rojo': div.style.backgroundColor = '#ff0000';
        break;
        case 'verde': div.style.backgroundColor = '#00ff00';
        break;
        case 'azul': div.style.backgroundColor = '#0000ff';
        break;
    }
}

function ejemplo10(){
    var div = document.getElementById('ejemplo10');
}

function ejemplo11(){
    var div = document.getElementById('ejemplo11');
}

function ejemplo12(){
    var div = document.getElementById('ejemplo12');
}

function ejemplo13(){
    var div = document.getElementById('ejemplo13');
}

function ejemplo14(){
    var div = document.getElementById('ejemplo14');
}

function ejemplo15(){
    var div = document.getElementById('ejemplo15');
}

function ejemplo16(){
    var div = document.getElementById('ejemplo16');
}

function ejemplo17(){
    var div = document.getElementById('ejemplo17');
}

function ejemplo18(){
    var div = document.getElementById('ejemplo18');
}