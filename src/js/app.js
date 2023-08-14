//Variables para el buscador
const buscadorInput = document.querySelector('#inputSearch');
box_search =document.getElementById("box-search");
bars_search =document.getElementById("ctn-bars-search");
cover_ctn_search =document.getElementById("cover-ctn-search");
inputSearch =document.getElementById("inputSearch");
box_search =document.getElementById("box-search");

//Variables para el carrito
const carrito = document.querySelector('#carrito');
const carrito1 = document.querySelector('#carrito1');
const irboton = document.querySelector('.ir');
const inputDetalles = document.querySelector('#irDetalles');
const listaProductos = document.querySelector('#lista-productos');
const listaCompra=document.querySelector('#lista-compra');
const contenedorCompra = document.querySelector('#lista-compra tbody');
const contenedorCarrito = document.querySelector('#lista-carrito tbody');
const listaCa = document.querySelector('#lista-carrito');
const vaciarCarritoBtn = document.querySelector('#vaciar-carrito'); 
const imagenCarrito = document.querySelector('#img-carrito');
const Xcerrar = document.querySelector('.borrar-carrito');
const mens = document.querySelector('#mensaje-carrito');
const divSub = document.querySelector('.subtotal');
const totalCompra=document.querySelector('#totalCompra');

const mensCompra=document.querySelector('#mensaje-compra');
const procesarCompra=document.querySelector('#procesar-compra');
const actualizarpago=document.querySelector('#actualizar-pago');
const mostrarCont=document.querySelector('#mostrar-contenido');
const spinnerC = document.querySelector('#spiner');

const listaDetalles= document.querySelector('.contenedor-app');

const usuario=document.querySelector('#idUsuario');

let articulosCarrito = [];
let cantDeta=1;


// CUANDO CARGUE LA PAGINA SE EJECUTARÁ ESTAS FUNCIONES:
document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
    
    
});

function iniciarApp() {
    
    consultarAPI();//backend
    CargarlocalStorage();
    if(actualizarpago){
        Spinner();
        actualizarInventario();
    }

}


async function consultarAPI() {

    try {
        //! const url =`${location.origin}/api/productos`;
        const url = '/api/productos';
        const resultado = await fetch(url);
        
        const datos = await resultado.json();
        
        mostrarProductos(datos['productos']);
        
    }
    
     catch (error) {
        console.log(error);
    }
}
/////////////////////////////////////

//FUNCIONES CARRITO(AGREGAR,ELIMINAR,ETC)

    // Listeners
    cargarEventListeners();

function cargarEventListeners() {
    
     // Dispara cuando se presiona "Agregar Carrito"
    if(listaProductos!=null){
        listaProductos.addEventListener('click', agregarCurso);
    }
    if(listaDetalles!=null){
        listaDetalles.addEventListener('click', agregarManga);
        listaDetalles.addEventListener('click', eliminarManga);
    }

    // Cuando se elimina un curso del carrito
    carrito.addEventListener('click', eliminarCurso);
    if(carrito1!=null){
        carrito1.addEventListener('click', eliminarCurso);
    }
    
    // Al Vaciar el carrito
    vaciarCarritoBtn.addEventListener('click', () =>{
        articulosCarrito=[];
        localStorage.removeItem('carrito');
        limpiarHtml(contenedorCarrito);
        limpiarHtml(divSub);
        mens.style.display='block';
        vaciarCarritoBtn.style.display='none';
        irboton.style.display='none';
        listaCa.style.display='none';
    });

    imagenCarrito.addEventListener('click', function(){
        clickCarrito('ventana')
    });
    Xcerrar.addEventListener('click', function(){
        clickCarrito('ventana')
    });
    irboton.addEventListener('click', function(){
        window.location = `/carrito`;
    });
    if(procesarCompra!=null){
        procesarCompra.addEventListener('click', realizarCompra);
    }

    
}

function CargarlocalStorage(){
    articulosCarrito = JSON.parse( localStorage.getItem('carrito') ) || []  ;
    token = JSON.parse( localStorage.getItem('token') ) || ''  ;
        // console.log(articulosCarrito);
    carritoHTML();
    if(contenedorCompra!==null){
        compraHTML();
    }

    if(articulosCarrito.length===0){
        vaciarCarritoBtn.style.display = 'none';
        listaCa.style.display = 'none';
        if(contenedorCompra!=null){
            listaCompra.style.display='none';
            mensCompra.style.display='block';
            procesarCompra.style.display='none';
        }
    }else{
        vaciarCarritoBtn.style.display = 'block';
        listaCa.style.display = 'block';
        mens.style.display = 'none';
    }

    
    
}

