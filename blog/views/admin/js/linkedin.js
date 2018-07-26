let btnLinkedin = document.querySelector('#btnLinkedin');
let titulo = document.querySelector('#titulo');
let resumen = document.querySelector('#resumen');
let ruta = document.querySelector('#ruta').innerText;
let fotoPrincipal = document.querySelector('#fotoPrincipal').innerText;


btnLinkedin.addEventListener('click', sendShare, false);

function sendShare() {
	postContent = {
		"comment": "un comentario",
		"content": {
			"title": titulo ,
			"description": resumen,
			"submitted-url": ruta,
			"submitted-image_url": fotoPrincipal, 
		},
		"visibility": {
			"code": "anyone"
		}
	};
	let postcontent = JSON.stringify(postContent);
	console.log(postcontent);
	shareContent(postcontent);
}


function onLinkedInLoad() {
  IN.Event.on(IN, "auth", sendShare);
}

// Handle the successful return from the API call
function onSuccess(data) {
	console.log(data);
	alert("Post Successful!");
}

// Handle an error response from the API call
function onError(error) {
	console.log(error);
	alert("Oh no, something went wrong. Check the console for an error log.");
}

// Use the API call wrapper to share content on LinkedIn
function shareContent(pcontent) {
	IN.API.Raw("/people/~/shares?format=json")
	.method("POST")
	.body(pcontent)
	.result(onSuccess)
	.error(onError);
}