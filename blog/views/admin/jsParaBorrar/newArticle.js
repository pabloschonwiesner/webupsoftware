let btnSave = document.querySelector('#btnSave')
window.myFiles = []
const RUTA_IMAGENES = 'http:////localhost:81//upsoftware//web//blog//public//media//images//'

btnSave.addEventListener('click', fnSaveArticle, false)

function fnSaveArticle (event) {
	// console.log('prueba')
	// //event.preventDefault()
	// let images = document.querySelectorAll('.medium-insert-images figure');
	// for(i=0;i<images.length; i++) {
	// 	img = images[i].querySelector('img');
	// 	// console.log('Antes: ' + img.src);
	// 	img.src = RUTA_IMAGENES + myFiles[i][0].files[0].name
	// 	console.log('Despues: ' + img.src)		
	// }
	// ajaxSaveArticle();
}
	


function ajaxSaveArticle () {
	let title = document.querySelector('#title').value
	let summary = document.querySelector('#summary').value ||''
	let file = document.querySelector('#file').value || ''
	let textoBlog = document.querySelector('#textoBlog').value || ''
	let dataObject = `title=${title}&summary=${summary}&file=${file}&textoBlog=${textoBlog}`
	console.log(dataObject)
	let url = './../newArticle.php'
	let type = 'POST'
	let r = new XMLHttpRequest()

	r.onreadystatechange = function () {
		if(r.readyState === 4 && r.status === 200) {
			let respuesta = r.responseText
			console.log(respuesta)
			if(respuesta) {
				location.href = "/"
			}
		}
	}
	r.open(type, url, true)
	r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
	r.send(dataObject)
}