function agregarManga(e){
    e.preventDefault();
    
    if(e.target.classList.contains('agregar-carrito')){
        vaciarCarritoBtn.style.display = 'block';
        listaCa.style.display = 'block';
        mens.style.display = 'none';
        irboton.style.display='block';
        const manga = e.target.parentElement.parentElement.parentElement;
        cantStr= document.querySelector('#cantidadDe').textContent;
        cantDeta=parseInt(cantStr);
        return leerDatosCurso(manga,'manga');
    }
    
}
function eliminarManga(e){
    e.preventDefault();
    if(e.target.classList.contains('btn-info') ) {
        cantDeta++;
        document.querySelector('#cantidadDe').textContent=cantDeta;
    }

    if(e.target.classList.contains('btn-danger') ) {
        if(cantDeta>1){
            cantDeta--;
            document.querySelector('#cantidadDe').textContent=cantDeta;
        }
    }
}

// Función que añade el curso al carrito
function agregarCurso(e) {
    e.preventDefault();
    
    // Delegation para agregar-carrito
    if(e.target.classList.contains('agregar-carrito')) {
        vaciarCarritoBtn.style.display = 'block';
        listaCa.style.display = 'block';
        mens.style.display = 'none';
        irboton.style.display='block';
        const curso = e.target.parentElement;
        // console.log(curso.querySelector('button').getAttribute('data-id'));
        
        // Enviamos el curso seleccionado para tomar sus datos
        return leerDatosCurso(curso,'curso');
    }

    const manga = e.target.parentElement.dataset.manga;
    // console.log(manga)
    // return
    if(manga){
        return irDetalles(manga);
    }
    
}

function irDetalles(manga){
    window.location = `/detalles?id=${manga}`;
}

// Lee los datos del curso
function leerDatosCurso(curso,tipo) {
    const infoCurso = {
        imagen: curso.querySelector('img').src,
        titulo: curso.querySelector('span').textContent,
        precio: curso.querySelector('.precioC span').textContent,
        id: curso.querySelector('button').getAttribute('data-id'), 
        cantidad: tipo==='curso' ? 1 : cantDeta,
        stock: curso.querySelector('.stock span').textContent
    }
    console.log(infoCurso)
    

    if( articulosCarrito.some( curso => curso.id === infoCurso.id ) ) { 
        const cursos = articulosCarrito.map( curso => {
            if( curso.id === infoCurso.id ) {
                curso.cantidad +=  infoCurso.cantidad;
                return curso;
            } else {
                return curso;
            }
        })
        articulosCarrito = [...cursos];
        clickCarrito('producto');
        console.log(articulosCarrito)
    }else {
        articulosCarrito = [infoCurso,...articulosCarrito];//esto es lo más importante para agregar al inicio del array, si quieres agregar al final: [...articulosCarrito,infoCurso];

        clickCarrito('producto');
        
    }


    // console.log(articulosCarrito)
    carritoHTML();
}

// Elimina el curso del carrito en el DOM
function eliminarCurso(e) {
    e.preventDefault();

    if(e.target.classList.contains('borrar-curso') ) {
        // e.target.parentElement.parentElement.remove();
        const curso = e.target.parentElement;
        const cursoId = curso.querySelector('a').getAttribute('data-id');
        
        // Eliminar del arreglo del carrito
        articulosCarrito = articulosCarrito.filter(curso => curso.id !== cursoId);
        carritoHTML();
        if(contenedorCompra!=null){
            compraHTML();
        }
        if(articulosCarrito.length===0){
            mens.style.display='block';
            vaciarCarritoBtn.style.display='none';
            irboton.style.display='none';
            listaCa.style.display='none';
            if(contenedorCompra!=null){
                listaCompra.style.display='none';
                mensCompra.style.display='block';
                procesarCompra.style.display='none';
            }
        }
        
    }
    
    if(e.target.classList.contains('btn-info') ) {
        const curso = e.target.parentElement;
        const cursoId = curso.querySelector('button').getAttribute('data-id');

        const cursos = articulosCarrito.map( curso => {
            if( curso.id === cursoId ) {
                let cantidad = parseInt(curso.cantidad);
                cantidad++
                curso.cantidad =  cantidad;
                return curso;
            } else {
                return curso;
            }
        })
        articulosCarrito = [...cursos];

        carritoHTML();
        if(contenedorCompra!=null){
            compraHTML();
        }
    }

    if(e.target.classList.contains('btn-danger') ) {
        const curso = e.target.parentElement;
        const cursoId = curso.querySelector('button').getAttribute('data-id');

        const cursos = articulosCarrito.map( curso => {
            if( curso.id === cursoId ) {
                let cantidad = parseInt(curso.cantidad);
                cantidad--
                curso.cantidad =  cantidad;
                return curso;
            } else {
                return curso;
            }

        })

        articulosCarrito = cursos.filter(curso => curso.cantidad !== 0);

        carritoHTML();
        if(contenedorCompra!=null){
            compraHTML();
        }

        if(articulosCarrito.length===0){
            mens.style.display='block';
            vaciarCarritoBtn.style.display='none';
            irboton.style.display='none';
            listaCa.style.display='none';
            if(contenedorCompra!=null){
                listaCompra.style.display='none';
                mensCompra.style.display='block';
                procesarCompra.style.display='none';
            }
        }

    }
}

