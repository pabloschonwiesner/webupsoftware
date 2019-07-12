let btnNewArticle = document.querySelector('#btnNewArticle')
let btnsToPost = document.querySelectorAll('.btnToPost')
let btnsModifyArticle = document.querySelectorAll('.btnModifyArticle') 
let btnsDeleteArticle = document.querySelectorAll('.btnDeleteArticle')

// listeners
btnNewArticle.addEventListener('click', fnNewArticle, false)
for(let i = 0 ; i < btnsToPost.length; i ++) {	
	btnsToPost[i].addEventListener('click', fnToPost, false)
}

for(let i = 0; i < btnsModifyArticle.length; i++) {
	btnsModifyArticle[i].addEventListener('click', fnModifyArticle, false)
}

for(let i = 0; i < btnsDeleteArticle.length; i++) {
	btnsDeleteArticle[i].addEventListener('click', fnDeleteArticle, false)
}

// functions

function fnNewArticle () {
	location.href = './newArticle'
}

function fnToPost (o) {
	let nroArticle = o.target.dataset.nroarticle
	alert(`El artículo ${nroArticle} fue publicado`)
}

function fnModifyArticle (o) {
	let nroArticle = o.target.dataset.nroarticle
	alert(`El artículo ${nroArticle} fue modificado`)
}

function fnDeleteArticle (o) {
	let nroArticle = o.target.dataset.nroarticle
	alert(`El artículo ${nroArticle} fue eliminado`)
}

