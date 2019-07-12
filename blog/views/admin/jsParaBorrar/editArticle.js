let btnSave = document.querySelector('#btnSave');
window.myFiles = [];
// let RUTA_IMAGENES = 'http://localhost:81/upsoftware/web/blog/public/media/images';
// let RUTA_EDIT = 'http://localhost:81/Upsoftware/web/blog/public/admin/edit/';
let RUTA_IMAGENES = 'http://www.upsoftware.com.ar/blog/media/images';
let RUTA_EDIT = 'http://www.upsoftware.com.ar/blog/admin/edit';
let desmarcaArtPpal = document.querySelector('#desmarcaArtPpal');
let marcaArtPpal = document.querySelector('#marcaArtPpal');


if(btnSave) {
	console.log('si')
	btnSave.addEventListener('click', fnSaveArticle, false);
}

Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = this.length - 1; i >= 0; i--) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}

function fnSaveArticle (event) {
	// debugger
	//event.preventDefault()
	let arr = window.location.pathname.split('/')
	let nroArticle = arr[arr.length -1]
	RUTA_IMAGENES = RUTA_IMAGENES + '/' + nroArticle + '/';
	let images = document.querySelectorAll('.medium-insert-images figure');
	
	for(i=0;i<images.length; i++) {
		img = images[i].querySelector('img');
		img.src = RUTA_IMAGENES + myFiles[i][0].files[0].name
		let clone = img.cloneNode(true)
		let figure = img.parentNode
		let div = figure.parentNode
		let edit = div.parentNode
		edit.replaceChild(clone, div);
	}
	ajaxSaveArticle(nroArticle);
}
	


function ajaxSaveArticle (nroArticle) {	
	let editable = document.querySelector('.editable.medium-editor-insert-plugin');
	let buttons = editable.getElementsByClassName('medium-insert-buttons')[0]
	if(buttons) buttons.parentNode.removeChild(buttons);
	let textoBlog = editable.innerHTML;
	// console.log(editable.innerHTML)
	let title = document.querySelector('#title').value
	let summary = document.querySelector('#summary').value ||''
	let file = document.querySelector('#file').value || ''
	let dataObject = `title=${title}&summary=${summary}&file=${file}&textoBlog=${textoBlog}`
	// console.log(dataObject)

	let url = `${RUTA_EDIT}/${nroArticle}`
	console.log(url)
	let type = 'POST'
	let r = new XMLHttpRequest()
	r.onreadystatechange = function () {
		if(r.readyState === 4 && r.status === 200) {
			let respuesta = r.responseText
			// console.log(respuesta)
		}
	}
	r.open(type, url, true)
	r.setRequestHeader("Content-Type", "image/*");
	r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	r.send(dataObject)
}

if(desmarcaArtPpal) desmarcaArtPpal.addEventListener('click', desmarcarArtPpal, true);
if(marcaArtPpal) marcaArtPpal.addEventListener('click', marcarArtPpal, true);

function desmarcarArtPpal () {
	event.preventDefault();
	alert('Para cambiar el artículo principal tenés que ir al artículo que irá en su lugar y chequear la casilla "Artículo principal" reemplazando al actual.');
}

function marcarArtPpal (element) {
	if(element.target.checked) {
		alert('Marcaste este artículo como principal. Cuando lo guardes reemplazará al articulo principal actualmente configurado. Si no queres que lo reemplace quitá el check a "Articulo principal".');
	}
}