// Muestra el curso seleccionado en el Carrito
function carritoHTML() {

    limpiarHtml(contenedorCarrito);

    articulosCarrito.forEach(curso => {
        const row = document.createElement('tr');
        row.setAttribute("style", "border-bottom: 1px solid #E1E1E1;");
        row.innerHTML = `
            <td>  
                <img src="${curso.imagen}" width=100>
            </td>
            <td>${curso.titulo}</td>
            <td class="price">S/. ${curso.precio}</td>
            <td >
            <button class="btn btn-info btn-sm" style="padding-left: 1rem;" data-id="${curso.id}">
                +
            </button>
            <p class="cant">${curso.cantidad}</p>
            <button class="btn btn-danger btn-sm" style="padding-left: 1.3rem;" data-id="${curso.id}">
            -
            </button>
            </td>
            
            <td>
                <a href="#" class="borrar-curso" data-id="${curso.id}">X</a>
            </td>
            
        `;
        contenedorCarrito.appendChild(row);//cada vez que hagas un append child, tienes que removerlo con la funcion vaciar()
        
    });
    
        
    // });

    let totalCarrito = calcularTotalCarrito();
    if(totalCarrito>0){

        limpiarHtml(divSub);
        limpiarHtml(irboton);

        // Crear el elemento div
        // Crear el elemento span para el texto "Subtotal del carrito:"
        const spanLabel = document.createElement('span');
        spanLabel.textContent = 'Subtotal del carrito: ';

        // Crear el elemento span para el precio
        const spanPrice = document.createElement('span');
        spanPrice.classList.add('price');
        spanPrice.textContent = `S/. ${totalCarrito} `;

        // Crear el elemento <a>
        const enlaceCarrito = document.createElement('a');

        // Establecer el valor del atributo href
        enlaceCarrito.href = '/carrito';

        // Establecer el valor del atributo id
        enlaceCarrito.id = 'ir-carrito';

        // Establecer el valor de la clase
        enlaceCarrito.className = 'boton';

        // Establecer el texto del enlace
        enlaceCarrito.textContent = 'Ver y editar carrito';

        // Agregar el enlace al documento
        

        // Agregar los elementos span al elemento div
        divSub.appendChild(spanLabel);
        divSub.appendChild(spanPrice);
        irboton.appendChild(enlaceCarrito);
        // divSub.appendChild(irPaginaCarro);
    }else{
        limpiarHtml(divSub);
    }
    
    
    // NUEVO:
    sincronizarStorage();
}

function compraHTML() {

    limpiarHtml(contenedorCompra);

    articulosCarrito.forEach(curso => {
        const row1 = document.createElement('tr');
        row1.setAttribute("style", "border-bottom: 1px solid #E1E1E1;");
        row1.innerHTML = `
            <td>  
                <img src="${curso.imagen}" width=100>
            </td>
            <td>${curso.titulo}</td>
            <td class="price">S/. ${curso.precio}</td>
            <td >
            <button class="btn btn-info btn-sm" style="padding-left: 1rem;" data-id="${curso.id}">
                +
            </button>
            <p class="cant">${curso.cantidad}</p>
            <button class="btn btn-danger btn-sm" style="padding-left: 1.3rem;" data-id="${curso.id}">
            -
            </button>
            </td>
            <td>
                <p class="price">S/. ${curso.cantidad*curso.precio}</p>
            </td>
            <td>
                <a href="#" class="borrar-curso" data-id="${curso.id}">X</a>
            </td>
            
        `;
        contenedorCompra.appendChild(row1);
        
    });
}
// NUEVO: 
function sincronizarStorage() {
    localStorage.setItem('carrito', JSON.stringify(articulosCarrito));
}

