

(function load() {
	var item = 0;
	var linea = 0;
	var i = 1;
	var dotA = document.querySelector('#dotA');
	var dotB = document.querySelector('#dotB');
	var dotC = document.querySelector('#dotC');
	var dotTextA = document.querySelector('#dotTextA');
	var dotTextB = document.querySelector('#dotTextB');
	var dotTextC = document.querySelector('#dotTextC');
	var msjA = document.querySelector('#msjA');
	var msjB = document.querySelector('#msjB');
	var msjC = document.querySelector('#msjC');
	var clientes = document.querySelector('#tiraDeClientes');
	var productoA = document.querySelector('#productoA');
	var productoB = document.querySelector('#productoB');
	var productoC = document.querySelector('#productoC');
	var productoD = document.querySelector('#productoD');
	var tituloProductoA = document.querySelector('#tituloProductoA');
	var tituloProductoB = document.querySelector('#tituloProductoB');
	var tituloProductoC = document.querySelector('#tituloProductoC');
	var tituloProductoD = document.querySelector('#tituloProductoD');
	var infoProductoA = document.querySelector('#infoProductoA');
	var infoProductoB = document.querySelector('#infoProductoB');
	var infoProductoC = document.querySelector('#infoProductoC');
	var infoProductoD = document.querySelector('#infoProductoD');
	var planifica = document.querySelector('#planifica');
	var btnSolicitar = document.querySelector('#btnSolicitar');
	var btnEntendido = document.querySelector('#btnEntendido');
	var modal = document.querySelector('#modal');
	var btnMenu = document.querySelector('#botonMenu');
	var ld = document.querySelector('#listaDesordenada');
	var menu = document.querySelector('#menu');
	var itemMenu = document.querySelectorAll('.itemMenu');
	var linkItemMenu = document.querySelectorAll('.linkItemMenu');
	var iconoMenu = document.querySelector('#iconoMenu');
	var inicioMenu = document.querySelector('#inicioMenu');
	var productosMenu = document.querySelector('#productosMenu');
	var nosotrosMenu = document.querySelector('#nosotrosMenu');
	var blogMenu = document.querySelector('#blogMenu');
	var contactoMenu = document.querySelector('#contactoMenu');
	
	//articulos de blog
	var articulos = document.querySelectorAll('.articulo');
	console.log(articulos)
	for(let a=0; a<articulos.length;a++) {
		articulos[a].addEventListener('click', enlaceArticulo, false);
	}

	function enlaceArticulo() {
		let this_ = this;
		data = this_.dataset;
		window.location = data.ruta;
	}

	dotA.addEventListener('click', selectDotA);
	dotB.addEventListener('click', selectDotB);
	dotC.addEventListener('click', selectDotC);

	function selectDotA() {
		dotA.className = "dot fondoCeleste";
		dotB.className = "dot fondoBlanco";
		dotC.className = "dot fondoBlanco";
		dotTextA.className = "celeste";
		dotTextB.className = "white";
		dotTextC.className = "white";

		msjA.className = "art block";
		msjB.className = "art none";
		msjC.className = "art none";
	}

	function selectDotB() {
		dotA.className = "dot fondoBlanco";
		dotB.className = "dot fondoCeleste";
		dotC.className = "dot fondoBlanco";
		dotTextA.className = "white";
		dotTextB.className = "celeste";
		dotTextC.className = "white";

		msjA.className = "art none";
		msjB.className = "art block";
		msjC.className = "art none";
	}

	function selectDotC() {
		dotA.className = "dot fondoBlanco";
		dotB.className = "dot fondoBlanco";
		dotC.className = "dot fondoCeleste";
		dotTextA.className = "white";
		dotTextB.className = "white";
		dotTextC.className = "celeste";

		msjA.className = "art none";
		msjB.className = "art none";
		msjC.className = "art block";
	}

	setInterval(mjsCalesita, 2200);
	
	function mjsCalesita() {	
		
		if(item===4) {
			item=0;
		}

		if(item===3) {
			item++;
		}

		if(item===2) {
			selectDotC();
			item++;
		}

		if(item===1) {
			selectDotB();
			item++;
		}

		if(item===0) {
			selectDotA();
			item++;
		}
	}

	let anchoPantalla = screen.width;
	let vh = window.innerHeight / 100;
	window.addEventListener('scroll',function(e){
		//console.log('scrollY: ' + window.scrollY + ' / innerHeight: ' + window.innerHeight)

		var header = document.querySelector("#header");
		var logo = document.querySelector("#imgLogo");

		if(window.scrollY > (90 * vh)){
				header.className = 'headerWhite';
				logo.src = 'media/images/isologoBlack.svg';
				iconoMenu.src = 'media/images/boton-menu.svg';
		}

		if(window.scrollY <= (90 * vh)){
				header.className = 'headerTransparent';
				logo.src = 'media/images/isologo.svg';
				iconoMenu.src = 'media/images/boton-menu-blanco.svg';
		}

		if(anchoPantalla>=600 ){
			if(window.scrollY > (90 * vh)){
				inicioMenu.style.color = 'black';
				productosMenu.style.color = '#0099ff';
				nosotrosMenu.style.color = 'black';
				blogMenu.style.color = 'black';
				contactoMenu.style.color = 'black';
			};

			if(window.scrollY <= (90 * vh)){
				inicioMenu.style.color = '#0099ff';
				productosMenu.style.color = 'white';
				nosotrosMenu.style.color = 'white';
				blogMenu.style.color = 'white';
				contactoMenu.style.color = 'white';
			}

			if(window.scrollY > (135 * vh)){
				inicioMenu.style.color = 'black';
				productosMenu.style.color = '#0099ff';
				nosotrosMenu.style.color = 'black';
				blogMenu.style.color = 'black';
				contactoMenu.style.color = 'black';
			} 

			if(window.scrollY > (230 * vh)) {
				inicioMenu.style.color = 'black';
				productosMenu.style.color = 'black';
				nosotrosMenu.style.color = '#0099ff';
				blogMenu.style.color = 'black';
				contactoMenu.style.color = 'black';
			}

			if(window.scrollY >  (630 * vh)) {
				inicioMenu.style.color = 'black';
				productosMenu.style.color = 'black';
				nosotrosMenu.style.color = 'black';
				blogMenu.style.color = 'black';
				contactoMenu.style.color = '#0099ff';
			}
		}
	});	

	productoA.addEventListener('click', productoAActivo, true);
	productoA.addEventListener('mouseenter', productoAActivo, true);
	productoB.addEventListener('click', productoBActivo, true);
	productoB.addEventListener('mouseenter', productoBActivo, true);
	productoC.addEventListener('click', productoCActivo, true);
	productoC.addEventListener('mouseenter', productoCActivo, true);
	productoD.addEventListener('click', productoDActivo, true);
	productoD.addEventListener('mouseenter', productoDActivo, true);

	
	function productoAActivo() {
		infoProductoA.className = 'detalleInfoProducto activo';
		infoProductoB.className = 'detalleInfoProducto desactivo';
		infoProductoC.className = 'detalleInfoProducto desactivo';
		infoProductoD.className = 'detalleInfoProducto desactivo';
		productoA.className = 'productos productoAActivo';
		productoB.className = 'productos productoBDesactivo';
		productoC.className = 'productos productoCDesactivo';
		productoD.className = 'productos productoDDesactivo';
		tituloProductoA.className = 'tituloProductoAActivo'
		tituloProductoB.className = 'tituloProductoB'
		tituloProductoC.className = 'tituloProductoC'
		tituloProductoD.className = 'tituloProductoD'
	}

	function productoBActivo() {
		infoProductoA.className = 'detalleInfoProducto desactivo';
		infoProductoB.className = 'detalleInfoProducto activo';
		infoProductoC.className = 'detalleInfoProducto desactivo';
		infoProductoD.className = 'detalleInfoProducto desactivo';
		productoA.className = 'productos productoADesactivo';
		productoB.className = 'productos productoBActivo';
		productoC.className = 'productos productoCDesactivo';
		productoD.className = 'productos productoDDesactivo';
		tituloProductoA.className = 'tituloProductoA'
		tituloProductoB.className = 'tituloProductoBActivo'
		tituloProductoC.className = 'tituloProductoC'
		tituloProductoD.className = 'tituloProductoD'
	}

	function productoCActivo() {
		infoProductoA.className = 'detalleInfoProducto desactivo';
		infoProductoB.className = 'detalleInfoProducto desactivo';
		infoProductoC.className = 'detalleInfoProducto activo';
		infoProductoD.className = 'detalleInfoProducto desactivo';
		productoA.className = 'productos productoADesactivo';
		productoB.className = 'productos productoBDesactivo';
		productoC.className = 'productos productoCActivo';
		productoD.className = 'productos productoDDesactivo';
		tituloProductoA.className = 'tituloProductoA'
		tituloProductoB.className = 'tituloProductoB'
		tituloProductoC.className = 'tituloProductoCActivo'
		tituloProductoD.className = 'tituloProductoD'
	}

	function productoDActivo() {
		infoProductoA.className = 'detalleInfoProducto desactivo';
		infoProductoB.className = 'detalleInfoProducto desactivo';
		infoProductoC.className = 'detalleInfoProducto desactivo';
		infoProductoD.className = 'detalleInfoProducto activo';
		productoA.className = 'productos productoADesactivo';
		productoB.className = 'productos productoBDesactivo';
		productoC.className = 'productos productoCDesactivo';
		productoD.className = 'productos productoDActivo';
		tituloProductoA.className = 'tituloProductoA'
		tituloProductoB.className = 'tituloProductoB'
		tituloProductoC.className = 'tituloProductoC'
		tituloProductoD.className = 'tituloProductoDActivo'
	}

	btnEntendido.addEventListener('click', function() {
		modal.className = 'modalInvisible';
	})

	function cerrarMenu() {
		for (var a = 0; a < itemMenu.length; a++) {
			itemMenu[a].className = 'itemMenu menuCerrado';
		}
	}

	function cerrarMenuClick() {
		if(i==1){
			for (var a = 0; a < itemMenu.length; a++) {
			itemMenu[a].className = 'itemMenu';
		}
			i=2;
		}else{
			i=1;
			cerrarMenu();
		}	
	}

	btnMenu.addEventListener('click', cerrarMenuClick,true);

	var a=itemMenu.length;
	for(var z=0;z<a;z++){
		itemMenu[z].addEventListener('click',cerrarMenuClick,false);
	}

	cerrarMenu();

})();

