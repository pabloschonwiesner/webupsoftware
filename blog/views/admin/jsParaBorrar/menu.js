let usuario = document.querySelector('.usuario');
let menu = document.querySelector('.menu');


usuario.addEventListener('mouseover', mostrarMenu, false);
usuario.addEventListener('mouseout', ocultarMenu, false);

function mostrarMenu (el) {
	if(menu.className == 'menu') {
		menu.className = 'menu desplegado';
	}	
}

function ocultarMenu (el) {
	if(menu.className == 'menu desplegado') {
		menu.className = 'menu';
	}	
}