function calcularTotalCarrito(){
    const total = articulosCarrito.reduce((acc, { cantidad, precio }) => {
        return acc + cantidad * precio;
    }, 0);
    if(totalCompra!=null){
        totalCompra.textContent=`S/. ${total}`;
    }
    return total;
};


async function realizarCompra(e){
    e.preventDefault();//IMPORTANTE
    const totalCarrito = calcularTotalCarrito();

    const idU=usuario.textContent;
    if(idU===''){
        window.location.href='/login';
        return
    }
    //*MANERA SIMPLE SIN METODO DE PAGO:
    // let mensajeCompleto = '<h3>Resumen del pedido</h3>';
    //     mensajeCompleto += `
    //         <table style="margin-bottom: 10px;">
    //             <thead class="mensaje-alerta">
    //                 <tr>
    //                     <th >Nombre</th>
    //                     <th >Cantidad</th>
    //                     <th style="padding-left: 3.5rem;">Precio</th>
    //                 </tr>
    //             </thead>
    //             <tbody>
    //     `;

    //     articulosCarrito.forEach(producto => {
    //         mensajeCompleto += `
    //             <tr>
    //                 <td style="padding-left: 3rem;">${producto.titulo}</td>
    //                 <td style="padding-left: 3.5rem;">${producto.cantidad}</td>
    //                 <td style="padding-left: 3.5rem;">${producto.cantidad * producto.precio}</td>
    //             </tr>
    //         `;
    //     });

    //     mensajeCompleto += `
    //             </tbody>
    //         </table>
    //         <p class="price" >Total: ${totalCarrito}</p>
    //         <p style="margin-bottom: 20px;">¡Gracias por tu pedido! Por favor, paga mediante este qr y te enviaremos despues de la confirmacion.</p>
            

    //     `;
    //*

        // const idProductos=articulosCarrito.map(producto=>producto.id);
        const nombreProductos=articulosCarrito.map(producto=>producto.titulo);
        const precioProduct=articulosCarrito.map(producto=>producto.precio);
        const cantidad=articulosCarrito.map(producto=>producto.cantidad);
        
        const datos= new FormData();

        //TARJETA
        datos.append('idUsuario',idU);
        datos.append('nombre',nombreProductos);
        datos.append('cantidad',cantidad);
        datos.append('precio_unitario',precioProduct);
        

        try {
            //! const url =`${location.origin}/carrito`;
            const url = '/carrito'

            const respuesta=await fetch(url,{
            method:'POST',
            body:datos //IMPORTANTE PARA PASAR LOS DATOS AL FETCH
            });
            const resultado=await respuesta.json();
            // console.log(resultado);
            // return
            if(resultado){
                // token=resultado.token;
                // localStorage.setItem('token', JSON.stringify(token));
                window.location.href = resultado.session.url;
            }
        }catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al realizar la compra'
            })
        }
    
}

async function actualizarInventario(){
    const totalCarrito = calcularTotalCarrito();

    const idProductos=articulosCarrito.map(producto=>producto.id);
    // const nombreProductos=articulosCarrito.map(producto=>producto.titulo);
    const precioProduct=articulosCarrito.map(producto=>producto.precio);
    const cantidad=articulosCarrito.map(producto=>producto.cantidad);
    const fecha=document.querySelector('#fecha').textContent;
    const stock=articulosCarrito.map(producto=>parseInt(producto.stock));
    const idUsuario=usuario.textContent;

    const nuevoStock=stock.map((valor,indice)=>valor-cantidad[indice]);
    const precioVenta=articulosCarrito.map((producto,indice)=>producto.precio*cantidad[indice]);

    // Supongamos que la URL es: http://ejemplo.com/?parametro1=valor1&parametro2=valor2

    // Obtener la cadena de consulta de la URL
    const queryString = window.location.search;

    // Crear un nuevo objeto URLSearchParams con la cadena de consulta
    const params = new URLSearchParams(queryString);

    // Obtener el valor de un parámetro específico
    const parametro1 = params.get('token');

    const datos= new FormData();

    datos.append('idUsuario',idUsuario);
    datos.append('total',totalCarrito);
    datos.append('fecha_compra',fecha);

    //DETALLE COMPRA
    datos.append('productos',idProductos);
    
    datos.append('precio_unitario',precioProduct);
    datos.append('cantidad',cantidad);
    datos.append('precio_venta',precioVenta);

    //ACTUALIZAR PRODUCTO
    datos.append('stock',nuevoStock);


    try {
        //! const url =`${location.origin}/api/compras`;
        const url = '/api/compras'
        // const url = '/pagado'
        const respuesta=await fetch(url,{
        method:'POST',
        body:datos //IMPORTANTE PARA PASAR LOS DATOS AL FETCH
        });

        const resultado=await respuesta.json();

        // console.log(resultado);
    
        if(resultado) {
            localStorage.removeItem('carrito');
            CargarlocalStorage();
            irboton.style.display='none';
            mens.style.display='block';
            spinnerC.style.display='none';
            mostrarCont.style.display='block';
            

            // localStorage.removeItem('token');
            // token='';
            Swal.fire({
                icon: 'success',
                title: 'Compra Realizada',
                text: 'La compra fue realizada correctamente',
                button: 'OK'
            })

        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error al realizar la compra'
        })
    }

    
}

// function colocarToken(){
//     token1.value=token;
// }

// Elimina los cursos del carrito en el DOM
function limpiarHtml(selector) {
    // forma rapida (recomendada)
    while(selector.firstChild) {
        selector.removeChild(selector.firstChild);
    }
}

/////////////////////////////////////////

//HEADER: BUSCADOR, MOSTRAR PRODUCTOS EN EL BUSCADOR Y MOSTRAR EL CONTENEDOR CARRITO

function clickCarrito(tipo){
    let styles = window.getComputedStyle(carrito);
    
    if(tipo =='ventana'){
        if (styles.display === 'none') {
            carrito.style.display = 'block';
        } else {
            carrito.style.display = 'none';
        }
    }else if(tipo=='producto'){
        if(styles.display === 'none'){
            carrito.style.display = 'block';
        }else{
            carrito.style.display = 'block';
        }
    }
    
}

//Ejecutando funciones
document.getElementById("icon-search").addEventListener("click", mostrar_buscador);
document.getElementById("cover-ctn-search").addEventListener("click", ocultar_buscador);


//Funcion para mostrar el buscador
function mostrar_buscador(){

    bars_search.style.top = "80px";
    cover_ctn_search.style.display = "block";
    inputSearch.focus();

    if (inputSearch.value === ""){
        box_search.style.display = "none";
    }

}

//Funcion para ocultar el buscador
function ocultar_buscador(){

    bars_search.style.top = "-10px";
    cover_ctn_search.style.display = "none";
    inputSearch.value = "";
    box_search.style.display = "none";

}

function mostrarProductos(productos=[]) {
    productos.forEach( producto =>{
        // Crear el elemento <li>
        const li = document.createElement('li');

        // Crear el elemento <a> y establecer el atributo href
        const a = document.createElement('a');
        a.href = `/detalles?id=${producto.id}`;

        // Crear el elemento <i> y establecer la clase
        const i = document.createElement('i');
        i.className = 'fas fa-search';

        // Agregar el elemento <i> como hijo del elemento <a>
        a.appendChild(i);

        // Establecer el texto dentro del elemento <a>
        a.textContent = producto.Titulo;

        // Agregar el elemento <a> como hijo del elemento <li>
        li.appendChild(a);
        box_search.appendChild(li);
    });
    //BUSCADOR
    document.getElementById("inputSearch").addEventListener("keyup", buscador_interno);

    function buscador_interno(){

        filter = inputSearch.value.toUpperCase();
        li = box_search.getElementsByTagName("li");

        //Recorriendo elementos a filtrar mediante los "li"
        for (i = 0; i < li.length; i++){

            a = li[i].getElementsByTagName("a")[0];
            textValue = a.textContent || a.innerText;

            if(textValue.toUpperCase().indexOf(filter) > -1){

                li[i].style.display = "";
                box_search.style.display = "block";

                if (inputSearch.value === ""){
                    box_search.style.display = "none";
                }

            }else{
                li[i].style.display = "none";
            }
        }
    }
}
//////////////////////////////

function Spinner(){
    const divSpinner= document.createElement('div');
    divSpinner.classList.add('sk-circle');

    divSpinner.innerHTML = `
        <div class="sk-circle1 sk-child"></div>
        <div class="sk-circle2 sk-child"></div>
        <div class="sk-circle3 sk-child"></div>
        <div class="sk-circle4 sk-child"></div>
        <div class="sk-circle5 sk-child"></div>
        <div class="sk-circle6 sk-child"></div>
        <div class="sk-circle7 sk-child"></div>
        <div class="sk-circle8 sk-child"></div>
        <div class="sk-circle9 sk-child"></div>
        <div class="sk-circle10 sk-child"></div>
        <div class="sk-circle11 sk-child"></div>
        <div class="sk-circle12 sk-child"></div>
    `;
    spinnerC.appendChild(divSpinner);

}
